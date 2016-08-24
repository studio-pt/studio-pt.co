<div class="works-container">
<?php if (!is_post_type_archive('works') || is_tax()) : ?>
  <?php get_template_part('templates/page', 'header'); ?>
<?php endif; ?>

<?php if (!have_posts()) : ?>
  <p><?php _e('Sorry, no results were found.', 'sage'); ?></p>
<?php endif; ?>

<div class="works-body">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'works'); ?>
<?php endwhile; ?>
</div>
<?php the_posts_pagination(); ?>
</div>
