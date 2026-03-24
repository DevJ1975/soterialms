# Soteria LMS — Administrator Instructions

**Platform:** Moodle 4.x | **Theme:** Soteria (Boost child) | **Delivery:** SCORM 1.2

---

## Table of Contents

1. [Initial Server Installation](#1-initial-server-installation)
2. [Activate the Soteria Theme](#2-activate-the-soteria-theme)
3. [Install Required Plugins](#3-install-required-plugins)
4. [Run Soteria Local Plugin Setup](#4-run-soteria-local-plugin-setup)
5. [Configure Site Settings](#5-configure-site-settings)
6. [Create a Training Course](#6-create-a-training-course)
7. [Upload a SCORM Module](#7-upload-a-scorm-module)
8. [Set Up Completion & Certificates](#8-set-up-completion--certificates)
9. [Configure Recurring Training](#9-configure-recurring-training)
10. [Reporting & Compliance Dashboards](#10-reporting--compliance-dashboards)
11. [User & Enrolment Management](#11-user--enrolment-management)
12. [Daily Admin Tasks & Maintenance](#12-daily-admin-tasks--maintenance)
13. [Troubleshooting](#13-troubleshooting)

---

## 1. Initial Server Installation

> **Rule:** Never modify Moodle core files. All customization is done through themes, plugins, and admin settings.

### Prerequisites

| Requirement | Minimum Version |
|-------------|----------------|
| PHP | 8.1+ |
| MySQL / MariaDB | 8.0 / 10.6+ |
| Web server | Apache 2.4 or Nginx |
| PHP extensions | `mbstring`, `xml`, `curl`, `zip`, `gd`, `sodium`, `intl` |

### Install/Upgrade Moodle

Place the Moodle codebase into your web root (e.g., `/var/www/html/moodle`), then:

```bash
# Copy the sample config and edit database credentials
cp config-dist.php config.php
nano config.php

# Set the data directory (outside the web root!)
$CFG->dataroot = '/var/moodledata';

# Run the CLI installer
php public/admin/cli/install.php
```

Accept all prompts. When complete, the site will be accessible at your configured URL.

---

## 2. Activate the Soteria Theme

The Soteria theme is located in `public/theme/soteria/` and is a child of Boost.

### Via Admin UI

1. Go to **Site Administration → Appearance → Themes → Theme Selector**
2. Click **"Change theme"** next to **Default**
3. Select **Soteria** → click **"Use theme"**

### Via CLI

```bash
php public/admin/cli/cfg.php --name=theme --set=soteria
```

### Purge theme cache (after any SCSS change)

```bash
php public/admin/cli/purge_caches.php
```

---

## 3. Install Required Plugins

Download each plugin as a `.zip` from [moodle.org/plugins](https://moodle.org/plugins) and extract it into the folder listed below.

| Plugin | Folder | Plugin ID |
|--------|--------|-----------|
| Tiles course format | `public/course/format/tiles/` | `format_tiles` |
| Completion Progress (block) | `public/blocks/completion_progress/` | `block_completion_progress` |
| Configurable Reports (block) | `public/blocks/configurable_reports/` | `block_configurable_reports` |
| Custom Certificate | `public/mod/customcert/` | `mod_customcert` |
| Reengagement activity | `public/mod/reengagement/` | `mod_reengagement` |
| Course Recompletion | `public/local/recompletion/` | `local_recompletion` |

After all folders are in place, run the upgrade:

```bash
php public/admin/cli/upgrade.php --non-interactive
```

**Verify:** Go to **Site Administration → Plugins → Plugins Overview** — all 6 plugins should show **"Installed"**.

---

## 4. Run Soteria Local Plugin Setup

The `local_soteria` plugin (located at `public/local/soteria/`) registers Soteria-specific admin settings and seeds defaults.

It installs automatically when you run the upgrade script above. After install:

1. Go to **Site Administration → Local plugins → Soteria LMS Settings**
2. Confirm or adjust these values:

| Setting | Default | Notes |
|---------|---------|-------|
| Module prefix | `SOT` | Used in SCORM naming (e.g., SOT-LOTO-001) |
| Pass score threshold | `80` % | Minimum score for pass |
| Default recompletion period | `365` days | Annual retraining cycle |
| Organisation name | `Soteria LMS` | Appears on certificates |
| Support email | *(blank)* | Set your admin/support email |

---

## 5. Configure Site Settings

### Course Format

1. **Site Administration → Courses → Course default settings**
2. Set **Course format** to **Tiles**
3. Set **Number of sections** to match typical module count (e.g., 10)

### Completion Tracking

1. **Site Administration → Advanced features**
2. Enable **Completion tracking** ✓
3. Enable **Conditional activities** ✓

### Grade Display

1. **Site Administration → Grades → General settings**
2. Set **Grade display type** to **Percentage**
3. Set **Overall decimal points** to `0`

### Language & Timezone

1. **Site Administration → Location → Location settings**
2. Set **Default timezone** to your region (e.g., `America/Los_Angeles`)

---

## 6. Create a Training Course

1. Go to **Site Administration → Courses → Manage courses and categories**
2. Click **"Create new course"**
3. Fill in:
   - **Full name:** e.g., `Lockout/Tagout Safety Training`
   - **Short name:** e.g., `SOT-LOTO-001`
   - **Course format:** Tiles
   - **Enable completion tracking:** Yes
4. Click **"Save and display"**

### Add Blocks to the Course

In editing mode, add these blocks to the sidebar:
- **Completion Progress** — shows learner progress bar
- **Configurable Reports** (for admin/manager view only)

---

## 7. Upload a SCORM Module

### Naming Convention

All SCORM packages must follow this format:

```
SOT-[TOPIC]-[NUMBER].zip
```

Examples:
- `SOT-LOTO-001.zip` — Lockout/Tagout
- `SOT-FORK-002.zip` — Forklift Safety
- `SOT-HF-003.zip` — Hand & Finger Safety

### Steps

1. Inside the course, click **"Add an activity or resource"**
2. Select **SCORM package** → click **Add**
3. Fill in:
   - **Name:** Match the ZIP filename (e.g., `SOT-LOTO-001`)
   - **Package:** Upload your `.zip` file
4. Under **Grading:**
   - Grading method: **Highest attempt**
   - Maximum grade: `100`
   - Pass mark: `80`
5. Under **Attempts management:**
   - Number of attempts: **Unlimited**
6. Under **Compatibility:**
   - Force completed: **No** (let SCORM report its own status)
7. Click **"Save and return to course"**

> **Tip:** Always test the SCORM package in Moodle's preview mode before making the course available to learners.

---

## 8. Set Up Completion & Certificates

### Activity Completion

1. Edit the SCORM activity → **Activity completion** tab
2. Set: **Show activity as complete when conditions are met**
3. Check: **Require grade** — minimum grade: `80`

### Course Completion

1. **Course Administration → Course completion**
2. Set: **Condition - Activity completion** → select the SCORM activity
3. Save

### Custom Certificate

1. **Add an activity or resource → Custom Certificate**
2. Design the certificate:
   - Add element: **Course name**
   - Add element: **Student name**
   - Add element: **Date completed**
   - Add element: **Grade** (from the SCORM activity)
   - Add a logo or signature image if available
3. Under **Required activities**, select the SCORM activity
4. Save

Learners will see a **"Download Certificate"** button once they pass.

---

## 9. Configure Recurring Training

Use **Course Recompletion** for annual or periodic retraining.

1. Go to **Course Administration → Recompletion**
2. Set **Recompletion period** (e.g., `365` days)
3. Under **Reset options**, check:
   - SCORM attempts ✓
   - Grades ✓
   - Activity completion ✓
   - Certificates ✓ (so a new certificate is issued each cycle)
4. Save

### Add Reminder Emails (Reengagement activity)

1. **Add activity → Reengagement**
2. Set **Days until due:** `330` (remind 35 days before 1-year mark)
3. Compose an email reminding learners to retake the training
4. Save

---

## 10. Reporting & Compliance Dashboards

### SCORM Completion Report (built-in)

1. **Course Administration → Reports → SCORM**
2. View pass/fail per learner, per attempt

### Configurable Reports (block)

1. Go to any course with the **Configurable Reports** block
2. Click **"Add report"**
3. Suggested reports to create:

| Report Name | Columns |
|-------------|---------|
| Course Completion Status | User, Course, Completed (Y/N), Date |
| SCORM Pass/Fail | User, Module, Score, Status, Date |
| Overdue Training | User, Course, Days Overdue |

4. Set a schedule to email reports to managers

### Admin Report (site-wide)

- **Site Administration → Reports → Course completion** — shows every user's completion across all courses in one view

---

## 11. User & Enrolment Management

### Add a Single User

1. **Site Administration → Users → Add a new user**
2. Fill in username, password, name, email
3. Click **Create user**

### Bulk Upload Users (CSV)

1. **Site Administration → Users → Upload users**
2. CSV format:
   ```
   username,password,firstname,lastname,email,course1
   jsmith,Temp@1234,John,Smith,jsmith@example.com,SOT-LOTO-001
   ```
3. Upload and review the preview — click **"Upload users"**

### Enrol Users in a Course

1. Inside the course → **Course Administration → Users → Enrolled users**
2. Click **"Enrol users"**
3. Search and select users → click **"Enrol selected users"**

### Assign Roles

| Role | Use Case |
|------|---------|
| Manager | Client admin / supervisor — can view reports |
| Teacher | Course author — can edit and manage content |
| Student | Learner — takes courses |

---

## 12. Daily Admin Tasks & Maintenance

### Cron (Required — must run every minute)

Add this to the server's crontab (`crontab -e`):

```bash
* * * * * /usr/bin/php /path/to/moodle/public/admin/cli/cron.php >> /dev/null 2>&1
```

Cron handles:
- Reengagement reminder emails
- Scheduled report delivery
- Course recompletion triggers
- Notification queues

### Cache Purge

Run after any configuration or theme change:

```bash
php public/admin/cli/purge_caches.php
```

Or via UI: **Site Administration → Development → Purge all caches**

### Backups

1. **Site Administration → Courses → Backups → General backup defaults**
2. Schedule automatic daily backups
3. Store backup files **outside** the web root

### Moodle Upgrade

```bash
# Always backup first, then:
git pull   # or replace files manually
php public/admin/cli/upgrade.php --non-interactive
php public/admin/cli/purge_caches.php
```

---

## 13. Troubleshooting

| Problem | Solution |
|---------|---------|
| SCORM doesn't track completion | Ensure "Force completed" is off; check SCORM package has reporting enabled in Adobe Captivate |
| Certificate not appearing | Verify course completion criteria are met and the certificate activity has the SCORM listed as a required activity |
| Emails not sending | Check cron is running: **Site Administration → Server → Cron** — confirm last run timestamp |
| Theme not showing Soteria styles | Run `php public/admin/cli/purge_caches.php` and hard-refresh the browser |
| Plugin shows "Needs upgrading" | Run `php public/admin/cli/upgrade.php --non-interactive` |
| Learner stuck on SCORM | Ask learner to clear browser cache; check SCORM compatibility settings in the activity |
| Recompletion not resetting | Confirm cron is running and the recompletion period has actually elapsed |

---

*Last updated: March 2026 | Maintained by Trainovate Tech*
