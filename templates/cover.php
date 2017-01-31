<?php
  if (get_field('video', 'option') && get_field('poster', 'option')) :
  $video = get_field('video', 'option');
  $poster = get_field('poster', 'option');
  ?>
  <img class='cover-label cover-trigger' data-href="#b" src="/assets/images/brand__hg.svg" alt="<?php bloginfo('name'); ?>">
  <img class='cover-down cover-trigger' data-href="#b" src="/assets/images/icon__chevron--down.svg" alt="">
  <div class="cover-poster">
    <video poster="<?= $poster['url'] ?>" muted autoplay loop playsinline>
      <source src="<?= $video['url'] ?>" type="<?= $video['mime_type'] ?>">
    </video>
  </div>
<?php else: ?>
  <p>No Video or Poster.</p>
<?php endif; ?>
