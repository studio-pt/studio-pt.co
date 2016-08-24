<div class="works-body">
<?php
  $the_query = new WP_Query(array(
    'paged'       => get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1,
    'post_type'   => 'works'
  ));
  ?>
<?php if ( $the_query->have_posts() ) while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  <?php get_template_part('templates/content', 'works'); ?>
<?php endwhile; ?>
<?php
  $GLOBALS['wp_query']->max_num_pages = $the_query->max_num_pages;
  the_posts_pagination(array(
    'base' => '/works/%_%'
  ));
  wp_reset_postdata();
  ?>
</div>
