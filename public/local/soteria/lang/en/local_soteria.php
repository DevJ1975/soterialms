<?php
// This file is part of Moodle - http://moodle.org/

defined('MOODLE_INTERNAL') || die();

// Plugin name & description
$string['pluginname']             = 'Soteria LMS Settings';
$string['plugindesc']             = 'Configuration settings for the Soteria LMS platform.';

// Naming section
$string['naming_heading']         = 'SCORM Module Naming Convention';
$string['naming_heading_desc']    = 'Enforce the SOT-XXXX-NNN naming standard for all SCORM packages uploaded into Moodle.';
$string['scorm_prefix']           = 'Module prefix';
$string['scorm_prefix_desc']      = 'Three-letter prefix used in SCORM package names, e.g. <strong>SOT</strong>-LOTO-001.';

// Compliance section
$string['compliance_heading']     = 'Compliance Defaults';
$string['compliance_heading_desc'] = 'Default thresholds applied to new SCORM activities.';
$string['pass_threshold']         = 'Pass score threshold (%)';
$string['pass_threshold_desc']    = 'Minimum score a learner must achieve to be marked as passed.';
$string['recompletion_period']    = 'Default recompletion period';
$string['recompletion_period_desc'] = 'How often learners must retake training when using the Course Recompletion plugin.';
$string['days90']                 = 'Every 90 days';
$string['days180']                = 'Every 180 days';
$string['days365']                = 'Annually (365 days)';

// Branding section
$string['branding_heading']       = 'Branding';
$string['org_name']               = 'Organisation name';
$string['org_name_desc']          = 'Displayed in certificates and system emails.';
$string['support_email']          = 'Support email address';
$string['support_email_desc']     = 'Learner-facing contact email shown in notification messages.';
