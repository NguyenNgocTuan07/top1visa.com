<?php
/*
Plugin Name: Flamix: Bitrix24 and Contact Forms 7 integration
Plugin URI: https://flamix.solutions/bitrix24/integrations/site/cf7.php#price
Description: Automatic create Lead or Deal in Bitrxi24 when submitting Contact Forms 7 form.
Author: Roman Shkabko (Flamix)
Version: 2.2.0
Author URI: https://flamix.info
License: GPLv2
*/

if (version_compare(PHP_VERSION, '7.2.0') < 0) {
    add_action('admin_notices', function () {
        echo '<div class="error notice"><p><b>Flamix: Bitrix24 and Contact Forms 7 integrations</b>: Upgrade your PHP version. Minimum version - 7.2+. Your PHP version ' . PHP_VERSION . '! If you don\'t know how to upgrade PHP version, just ask in your hosting provider! If you can\'t upgrade - delete this plugin!</p></div>';
    });
    return false;
}

include_once 'includes/vendor/autoload.php';
include_once 'settings/Settings.php';
include_once 'includes/Helpers.php';
include_once 'includes/Handlers.php';

$namespace = '\Flamix\Bitrix24\CF7\\';

//Setting Page
if (is_admin()) {
    //Register menu
    add_action('admin_menu', [$namespace . 'Settings', 'add_menu']);
    //Add extra link to plugin page
    add_filter('plugin_action_links_flamix-bitrix24-and-contact-forms-7-integrations/flamix-bitrix24-and-contact-forms-7-integrations.php', [$namespace . 'Settings', 'add_link_to_plugin_widget']);
}

/**
 * Save UTMs and Trace
 */
add_action('wp', [$namespace . 'Handlers', 'trace']);

/**
 * Compatibility (in video I show this, now you don't need to use it)
 */
add_action('wpcf7_init', function () {
    wpcf7_add_form_tag('b24_trace', function () {
        return '';
    });
});

/**
 * Register event handler and create Lead/Deal etc
 */
if (\Flamix\Bitrix24\CF7\Helpers::isPluginActive('contact-form-7/wp-contact-form-7.php'))
    add_action('wpcf7_mail_sent', [$namespace . 'Handlers', 'cf7_send']);