<?php
  $video_sp = get_field('video-sp', 'option');
  $video_pc = get_field('video-pc', 'option');
  if (get_field('video-sp', 'option') && get_field('video-pc', 'option')) :
  ?>
  <div class="cover-label">
    <img class="cover-trigger" data-href="#b" src="/assets/images/brand__hg.svg" alt="<?php bloginfo('name'); ?>">
  </div>
  <img class='cover-down cover-trigger' data-href="#b" src="/assets/images/icon__chevron--down.svg" alt="">
  <div class="cover-poster">
    <video class="hidden-sm" muted autoplay loop playsinline webkit-playsinline>
      <source src="<?= $video_pc['url'] ?>" type="<?= $video_pc['mime_type'] ?>">
    </video>
    <video class="visible-xs hidden-sm" muted autoplay loop playsinline webkit-playsinline>
      <source src="<?= $video_sp['url'] ?>" type="<?= $video_sp['mime_type'] ?>">
    </video>
  </div>
<?php else: ?>
  <p>No Video or Poster.</p>
<?php endif; ?>
