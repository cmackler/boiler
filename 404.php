<?php get_header(); ?>
<div id="content-wrapper" class="wrapper clearfix">
	<div class="content-container container clearfix">
		<div class="content clearfix">
			<?php the_post(); ?>
				<div class="col-md-8 col-sm-8 entry-content">
					<h1>Page Not Found</h1>
					<p><?php _e('Nothing found for the requested page. Try a search instead?'); ?></p>
<?php get_search_form(); ?>
				</div>
					<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>