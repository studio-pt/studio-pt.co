<div class="posts-container">
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <?php get_template_part('templates/entry-meta'); ?>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <nav class="navigation posts-navigation">
        <div class="nav-links">
          <?php previous_post_link('%link', '前へ'); ?>
          <?php
            $cat = get_the_category();
            $cat_id = $cat[0]->cat_ID;
            $link = get_category_link($cat_id);
            ?>
          <a href="<?php echo $link; ?>">一覧にもどる</a>
          <?php next_post_link('%link', '次へ'); ?>
        </div>
      </nav>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
</div>
