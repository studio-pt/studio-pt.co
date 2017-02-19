<?php
  $video_sp = get_field('video-sp', 'option');
  $video_pc = get_field('video-pc', 'option');
  if ($video_sp && $video_pc) :
  ?>
  <div class="cover-label">
    <img class="cover-trigger" data-href="#b" src="/assets/images/brand__hg.svg" alt="<?php bloginfo('name'); ?>">
  </div>
  <img class='cover-down cover-trigger' data-href="#b" src="/assets/images/icon__chevron--down.svg" alt="">
  <div class="cover-poster">
    <video id="vpc" muted loop playsinline webkit-playsinline>
      <source src="<?= $video_pc['url'] ?>" type="<?= $video_pc['mime_type'] ?>">
    </video>
    <video id="vsp" muted loop playsinline webkit-playsinline>
      <source src="<?= $video_sp['url'] ?>" type="<?= $video_sp['mime_type'] ?>">
    </video>
  </div>
<?php else: ?>
  <p>No Video or Poster.</p>
<?php endif; ?>
