<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://dominhhai.com/
 * @since             1.8
 * @package           Wordpress_Review_Mh
 *
 * @wordpress-plugin
 * Plugin Name:       Wordpress Review MH
 * Plugin URI:        wordpress-review-mh
 * Description:       Plugin Đánh giá và Bình luận cho Sản phẩm, Bài viết của bạn cực xịn xò.
 * Version:           1.8
 * Author:            Đỗ Minh Hải
 * Author URI:        https://dominhhai.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress-review-mh
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'WP_REVIEW_MH' ) ) {
	define( 'WP_REVIEW_MH', __FILE__ );
}
if ( ! defined( 'WP_RV_IS_MOBILE' ) ) {
	define( 'WP_RV_IS_MOBILE', wp_is_mobile() );
}
if ( ! defined( 'WP_RV_URL' ) ) {
 define('WP_RV_URL', get_site_url());
}
if ( ! defined( 'WP_RV_PLUGIN_URL' ) ) {
 define('WP_RV_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WORDPRESS_REVIEW_MH_VERSION', '1.8' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordpress-review-mh-activator.php
 */
function activate_wordpress_review_mh() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-review-mh-activator.php';
	Wordpress_Review_Mh_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordpress-review-mh-deactivator.php
 */
function deactivate_wordpress_review_mh() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-review-mh-deactivator.php';
	Wordpress_Review_Mh_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wordpress_review_mh' );
register_deactivation_hook( __FILE__, 'deactivate_wordpress_review_mh' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-momo-mh-en.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-review-mh.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

//Helper
if(!function_exists('addMinutesAndSeconds'))
{
	function addMinutesAndSeconds($time_string, $random = [], $minutes = 0){
		if($random)
			$minutes = rand($random['min'], $random['max']);
		$seconds = rand(0, 60);
		$newtimestamp = strtotime("$time_string + $minutes minutes + $seconds seconds");
		return date('Y-m-d H:i:s', $newtimestamp);
	}

}
if(!function_exists('getClientIP'))
{
	function getClientIP() {

	    if (isset($_SERVER)) {

	        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
	            return $_SERVER["HTTP_X_FORWARDED_FOR"];

	        if (isset($_SERVER["HTTP_CLIENT_IP"]))
	            return $_SERVER["HTTP_CLIENT_IP"];

	        return $_SERVER["REMOTE_ADDR"];
	    }

	    if (getenv('HTTP_X_FORWARDED_FOR'))
	        return getenv('HTTP_X_FORWARDED_FOR');

	    if (getenv('HTTP_CLIENT_IP'))
	        return getenv('HTTP_CLIENT_IP');

	    return getenv('REMOTE_ADDR');
	}
}
if(!function_exists('load_view'))
{
	function load_view($view, $data = array(), $echo = false) 
	{
	    // Chuyển mảng dữ liệu thành từng biến
	    extract($data);
	     
	    // Chuyển nội dung view thành biến thay vì in ra bằng cách dùng ab_start()
	    ob_start();
	    require plugin_dir_path( WP_REVIEW_MH ) . '/' . $view;
	    $content = ob_get_contents();
	    ob_end_clean();
	     
	    // Gán nội dung vào danh sách view đã load
	    if($echo)
	    	echo $content;
	    else
	        return $content;
	}
}

if(!function_exists('getSmartPageNumbers')){
	function getSmartPageNumbers($currentPage, $totalPage)
	{

		if($currentPage == $totalPage  && $currentPage > 1)
			return getSmartPageNumbers(1, $totalPage);

	    $pageNumbers = [];
	    $diff = 2;
	    
	    if($totalPage < 10){
	        $arr = [];
	        for ($i=1; $i <= $totalPage; $i++) { 
	            $arr[] = $i;
	        }
	        return $arr;
	    }


	    
	    $firstChunk = [1, 2, 3];
	    $lastChunk = [$totalPage - 2, $totalPage - 1, $totalPage];
	    
	    if ($currentPage < $totalPage) {
	        $loopStartAt = $currentPage - $diff;
	        if ($loopStartAt < 1) {
	            $loopStartAt = 1;
	        }
	        
	        $loopEndAt = $loopStartAt + ($diff * 2);
	        if ($loopEndAt > $totalPage) {
	            $loopEndAt = $totalPage;
	            $loopStartAt = $loopEndAt - ($diff * 2);
	        }
	        
	        if (!in_array($loopStartAt, $firstChunk)) {
	            foreach ($firstChunk as $i) {
	                $pageNumbers[] = $i;
	            }
	            
	            $pageNumbers[] = '...';
	        }
	        
	        for ($i = $loopStartAt; $i <= $loopEndAt; $i++) {
	            $pageNumbers[] = $i;
	        }
	        
	        if (!in_array($loopEndAt, $lastChunk)) {
	            $pageNumbers[] = '...';
	            
	            foreach ($lastChunk as $i) {
	                $pageNumbers[] = $i;
	            }
	        }
	    }
	    
	    return $pageNumbers;
	}
}

//

function run_wordpress_review_mh() {

	$plugin = new Wordpress_Review_Mh();
	$plugin->run();

}
run_wordpress_review_mh();
