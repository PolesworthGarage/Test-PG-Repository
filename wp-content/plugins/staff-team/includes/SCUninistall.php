<?php
/**
 * Created by PhpStorm.
 * User: Sales1
 * Date: 3/31/2016
 * Time: 2:42 PM
 */

function sc_uninstall_plugin(){
    global $wpdb;
    $wpdb->get_results('DELETE from '.$wpdb->prefix.'posts WHERE post_type = "revision" OR post_type = "cont_theme" OR post_type = "contact" OR post_type = "cont_mess"');
    $wpdb->get_results('DELETE from '.$wpdb->prefix.'term_taxonomy WHERE taxonomy = "category"');
    $wpdb->get_results('DELETE from '.$wpdb->prefix.'postmeta WHERE meta_key = "params" OR meta_key = "_edit_last" OR meta_key = "_edit_lock" OR meta_key = "want_email" OR meta_key = "email" OR meta_key = "categories" OR meta_key = "sender_name" OR meta_key = "sender_phone" OR meta_key = "sender_mail" OR meta_key = "sender_preference" OR meta_key = "contact" OR meta_key = "mess_date"');
    //$wpdb->get_results('DELETE from '.$wpdb->prefix.'options WHERE option_name = "sc_uninstall_mess" OR option_name = "sc_uninstall_plugin" OR option_name = "name_search" OR option_name = "lightbox" OR option_name = "enable_message" OR option_name = "show_name" OR option_name = "show_email" OR option_name = "show_phone" OR option_name = "show_cont_pref" OR option_name = "cont_active_theme"');
    $delete_demo_data = get_option('delete_demo_data');
    if($delete_demo_data) {
        foreach ($delete_demo_data as $demo_data) {
            $_thumbnail_id = get_post_meta($demo_data, '_thumbnail_id');
            wp_delete_post($_thumbnail_id[0], true);
            delete_post_meta($demo_data, 'email');
            delete_post_meta($demo_data, 'want_email');
            wp_delete_post($demo_data, true);
        }
        $delete_demo_category = get_option('delete_demo_category');
        wp_delete_term($delete_demo_category["term_id"], 'cont_category');
        delete_option('delete_demo_data');
        delete_option('delete_demo_category');
        delete_option('demo_success');
        delete_option('staff_order_contact');
    }
}