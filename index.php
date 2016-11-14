<div class="posts-container">
<?php if (!is_home() || !is_front_page()) : ?>
  <?php if (!is_post_type_archive()) : ?>
    <?php get_template_part('templates/page', 'header'); ?>
  <?php endif; ?>
<?php endif; ?>

<?php if (!have_posts()) : ?>
  <p><?php _e('Sorry, no results were found.', 'sage'); ?></p>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>

<?php the_posts_pagination(); ?>
</div>