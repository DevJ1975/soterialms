<?php
// This file is part of Moodle - http://moodle.org/

defined('MOODLE_INTERNAL') || die();

/**
 * Returns the main SCSS content for the Soteria theme.
 *
 * @param theme_config $theme The theme object.
 * @return string SCSS code.
 */
function theme_soteria_get_main_scss_content(theme_config $theme): string {
    global $CFG;

    $scss = '';

    // Load Soteria custom SCSS.
    $filename = "{$CFG->dirroot}/theme/soteria/scss/soteria.scss";
    if (is_readable($filename)) {
        $scss .= file_get_contents($filename);
    }

    // Append parent (Boost) SCSS.
    $parenttheme = theme_config::load('boost');
    $scss .= theme_boost_get_main_scss_content($parenttheme);

    return $scss;
}

/**
 * Inject Soteria variable overrides BEFORE Boost compiles.
 *
 * @param theme_config $theme The theme object.
 * @return string SCSS variables.
 */
function theme_soteria_get_pre_scss(theme_config $theme): string {
    global $CFG;

    $scss = '';
    $filename = "{$CFG->dirroot}/theme/soteria/scss/_variables.scss";
    if (is_readable($filename)) {
        $scss .= file_get_contents($filename);
    }

    return $scss;
}

/**
 * Inject extra SCSS AFTER Boost compiles (overrides).
 *
 * @param theme_config $theme The theme object.
 * @return string SCSS overrides.
 */
function theme_soteria_get_extra_scss(theme_config $theme): string {
    return '';
}
