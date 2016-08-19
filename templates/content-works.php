<article <?php post_class('works-item'); ?>>
  <div class="card card-square">
    <a class="card-foreground" href="<?php the_permalink(); ?>">
      <span class="card-title middle-center"><?php the_title(); ?></span>
    </a>
    <?php
      if ( has_post_thumbnail() ) :
        $img_id = get_post_thumbnail_id ();
        $img_url = wp_get_attachment_image_src ($img_id, 'thumbnail', false);
        ?>
      <div class="card-background" style="background-image:url(<?php echo $img_url[0]; ?>)"></div>
    <?php else: ?>
      <div class="card-background" style="background-image:url(<?= home_url() . "/assets/images/post-thumbnail.png"; ?>)"></div>
    <?php endif; ?>
  </div>
</article>
