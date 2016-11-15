<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/assets/images/favicon.png" sizes="48x48" type="image/png">
  <meta property="fb:app_id" content="1171632842868765">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
  <meta property="og:locale" content="ja_JP">
  <meta name="twitter:card" content="summary_large_image">

  <?php
    if (is_single()) {
      if (have_posts()): while(have_posts()): the_post();
        if (get_the_excerpt()):
          echo '<meta property="og:description" content="'; echo mb_substr(str_replace(array("\r\n", "\r", "\n"), '', strip_tags(get_the_excerpt())), 0, 100); echo '">'; echo "\n";
          echo '<meta property="twitter:text:description" content="'; echo mb_substr(str_replace(array("\r\n", "\r", "\n"), '', strip_tags(get_the_excerpt())), 0, 100); echo '">'; echo "\n";
        else:
          if (get_field('summary')) :
            $summary = get_field('summary');
          endif;
          echo '<meta property="og:description" content="' . $summary . '">'; echo "\n";
          echo '<meta property="twitter:text:description" content="' . $summary . '">'; echo "\n";
        endif;
      endwhile; endif;
      echo '<meta property="og:title" content="'; the_title(); echo '">'; echo "\n";
      echo '<meta property="og:url" content="'; the_permalink(); echo '">'; echo "\n";
    } else {
      echo '<meta property="og:description" content="'; bloginfo('description'); echo '">';echo "\n";
      echo '<meta property="twitter:text:description" content="'; bloginfo('description'); echo '">';echo "\n";
      echo '<meta property="og:title" content="'; bloginfo('name'); echo '">'; echo "\n";
      echo '<meta property="og:url" content="'; bloginfo('url'); echo '">'; echo "\n";
    }

    $preg = '/<img.*?src=(["\'])(.+?)\1.*?>/i';

    if (is_single()) {
      if (has_post_thumbnail()) {
        $image_id = get_post_thumbnail_id();
        $image = wp_get_attachment_image_src( $image_id, 'full');
        echo '<meta property="og:image" content="'; echo home_url(); echo $image[0]; echo '">';echo "\n";
      } else if ( preg_match( $preg, $post->post_content, $imgurl ) && !is_archive()) {
        echo '<meta property="og:image" content="'; echo home_url(); echo $imgurl[2]; echo '">';echo "\n";
      } else {
        echo '<meta property="og:image" content="'; echo home_url(); echo '/assets/images/og.png">'; echo "\n";
      }
    } else {
      echo '<meta property="og:image" content="'; echo home_url(); echo '/assets/images/og.png">'; echo "\n";
    }
  ?>

  <?php wp_head(); ?>
  <script type="text/javascript" src="//typesquare.com/accessor/script/typesquare.js?bSUjKVZ6Hf0%3D" charset="utf-8"></script>
</head>
