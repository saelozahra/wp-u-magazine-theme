<hr>
<!-- Share this post starts -->
<div class="sharepost">
	<ul>
		<li><?php _e('SHARE THIS POST','highthemes');?></li>
		<li class="facebook">
			<div class="icon"><a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink());?>"><i class="fa fa-facebook"></i></a></div>
		</li>
		<li class="twitter">
			<div class="icon"><a href="https://twitter.com/share?url=<?php echo urlencode(get_permalink());?>&amp;text=<?php echo urlencode(get_the_title());?>"><i class="fa fa-twitter"></i></a></div>
		</li>
		<li class="linkedin">
			<div class="icon"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink());?>"><i class="fa fa-linkedin"></i></a></div>
		</li>
		<li class="google-plus">
			<div class="icon"><a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink());?>"><i class="fa fa-google-plus"></i></a></div>
		</li>

	</ul>
	<div class="clearfix"></div>
</div>
<!-- Share this post ends -->