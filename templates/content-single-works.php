<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('entry-body'); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <div class="entry-meta">
        <ul class="entry-attributes">
        <?php // Summary
          if (get_field('summary')) :
            $summary = get_field('summary');
            echo '<li>' . $summary . '</li>';
          endif;
        ?>
        <?php // Credits
          if (have_rows('credits')):
            while (have_rows('credits')) : the_row();
              if (get_row_layout() == 'credit'):
                echo '<li><dl>';
                $role = get_sub_field('role');
                echo '<dt>' . $role . '</dt>';
                if (have_rows('persons')):
                  while (have_rows('persons')) : the_row();
                    if (get_row_layout() == 'current-staff'):
                      $current = get_sub_field('current-staff');
                      echo '<dd>';
                      echo '<a href="'. esc_url(home_url('/')) . get_post_type(get_the_ID()) . '/?' . $current->taxonomy . '=' . $current->slug  . '">';
                      echo $current->name;
                      echo '</a>';
                      echo '</dd>';
                    elseif (get_row_layout() == 'ex-staff'):
                      $ex = get_sub_field('ex-staff');
                      echo '<dd>' . $ex . '</dd>';
                    endif;
                  endwhile;
                endif;
                echo '</dl></li>';
              endif;
            endwhile;
          endif;
        ?>
        <?php
          if (get_the_terms($post->ID, 'y')) :
            $years = get_the_terms($post->ID, 'y');
            foreach ($years as $year) :
              echo '<li><a href="'. esc_url(home_url('/')) . get_post_type(get_the_ID()) . '/?' . $year->taxonomy . '=' . $year->slug  . '">';
              echo $year->name;
              echo '</a></li>';
            endforeach;
          endif;
        ?>
        <?php
          if( have_rows('client') ):
            echo '<li><dl><dt>Client</dt>';
            while ( have_rows('client') ) : the_row();
              echo '<dd>' . the_sub_field('name') . '</dd>';
            endwhile;
            echo '</dl></li>';
          endif;
        ?>
        </ul>
        <?php
          $type = get_the_term_list($post->ID, 't', '<li>', '</li><li>', '</li>');
          if ($type) :
            echo '<ul class="entry-types">'. $type . '</ul>';
          endif;
        ?>
      </div>
    </header>
    <div class="entry-content">
      <?php // Items
        if( have_rows('item') ):
          while ( have_rows('item') ) : the_row();
            if( get_row_layout() == 'image' ):
              $image = get_sub_field('image');
              echo '<div class="entry-item image">';
            	echo '<img src="' . $image['sizes']['large'] . '" alt="">';
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
              echo '<div class="entry-item oembed">' . $iframe . '</div>';
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
                'color'     => '221fff'
              );
              $new_src = add_query_arg($params, $src);
              $iframe = str_replace($src, $new_src, $iframe);
              // add extra attributes to iframe html
              $attributes = 'frameborder="0"';
              $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
              echo '<div class="entry-item oembed">' . $iframe . '</div>';
            elseif( get_row_layout() == 'caption' ):
              $caption = get_sub_field('caption');
              echo '<div class="entry-item caption"><small>' . $caption . '</small></div>';
            elseif( get_row_layout() == 'editor' ):
              $editor = get_sub_field('editor');
              echo '<div class="entry-item editor">' . $editor . '</div>';
            elseif( get_row_layout() == 'credit' ):
              $credit = get_sub_field('credit');
              echo '<div class="entry-item credit">' . $credit . '</div>';
            elseif( get_row_layout() == 'video' ):
              $video = get_sub_field('video');
              $poster = get_sub_field('poster');
              echo '<div class="entry-item video">';
              echo '<video poster="' . $poster['sizes']['large'] . '" autoplay loop controls>';
              echo '<source src="' . $video['url'] . '" type="' . $video['mime_type'] . '">';
              echo '</video>';
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

<?php get_template_part('templates/post-items-works'); ?>
