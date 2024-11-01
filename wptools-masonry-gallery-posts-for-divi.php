<?php
/**
 * Plugin Name:     WPTools Masonry Gallery & Posts For Divi
 * Plugin URI:      https://wptools.app
 * Description:     Create masonry gallery for images & blogs using divi modules
 * Author:          WP Tools
 * Text Domain:     masonry-gallery-and-posts-for-divi
 * Domain Path:     /languages
 * Version:         3.7.0
 *
 * @package         Masonry_Gallery_And_Posts_For_Divi
 */

require_once __DIR__ . '/freemius.php';
require_once __DIR__ . '/vendor/autoload.php';

$loader = \WPT\Masonry\Loader::getInstance();

$loader['plugin_name']    = 'WPTools Masonry Gallery & Posts For Divi';
$loader['plugin_version'] = '3.7.0';
$loader['plugin_dir']     = __DIR__;
$loader['plugin_slug']    = basename( __DIR__ );
$loader['plugin_url']     = plugins_url( '/' . $loader['plugin_slug'] );
$loader['plugin_file']    = __FILE__;

$loader->run();
