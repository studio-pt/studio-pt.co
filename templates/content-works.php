<article <?php post_class('post-item'); ?>>
  <a class='post-link' href="<?php the_permalink(); ?>">
    <?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail('square', array('class' => 'post-thumbnail')); ?>
    <?php else: ?>
      <img class='post-thumbnail' src='<?= home_url() . "/assets/images/post-thumbnail.png"; ?>'>
    <?php endif; ?>
    <span class="post-title"><?php the_title(); ?></span>
  </a>
</article>
