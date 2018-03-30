
/*
 * Plugin Name: WooCommerce Mobile Redirect for Product
 * Plugin URI: https://profiles.wordpress.org/viky081
 * Description: Redirect WooCommerce Products to Mobile Version of WooCommerce Products
 * Version: 1.0
 * Author: viky081
 * Author URI: https://profiles.wordpress.org/viky081


function wc_49570125_register_meta_boxes() {
    add_meta_box('meta-box-id', __('Mobile Version URL', 'yourtextdomain'), 'wc_49570125_my_display_callback', 'product');
}

add_action('add_meta_boxes', 'wc_49570125_register_meta_boxes');

// Add Input Field
function wc_49570125_my_display_callback($post) {
    $get_id = $post->ID;
    $get_value = get_post_meta($get_id, 'wc_mobile_version_url', true);
    ?>
    <p>
        <label><?php _e('Mobile URL to Redirect', 'yourtextdomain'); ?></label>
        <input type="text" name="wc_mobile_version_url" value="<?php echo $get_value; ?>"/>
    </p>
    <?php
}

// save input field
function wc_49570125_save_meta_box($post_id) {
    $post_type = get_post_type($post_id);
    if ('product' != $post_type) {
        return;
    }
    if (isset($_POST['wc_mobile_version_url'])) {
        $mobile_version = $_POST['wc_mobile_version_url'];
        update_post_meta($post_id, 'wc_mobile_version_url', $mobile_version);
    }
}

add_action('save_post', 'wc_49570125_save_meta_box');

// redirect input field

function wc_49570125_mobile_redirect() {
    global $product, $post;
    if (is_product()) {
        $get_id = $post->ID;
        $amp_location = get_post_meta($get_id, 'wc_mobile_version_url', true);
        if (wp_is_mobile() && $amp_location) {
            wp_redirect($amp_location);
            exit;
        }
    }
}

add_action('wp', 'wc_49570125_mobile_redirect');
