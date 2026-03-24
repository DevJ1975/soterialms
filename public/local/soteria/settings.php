<?php
// This file is part of Moodle - http://moodle.org/

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {

    $settings = new admin_settingpage(
        'local_soteria',
        get_string('pluginname', 'local_soteria')
    );

    $ADMIN->add('localplugins', $settings);

    // -------------------------------------------------------------------------
    // SCORM Naming Convention
    // -------------------------------------------------------------------------
    $settings->add(new admin_setting_heading(
        'local_soteria/naming_heading',
        get_string('naming_heading', 'local_soteria'),
        get_string('naming_heading_desc', 'local_soteria')
    ));

    $settings->add(new admin_setting_configtext(
        'local_soteria/scorm_prefix',
        get_string('scorm_prefix', 'local_soteria'),
        get_string('scorm_prefix_desc', 'local_soteria'),
        'SOT',
        PARAM_ALPHANUMEXT
    ));

    // -------------------------------------------------------------------------
    // Compliance Defaults
    // -------------------------------------------------------------------------
    $settings->add(new admin_setting_heading(
        'local_soteria/compliance_heading',
        get_string('compliance_heading', 'local_soteria'),
        get_string('compliance_heading_desc', 'local_soteria')
    ));

    $settings->add(new admin_setting_configtext(
        'local_soteria/pass_threshold',
        get_string('pass_threshold', 'local_soteria'),
        get_string('pass_threshold_desc', 'local_soteria'),
        '80',
        PARAM_INT
    ));

    $settings->add(new admin_setting_configselect(
        'local_soteria/recompletion_period',
        get_string('recompletion_period', 'local_soteria'),
        get_string('recompletion_period_desc', 'local_soteria'),
        '365',
        [
            '90'  => get_string('days90', 'local_soteria'),
            '180' => get_string('days180', 'local_soteria'),
            '365' => get_string('days365', 'local_soteria'),
        ]
    ));

    // -------------------------------------------------------------------------
    // Contact / Branding
    // -------------------------------------------------------------------------
    $settings->add(new admin_setting_heading(
        'local_soteria/branding_heading',
        get_string('branding_heading', 'local_soteria'),
        ''
    ));

    $settings->add(new admin_setting_configtext(
        'local_soteria/org_name',
        get_string('org_name', 'local_soteria'),
        get_string('org_name_desc', 'local_soteria'),
        'Soteria LMS',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configtext(
        'local_soteria/support_email',
        get_string('support_email', 'local_soteria'),
        get_string('support_email_desc', 'local_soteria'),
        '',
        PARAM_EMAIL
    ));
}
