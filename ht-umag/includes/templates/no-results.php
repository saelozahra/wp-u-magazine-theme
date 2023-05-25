<?php if ( is_search() ) : ?>
		<div class="no-result col-md-12">
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'highthemes' ); ?></p>
	        <?php get_search_form(); ?>
		</div><!-- .post-area  -->
<?php else : ?>
		<div class="no-result col-md-12">
	        <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'highthemes' ); ?></p>
	        <?php get_search_form(); ?>
		</div><!-- .post-area  -->
<?php endif; ?>