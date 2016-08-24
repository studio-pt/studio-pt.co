<div id="icon-menu">
  <span></span>
  <span></span>
  <span></span>
  <span></span>
</div>

<nav role="navigation" class="nav-primary">
  <?php
  if (has_nav_menu('primary_navigation')) :
    wp_nav_menu([
      'menu' => 'primary_navigation',
      'theme_location' => 'primary_navigation',
      'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
      'walker' => new wp_bootstrap_navwalker(),
      'menu_class' => 'nav'
    ]);
  endif;
  ?>
</nav>
