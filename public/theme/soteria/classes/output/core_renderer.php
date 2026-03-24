<?php
namespace theme_soteria\output;

defined('MOODLE_INTERNAL') || die();

class core_renderer extends \theme_boost\output\core_renderer {
    // We must extend the Boost core_renderer so that layouts from Boost
    // which use Boost-specific renderer methods (like firstview_fakeblocks)
    // do not crash when rendered by Soteria.
}
