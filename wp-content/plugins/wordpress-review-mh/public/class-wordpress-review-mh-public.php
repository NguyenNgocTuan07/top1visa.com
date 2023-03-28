<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://dominhhai.com/
 * @since      1.0.0
 *
 * @package    Wordpress_Review_Mh
 * @subpackage Wordpress_Review_Mh/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wordpress_Review_Mh
 * @subpackage Wordpress_Review_Mh/public
 * @author     Đỗ Minh Hải <minhhai27121994@gmail.com>
 */
class Wordpress_Review_Mh_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	private $table_reviews = 'dmh_rv_reviews';
	private $table_products = 'dmh_rv_products';

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	public $settings;

	

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		// add_action( 'woocommerce_product_tabs', [$this, 'rv_replace_default_review'] );

		
		$settings = get_option('wp_rv_settings', false);
		$settings = json_decode($settings, true);
		$this->settings = $settings;

		if($settings['active']['rating'] == 'false' && $settings['active']['comment'] == 'false')
			return;
		

		// var_dump($settings);
		if($this->settings['product_show']['reviews'] == 'true' || $this->settings['product_show']['sold'] == 'true')
		add_action( 'woocommerce_shop_loop_item_title', [$this, 'rv_product_loop_meta'] );

		if($this->settings['product_show']['reviews'] == 'true'){

			add_action( 'woocommerce_single_product_summary', [$this, 'rv_product_single_meta'], 5 );
		}
		


		if($this->settings['turn_off_review_default'] == 'true'){ 

			add_filter( 'woocommerce_product_tabs', [$this, 'sb_woo_remove_reviews_tab'], 98);
		}

		if($this->settings['instead_of_my_review'] == 'true'){
				add_action( 'woocommerce_after_single_product_summary', [$this, 'rv_replace_default_review_callback'] );
		}

		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating ', 10);

		add_shortcode( 'wp_reviews_mh_all', [$this, 'wp_reviews_mh_all'] );

		add_shortcode( 'wp_reviews_mh', [$this, 'rv_shortcode'] );
		add_shortcode( 'wp_rv_product_single_meta', [$this, 'rv_product_single_meta_short_code'] );

		add_action('woocommerce_single_product_summary', [$this, 'customizing_single_product_summary_hooks'], 2  );

		add_action('woocommerce_checkout_order_processed', [$this, 'fsmh_woocommerce_checkout_order_processed'], 10, 1);

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		add_action('woocommerce_after_single_product_summary', function(){
			echo do_shortcode('[wp_reviews_mh]');
		}, 15);
	}

	public function customizing_single_product_summary_hooks(){
	    remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating', 10 );

	}


	public function rv_shortcode(){

		ob_start();
		$this->rv_replace_default_review_callback();
		$output = ob_get_clean();
		return $output;
	}

	public function wp_reviews_mh_all(){
		ob_start();
		$this->rv_replace_default_review_callback(['all' => true]);
		$output = ob_get_clean();
		return $output;
	}

	public function rv_product_single_meta(){
		global $wpdb;
		$id = get_the_ID();
		$sql = "SELECT * FROM  $this->table_products WHERE post_id = $id";
		$data = $wpdb->get_row( $sql );
		if($data){
			$offset = ['0'=> 1, '0.1'=> 3, '0.2'=> 3, '0.3'=> 1, '0.4'=> 0, '0.5'=> -1, '0.6'=> -2, '0.7'=> -3, '0.8'=> -4, '0.9'=> -4, '1'=> 1, '1.1'=> 3, '1.2'=> 3, '1.3'=> 1, '1.4'=> 0, '1.5'=> -1, '1.6'=> -2, '1.7'=> -3, '1.8'=> -4, '1.9'=> -4, '2'=> 1, '2.1'=> 3, '2.2'=> 4, '2.3'=> 2, '2.4'=> 1, '2.5'=> 0, '2.6'=> -1, '2.7'=> -3, '2.8'=> -4, '2.9'=> -4, '3'=> 1, '3.1'=> 4, '3.2'=> 5, '3.3'=> 4, '3.4'=> 3, '3.5'=> 1, '3.6'=> -1, '3.7'=> -2, '3.8'=> -3, '3.9'=> -4, '4'=> 1, '4.1'=> 4, '4.2'=> 5, '4.3'=> 5, '4.4'=> 3, '4.5'=> 2, '4.6'=> 0, '4.7'=> -1, '4.8'=> -1, '4.9'=> -1, '5'=> 1, ];
		}
		$data->average = round($data->average, 1);
		
		$margin_w = isset($data->average) ? $offset[$data->average] : 0;

		$sql = "SELECT COUNT(id) FROM $this->table_reviews WHERE type = 2 AND status = 2";
		$total_comments = $wpdb->get_var($sql);

		load_view('/public/partials/templates/tiki-theme/product-single-meta.php', ['settings' => $this->settings], true);

	}

	public function rv_product_single_meta_short_code(){
		ob_start();
		$this->rv_product_single_meta();
		return ob_get_clean();
	}

	public function rv_product_loop_meta() {
		global $wpdb, $product;
		$id = get_the_ID();
		
		$sql = "SELECT * FROM  $this->table_products WHERE post_id = $id";
		$data = $wpdb->get_row( $sql );
		if($data){
			$offset = ['0'=> 1, '0.1'=> 3, '0.2'=> 3, '0.3'=> 1, '0.4'=> 0, '0.5'=> -1, '0.6'=> -2, '0.7'=> -3, '0.8'=> -4, '0.9'=> -4, '1'=> 1, '1.1'=> 3, '1.2'=> 3, '1.3'=> 1, '1.4'=> 0, '1.5'=> -1, '1.6'=> -2, '1.7'=> -3, '1.8'=> -4, '1.9'=> -4, '2'=> 1, '2.1'=> 3, '2.2'=> 4, '2.3'=> 2, '2.4'=> 1, '2.5'=> 0, '2.6'=> -1, '2.7'=> -3, '2.8'=> -4, '2.9'=> -4, '3'=> 1, '3.1'=> 4, '3.2'=> 5, '3.3'=> 4, '3.4'=> 3, '3.5'=> 1, '3.6'=> -1, '3.7'=> -2, '3.8'=> -3, '3.9'=> -4, '4'=> 1, '4.1'=> 4, '4.2'=> 5, '4.3'=> 5, '4.4'=> 3, '4.5'=> 2, '4.6'=> 0, '4.7'=> -1, '4.8'=> -1, '4.9'=> -1, '5'=> 1, ];

			$offset[$data->average] = round($offset[$data->average], 1);

			$margin_w = isset($offset[$data->average]) ? $offset[$data->average] : 0;
			load_view('/public/partials/templates/tiki-theme/product-meta.php', [
					'data' => $data,
					'settings' => $this->settings,
					'margin_w' => $margin_w
			], true);
		}
	}


	
	 
	public function rv_replace_default_review_callback($args = []) {
		global $wpdb;

	 	$post_id = get_the_ID();

	 	$whereArr = [
	 		"post_id" 		=> "post_id = $post_id",
	 		"parent_id" 	=> "parent_id = 0",
	 		"type"			=> "type = 1",
	 		'status'		=> 'status = 2',
	 		'date'			=> 'DATE(`created_at`) <= CURRENT_DATE()'
	 	];
	 	if(isset($args['all']))
	 		unset($whereArr['post_id']);

	 	if(sizeof($whereArr) > 0)
	 		$where = "WHERE " . implode(" AND ", array_values($whereArr));
	 	$per_page = $this->settings['per_page']['review'];
	 	// print_r($per_page);

	 	$date_format = '%d/%m/%Y %H:%i';
	 	if($this->settings['is_time_ago'] == 'true')
		 	$date_format = '%Y-%m-%dT%TZ';

	 	$sql = "SELECT SQL_CALC_FOUND_ROWS *, DATE_FORMAT(created_at, '$date_format') as date FROM  $this->table_reviews $where ORDER BY UNIX_TIMESTAMP(created_at) DESC limit 0, $per_page";


	 	$reviews = $wpdb->get_results( $sql );
	 	$total_reviews = $wpdb->get_var("SELECT FOUND_ROWS() as total");
	 

	 	foreach ($reviews as $key => &$record) {
	 		if($record->attactments)
	 			$record->attactments = json_decode($record->attactments, true);


		 	$sql = "SELECT *, DATE_FORMAT(created_at, '$date_format') as date FROM  $this->table_reviews WHERE parent_id = $record->id ORDER BY UNIX_TIMESTAMP(created_at) DESC";
 		 	$children = $wpdb->get_results( $sql );
 		 	// print_r($children);

 		 	if($children)
 		 	{
 		 		foreach ($children as $key => &$child) {
		 			$child->attactments = json_decode($child->attactments, true);
 		 		}
 		 		$record->children = $children;
 		 	}
 		 	$record->post = [
 		 		'title' => get_the_title($record->post_id),
 		 		'image' => get_the_post_thumbnail_url($record->post_id),
 		 	];

	 	}

	 	$whereArr['type'] = 'type = 2';
	 	$where = "WHERE " . implode(" AND ", array_values($whereArr));
	 	$per_page = $this->settings['per_page']['comment'];

	 	
	 	// print_r($per_page);
	 	$sql = "SELECT SQL_CALC_FOUND_ROWS *, DATE_FORMAT(created_at, '$date_format') as date FROM  $this->table_reviews $where ORDER BY UNIX_TIMESTAMP(created_at) DESC limit 0, $per_page";

	 	$comments = $wpdb->get_results( $sql );
	 	$total_comments = $wpdb->get_var("SELECT FOUND_ROWS() as total");

	 	foreach ($comments as $key => &$record) {
	 		if($record->attactments)
	 			$record->attactments = json_decode($record->attactments, true);


		 	$sql = "SELECT *, DATE_FORMAT(created_at, '$date_format') as date FROM  $this->table_reviews WHERE parent_id = $record->id";
 		 	$children = $wpdb->get_results( $sql );
 		 	// print_r($children);

 		 	if($children)
 		 	{
 		 		foreach ($children as $key => &$child) {
		 			$child->attactments = json_decode($child->attactments, true);
 		 		}
 		 		$record->children = $children;
 		 	}

	 	}
	


		$data_extract = [
			'review_all' => isset($args['all']) ? true : false,
			'star_labels' => [
				1 => 'Rất không hài lòng',
				2 => 'Không hài lòng',
				3 => 'Bình thường',
				4 => 'Hài lòng',
				5 => 'Cực kì hài lòng',
			],
			'settings' => $this->settings,
			'img_url' => get_site_url(). '/wp-content/uploads/wprv/h', 
			'post_id' => $post_id,
			'isFilter' => sizeof($whereArr) > 4,
			'reviews' => $reviews,
			'comments' => $comments,
			'pagination' => [
				'review' => [
					'total' => $total_reviews,
					'page'	=> 1,
					'max_page' => ceil($total_reviews / $this->settings['per_page']['review'])
				],
				'comment' => [
					'total' => $total_comments,
					'page'	=> 1,
					'max_page' => ceil($total_comments / $this->settings['per_page']['comment'])	
				]
			],
			
		];
		load_view('public/partials/wordpress-review-mh-public-display.php', $data_extract, true);
		// print_r($data_extract['pagination']);
		// wc_get_template(
		// 	'wordpress-review-mh-public-display.php',
		// 	$data_extract,
		// 	'',
		// 	plugin_dir_path( WP_REVIEW_MH ) . '/public/partials/'
		// );
	 	// include_once plugin_dir_path( __FILE__ ) . 'partials/' .$this->plugin_name . '-public-display.php';
		
	 
	}

	public function fsmh_woocommerce_checkout_order_processed($order_id){
			global $wpdb;
			$order = wc_get_order($order_id);
			if($order)
			{
				$items = $order->get_items();
				foreach ( $items as $item ) {
					$id = $item->get_product_id();
					$sql = "SELECT * FROM dmh_rv_products WHERE post_id = $id";
					$record = $wpdb->get_row($sql, ARRAY_A);
					if($record){
						$wpdb->update('dmh_rv_products', ['sold' => $record['sold'] + $item->get_quantity()], ['id' => $record['id']]);
					}
					
				}
				
			}
		}

	public function sb_woo_remove_reviews_tab($tabs)
	{
		
		unset($tabs['reviews']);
		return $tabs;

	}
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordpress_Review_Mh_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Review_Mh_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-review-mh-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordpress_Review_Mh_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Review_Mh_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpress-review-mh-public.js', array( 'jquery' ), $this->version, false );

	}

}


// UPDATE table SET nameofdatefield = ADDDATE(nameofdatefield, 2)