<?php
  include 'ChromePhp.php';
  // check if the flexible content field has rows of data
  if( have_rows('topic', 'option') ):
     // loop through the rows of data
    while ( have_rows('topic', 'option') ) : the_row();
      $id = get_sub_field('image');
      $size = 'large';
      $image = wp_get_attachment_image_src( $id, $size );
      $title = get_sub_field('title');
      $url = get_sub_field('url');
      echo '<div class="entry-item image">';
    	echo '<img src="' . $image[0] . '" alt="">';
      echo '</div>';
      echo '<div class="entry-title">' . $title . '</div>';
      echo $url;
    endwhile;
  else :
    // no layouts found
  endif;
?>
