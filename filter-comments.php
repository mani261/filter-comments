<?php
/*
Plugin Name: Filter Comments
Plugin URI: https://www.7learn.com/
Description: wordpress plugin to manage comments
Author: MaNi
Author URI: https://www.7learn.com/
Text Domain: filter-comments
Domain Path: /languages/
Version: 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/*define('WP_AUTH_DIR', plugin_dir_path(__FILE__));
define('WP_AUTH_URL', plugin_dir_url(__FILE__));
define('WP_AUTH_INC', WP_AUTH_DIR . '/inc/');
define('WP_AUTH_TPL', WP_AUTH_DIR . '/tpl/');

include WP_AUTH_INC . "functions.php";
include WP_AUTH_INC . "shortcodes.php";*/

function comment_text_filter(string $comment_body):string {
    $filter_words = ['moderating','the'];
    foreach ($filter_words as $word) {
        $word_len = strlen($word);
        $word_filtered = str_repeat('*',$word_len);
        $comment_body = str_replace($word,$word_filtered,$comment_body);
    }
    return $comment_body;
}
add_filter('comment_text', 'comment_text_filter');