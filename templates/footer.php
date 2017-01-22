<footer class="content-info">
  <div class="container-fluid">
    <p><a class="brand" href="<?= esc_url(home_url('/')); ?>"><img src="/assets/images/brand__sm.svg" alt="<?php bloginfo('name'); ?>"></a></p>
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <p><small class="copyright">&copy; <?php echo date('Y'); ?> HOEDOWN</small></p>
  </div>
</footer>
