<?php get_header(); ?>
<div id="content-wrapper" class="wrapper clearfix">
	<div class="content-container container clearfix">
		<div class="content clearfix">
			<?php the_post(); ?>
				<div class="col-md-8 col-sm-8 entry-content">
					<?php the_post(); ?>
<h1 class="page-title"><?php _e( 'Tag Archives:', 'boiler' ) ?> <span><?php single_tag_title() ?></span></h1>
<?php rewind_posts(); ?>
<?php get_template_part( 'nav', 'above' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php endwhile; ?>
<?php get_template_part( 'nav', 'below' ); ?>
				</div>
					<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>