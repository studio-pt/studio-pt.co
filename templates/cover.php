<?php
  if (get_field('video-sp', 'option') && get_field('video-pc', 'option') && get_field('poster', 'option')) :
  $video_sp = get_field('video-sp', 'option');
  $video_pc = get_field('video-pc', 'option');
  $poster = get_field('poster', 'option');
  ?>
  <div class="cover-label cover-trigger">
    <img data-href="#b" src="/assets/images/brand__hg.svg" alt="<?php bloginfo('name'); ?>">
  </div>
  <img class='cover-down cover-trigger' data-href="#b" src="/assets/images/icon__chevron--down.svg" alt="">
  <div class="cover-poster">
    <video class="hidden-sm" poster="<?= $poster['url'] ?>" muted autoplay loop playsinline>
      <source src="<?= $video_pc['url'] ?>" type="<?= $video_pc['mime_type'] ?>">
    </video>
    <video class="visible-xs hidden-sm" poster="<?= $poster['url'] ?>" muted autoplay loop playsinline>
      <source src="<?= $video_sp['url'] ?>" type="<?= $video_sp['mime_type'] ?>">
    </video>
  </div>
<?php else: ?>
  <p>No Video or Poster.</p>
<?php endif; ?>
