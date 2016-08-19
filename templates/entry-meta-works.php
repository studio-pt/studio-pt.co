<div class="entry-meta">
  <?php include(dirname(__FILE__) . "/../ChromePhp.php"); ?>
    <?php
      $genre  = get_the_term_list($post->ID, 'genre', '<li>', '</li><li>', '</li>');
      $credit = get_the_term_list($post->ID, 'credit', '<li>', '</li><li>', '</li>');
      ?>
    <?php if ($genre) : ?>
      <h4>Genre</h4>
      <ul><?php echo $genre; ?></ul>
    <?php endif; ?>
    <?php if ($credit) : ?>
      <h4>Credit</h4>
      <ul><?php echo $credit; ?></ul>
    <?php endif; ?>
  <?php ChromePhp::log($genre); ?>
</div>

<!--
  <?php
    // Genre List
    $terms = get_terms('genre');
    foreach ($terms as $term) :
    ?>
    <li><a href="<?=get_term_link($term->slug, 'genre');?>"><?=$term->name;?></a></li>
    <?php endforeach; ?>
-->
