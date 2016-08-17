<article <?php post_class('post-item'); ?>>
  <div class="card card-square">
    <a class="card-foreground" href="<?php the_permalink(); ?>">
      <div class="card-title middle-center"><?php the_title(); ?></div>
    </a>
    <?php
      if ( has_post_thumbnail() ) :
        $img_id = get_post_thumbnail_id ();
        $img_url = wp_get_attachment_image_src ($img_id, true);
        ?>
      <div class="card-background" style="background-image:url(<?php echo $img_url[0]; ?>)"></div>
    <?php else: ?>
      <div class="card-background" style="background-image:url(<?= home_url() . "/assets/images/post-thumbnail.png"; ?>)"></div>
    <?php endif; ?>
  </div>
</article>
