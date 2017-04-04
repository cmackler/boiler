<?php get_header(); ?>
<div id="content-wrapper" class="wrapper clearfix">
	<div class="content-container container clearfix">
		<div class="content clearfix">
				<div class="col-md-9 col-sm-8 entry-content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'entry' ); ?>
					<?php //comments_template('', true); ?>
					<?php endwhile; endif; ?>
					
					<?php get_template_part( 'nav', 'below-single' ); ?>
				</div>
					<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>