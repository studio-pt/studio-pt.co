<?php
  // check if the flexible content field has rows of data
  if( have_rows('topic', 'option') ):
     // loop through the rows of data
    echo '<div class="topics">';
    while ( have_rows('topic', 'option') ) : the_row();
      $id = get_sub_field('image');
      $size = 'large';
      $image = wp_get_attachment_image_src( $id, $size );
      $title = get_sub_field('title');
      $url = get_sub_field('url');
      echo '<div class="topic">';
      echo '<div class="topic-item">';
      echo '<a class="topic-item-title" href="' . $url . '">' . $title . '</a>';
      echo '<div class="topic-item-bg" style="background-image:url(' . $image[0] . ')">';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    endwhile;
    echo '</div>';
  else :
    // no layouts found
  endif;
?>
