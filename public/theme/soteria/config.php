<?php
// This file is part of Moodle - http://moodle.org/

defined('MOODLE_INTERNAL') || die();

$THEME->name        = 'soteria';
$THEME->parents     = ['boost'];
$THEME->enable_dock = false;
$THEME->editor_sheets = [];

// SCSS pipeline: inject Soteria variables before Boost compiles.
$THEME->scss = function(theme_config $theme) {
    return theme_soteria_get_main_scss_content($theme);
};

$THEME->prescsscallback = 'theme_soteria_get_pre_scss';
$THEME->extrascsscallback = 'theme_soteria_get_extra_scss';

$THEME->layouts = [];  // Inherit all layouts from Boost.

$THEME->requiredblocks = '';
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;

$THEME->haseditswitch = true;
$THEME->usescourseindex = true;
$THEME->activityheaderconfig = [
    'notitle' => true,
];
