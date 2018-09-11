<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',                // Scripts and stylesheets
  'lib/extras.php',                // Custom functions
  'lib/setup.php',                 // Theme setup
  'lib/titles.php',                // Page titles
  'lib/wrapper.php',               // Theme wrapper class
  'lib/customizer.php',            // Theme customizer
  'lib/wp_bootstrap_navwalker.php' // Bootstrap nav walker
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


/**
 * ACF settings
 */

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}


/**
 * allow to upload svg
 */

add_filter('upload_mimes', 'set_mime_types');
function set_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

/**
 * exclude attribution from title
 */

 add_filter('get_the_archive_title', function ($title) {
  $title = single_cat_title( '', false );
  return $title;
});

/**
 * add specific class to previous_post_link
 */

add_filter( 'previous_post_link', 'add_prev_post_link_class' );
function add_prev_post_link_class($output) {
  return str_replace('<a href=', '<a class="next-works" href=', $output);
}
