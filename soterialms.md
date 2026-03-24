# Adobe Captivate Configuration for Soteria LMS

## Recommended Publishing Standard
Use **SCORM 1.2** as the default export format for Adobe Captivate modules uploaded into Moodle.

Reason:
- Stable Moodle workflow
- Strong compatibility
- Easier setup and tracking for launch version

---

## Captivate Delivery Method
Upload each Adobe Captivate course as a **SCORM ZIP package** inside Moodle using the native **SCORM activity**.

Best practice:
- One training module per ZIP package
- Consistent naming convention
- Enable reporting in Captivate before publishing
- Test each package in Moodle before release

Example naming:
- SOT-LOTO-001
- SOT-FORK-002
- SOT-HF-003

---

## Recommended Plugins for Captivate-Based Courses

### 1. Course Presentation
Use one of these course format plugins:
- Tiles format
- Cards format

Purpose:
- Improve visual layout
- Make modules feel modern and app-like
- Better fit Soteria branding

### 2. Progress Tracking
- Completion Progress

Purpose:
- Visual learner progress
- Better compliance visibility
- Easier experience for learners and admins

### 3. Reporting
- Configurable Reports

Purpose:
- SCORM completion reporting
- Pass/fail dashboards
- Client reporting views

### 4. Certificates
- Custom certificate

Purpose:
- Branded PDF certificates
- Completion-based certification
- Better compliance documentation

### 5. Reminder Automation
- Reengagement

Purpose:
- Remind learners to complete overdue training
- Improve compliance follow-through

### 6. Recurring Training
- Course recompletion

Purpose:
- Support annual or periodic retraining
- Reset completion states as needed

---

## Optional Advanced Tracking
If advanced learning analytics are needed later, evaluate:
- xAPI Launch Link

Use only if:
- An external Learning Record Store (LRS) will be used
- More detailed activity statements are required beyond standard SCORM tracking

For launch:
> Prefer SCORM first, xAPI later if needed

---

## Captivate Design Guidelines for Soteria
- Keep modules mobile-aware
- Use clear navigation
- Keep fonts readable
- Avoid overly dense slides
- Match Soteria colors where possible
- Keep module lengths manageable

---

## Implementation Rule
Do not modify Moodle core code.

Use:
- Native SCORM activity
- Theme styling
- Plugins
- Admin settings
- Language customization

---

## Setup Guide

### Step 1 — Activate Soteria Theme

1. Log in as Moodle admin
2. Go to **Site Administration → Appearance → Themes → Theme Selector**
3. Select **Soteria** and click **"Use theme"**

Or via CLI:
```bash
php public/admin/cli/cfg.php --name=theme --set=soteria
```

---

### Step 2 — Install Required Plugins

Download each plugin from [moodle.org/plugins](https://moodle.org/plugins) and place it in the directory listed. Then run the upgrade script.

| Plugin | Directory | Moodle Plugin ID |
|--------|-----------|-----------------|
| Tiles course format | `public/course/format/tiles/` | `format_tiles` |
| Completion Progress (block) | `public/blocks/completion_progress/` | `block_completion_progress` |
| Configurable Reports (block) | `public/blocks/configurable_reports/` | `block_configurable_reports` |
| Custom Certificate | `public/mod/customcert/` | `mod_customcert` |
| Reengagement | `public/mod/reengagement/` | `mod_reengagement` |
| Course Recompletion | `public/local/recompletion/` | `local_recompletion` |

After placing all plugin folders, run:
```bash
php public/admin/cli/upgrade.php --non-interactive
```

Verify installation:
- Browse to **Site Administration → Plugins → Plugins Overview**
- All 6 plugins should show status **"Installed"**

---

### Step 3 — Configure Soteria Admin Settings

Go to **Site Administration → Local plugins → Soteria LMS Settings** and configure:

| Setting | Recommended Value |
|---------|------------------|
| Module prefix | `SOT` |
| Pass score threshold | `80` (%) |
| Default recompletion period | `365` days (annual) |
| Organisation name | `Soteria LMS` |
| Support email | *(your support address)* |

---

### Step 4 — Add a SCORM Activity (per course)

1. Inside a course, click **"Add an activity or resource"**
2. Choose **SCORM package**
3. Upload your `.zip` file (e.g., `SOT-LOTO-001.zip`)
4. Under **Grading**, set:
   - Grading method: **Highest attempt**
   - Maximum grade: **100**
   - Pass mark: **80**
5. Under **Attempts management**, set **Number of attempts** to **Unlimited** (learners can retry)
6. Enable **"Require grade"** as the course completion condition

---

### Step 5 — Set Up Recurring Training

1. On the target course, go to **Course Administration → Recompletion**
2. Set the recompletion period (e.g., **365 days**)
3. Choose which data to reset (SCORM, grades, certificates)
4. Save

Add a **Reengagement** activity to the same course to send automated reminder emails before the recompletion deadline.

---

### Step 6 — Verify Core Integrity

After all setup, confirm no Moodle core files were changed:

```bash
cd "/Users/jamiljones/Axiom Dropbox/Trainovate Tech/Soteria LMS/moodle"
git diff --name-only HEAD -- public/lib public/admin/lib public/mod/scorm
```

Expected result: **no output** (zero core changes).