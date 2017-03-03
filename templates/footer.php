<footer class="content-info">
  <div class="container-fluid">
    <p><a class="brand" href="<?= esc_url(home_url('/')); ?>">
      <svg width="94" height="24" viewBox="0 0 94 24" xmlns="http://www.w3.org/2000/svg"><title><?php bloginfo('name'); ?></title><path d="M56.486 0c-4.249 0-5.56 2.95-5.56 12s1.312 12 5.56 12c4.248 0 5.563-2.95 5.563-12S60.734 0 56.486 0zm0 21.364c-2.088 0-2.404-2.139-2.404-9.363 0-7.225.314-9.365 2.404-9.365s2.404 2.14 2.404 9.365-.315 9.363-2.404 9.363zM17.854 0c-4.25 0-5.561 2.95-5.561 12s1.311 12 5.56 12c4.25 0 5.562-2.95 5.562-12S22.103 0 17.854 0zm0 21.364c-2.09 0-2.405-2.139-2.405-9.363 0-7.225.314-9.365 2.405-9.365 2.09 0 2.404 2.14 2.404 9.365s-.315 9.363-2.404 9.363zM42.57.585h-5.107V24h5.107c4.22 0 6.015-3.904 6.015-11.708C48.585 4.49 46.79.585 42.57.585zm-.583 20.782l-1.261-.019V3.236h1.26c2.129 0 3.337 1.829 3.337 9.056 0 7.226-1.208 9.073-3.336 9.073v.002zm-12.476-.147h6.196V24h-9.366V.584h9.006v2.781h-5.836l-.002 6.878h5.493v2.78H29.51zM3.128 24H0V.585h3.128v9.677h3.696V.585H9.95V24H6.824V13.17H3.128zM73.537.585l2.234 18.156L77.67.585h3.11L77.76 24h-3.93L72 8.36 70.17 24h-3.931L63.219.585h3.11l1.9 18.154L70.464.585zM89.854 24h3.805V.585h-3v16.927L86.342.585h-3.805V24h3V7.073z" fill="#03F" fill-rule="evenodd"/></svg></a></p>
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <p><small class="copyright">&copy; <?php echo date('Y'); ?> HOEDOWN</small></p>
  </div>
</footer>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-92966217-1', 'auto');
  ga('send', 'pageview');
</script>
