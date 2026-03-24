<?php
// This file is part of Moodle - http://moodle.org/
// Runs once on plugin install to seed default config values.

defined('MOODLE_INTERNAL') || die();

/**
 * Install function — seed Soteria LMS default configuration.
 * @return bool
 */
function xmldb_local_soteria_install(): bool {
    // Only set defaults if not already configured.
    $defaults = [
        'scorm_prefix'        => 'SOT',
        'pass_threshold'      => '80',
        'recompletion_period' => '365',
        'org_name'            => 'Soteria LMS',
        'support_email'       => '',
    ];

    foreach ($defaults as $key => $value) {
        if (!get_config('local_soteria', $key)) {
            set_config($key, $value, 'local_soteria');
        }
    }

    return true;
}
