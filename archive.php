<?php get_header(); ?>
<div id="content-wrapper" class="wrapper clearfix">
	<div class="content-container container clearfix">
		<div class="content clearfix">
			<?php the_post(); ?>
				<div class="col-md-8 col-sm-8 entry-content">
					<?php if ( is_day() ) : ?>
<h1 class="page-title"><?php printf( __( 'Daily Archives: %s', 'boiler' ), '<span>' . get_the_time(get_option('date_format')) . '</span>' ) ?></h1>
<?php elseif ( is_month() ) : ?>
<h1 class="page-title"><?php printf( __( 'Monthly Archives: %s', 'boiler' ), '<span>' . get_the_time('F Y') . '</span>' ) ?></h1>
<?php elseif ( is_year() ) : ?>
<h1 class="page-title"><?php printf( __( 'Yearly Archives: %s', 'boiler' ), '<span>' . get_the_time('Y') . '</span>' ) ?></h1>
<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
<h1 class="page-title"><?php _e('Blog Archives', 'boiler' ); ?></h1>
<?php endif; ?>
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