<?php
  if (get_field('video', 'option') && get_field('poster', 'option')) :
  $video = get_field('video', 'option');
  $poster = get_field('poster', 'option');
  ?>
  <div class="cover-poster">
    <img class="cover-label" src="/assets/images/brand__hg.svg" alt="<?php bloginfo('name'); ?>">
    <video poster="<?= $poster['url'] ?>" autoplay loop>
      <source src="<?= $video['url'] ?>" type="<?= $video['mime_type'] ?>">
    </video>
  </div>
<?php else: ?>
  <p>No Video or Poster.</p>
<?php endif; ?>
