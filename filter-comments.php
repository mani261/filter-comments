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

if (!defined ('ABSPATH')) {
    exit;
}

/*define('WP_AUTH_DIR', plugin_dir_path(__FILE__));
define('WP_AUTH_URL', plugin_dir_url(__FILE__));
define('WP_AUTH_INC', WP_AUTH_DIR . '/inc/');
define('WP_AUTH_TPL', WP_AUTH_DIR . '/tpl/');

include WP_AUTH_INC . "functions.php";
include WP_AUTH_INC . "shortcodes.php";*/

add_action ('admin_menu', 'menu_handler');

function menu_handler ()
{
    add_menu_page ('Filter Comments', 'Filter Comments', 'manage_options',
        'filter-comments', 'filter_comment_main_handler', 'dashicons-format-chat',26);
    add_submenu_page ('filter-comments', 'Settings', 'Settings', 'manage_options', 'settings', 'filter_comment_settings_handler');
}

function filter_comment_main_handler(){
    echo 'From Main ';
}

function filter_comment_settings_handler(){
    echo 'settings';
}

function comment_text_filter (string $comment_body): string
{
    $filter_words = ['moderating', 'the'];
    foreach ($filter_words as $word) {
        $word_len = strlen ($word);
        $word_filtered = str_repeat ('*', $word_len);
        $comment_body = str_replace ($word, $word_filtered, $comment_body);
    }
    return $comment_body;
}

add_filter ('comment_text', 'comment_text_filter');