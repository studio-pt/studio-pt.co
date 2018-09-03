<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('entry-body'); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php
        $terms = get_the_terms($post->ID, 'c');
        echo '<ul class="entry-types">';
        foreach ($terms as $term) :
          echo '<li><a href="' . get_term_link($term) . '">'.$term->name.'</a></li>';
        endforeach;
        echo '</ul>';
      ?>
    </header>
    <div class='entry-feature'>
      <?php // Feature
        if( have_rows('feature') ):
          while ( have_rows('feature') ) : the_row();
            if( get_row_layout() == 'image' ):
              $image = get_sub_field('image');
              echo '<div class="entry-item">';
              echo '<div class="item-image">';
            	echo '<img src="' . $image['sizes']['large'] . '" alt="">';
              echo '</div>';
              echo '</div>';
            elseif( get_row_layout() == 'youtube' ):
              $iframe = get_sub_field('youtube');
              preg_match('/src="(.+?)"/', $iframe, $matches);
              $src = $matches[1];
              // add extra params to iframe src
              $params = array(
                'showinfo'  => 0,
                'hd'        => 1,
                'autohide'  => 1,
                'rel'       => 0
              );
              $new_src = add_query_arg($params, $src);
              $iframe = str_replace($src, $new_src, $iframe);
              // add extra attributes to iframe html
              $attributes = 'frameborder="0"';
              $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
              echo '<div class="entry-item"><div class="item-oembed">' . $iframe . '</div></div>';
            elseif( get_row_layout() == 'vimeo' ):
              $iframe = get_sub_field('vimeo');
              preg_match('/src="(.+?)"/', $iframe, $matches);
              $src = $matches[1];
              // add extra params to iframe src
              $params = array(
                'title'     => 0,
                'byline'    => 0,
                'badge'     => 0,
                'portrait'  => 0,
                'color'     => '0033ff'
              );
              $new_src = add_query_arg($params, $src);
              $iframe = str_replace($src, $new_src, $iframe);
              // add extra attributes to iframe html
              $attributes = 'frameborder="0"';
              $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
              echo '<div class="entry-item"><div class="item-oembed">' . $iframe . '</div></div>';
            endif;
          endwhile;
        else :
            // no layouts found
        endif;
      ?>
    </div>
    <div class="entry-content">
      <?php // Items
        if( have_rows('item') ):
          while ( have_rows('item') ) : the_row();
            if( get_row_layout() == 'image' ):
              $image = get_sub_field('image');
              echo '<div class="entry-item">';
              echo '<div class="item-image">';
            	echo '<img src="' . $image['sizes']['large'] . '" alt="">';
              echo '</div>';
              echo '</div>';
            elseif( get_row_layout() == 'youtube' ):
              $iframe = get_sub_field('youtube');
              preg_match('/src="(.+?)"/', $iframe, $matches);
              $src = $matches[1];
              // add extra params to iframe src
              $params = array(
                'showinfo'  => 0,
                'hd'        => 1,
                'autohide'  => 1,
                'rel'       => 0
              );
              $new_src = add_query_arg($params, $src);
              $iframe = str_replace($src, $new_src, $iframe);
              // add extra attributes to iframe html
              $attributes = 'frameborder="0"';
              $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
              echo '<div class="entry-item"><div class="item-oembed">' . $iframe . '</div></div>';
            elseif( get_row_layout() == 'vimeo' ):
              $iframe = get_sub_field('vimeo');
              preg_match('/src="(.+?)"/', $iframe, $matches);
              $src = $matches[1];
              // add extra params to iframe src
              $params = array(
                'title'     => 0,
                'byline'    => 0,
                'badge'     => 0,
                'portrait'  => 0,
                'color'     => '0033ff'
              );
              $new_src = add_query_arg($params, $src);
              $iframe = str_replace($src, $new_src, $iframe);
              // add extra attributes to iframe html
              $attributes = 'frameborder="0"';
              $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
              echo '<div class="entry-item"><div class="item-oembed">' . $iframe . '</div></div>';
            elseif( get_row_layout() == 'editor' ):
              $editor = get_sub_field('editor');
              echo '<div class="entry-item"><div class="item-editor">' . $editor . '</div></div>';
            elseif( get_row_layout() == 'video' ):
              $video = get_sub_field('video');
              $poster = get_sub_field('poster');
              echo '<div class="entry-item">';
              echo '<div class="item-video">';
              echo '<video poster="' . $poster['sizes']['large'] . '" autoplay loop controls>';
              echo '<source src="' . $video['url'] . '" type="' . $video['mime_type'] . '">';
              echo '</video>';
              echo '</div>';
              echo '</div>';
            endif;
          endwhile;
        else :
            // no layouts found
        endif;
      ?>
    </div>

    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>

<div class="works-body">
  <div class='section-header'>
    <h3>Latest</h3>
  </div>
  <?php get_template_part('templates/post-items-works'); ?>
</div>
