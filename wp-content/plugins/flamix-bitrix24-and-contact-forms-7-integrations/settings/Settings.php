<?php
namespace Flamix\Bitrix24\CF7;

class Settings {

    /**
     * Get Plugin UNIQ Name to Setting
     *
     * @return string
     */
    private static function getPluginName()
    {
        return strtolower(str_replace('\\', '_', __NAMESPACE__));
    }

    /**
     * Get Full Options Name
     *
     * @param $name
     * @return string
     */
    public static function getOptionName($name)
    {
        return self::getPluginName() . '_' . $name;
    }

    /**
     * Get Options VALUE by Name
     *
     * @param $name
     * @return mixed|void
     */
    public static function getOption($name)
    {
        //@todo Remove after NY
        //        return get_option(self::getOptionName($name));
        $value = get_option(self::getOptionName($name));

        //Обратная совместимость
        if(empty($value) || !$value) {
            if($name == 'lead_domain' && !empty(get_option('flamix_b24_cf7_lead_domain')))
                update_option(self::getOptionName('lead_domain'), get_option('flamix_b24_cf7_lead_api'));

            if($name == 'lead_api' && !empty(get_option('flamix_b24_cf7_lead_domain')))
                update_option(self::getOptionName('lead_api'), get_option('flamix_b24_cf7_lead_domain'));

            $value = get_option(self::getOptionName($name));
        }

        return $value;
    }

    /**
     * Register Setting Page in Menu
     */
    public static function add_menu()
    {
        add_options_page(
            'Bitrix24 and WordPress Contact Forms 7 integrations',
            'Bitrix24 ← CF7',
            'administrator',
            __FILE__,
            [__NAMESPACE__ . '\Settings', 'include_setting_page']
        );

        add_action('admin_init', [__NAMESPACE__ . '\Settings', 'register_options']);
    }

    /**
     * Register options
     */
    public static function register_options()
    {
        register_setting(self::getOptionName('group'), self::getOptionName('lead_domain'), [__NAMESPACE__ . '\Helpers', 'parseDomain']);
        register_setting(self::getOptionName('group'), self::getOptionName('lead_api'));
        register_setting(self::getOptionName('group'), self::getOptionName('lead_backup_email'), [__NAMESPACE__ . '\Helpers', 'isEmail']);
    }

    /**
     * Include page
     */
    public static function include_setting_page() {
        include_once 'View.php';
    }

    /**
     * Add link to Setting Page and Install Module Landing
     * @param $links
     * @return mixed
     */
    public static function add_link_to_plugin_widget($links)
    {
        $url = esc_url(add_query_arg(
            'page',
            'flamix-bitrix24-and-contact-forms-7-integrations/settings/Settings.php',
            get_admin_url() . 'options-general.php'
        ));

        $settings_link  = '<a href="' . $url . '">' . __( 'Settings' ) . '</a>';
        $plugin_link    = '<a target="_blank" href="https://flamix.solutions/bitrix24/integrations/site/cf7.php">Bitrix24 Plugin</a>';

        array_push(
            $links,
            $settings_link,
            $plugin_link
        );

        return $links;
    }
}