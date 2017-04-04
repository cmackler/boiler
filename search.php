<?php get_header(); ?>
<div id="content-wrapper" class="wrapper clearfix">
	<div class="content-container container clearfix">
		<div class="content clearfix">
			<?php the_post(); ?>
				<div class="col-md-8 col-sm-8 entry-content">
										<?php if ( have_posts() ) : ?>
<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'boiler' ), '<span>' . get_search_query()  . '</span>' ); ?></h1>
<?php get_template_part( 'nav', 'above' ); ?>
<?php while ( have_posts() ) : the_post() ?>
<?php get_template_part( 'entry' ); ?>
<?php endwhile; ?>
<?php get_template_part( 'nav', 'below' ); ?>
<?php else : ?>
<div id="post-0" class="post no-results not-found">
<h2 class="entry-title"><?php _e( 'Nothing Found', 'boiler' ) ?></h2>
<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'boiler' ); ?></p>
<?php get_search_form(); ?>
</div>
<?php endif; ?>
				</div>
					<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>