<div class="entry-meta">
  <?php
    $genre  = get_the_term_list($post->ID, 'genre', '<li>', '</li><li>', '</li>');
    $credit = get_the_term_list($post->ID, 'credit', '<li>', '</li><li>', '</li>');
    $date  =  get_the_term_list($post->ID, 'date', '<li>', '</li><li>', '</li>');
    ?>
  <?php if ($genre) : ?>
    <h4>Genre</h4>
    <ul><?php echo $genre; ?></ul>
  <?php endif; ?>
  <?php if ($credit) : ?>
    <h4>Credit</h4>
    <ul><?php echo $credit; ?></ul>
  <?php endif; ?>
  <?php if ($date) : ?>
    <h4>Date</h4>
    <ul><?php echo $date; ?></ul>
  <?php endif; ?>
</div>
