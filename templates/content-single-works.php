<div class='entry-container'>

  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('entry-body'); ?>>
      <header class="entry-header">
        <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <div class="entry-description">
          <?= the_content(); ?>
        </div>
        <?php
          $terms = get_the_terms($post->ID, 'c');
          echo '<ul class="entry-categories">';
          foreach ($terms as $term) :
            echo '<li><a href="' . get_term_link($term) . '">'.$term->name.'</a></li>';
          endforeach;
          echo '</ul>';
        ?>
        <?php
          $terms = get_the_terms($post->ID, 't');
          echo '<ul class="entry-taxonomies">';
          foreach ($terms as $term) :
            echo '<li><a href="' . get_term_link($term) . '">'.$term->name.'</a></li>';
          endforeach;
          echo '</ul>';
        ?>
      </header>
      <div class="entry-content">
        <?php // Items
          if( have_rows('item') ):
            while ( have_rows('item') ) : the_row();
              if( get_row_layout() == 'image' ):
                $image = get_sub_field('image');
                echo '<div class="entry-item">';
                echo '<div class="item-image" style="background-image:url(' . $image['sizes']['large'] . ');">';
                echo '</div>';
                echo '</div>';
              elseif( get_row_layout() == 'images' ):
                echo '<div class="entry-item">';
                while( have_rows('images') ): the_row();
                  $image = get_sub_field('image');
                  echo '<div class="item-images" style="background-image:url(' . $image['sizes']['large'] . ');">';
                  echo '</div>';
                endwhile;
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
              elseif( get_row_layout() == 'caption' ):
                $caption = get_sub_field('caption');
                echo '<div class="entry-item"><div class="item-caption">' . $caption .  '</div></div>';
              elseif( get_row_layout() == 'video' ):
                $video = get_sub_field('video');
                $poster = get_sub_field('poster');
                echo '<div class="entry-item">';
                echo '<div class="item-video">';
                echo '<video poster="' . $poster['sizes']['large'] . '" muted autoplay loop>';
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
        <?php previous_post_link('%link', '前へ'); ?>
      </footer>
    </article>
  <?php endwhile; ?>
</div>
