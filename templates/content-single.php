<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class='entry-thumbnail'>
          <p><?php the_post_thumbnail('large'); ?></p>
        </div>
    <?php endif; ?>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>

    <?php
      // check if the flexible content field has rows of data
      if( have_rows('work') ):
           // loop through the rows of data
          while ( have_rows('work') ) : the_row();

              if( get_row_layout() == 'image' ):
                $id = get_sub_field('image');
                $size = 'large';
                $image = wp_get_attachment_image_src( $id, $size );
                echo '<div class="entry-item image">';
              	echo '<img src="' . $image[0] . '" alt="">';
                echo '</div>';

              elseif( get_row_layout() == 'video' ):
                $caption = get_sub_field('video');
                echo '<div class="entry-item video">' . $video . '</div>';

              elseif( get_row_layout() == 'widget' ):
                $widget = get_sub_field('widget');
                echo '<div class="entry-item widget">' . $widget . '</div>';

              elseif( get_row_layout() == 'caption' ):
                $caption = get_sub_field('caption');
                echo '<div class="entry-item caption">' . $caption . '</div>';

              endif;
          endwhile;
      else :
          // no layouts found
      endif;
    ?>

    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>

<?php get_template_part('templates/post-items'); ?>
