<div class="entry-meta">
  <?php
    include(dirname(__FILE__) . "/../ChromePhp.php");
    echo get_the_term_list($post->ID, 'credit');
    //ChromePhp::log($terms);
  ?>
</div>
