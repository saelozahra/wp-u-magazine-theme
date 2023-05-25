
<!-- FOOTER STARTS
			========================================================================= -->
<footer class="footer">
	<?php if( ot_get_option('footer_status') == 'on' ):?>
	<!-- 1ST ROW STARTS -->
	<div class="row1 <?php if(ot_get_option('full-boxed') == 'boxed') echo 'container';?>">
		<div class="<?php echo ht_get_container_class();?>">
				<?php if( ot_get_option('footer-cols') != '0' ) { ?>
					<div class="row clearfix">
						<?php if( ot_get_option('footer-cols') == '2' ) { ?>
							<div class="col-lg-6">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div><!-- /grid3 -->
							<div class="col-lg-6">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</div><!-- /grid3 -->
						<?php } elseif( ot_get_option('footer-cols') == '3' ) { ?>
							<div class="col-lg-4">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div><!-- /grid3 -->
							<div class="col-lg-4">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</div><!-- /grid3 -->
							<div class="col-lg-4">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</div><!-- /grid3 -->
						<?php } elseif( ot_get_option('footer-cols') == '4' ) { ?>
							<div class="col-lg-3">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div><!-- /grid3 -->
							<div class="col-lg-3">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</div><!-- /grid3 -->
							<div class="col-lg-3">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</div><!-- /grid3 -->
							<div class="col-lg-3">
								<?php dynamic_sidebar( 'footer-4' ); ?>
							</div><!-- /grid3 -->
						<?php } else { ?>
							<div class="col-lg-12">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div><!-- /grid3 -->
						<?php } ?>
					</div><!-- /row -->
				<?php } ?>

		</div>
	</div>
	<!-- 1ST ROW ENDS -->
	<?php endif;?>
	<?php if( ot_get_option('2nd_footer_status') == 'on' ):?>

	<!-- 2ND ROW STARTS -->
	<div class="row2">
		<div class="container">
			<?php if( ot_get_option('2nd-footer-cols') != '0' ) { ?>
				<div class="row clearfix">
					<?php if( ot_get_option('2nd-footer-cols') == '2' ) { ?>
						<div class="col-lg-6">
							<?php dynamic_sidebar( '2nd-footer-1' ); ?>
						</div><!-- /grid3 -->
						<div class="col-lg-6">
							<?php dynamic_sidebar( '2nd-footer-2' ); ?>
						</div><!-- /grid3 -->
					<?php } elseif( ot_get_option('2nd-footer-cols') == '3' ) { ?>
						<div class="col-lg-4">
							<?php dynamic_sidebar( '2nd-footer-1' ); ?>
						</div><!-- /grid3 -->
						<div class="col-lg-4">
							<?php dynamic_sidebar( '2nd-footer-2' ); ?>
						</div><!-- /grid3 -->
						<div class="col-lg-4">
							<?php dynamic_sidebar( '2nd-footer-3' ); ?>
						</div><!-- /grid3 -->
					<?php } elseif( ot_get_option('2nd-footer-cols') == '4' ) { ?>
						<div class="col-lg-3">
							<?php dynamic_sidebar( '2nd-footer-1' ); ?>
						</div><!-- /grid3 -->
						<div class="col-lg-3">
							<?php dynamic_sidebar( '2nd-footer-2' ); ?>
						</div><!-- /grid3 -->
						<div class="col-lg-3">
							<?php dynamic_sidebar( '2nd-footer-3' ); ?>
						</div><!-- /grid3 -->
						<div class="col-lg-3">
							<?php dynamic_sidebar( '2nd-footer-4' ); ?>
						</div><!-- /grid3 -->
					<?php } else { ?>
						<div class="col-lg-12">
							<?php dynamic_sidebar( '2nd-footer-1' ); ?>
						</div><!-- /grid3 -->
					<?php } ?>
				</div><!-- /row -->
			<?php } ?>
		</div>
	</div>
	<!-- 2ND ROW ENDS -->
	<?php endif;?>
	<?php if( ot_get_option('sub_footer_status') == 'on' ):?>
	<!-- 3RD ROW STARTS -->
	<div class="row3">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 copyright"><?php echo ot_get_option('footer_text');?></div>
			</div>
		</div>
	</div>
	<!-- 3RD ROW ENDS -->
	<?php endif;?>
</footer>
<!-- /. FOOTER ENDS
    ========================================================================= -->
<?php
$retina_out = '';

if( ot_get_option('retina_logo_url') != '' || ot_get_option('retina_dark_logo_url') != '' ) {
	$retina_out .='
	<script>
	jQuery(document).ready(function () {
		var retina = (window.devicePixelRatio > 1 || (window.matchMedia && window.matchMedia("(-webkit-min-device-pixel-ratio: 1.5),(-moz-min-device-pixel-ratio: 1.5),(min-device-pixel-ratio: 1.5)").matches) );
		if(retina) {
			var defaultWidth = jQuery(".logo img").width();
	';

	if( ot_get_option('retina_logo_url') != '' ) {
		$retina_out .='jQuery(".logo img").attr("src", "'.esc_url(ot_get_option('retina_logo_url')).'").css("width", defaultWidth + "px");';
	}

	if( ot_get_option('retina_dark_logo_url') != '' && ot_get_option('dark') == 'on' ) {
		$retina_out .='jQuery(".logo img").attr("src", "'.esc_url(ot_get_option('retina_dark_logo_url')).'").css("width", defaultWidth + "px");';
	}

	// escaped above
	$retina_out .='
		}
	});
	</script>
	';
	echo $retina_out;
}
?>

</div><!-- /end #layout -->
<!-- TO TOP STARTS
    ========================================================================= -->
<?php if( ot_get_option('Back_to_top') == 'on' ) : ?>
	<a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
<?php endif; ?>
<!-- /. TO TOP ENDS
    ========================================================================= -->
<?php if( ot_get_option('custom-codes-footer') != '' ) echo ot_get_option('custom-codes-footer'); ?>
<?php wp_footer(); ?>

</body>
</html>