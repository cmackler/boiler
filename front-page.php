<?php get_header(); ?>
<div id="content-wrapper" class="wrapper clearfix">
	<div class="content-container container clearfix">
		<div class="content clearfix">
			<?php the_post(); ?>
				<div class="entry-content col-md-9 col-sm-8 clearfix">
					<?php if ( has_post_thumbnail() ) {the_post_thumbnail();} ?>
					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'boiler' ) . '&after=</div>') ?>
					<?php edit_post_link( __( 'Edit', 'boiler' ), '<div class="edit-link">', '</div>' ) ?>
				</div>
				<?php get_sidebar(); ?>
		</div>
			<?php get_sidebar(ctas4); ?>
	</div>
</div>
<?php get_footer(); ?>