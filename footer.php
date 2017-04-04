
<div id="footer-wrapper" class="wrapper clearfix">
	<div class="container clearfix">
			<div id="footer" class="clearfix">
				<div class="footer-nav clearfix">
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
				</div>
				<div class="copyright clearfix">
					<?php dynamic_sidebar('copyright'); ?>
				</div>
			</div>
	</div>	
</div>
<?php wp_footer(); ?>
<!--<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fitvids.js"></script>-->
<!--<script>
  jQuery(document).ready(function(){
    // Target your .container, .wrapper, .post, etc.
    jQuery(".video-container").fitVids();
  });
</script>-->
</body>
</html>

