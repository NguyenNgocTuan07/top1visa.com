<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://dominhhai.com/
 * @since      1.0.0
 *
 * @package    Wordpress_Review_Mh
 * @subpackage Wordpress_Review_Mh/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordpress_Review_Mh
 * @subpackage Wordpress_Review_Mh/admin
 * @author     Đỗ Minh Hải <minhhai27121994@gmail.com>
 */
include "class-product.php";
class Wordpress_Review_Mh_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	public $settings;
	public $productClass;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $table_reviews = 'dmh_rv_reviews';
	private $table_products = 'dmh_rv_products';
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->productClass = new Wordpress_Review_Mh_Product();

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$settings = get_option('wp_rv_settings', false);
		$settings = json_decode($settings, true);
		$this->settings = $settings;

		if(is_admin() && defined('WORDPRESS_REVIEW_MH'))
		{

			
			//For Admin Only
			add_action('admin_menu', [$this, 'add_admin_pages']); 
			add_action('wp_ajax_wp_rv_update_column', [$this, 'update_column']);
			add_action('wp_ajax_wp_rv_remove_review', [$this, 'remove_review']);
			add_action('wp_ajax_wp_rv_update_columns', [$this, 'update']);
			add_action('wp_ajax_wp_rv_get_posttypes', [$this, 'get_posttypes']);
			add_action('wp_ajax_wp_rv_get_general_info', [$this, 'get_general_info']);
			add_action('wp_ajax_wp_rv_tool_create_review', [$this, 'tool_create_review']);
			add_action('wp_ajax_wp_rv_tool_create_comment', [$this, 'tool_create_comment']);
			add_action('wp_ajax_wp_rv_tool_increase_date', [$this, 'tool_increase_date']);
			add_action('wp_ajax_wp_rv_tool_sold_product', [$this, 'tool_sold_product']);
			add_action('wp_ajax_wp_rv_reset_all_data', [$this, 'reset_all_data']);
			add_action('wp_ajax_wp_rv_admin_reply_review', [$this, 'admin_reply_review']);
			add_action('wp_ajax_wp_rv_get_option', [$this, 'get_option']);
			add_action('wp_ajax_wp_rv_save_option', [$this, 'save_option']);
		}





		add_action('wp_ajax_nopriv_wp_rv_review', [$this, 'review']);
		add_action('wp_ajax_wp_rv_review', [$this, 'review']);
		add_action('wp_ajax_nopriv_wp_rv_comment', [$this, 'comment']);
		add_action('wp_ajax_wp_rv_comment', [$this, 'comment']);
		add_action('wp_ajax_nopriv_wp_rv_do_like', [$this, 'do_like']);
		add_action('wp_ajax_wp_rv_do_like', [$this, 'do_like']);
		add_action('wp_ajax_wp_rv_get_reviews', [$this, 'getReviews']);
		add_action('wp_ajax_nopriv_wp_rv_get_reviews_f', [$this, 'get_reviews_front_end']);
		add_action('wp_ajax_wp_rv_get_reviews_f', [$this, 'get_reviews_front_end']);
		add_action('wp_ajax_wp_rv_get_post_info', [$this, 'get_post_info']);
		add_action('wp_ajax_nopriv_wp_rv_get_post_info', [$this, 'get_post_info']);
		

		add_filter( 'wp_mail_content_type', [$this, 'wpse278561_set_content_type_'] );
		add_action('woocommerce_order_item_meta_end', [$this, 'completed_order_email_notification'], 10, 4);
		// add_action( 'woocommerce_order_status_changed', [$this, 'order_status_changed'], 10, 4 );
		// add_filter( 'woocommerce_email_order_items_args', [$this, 'bt_email_order_items_args'], 10, 1 );
		add_action('admin_enqueue_scripts', [$this, 'my_media_lib_uploader_enqueue']);

		
	}


	public function my_media_lib_uploader_enqueue() {
	    wp_enqueue_media();
	    wp_register_script( 'media-lib-uploader-js', plugins_url( 'media-lib-uploader.js' , __FILE__ ), array('jquery') );
	    wp_enqueue_script( 'media-lib-uploader-js' );
	}
	public function wpse278561_set_content_type_(){
		    return "text/html";
	}

	public function add_admin_pages()
	{
			$icon = WP_RV_PLUGIN_URL . 'assets/images/favourites.svg';
			// $icon = plugin_dir_url( __FILE__ ) . 'images/theme_option.png';
			add_menu_page(
		        __( 'WP Reviews MH', 'textdomain' ),
		        'WP Reviews MH',
		        'manage_options',
		        'wp_reviews_mh',
		        [$this, 'admin_template'],
		        $icon,
		        110
		    );


		    
	}


	public function admin_template()
	{
		// wp_redirect( get_site_url() . '/wp-content/plugins/wordpress-review-mh/admin/' );
		require_once plugin_dir_path( __FILE__ ) . 'partials/' .$this->plugin_name . '-admin-display.php';
	}

	public function tool_increase_date(){
		global $wpdb;
		$increase = isset($_POST['increase']) ? $_POST['increase'] : '';
		if($increase)
		{
			$sql = "UPDATE dmh_rv_reviews SET created_at = ADDDATE(created_at, $increase)";
			// $sql = "UPDATE dmh_rv_reviews SET created_at = ADDDATE(created_at, $increase)  WHERE date(created_at) = CURDATE() - 2";

			$wpdb->query($sql);
		}
		echo json_encode(['success' => true, 'msg' => 'Thao tác thành công']);
	    die();
	}



	public function tool_sold_product(){
		global $wpdb;

		$min = isset($_POST['min']) ? $_POST['min'] : 10;
		$max = isset($_POST['max']) ? $_POST['max'] : 50;

		$products_IDs = new WP_Query( array(
		        'post_type' => 'product',
		        'post_status' => 'publish',
		        'fields' => 'ids', 
		        'posts_per_page' => -1
		        
	    ) );
	    $products = $products_IDs->posts;
	    if(sizeof($products))
	    {
	    	foreach ($products as $key => $id) {

    			$sold = rand($min,$max);
	    		$sql = "SELECT * from $this->table_products WHERE post_id = $id";
	    		$record = $wpdb->get_row($sql);
	    		if($record)
	    		{
	    			$sql = "UPDATE $this->table_products SET sold = $sold WHERE post_id = $id";
	    			$wpdb->query($sql);
	    		}
	    		else
	    		{
	    			$data = [
	    				'post_id' => $id,
	    				'sold'	  => $sold	
	    			];
	    			$wpdb->insert($this->table_products, $data);
	    		}
	    	}
	    }
		echo json_encode(['success' => true, 'msg' => 'Thao tác thành công']);

	    die();

	}


	public function reset_all_data(){
		global $wpdb;
		$sql = "DELETE FROM dmh_rv_products";
		$wpdb->query($sql);
		$sql = "DELETE FROM dmh_rv_reviews";
		$wpdb->query($sql);
		delete_option('wp_rv_settings');
		$this->deleteDir(str_replace('h', '', wp_upload_dir('wprvmh')['path']));
		echo json_encode(['success' => true, 'msg' => 'Đã xóa toàn bộ dữ liệu']);
		die();
	}

	public function tool_create_comment(){
		global $wpdb;

		$records = isset($_POST['records']) ? $_POST['records'] : '';
		if($records && sizeof($records) > 0)
		{
			foreach ($records as $key => $record) {
				$postOject = get_post($record['post_id']);

				if(!$postOject)
					continue;

				$data = [
					'type'					=> 2,
					'status'				=> 2,
					'post_id' 				=> $record['post_id'],
					'post_type' 			=> $postOject->post_type,
					'message'	  			=> $record['message'],		
					'customer_name'	 		=> $record['name'],		
					'customer_email'		=> $record['email'],		
					'customer_phone'		=> $record['phone'],
					'customer_phone_hidden' => substr($record['phone'], 0, 3)  . '.' . substr($record['phone'], 4, 4),
					'by_admin'				=> current_user_can('administrator') ? 1 : 0,
					'ip' 					=> getClientIP(),
					'created_at'			=> $record['time']
				];
				
				$query = $wpdb->insert($this->table_reviews, $data);
				if($query){
					if($record['reply'])
					{
						$parent_id = $wpdb->insert_id;
						$data = [
							'type'		=> 2,
							'post_id' 	=> $record['post_id'],
							'post_type' => $postOject->post_type,
							'parent_id' => $parent_id,
							'message'	=> $record['reply'],
							'is_admin_message' => 1,
							'by_admin'	=> 1,
							'created_at' => $record['time_reply']
						];
						$query = $wpdb->insert($this->table_reviews, $data);
					}
					$this->handle_post_stat($record['post_id']);
				}
			}
		}
		echo json_encode(['success' => true, 'msg' => 'Thành công']);
		die();
	}

	public function tool_create_review(){
		global $wpdb;

		$records = isset($_POST['records']) ? $_POST['records'] : '';
		if($records && sizeof($records) > 0)
		{
			foreach ($records as $key => $record) {
				$postOject = get_post($record['post_id']);

				if(!$postOject)
					continue;

				$data = [
					'type'					=> 1,
					'status'				=> 2,
					'post_id' 				=> $record['post_id'],
					'stars' 				=> $record['stars'],
					'post_type' 			=> $postOject->post_type,
					'message'	  			=> $record['message'],		
					'customer_name'	 		=> $record['name'],		
					'customer_email'		=> $record['email'],		
					'likes'					=> isset($record['likes']) ? $record['likes'] : 0,		
					'customer_phone'		=> $record['phone'],
					'customer_phone_hidden' => substr($record['phone'], 0, 3)  . '.' . substr($record['phone'], 4, 4),
					'buyed'					=> $record['buyed'],		
					'by_admin'				=> current_user_can('administrator') ? 1 : 0,
					'ip' 					=> getClientIP(),
					'created_at'			=> $record['time']
				];
				if($record['attactments'])
				{
					$data['attactments'] = json_encode($record['attactments']);
				}
				if($record['video'])
				{
					$data['video'] = $record['video'];
				}

				$query = $wpdb->insert($this->table_reviews, $data);
				$parent_id = $wpdb->insert_id;
				$review_id = $wpdb->insert_id;

				$this->syncComment($review_id);

				if($query){
					if($record['reply'])
					{
						$data = [
							'type'		=> 1,
							'post_id' 	=> $record['post_id'],
							'post_type' => $postOject->post_type,
							'parent_id' => $parent_id,
							'message'	=> $record['reply'],
							'is_admin_message' => 1,
							'by_admin'	=> 1,
							'created_at' => $record['time_reply']
						];
						$query = $wpdb->insert($this->table_reviews, $data);
					}
					$this->handle_post_stat($record['post_id']);
				}
			}
		}
		echo json_encode(['success' => true, 'msg' => 'Thành công']);
		die();
	}

	public function get_posttypes(){
		$args = array(
		   'public'   => true,
		);

		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'
		$result = [
			['label' => 'Tất cả', 'value' => ''] 
		];
		$post_types = get_post_types( $args, $output, $operator ); 
		foreach ($post_types as $key => $v) {
			if($key == 'attachment')
				continue;
			$pt = get_post_type_object( $v );
			$result[] = [
				'label' => $pt->labels->name,
				'value' => $key,
			];
		}
		echo json_encode(['success' => true, 'data' => $result]);
		die();
	}
	public function update(){
		$columns = isset($_POST['columns']) ? $_POST['columns'] : '';
		$id = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';
		
		if($columns && $id)
		{
			print_r($columns);
		}
		die();
	}

	public function do_like(){
		global $wpdb;
		$id = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';
		$sql = "UPDATE $this->table_reviews SET likes = likes + 1 WHERE id = $id";
		if($wpdb->query($sql))
		{
			echo json_encode(['success' => true, 'msg' => 'Cảm ơn bạn đã góp ý']);

		}
		else
			echo json_encode(['success' => false, 'msg' => 'Có lỗi xảy ra vui lòng thử lại sau']);
		die();
	}
	public function comment(){
		global $wpdb;

		$post_id = isset($_POST['post_id']) ? sanitize_text_field($_POST['post_id']) : '';
		$message = isset($_POST['message']) ? sanitize_text_field($_POST['message']) : '';
		$customer_name = isset($_POST['customer_name']) ? sanitize_text_field($_POST['customer_name']) : '';
		$customer_email = isset($_POST['customer_email']) ? sanitize_text_field($_POST['customer_email']) : '';
		$parent_id = isset($_POST['parent_id']) ? sanitize_text_field($_POST['parent_id']) : '';

		if(!$post_id || !$message  || !$customer_name)
		{
			echo json_encode(['success' => false, 'msg' => 'Dữ liệu không hợp lệ']);
			die();
		}
		
		$postOject = get_post($post_id);
		if(!$postOject)
		{
			echo json_encode(['success' => false, 'msg' => 'Dữ liệu không hợp lệ']);
			die();
		}

		//Check IP before insert a new record  // Prevent Spam
		if($this->settings['limit']['ip'] == 'true')
				$this->check_spam(2, $post_id, $ip);


		$record = [
			'post_id' 				=> $post_id,
			'type'					=> 2,
			'post_type' 			=> $postOject->post_type,
			'message'	  			=> $message,		
			'customer_name'	 		=> $customer_name,		
			'customer_email'		=> $customer_email,		
			'parent_id'				=> $parent_id,
			'by_admin'				=> current_user_can('administrator') ? 1 : 0,
			'ip'					=> getClientIP(),
			'created_at'			=> date('Y-m-d H:i:s')
		];


		$query = $wpdb->insert($this->table_reviews, $record);

		// echo $wpdb->last_query;
		// // Print last SQL query result
		// echo $wpdb->last_result;
		// // Print last SQL query Error
		// echo $wpdb->last_error;

		
		if($query)
			echo json_encode(['success' => true, 'record' => $query, 'msg' => $parent_id ? 'Chúc mừng bạn trả lời bình luận thành công' :'Chúc mừng bạn bình luận thành công']);
		else
			echo json_encode(['success' => false, 'msg' => 'Có lỗi xảy ra vui lòng thử lại sau.']);

		die();

	}

	public function get_general_info(){
		global $wpdb;
		$sql = "SELECT COUNT(T1.id) as total FROM `dmh_rv_reviews` T1 LEFT JOIN dmh_rv_reviews T2 ON T1.id = T2.parent_id WHERE (T1.parent_id = 0 AND T1.status = 1 AND T1.type = 1) OR (T2.status = 1 AND T2.is_admin_message = 0 AND T2.type = 1)";
		$reviews_total = $wpdb->get_var($sql);


		$sql = "SELECT COUNT(T1.id) as total FROM `dmh_rv_reviews` T1 LEFT JOIN dmh_rv_reviews T2 ON T1.id = T2.parent_id WHERE (T1.parent_id = 0 AND T1.status = 1 AND T1.type = 2) OR (T2.status = 1 AND T2.is_admin_message = 0 AND T2.type = 2)";
		$comments_total = $wpdb->get_var($sql);
		echo json_encode(['success' => true, 'moderated' => ['review' => $reviews_total, 'comment' => $comments_total]]);
		die();
	}

	public function check_spam($type, $post_id, $ip){



		global $wpdb;
		$sql = "SELECT COUNT(id) FROM dmh_rv_reviews WHERE ip = '$ip' AND type = $type AND created_at > DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
		$total = $wpdb->get_var($sql);
		if($total > 5){
			echo 'spam';
			die();
		}
	}

	public function review(){
		global $wpdb;

		if($this->settings['captcha']['active'] == 'true')
		{
			if(isset($_POST['gcaptcha'])){
			  $gcaptcha=$_POST['gcaptcha'];
			}
			if(!$gcaptcha){
			  echo json_encode(['success' => false, 'msg' => 'Hãy xác thực mã Captcha']);
			  exit;
			}
			$url = "https://www.google.com/recaptcha/api/siteverify?secret=" .$this->settings['captcha']['server_key'] . "&response=".$gcaptcha."&remoteip=".$_SERVER['REMOTE_ADDR'];
			$result = file_get_contents($url);

			$result = json_decode($result, true);
			if(!$result['success'])
			{
			    echo json_encode(['success' => false, 'msg' => 'Hãy xác thực mã Captcha']);
			    exit;
			}
		}

		$post_id = isset($_POST['post_id']) ? sanitize_text_field($_POST['post_id']) : '';
		$stars = isset($_POST['stars']) ? sanitize_text_field($_POST['stars']) : '';
		$message = isset($_POST['message']) ? sanitize_text_field($_POST['message']) : '';
		$customer_phone = isset($_POST['customer_phone']) ? sanitize_text_field($_POST['customer_phone']) : '';
		$customer_name = isset($_POST['customer_name']) ? sanitize_text_field($_POST['customer_name']) : '';
		$customer_email = isset($_POST['customer_email']) ? sanitize_text_field($_POST['customer_email']) : '';
		$attactments = isset($_POST['attactments']) ? $_POST['attactments'] : '';
		$parent_id = isset($_POST['parent_id']) ? sanitize_text_field($_POST['parent_id']) : '';
		$ip = getClientIP();

		//Validate phone and email 
		if(!$post_id || !$message  || !$customer_name)
		{

			echo json_encode(['success' => false, 'msg' => 'Dữ liệu không hợp lệ']);
			die();
		}
		if($this->settings['customer_phone'] == 'true' &&  !is_user_logged_in() && strlen($customer_phone) != 10)
		{
			echo json_encode(['success' => false, 'msg' => 'Dữ liệu không hợp lệ']);
			die();	
		}
		if($parent_id == 0 && !$stars)
		{
			echo json_encode(['success' => false, 'msg' => 'Dữ liệu không hợp lệ']);
			die();
		}

		$postOject = get_post($post_id, $post_id, $ip);
		if(!$postOject)
		{

			echo json_encode(['success' => false, 'msg' => 'Dữ liệu không hợp lệ']);
			die();
		}

		//Check exists 
		if($parent_id){
			$record_exist = $this->get_record($this->table_reviews, $parent_id);
			// print_r($record_exist);
			if($record_exist && $record_exist->type == 1)
			{
			
				if(!is_user_logged_in() &&  strlen($customer_phone) != 10)
				{
					
					echo json_encode(['success' => false, 'msg' => 'Dữ liệu không hợp lệ']);
					die();
				}
			}
		}
		//Check IP before insert a new record  // Prevent Spam
		if($this->settings['limit']['ip'] == 'true')
				$this->check_spam(1, $post_id, $ip);

		//Upload Images
		$images = [];
		if($attactments && is_array($attactments) && sizeof($attactments) > 0)
		{
			
			foreach ($attactments as $key => $img) {
				$fileName = $this->generateRandomString(5) . time();

				// $images[] = $this->save_image($img, $fileName);
				$images[] = $this->saveBase64ImagePng($img, wp_upload_dir('wprvmh')['path'], $fileName);
			}
		}

		$by_admin = current_user_can('administrator') ? 1 : 0;
		if(!$by_admin)
			$by_admin = is_user_logged_in() ? 2 : 0;
		$record = [
			'post_id' 				=> $post_id,
			'type'					=> $parent_id > 0 ? $record_exist->type : 1,
			'post_type' 			=> $postOject->post_type,
			'stars'	 				=> $stars,		
			'message'	  			=> $message,		
			'customer_name'	 		=> $customer_name,		
			'customer_email'		=> $customer_email,		
			'attactments'			=> $images ? json_encode($images) : null,
			'parent_id'				=> $parent_id,
			'by_admin'				=> $by_admin,
			'ip'					=> $ip,
			'created_at'			=> date('Y-m-d H:i:s')
		];
		if(!is_user_logged_in())
		{
			$record['customer_phone'] = $customer_phone;
			$record['customer_phone_hidden'] = substr($customer_phone, 0, 3)  . '.' . substr($customer_phone, 4, 4);
		}



		$query = $wpdb->insert($this->table_reviews, $record);

		// echo $wpdb->last_query;
		// // Print last SQL query result
		// echo $wpdb->last_result;
		// // Print last SQL query Error
		// echo $wpdb->last_error;

		
		if($query)
			echo json_encode(['success' => true, 'record' => $query, 'msg' => $parent_id ? 'Chúc mừng bạn bình luận thành công' :'Chúc mừng bạn đánh giá sản phẩm thành công']);
		else
			echo json_encode(['success' => false, 'msg' => 'Có lỗi xảy ra vui lòng thử lại sau.']);


		if($this->settings['email']['active'] == 'true' && !current_user_can('administrator')){

			$this->sendEmail('new-review', [
				'type' => $record['type'],
				'customer_email' => $record['customer_email'],
				'customer_name' => $record['customer_name'],
				'customer_phone' => $record['customer_phone'],
				'post_id' => $record['post_id'],
				'message' => $record['message'],
				'ip'	=> $record['ip'],
				'settings' => $this->settings
				
			]);
		}

		die();

	}

	public function getReviews(){
		global $wpdb;

		$page = isset($_POST['page']) ? htmlspecialchars($_POST['page']) : 1;
		$per_page = isset($_POST['per_page']) ? htmlspecialchars($_POST['per_page']) : 4;
		$filters = isset($_POST['filters']) ? $_POST['filters'] : '';
		$offset = ($page - 1) * $per_page;

		// $sql = "SELECT COUNT(id) as date FROM  $this->table_reviews WHERE (parent_id = 0 AND status = 1) OR (parent_id > 0 AND status = 1 AND is_admin_message < 1)";
		$whereT1 = ['T1.parent_id = 0'];
		$whereT2 = [];

		if($filters['type']){
			$whereT1[] = "T1.type = $filters[type]";
			$whereT2[] = "T2.type = $filters[type]";
		}
		 

		if($filters['search'])
		{
			$search = mb_strtolower ($filters['search'], 'UTF-8');
			$whereT1[] = "( lower(T1.customer_phone) LIKE '%$search%' OR lower(T1.customer_email) LIKE '%$search%' OR lower(T1.message) LIKE '%$search%' )"; 
			$whereT2[] = "( lower(T2.customer_phone) LIKE '%$search%' OR lower(T2.customer_email) LIKE '%$search%' OR lower(T2.message) LIKE '%$search%' )";
		}
		
			//Set status if search is null
		if($filters['status']){
			if($filters['status'] == 1)
				$whereT2[] = "T2.is_admin_message = 0";	
			$whereT1[] = "T1.status = $filters[status]";
			$whereT2[] = "T2.status = $filters[status]";
		}
		


		if($filters['post_type'])
		{
			$whereT1[] = "T1.post_type = '$filters[post_type]'";
			$whereT2[] = "T2.post_type = '$filters[post_type]'";
		}

		if($filters['post_id'])
		{
			$whereT1[] = "T1.post_id = $filters[post_id]";
			$whereT2[] = "T2.post_id = $filters[post_id]";
		}

		if(sizeof($whereT1))
			$whereT1 =  "WHERE (" . implode(" AND ", $whereT1) . ")";
		if(sizeof($whereT2))
			$whereT2 =  "OR (" . implode(" AND ", $whereT2) . ")";
		else
			$whereT2 = '';



		$sql = "SELECT SQL_CALC_FOUND_ROWS T1.* FROM `dmh_rv_reviews` T1 LEFT JOIN dmh_rv_reviews T2 ON T1.id = T2.parent_id $whereT1 $whereT2 GROUP BY T1.id ORDER BY UNIX_TIMESTAMP(T1.created_at) DESC limit $offset, $per_page";

		$records = $wpdb->get_results( $sql );

		$total_records = $wpdb->get_var("SELECT FOUND_ROWS() as total");



				
		
        if($records)
        {

        

        	foreach ($records as $key => &$record) {
        		if($record->attactments && !is_array($record->attactments)){
					$record->attactments = json_decode($record->attactments);
        		}
        		else
        			$record->attactments = [];
        		
        		$sql = "SELECT *,  DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as date FROM  $this->table_reviews WHERE parent_id = $record->id";
        		$children = $wpdb->get_results( $sql );
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
        			'link' => get_the_permalink($record->post_id),
        		];
        	}

        }




		$pagination = [
	            	'total' => intval($total_records),
	            	'page' 	=> intval($page),
	            	'per_page' => intval($per_page),
	            	'max_page'  => ceil($total_records / $per_page)
        ];


		echo json_encode([
			'data' => $records ? $records : [], 
			'pagination' => $pagination, 
			'success' => true
		]);

		die();
	}	

	public function get_reviews_front_end(){
		global $wpdb;

		$type = isset($_POST['type']) ? intval($_POST['type']) : 1;
		$page = isset($_POST['page']) ? htmlspecialchars($_POST['page']) : 1;
		$per_page = isset($_POST['per_page']) ? $_POST['per_page'] :  '';
		// echo $per_page;
		$filters = 	isset($_POST['filters']) ? $_POST['filters'] : '';
		$whereArr = [
			// "post_id" 		=> "post_id = $post_id",
			"parent_id" 	=> "parent_id = 0",
			"type"			=> "type = $type",
			"status"		=> "status = 2",
	 		'date'			=> 'DATE(`created_at`) <= CURRENT_DATE()'

		];


		if(isset($filters['post_id']) && $filters['post_id'])
			$whereArr[] = "post_id = $filters[post_id]";
		if($type == 1)
		{
			if(isset($filters['attactments']) && $filters['attactments'] == true)
				$whereArr[] = 'attactments IS NOT NULL';
			if(isset($filters['buyed']) && $filters['buyed']){
				$whereArr[] = "buyed = $filters[buyed]";
			}
			if(isset($filters['stars']) && $filters['stars'])
				$whereArr[] = 'stars IN ('.implode(',', $filters['stars']).')';
		}

		$offset = ($page - 1) * $per_page;

		if(sizeof($whereArr) > 0)
			$where = "WHERE " . implode(" AND ", $whereArr);


	 	$date_format = '%d/%m/%Y %H:%i';
	 	if($this->settings['is_time_ago'] == 'true')
		 	$date_format = '%Y-%m-%dT%TZ';

		$sql = "SELECT SQL_CALC_FOUND_ROWS *, DATE_FORMAT(created_at, '$date_format') as date FROM  $this->table_reviews $where ORDER BY UNIX_TIMESTAMP(created_at) DESC limit $offset, $per_page";
		// echo $sql;

		$reviews = $wpdb->get_results( $sql );
		$total_reviews = $wpdb->get_var("SELECT FOUND_ROWS() as total");
				
		$pagination = [
	            	'total' => intval($total_reviews),
	            	'page' 	=> intval($page),
	            	'per_page' => intval($per_page),
	            	'max_page'  => intval(ceil($total_reviews / $per_page))
        ];

        if($reviews)
        {
        	foreach ($reviews as $key => &$record) {
        		unset($record->customer_phone);
        		if($record->attactments)
        			$record->attactments = json_decode($record->attactments, true);

        		$sql = "SELECT *,  DATE_FORMAT(created_at, '$date_format') as date FROM  $this->table_reviews WHERE parent_id = $record->id ORDER BY UNIX_TIMESTAMP(created_at) DESC";
        		$children = $wpdb->get_results( $sql );
	 		 	if($children)
	 		 	{
	 		 		foreach ($children as $key => &$child) {
		        		unset($child->customer_phone);
			 			$child->attactments = json_decode($child->attactments, true);
	 		 		}
	 		 		$record->children = $children;
	 		 	}

        		$record->post = [
        			'title' => get_the_title($record->post_id),
        			'image' => get_the_post_thumbnail_url($record->post_id),
        		];
        	}
        }
        $template = $type == 1 ? 'reviews.php' : 'comments_.php';
        $img_url = get_site_url(). '/wp-content/uploads/wprv/h';

		ob_start();
        
        load_view('/public/partials/templates/tiki-theme/' . $template, 
    	[
    		'img_url' => $img_url,
    		'isFilter' => sizeof($whereArr) > 3,
    		'reviews' => $reviews,
    		'comments' => $reviews,
    		'settings' => $this->settings,
    		
    	], true);
		$html_reviews = ob_get_clean();
		
  

        ob_start();
        load_view('/public/partials/templates/tiki-theme/pagination.php', 
    	[
    		'pagination' => $pagination,
    		'type'		=> $type,
    		'settings' => $this->settings
    		
    	], true);
		$html_pagination = ob_get_clean();


		


        // die();
		echo json_encode([
			'data' => $reviews, 
			'pagination' => $pagination, 
			'html'	=> [
				'content' => $html_reviews,
				'pagination' => $html_pagination
			],
			'success' => true
		]);


		die();
	}

	public function get_post_info($id){
		global $wpdb;

		$review_all = isset($_POST['review_all']) ? intval($_POST['review_all']) : '';
		if($review_all){
			$whereArr = ["status = 2", "attactments IS NOT NULL"];
			if(sizeof($whereArr) > 0)
				$where = "WHERE " . implode(" AND ", $whereArr);
			$sql = "SELECT attactments FROM $this->table_reviews $where  ORDER BY id DESC limit 0,12";
		
			$records_with_photos = $wpdb->get_results($sql);
			$review_photos = [];
			if($records_with_photos)
			{
			
				foreach ($records_with_photos as $key => $v) {
					$img_arr = json_decode($v->attactments, true);
					$review_photos = array_merge($review_photos, $img_arr);
				}
			}


			$whereArr = ["status = 2", "parent_id = 0", "type = 1"];
			if(sizeof($whereArr) > 0)
				$where = "WHERE " . implode(" AND ", $whereArr);


			$sql = "SELECT  AVG(stars) as average_stars FROM $this->table_reviews $where";
			$average_stars = $wpdb->get_var( $sql );
			$sql = "SELECT COUNT(id) as total, stars FROM $this->table_reviews $where GROUP BY stars";
			$star_stats = $wpdb->get_results( $sql );
			$total_records = $wpdb->get_var("SELECT COUNT(id) FROM $this->table_reviews $where");


			
			$post = get_post($id);
			$data = [
				'post' => [
					'title' => $post->post_title,
					'thumbnail' => get_the_post_thumbnail_url($id, 'thumbnail'),
					'image' => get_the_post_thumbnail_url($id),
				],
				'average_stars' => $average_stars ? round($average_stars, 1): 0, 
				'star_stats' 	=> $star_stats ? $star_stats : '', 
				'total' 		=> $total_records ? intval($total_records): 0,
				'sold' 			=> 0,
				'review_photos' => $review_photos,


			];

			echo json_encode(['success' => true, 'data' => $data, 'msg' => 'Lấy dữ liệu thành công']);
			die();
		}

		$id = isset($_POST['id']) ? intval($_POST['id']) : '';
		if($id)
		{
			$whereArr = ["post_id = $id", "status = 2"];
			if(sizeof($whereArr) > 0)
				$where = "WHERE " . implode(" AND ", $whereArr);
	
			
			

			$whereArr[] = "attactments IS NOT NULL";
			if(sizeof($whereArr) > 0)
				$where = "WHERE " . implode(" AND ", $whereArr);
			$sql = "SELECT attactments FROM $this->table_reviews $where  ORDER BY id DESC limit 0,8";
			$records_with_photos = $wpdb->get_results($sql);
			$review_photos = [];
			if($records_with_photos)
			{
			
				foreach ($records_with_photos as $key => $v) {
					$img_arr = json_decode($v->attactments, true);
					$review_photos = array_merge($review_photos, $img_arr);
				}
			}





			$product = $this->productClass->getProductByPostId($id);
			$post = get_post($id);
			$data = [
				'post' => [
					'title' => $post->post_title,
					'thumbnail' => get_the_post_thumbnail_url($id, 'thumbnail'),
					'image' => get_the_post_thumbnail_url($id),
				],
				'average_stars' => isset($product->average) ? round($product->average, 1): 0, 
				'star_stats' 	=> isset($product->star_stats) ? json_decode($product->star_stats, true): '', 
				'total' 		=> isset($product->total) ? intval($product->total): 0,
				'sold' 			=> isset($product->sold) ? intval($product->sold): 0,
				'review_photos' => $review_photos,


			];
			echo json_encode(['success' => true, 'data' => $data, 'msg' => 'Lấy dữ liệu thành công']);

		}

		

		die();

	}	

	public function admin_reply_review(){
		global $wpdb;



		$id = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';
		$message = isset($_POST['message']) ? sanitize_text_field($_POST['message']) : '';

		$sql = "SELECT * FROM $this->table_reviews WHERE id = $id";
		$checkExist = $wpdb->get_row($sql);
		if($checkExist)
		{
			$record = [
				'type' => $checkExist->type,
				'post_type' => $checkExist->post_type,
				'parent_id' => $id,
				'message' => $message,
				'is_admin_message' => 1,
				'by_admin'	=> 1,
				'created_at'			=> date('Y-m-d H:i:s')
			];
			$query = $wpdb->insert($this->table_reviews, $record);
		
			if($query){
				echo json_encode(['success' => true, 'record' => $this->get_record_with_children($id), 'msg' => 'Phản hồi thành công']);
			}
			else
				echo json_encode(['success' => false, 'msg' => 'Có lỗi xảy ra vui lòng thử lại sau.']);

		}	
		else
		{
			echo json_encode(['msg' => "Không tìm thấy ID.", 'success' => false]);
		}

		if($this->settings['email']['admin_reply'] == 'true'){
			$this->sendEmail('admin-reply', [
				'email' => $checkExist->customer_email,
				'message' => $checkExist->message,
				'reply' => $message,
				'settings' => $this->settings

			]);
		}
		die();

	}
	public function get_record_with_children($id){
		global $wpdb;
		$sql = "SELECT *,  DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as date FROM $this->table_reviews WHERE id = $id";
		$record = $wpdb->get_row($sql);
		if($record)
		{
			if($record->parent_id == 0)
			{
				if($record->attactments)
					$record->attactments = json_decode($record->attactments);
				$sql = "SELECT *,  DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as date FROM  $this->table_reviews WHERE parent_id = $record->id";
				$children = $wpdb->get_results( $sql );

	 		 	if($children)
	 		 	{
	 		 		foreach ($children as $key => &$child) {
			 			$child->attactments = json_decode($child->attactments, true);
	 		 		}
	 		 		$record->children = $children;
	 		 		$record->post = [
	 		 			'title' => get_the_title($record->post_id),
	 		 			'image' => get_the_post_thumbnail_url($record->post_id),
	 		 		];
	 		 	}
			}
			else
			{
				$sql = "SELECT *,  DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as date FROM $this->table_reviews WHERE id = $record->parent_id";
				$record = $wpdb->get_row($sql);
				if($record)
				{
					if($record->attactments)
						$record->attactments = json_decode($record->attactments);
					$sql = "SELECT *,  DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as date FROM  $this->table_reviews WHERE parent_id = $record->id";
					$children = $wpdb->get_results( $sql );

		 		 	if($children)
		 		 	{
		 		 		foreach ($children as $key => &$child) {
				 			$child->attactments = json_decode($child->attactments, true);
		 		 		}
		 		 		$record->children = $children;
		 		 		$record->post = [
		 		 			'title' => get_the_title($record->post_id),
		 		 			'image' => get_the_post_thumbnail_url($record->post_id),
		 		 		];
		 		 	}
				}
			}

 		 	return $record;
		}
		return;
	}

	public function get_record($table, $id){
		global $wpdb;
		$sql = "SELECT *,  DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as date FROM $table WHERE id = $id";
		$record = $wpdb->get_row( $sql );
		return $record;
	}

	public function handle_post_stat($post_id){

		global $wpdb;
		$sql = "SELECT * FROM $this->table_products WHERE post_id = $post_id";
		$record = $wpdb->get_row( $sql );
		if(!$record)
		{
			$data = [
				'post_id' => $post_id,
			];
			$wpdb->insert($this->table_products, $data);
		}

		$whereArr = ["post_id = $post_id", "status = 2", "parent_id = 0", "type = 1"];
		if(sizeof($whereArr) > 0)
			$where = "WHERE " . implode(" AND ", $whereArr);


		$sql = "SELECT  AVG(stars) as average_stars FROM $this->table_reviews $where";
		$average_stars = $wpdb->get_var( $sql );
		$sql = "SELECT COUNT(id) as total, stars FROM $this->table_reviews $where GROUP BY stars";
		$star_stats = $wpdb->get_results( $sql );
		$total_records = $wpdb->get_var("SELECT COUNT(id) FROM $this->table_reviews $where");

		$data = [
			'average' => $average_stars,
			'total' => $total_records,
			'star_stats'	=> $star_stats ? json_encode($star_stats) : ''
		];
		

		$hehe = $wpdb->update($this->table_products, $data, ['post_id' => $post_id]);
		

	}


	public function update_column(){
		global $wpdb;

		$id = isset($_POST['id']) ? intval($_POST['id']) : '';
		$value = isset($_POST['value']) ? $_POST['value'] : '';
		$column = isset($_POST['column']) ? $_POST['column'] : '';
		$table = isset($_POST['table']) ? $_POST['table'] : $this->table_reviews;
		$record = $this->get_record($table, $id);
		if($record && $id > 0 && $value)
		{
		
			$sql = "SELECT * FROM $table WHERE id = $id";
			$checkExist = $wpdb->get_results($sql);
			
			if($checkExist)
			{
				$sql = "UPDATE $table SET $column = '$value' WHERE id = $id";
				// echo $sql;
				if($wpdb->query($sql)){
					if($table == 'dmh_rv_products')
						echo json_encode(['success' => true, 'msg' => 'Cập nhật thành công']);
					else
						echo json_encode(['success' => true, 'record' => $this->get_record_with_children($id), 'msg' => 'Cập nhật thành công']);
				}
				else
					echo json_encode(['success' => false, 'msg' => 'Có lỗi xảy ra vui lòng thử lại sau.']);
			}
			if($column == 'status' || $column == 'stars'){
				$this->handle_post_stat($record->post_id);
				$this->syncComment($id);

			}
		}
		die();

	}

	public function remove_review(){
		global $wpdb;

		$ids = isset($_POST['ids']) ? $_POST['ids'] : '';
		if(is_array($ids) && sizeof($ids))
		{
			$idIn = "(".implode(',', $ids).")";

			$sql = "SELECT * FROM $this->table_reviews WHERE id IN $idIn";
			$checkExist = $wpdb->get_results($sql);
			if($checkExist)
			{

				$sql = "DELETE FROM $this->table_reviews WHERE id = $idIn OR parent_id = $idIn";
				foreach ($ids as $key => $id) {
					$this->syncComment($id, 'delete');
					$record_[] = $this->get_record($this->table_reviews, $id);
				}
				if($wpdb->query($sql)){
					foreach ($record_ as $key => $r) {
						$this->handle_post_stat($r->post_id);
					}
					echo json_encode(['success' => true, 'record' => $query, 'msg' => 'Xóa bình luận thành công']);
					
				}
				else
					echo json_encode(['success' => false, 'msg' => 'Có lỗi xảy ra vui lòng thử lại sau.']);

			}	
			else
			{
				echo json_encode(['msg' => "Không tìm thấy ID.", 'success' => false]);
			}
		}

		die();

	}

	public function get_option()
	{
		$key = $_POST['key'];
		$data = get_option($key, false);
		echo json_encode(['success' => 1, 'msg' => 'Thành công!', 'data' => $data ? json_decode($data) : null]);
		die();
	}

	public function save_option()
	{
		$data = $_POST['data'];
		$key = $_POST['key'];
		if(!$data || !$key)
		{
			echo json_encode(['success' => 0, 'msg' => 'Có lỗi xảy ra!']);
			die();
		}

		$option = get_option($key, false);
		if( $option ) {
		   update_option($key, json_encode($data));
		}else {
		
		   add_option( $key, json_encode($data));
		}
		$data = get_option($key, false);
		echo json_encode(['success' => 1, 'msg' => 'Lưu dữ liệu thành công!', 'data' => json_decode($data)]);
		die();
	}

	public function saveBase64ImagePng($base64Image, $imageDir, $fileName)
	{
	 $imageDir;
		if (!file_exists($imageDir)) {
		    mkdir($imageDir);
		}
	 	// wp_upload_dir('wordpress_review_mh')['path']

		// $size = getimagesize($base64Image);
		// die();
	    $base64Image = trim($base64Image);
	    $pos  = strpos($base64Image, ';');
	    $type = explode(':', substr($base64Image, 0, $pos))[1];
	    $base64Image = str_replace('data:image/png;base64,', '', $base64Image);
	    $base64Image = str_replace('data:image/jpg;base64,', '', $base64Image);
	    $base64Image = str_replace('data:image/jpeg;base64,', '', $base64Image);
	    $base64Image = str_replace('data:image/gif;base64,', '', $base64Image);
	    $base64Image = str_replace(' ', '+', $base64Image);
	    if (base64_decode($base64Image, true))
	    {
	        $imageData = base64_decode($base64Image);

	        if(stripos($type, 'png'))
	        {
	            $type = '.png';
	        }
	        else
	        {
	            $type = '.jpg';
	        }
	        //Set image whole path here 
	        $filePath = $imageDir . $fileName . $type;
	        file_put_contents($filePath, $imageData);
	        return $fileName . $type;
	        // echo json_encode(['success' => 1,'src' => $fileName . $type, 'width' => $size[0], 'height' => $size[1]]);
	    }
	    die();
	}



	public function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	function save_image ( $base64,  $filename = '') {

	    $pos  = strpos($base64, ';');
	    $file_type = explode(':', substr($base64, 0, $pos))[1];
	    $tail = explode('/', $file_type)[1];



	    $filename = 'wprv.'. $tail;    
	    $upload_dir  = wp_upload_dir();
	    $upload_path = str_replace( '/', DIRECTORY_SEPARATOR, $upload_dir['path'] ) . DIRECTORY_SEPARATOR;

	    $img             = str_replace( 'data:image/jpeg;base64,', '', $base64 );
	    $img             = str_replace('data:image/png;base64,', '', $img);
	    $img             = str_replace('data:image/jpg;base64,', '', $img);
	    $img             = str_replace('data:image/gif;base64,', '', $img);


	    $img             = str_replace( ' ', '+', $img );
	    $decoded         = base64_decode( $img );
	    
	    $hashed_filename = md5( $filename . microtime() ) . '_' . $filename;

	    // Save the image in the uploads directory.
	    $upload_file = file_put_contents( $upload_path . $hashed_filename, $decoded );

	    $attachment = array(
	        'post_mime_type' => $file_type,
	        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $hashed_filename ) ),
	        'post_content'   => '',
	        'post_status'    => 'inherit',
	        'guid'           => $upload_dir['url'] . '/' . basename( $hashed_filename )
	    );

	    $attach_id = wp_insert_attachment( $attachment, $upload_dir['path'] . '/' . $hashed_filename );
	    
	    require_once(ABSPATH . 'wp-admin/includes/image.php');
	    $attach_data = wp_generate_attachment_metadata( $attach_id, $upload_path . $hashed_filename );
	    wp_update_attachment_metadata( $attach_id, $attach_data );

	}

	public function bt_email_order_items_args($args ){
		$args['show_image'] = true;
	    $args['image_size'] = array( 150, 150 );
	    return $args;
	}
	public function completed_order_email_notification($item_id, $item, $order, $html)
	{
		if($this->settings['email']['order_completed'] == 'true' && $order->has_status('completed')){
			$src = WP_RV_PLUGIN_URL . 'assets/images/1040230.png';
			echo "<div style='margin-top:10px' class='rv-review-link'><a href='".get_permalink($item->get_product_id())."?review=true'><img src='".$src."' width='25px'>Đánh giá sản phẩm </a></div>";
		}
	}


	public function sendEmail($type = 'new-review', $data)
	{
		if($type == 'new-review')
		{

	        ob_start();
	        
            load_view('/public/partials/templates/tiki-theme/email-new-review.php', $data, true);
			$html = ob_get_clean();

	        ob_start();
	        $title = $data['type'] == 1 ? 'Đánh giá mới từ ' . $data['customer_name'] : 'Bình luận mới từ ' . $data['customer_name'];
			$headers = [];
			$headers[] = 'From: '. get_bloginfo('name') .' <minhhai@site.com>';
			$mail = wp_mail(get_option('admin_email'), $title, $html, $headers);
		}
		if($type == 'admin-reply')
		{
	        ob_start();
	        load_view('/public/partials/templates/tiki-theme/email-admin-reply.php', $data, true);
			$html = ob_get_clean();

	        ob_start();
			$headers = [];
			$headers[] = 'From: '. get_bloginfo('name') .' <minhhai@site.com>';
			$mail = wp_mail($data['email'], 'Phản hồi từ ' . get_bloginfo('name'), $html, $headers);
		}
		if($type == 'order-completed')
		{
	        ob_start();
	        load_view('/public/partials/templates/tiki-theme/email-order-completed.php', $data, true);
			$html = ob_get_clean();

	        ob_start();
			$headers = [];
			$headers[] = 'From: '. get_bloginfo('name') .' <minhhai@site.com>';
			$mail = wp_mail($data['email'], 'Phản hồi từ ' . get_bloginfo('name'), $html, $headers);
			// die();
		}

	}

	public function syncComment($id, $action = 'sync'){

		global $wpdb;
		$record = $this->get_record($this->table_reviews, $id);

		if($record->post_type != 'product')
			return;
		
		if($action == 'sync')
		{
			if($record && $record->parent_id == 0)
			{
			
				if($record->comment_id == NULL)
				{

					$comment_id = wp_insert_comment( array(
					    'comment_post_ID'      => $record->post_id, // <=== The product ID where the review will show up
					    'comment_author'       => $record->customer_name,
					    'comment_author_email' => $record->customer_email, // <== Important
					    'comment_author_url'   => '',
					    'comment_content'      => $record->message,
					    'comment_type'         => '',
					    'comment_parent'       => 0,
					    'comment_author_IP'    => '',
					    'comment_agent'        => '',
					    'comment_date'         => $record->created_at,
					    'comment_approved'     => 1,
					) );
					update_comment_meta( $comment_id, 'rating', $record->stars );
					update_comment_meta($comment_id, 'verified', 1);

					$sql = "UPDATE $this->table_reviews SET comment_id = $comment_id WHERE id = $record->id";
					$wpdb->query($sql);
				}
				else
					$comment_id = $record->comment_id;

				if($record->status == 2)
					wp_set_comment_status($comment_id, 1);
				else
					wp_set_comment_status($comment_id, 0);

		

  				$counts     = WC_Comments::get_rating_counts_for_product( wc_get_product( $record->post_id ) );
  				update_post_meta( $record->post_id, '_wc_rating_count', $counts );

			}
		}
		if($action == 'delete')
		{

			if($record->comment_id)
			{
				wp_delete_comment($record->comment_id, true);
				$sql = "DELETE FROM $wpdb->prefix" . "_commentmeta WHERE comment_id = $record->comment_id";
				$wpdb->query($sql);
			}
		}
		
		
	}

	

	public function deleteDir($folder) {
	    $glob = glob($folder);
	    foreach ($glob as $g) {
	        if (!is_dir($g)) {
	            unlink($g);
	        } else {
	            $this->deleteDir("$g/*");
	            rmdir($g);
	        }
	    }
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-review-mh-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		

	}

}

