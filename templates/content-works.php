<article <?php post_class('works-item'); ?>>
  <a class='item-poster' href="<?php the_permalink(); ?>">
  <?php
    if ( has_post_thumbnail() ) :
      $img_id = get_post_thumbnail_id ();
      $img_url = wp_get_attachment_image_src ($img_id, 'medium', false);
      ?>
      <div class='item-poster-inner' style='background-image:url(<?= $img_url[0]; ?>)'></div>
  <?php else: ?>
    <div class='item-poster-inner' style='background-image:url(<?= home_url() . "/assets/images/post-thumbnail.png"; ?>)'></div>
  <?php endif; ?>
  </a>
  <div class="item-summary">
    <h2 class='title'>
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
    <?php
      $terms = get_the_terms($post->ID, 'c');
      echo '<ul class="entry-types">';
      foreach ($terms as $term) :
        echo '<li><a href="' . get_term_link($term) . '">'.$term->name.'</a></li>';
      endforeach;
      echo '</ul>';
    ?>
  </div>
</article>
