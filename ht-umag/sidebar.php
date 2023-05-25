<?php 
wp_reset_postdata();
$s_p = ht_sidebar_primary();

// show sidebar
if ( is_active_sidebar( $s_p ) ) {
    dynamic_sidebar($s_p);
}
?>
