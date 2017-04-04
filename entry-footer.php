<?php global $post; if ( 'post' == $post->post_type ) : ?>
<div class="entry-footer clearfix">

<?php edit_post_link( __( 'Edit', 'boiler' ), "<span class=\"meta-sep\"> | </span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ); ?>
</div>
<?php endif; ?>