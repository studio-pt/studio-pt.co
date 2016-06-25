<div class="entry-meta">
  <?php
    $categories = get_the_category();
    $tags = get_the_tags();
    $separator = ' / ';
    $out_cat = '';
    $out_tag = '';

    if ( $categories ) {
      echo '<p>';
    	foreach( $categories as $category ) {
        if ($category->parent !== 0) {
      		$out_cat .= '<a href="' . get_category_link( $category->term_id ) . '">' . $category->cat_name . '</a>' . $separator;
        }
    	}
      echo trim( $out_cat, $separator ) . '</p>';
    }

    if ( $tags ) {
      echo '<p>';
    	foreach( $tags as $tag ) {
      	$out_tag .= '<a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a>' . $separator;
    	}
      echo trim( $out_tag, $separator ) . '</p>';
    }
  ?>
</div>
