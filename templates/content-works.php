<article <?php post_class('works-item'); ?>>
  <div class="item-summary">
    <h2 class='title'>
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
  </div>
  <a class='item-poster' href="<?php the_permalink(); ?>">
  <?php
    if ( has_post_thumbnail() ) :
      $img_id = get_post_thumbnail_id ();
      $img_url = wp_get_attachment_image_src ($img_id, 'large', false);
      ?>
      <div class='item-poster-inner' style='background-image:url(<?= $img_url[0]; ?>)'></div>
  <?php else: ?>
    <div class='item-poster-inner' style='background-image:url(<?= home_url() . "/assets/images/post-thumbnail.png"; ?>)'></div>
  <?php endif; ?>
  </a>
</article>
