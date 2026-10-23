# Backend — RaedApp

Server-side code. See [architecture.md](architecture.md) for the big picture,
[structure.md](structure.md) for layout.

## Models (`app/Models/`, 41)
Eloquent models using shared traits in `app/Traits/`:
- **`BelongsToSchool`** — tenant `school_id` auto-fill + `forSchool()` scope.
- **`HasUuid`** — public `uuid` for route keys.
- **`HasReference`** — human reference codes (e.g. `TCH-0001`, `INV-…`).
- **`Auditable`** — spatie/activitylog.
- **`HasAttachments`** — media.

Domain graph: School → AcademicYear → AcademicCycle → Grade → SchoolClass. Students enroll
(`Enrollment`) into a class/year; Guardians link to Students. Finance: `FeeSchedule`/`FeeItem` →
`StudentFeePlan` → `Invoice` → `Payment` (+ `PaymentAllocation`, `PaymentFollowup`) / `Expense`.
Academics: `Subject`, `Assessment` → `StudentScore` → `ReportCard` (+ subjects, approval workflow,
templates). Attendance: `AttendanceSession` → `AttendanceEntry`. Timetable: `TimetableTemplate`/
`TimetableEntry`/`TimetableOverride`, `Room`. Comms: `Announcement`, `Message`/`MessageThread`/
`MessageRecipient`, `CarnetEntry`. Plus `ScheduledTask`, `DmoneyTransaction`, `DeviceToken`, `ContactMessage`.

> Note: `Student`/`Teacher`/`Guardian` use a single `name` column (migrations dropped
> `first_name`/`last_name`); access via the `full_name` accessor.

## Enums (`app/Enums/`, 15)
`InvoiceStatus`, `PaymentStatus`, `InvoiceType`, `AttendanceStatus`, `EnrollmentStatus`,
`ReportCardStatus`, `AssessmentType`, `FeeScheduleType`, `ReportPeriod`, `GenderType`,
`GuardianRelation`, `AnnouncementLevel`, `AttachmentCategory`, `ScheduledTaskType`, `TaskFrequency`.
Prefer these over magic strings.

## Actions (`app/Actions/`, 6) — single-purpose writes
`CreateEnrollmentAction`, `ConfirmEnrollmentAction`, `RecordPaymentAction`,
`GenerateReportCardAction`, `SyncDmoneyPayment`, `ProvisionSchoolDefaults`.
Wired as singletons in `AppServiceProvider`.

## Services (`app/Services/`, 7) — domain logic
`InvoiceService`, `AttendanceService`, `ReportCardService`, `EnrollmentService`,
`BillingApiService`, `WhatsAppService`, `CredentialsNotifier`.

## Notifications & channels
- `app/Notifications/` (5): `AttendanceAlertNotification`, `InvoiceGeneratedNotification`,
  `InvoiceOverdueNotification`, `NewAnnouncementNotification`, `PaymentConfirmedNotification`.
  Most are `ShouldQueue` → **require the `raedapp-queue` worker running**.
- **Channels:** `mail`, `database`, and custom **`whatsapp`** (`App\Channels\WhatsAppChannel`,
  registered in `AppServiceProvider::boot`).
- A notification opts into WhatsApp by implementing any of: `toWhatsapp()` (text),
  `toWhatsappImage()` (`[url, caption]`), `toWhatsappDocument()` (`[url, filename, caption]`).
  The channel resolves the number via `routeNotificationForWhatsApp()` (User→Guardian bridge).
- ⚠️ **Current state is mixed**: payment confirmations are WhatsApp-only; attendance/invoice/
  announcement are mail+database. Goal: **dual-channel (mail + whatsapp) on all** — add the
  missing `toMail()`/`toWhatsapp()` + set each `via()` to both.

### WhatsApp integration (OpenWA / sahansolution)
`WhatsAppService` uses a session-based OpenWA gateway. Config: `config/services.php` `openwa.*`
from env (`OPENWA_ENABLED`, `OPENWA_BASE_URL`, `OPENWA_KEY`, `OPENWA_SESSION_ID`).
- **Prod gateway:** `OPENWA_BASE_URL=https://wa.sahansolution.com/api` (runs on the same VPS).
- Auth: `X-API-Key` header. Endpoint: `POST sessions/{sessionId}/messages/send-text|send-image|send-document`.
- Recipient is a **chatId**: `<digits>@c.us` (strip `+`/spaces). Verified working end-to-end.
- Webhooks (inbound) optional: `POST sessions/{id}/webhooks`, events `message.received` etc.,
  HMAC-SHA256 signature in `X-OpenWA-Signature` (would read `config('services.sahanwa.secret')`).

### Email
Mailables in `app/Mail/`, templates in `resources/views/emails/`. Prod SMTP = **Hostinger Email**:
`MAIL_HOST=smtp.hostinger.com`, `MAIL_PORT=465`, `MAIL_SCHEME=smtps`,
**`MAIL_USERNAME=contact@raedapp.tech`** (the real mailbox — `noreply@` is only an *alias*, has no
password), `MAIL_FROM_ADDRESS=noreply@raedapp.tech`. SPF + DKIM (3×) + DMARC are on the domain DNS.

## D-Money / Billing
`config/billing.php` + `BillingApiService` + `DmoneyTransaction`. Default gateway
`api.raedapp.com` (override with `BILLING_API_URL`). Create payment → poll notify endpoint.
Guardian portal pays invoices; callbacks `/guardian/paiement/{succes,annule}`.
Webhook `POST /webhooks/billing` (CSRF-exempt, verified via `BILLING_WEBHOOK_SECRET`).

## Console / scheduled
`app/Console/Commands/`: `tasks:dispatch` (every minute — fires due `ScheduledTask`s),
`ProvisionSchool`, `SeedSchoolAcademics`, `SeedSchoolTestUsers`, `TestWhatsApp`, `NotifyTest`.

## Controllers (`app/Http/Controllers/`)
Only non-Livewire flows: `Finance/InvoiceExportController` (PDF/XLSX), `Finance/ReceiptController`,
`DMoneyPaymentController`, `WebhookController`, `ContactController`, `Api/AuthController` (Sanctum).

## Migrations — cross-DB note
Works on both SQLite (local) and MySQL (prod). `2026_03_21_200001_drop_first_last_name_from_students_table`
is **driver-aware**: it only explicitly `dropIndex(['school_id','last_name'])` on **SQLite**
(SQLite can't drop a column an index references). On **MySQL** the explicit drop fails ("needed in a
foreign key constraint") — there the column drop reduces the index automatically. Keep new
destructive migrations driver-aware.

## Seeders & demo logins
`php artisan migrate:fresh --seed` → "École Démo RaedApp" + "Les Petits Futés". All passwords
`password`. Staff: `admin@raedapp.com` (super-admin), `directeur@/proviseur@/comptable@/caissier@/
surveillant@raedapp.com`. Teachers `*@ecole-demo.dj`, parents `*@parent.ecole-demo.dj`, students
`*@eleve.ecole-demo.dj`. (Seed emails rebranded scolapp.com → raedapp.com.)
