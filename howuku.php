<?php
/*
Plugin Name: Howuku User Insight
Description: Embed Howuku App into your Wordpress website, start collecting feedback and session replay/visitor recording with Howu User Insight Analytic.
Author: Donald Ng
Version: 1.0
Author URI: https://howuku.com/
*/

// If this file is called directly, abort.
if (!defined('WPINC')) die;

require 'settings.php';

function add_howuku_key($tag, $handle) {
  if ( 'howuku' !== $handle ) return $tag;
  return str_replace( ' src', ' key="' . esc_js(get_option('howuku_key', '')) . '" src', $tag );
}

function howuku_widget_script () {
  $howukuKey = esc_js(get_option('howuku_key', ''));
  if (empty($howukuKey)) {
    return;
  }
  wp_enqueue_script('howuku', 'https://cdn.howuku.com/js/howu-widget.js', array(), null, true);
  add_filter('script_loader_tag', 'add_howuku_key', 10, 2);
}

add_action('wp_enqueue_scripts', 'howuku_widget_script', 1, 1);