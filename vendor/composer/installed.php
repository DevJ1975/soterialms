<?php return array(
    'root' => array(
        'name' => 'moodle/moodle',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '3e03ce2fcc0cc5744b1d080936135e0fe174e88c',
        'type' => 'moodle-core',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => false,
    ),
    'versions' => array(
        'moodle/lms' => array(
            'dev_requirement' => false,
            'provided' => array(
                0 => '5.1',
            ),
        ),
        'moodle/moodle' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '3e03ce2fcc0cc5744b1d080936135e0fe174e88c',
            'type' => 'moodle-core',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
    ),
);
