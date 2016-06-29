<h3><?php the_category(' // ') ?>の最新記事</h3>
<?php
foreach((get_the_category()) as $cat) {
$catid = $cat->cat_ID ;
break ;
}
$get_posts_parm = "'numberposts=10&category=" . $catid . "'";
?>
<ul>
<?php $posts = get_posts($get_posts_parm); ?>
<?php foreach($posts as $post): ?>
<li><?php the_time('Y年m月d日'); ?>・・・<a href="<?php the_permalink(); ?>"
title="<?php the_title(); ?>"> <?php the_title(); ?></a></li>
<?php endforeach; ?>
