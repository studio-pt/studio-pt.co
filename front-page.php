<?php if (have_rows('topic', 'option')) : ?>
<div class="topics">
  <?php while (have_rows('topic', 'option')) : the_row();
    $id = get_sub_field('image');
    $size = 'large';
    $image = wp_get_attachment_image_src( $id, $size );
    $title = get_sub_field('title');
    $url = get_sub_field('url');
  ?>
  <div class="topic-item">
    <div class="card card-vista">
      <a class="card-foreground" href="<?php echo $url; ?>">
        <div class="card-title"><?php echo $title ?></div>
      </a>
      <div class="card-background" style="background-image:url(<?php echo $image[0]; ?>)"></div>
    </div>
  </div>
  <?php endwhile; ?>
</div>
<?php else: ?>
  <!-- no layouts found -->
<?php endif; ?>
