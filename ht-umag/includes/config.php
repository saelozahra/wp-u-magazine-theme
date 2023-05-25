<?php
/**
 * Configuration of the current theme
 */

// theme name
define('THEME_NAME', 'UMAG');


// custom meta boxes
require_once HT_THEME_INC_DIR . 'meta-boxes/index.php';

// paginattion
if (!function_exists('wp_pagenavi')) {
    require_once (HT_THEME_INC_DIR . 'lib/wp-pagenavi.php');
}

// zilla like
require_once (HT_THEME_INC_DIR .'lib/zilla-likes/zilla-likes.php');

