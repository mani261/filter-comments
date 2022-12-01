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

define('FC_DIR', plugin_dir_path(__FILE__));
define('FC_URL', plugin_dir_url(__FILE__));
define('FC_INC', FC_DIR . '/inc/');
define('FC_TPL', FC_DIR . '/tpl/');

//include FC_INC . "functions.php";
//include FC_INC . "shortcodes.php";

add_action ('admin_menu', 'menu_handler');

function menu_handler ()
{
    add_menu_page ('Filter Comments', 'Filter Comments', 'manage_options',
        'filter-comments', 'filter_comment_main_handler', 'dashicons-format-chat',26);
    add_submenu_page ('filter-comments', 'Settings', 'Settings', 'manage_options', 'settings', 'filter_comment_settings_handler');
}

function filter_comment_main_handler(){
    include_once FC_TPL . 'admin/main_menu.php' ;
}

function filter_comment_settings_handler(){
    include_once FC_TPL . 'admin/settings_menu.php' ;
}

function comment_text_filter (string $comment_body): string
{
    if (get_option ('_fc_words')) {
        $filter_words = get_option ('_fc_words');
        foreach ($filter_words as $word) {
            $word_len = strlen ($word);
            $word_filtered = str_repeat ('*', $word_len);
            $comment_body = str_replace ($word, $word_filtered, $comment_body);
        }
    }
    return $comment_body;
}

add_filter ('comment_text', 'comment_text_filter');