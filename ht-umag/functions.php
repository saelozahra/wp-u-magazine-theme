<?php
/*
HighThemes.com
Twitter: theHighThemes

*/

/**
 * Including the admin framework
 */
require_once ('framework/init.php');


/**
 * Theme Functions
 */
require_once (HT_THEME_INC_DIR .'functions.php');


/**
 * Redirect the uesr to admin options
 */
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
    wp_redirect(admin_url("themes.php?page=ot-theme-options"));
}
?>