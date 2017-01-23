<?php
  echo '<video poster="' . $poster['sizes']['large'] . '" autoplay loop controls>';
  echo '<source src="' . $video['url'] . '" type="' . $video['mime_type'] . '">';
  echo '</video>';
?>
