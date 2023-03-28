<?php 

	class Wordpress_Review_Mh_Product {

		private $table_products = 'dmh_rv_products';

		public function __construct() {
			add_action('wp_ajax_wp_rv_get_products', [$this, 'getProducts']);

		}

		public function getProducts()
		{
			global $wpdb;

			$page = isset($_POST['page']) ? htmlspecialchars($_POST['page']) : 1;
			$per_page = isset($_POST['per_page']) ? htmlspecialchars($_POST['per_page']) : 4;
			$filters = isset($_POST['filters']) ? $_POST['filters'] : '';

			$whereArr = [];

			if(isset($filters['search']) && $filters['search']){
				$sql = "SELECT ID from " . $wpdb->prefix . 'posts' . " WHERE " . 'LOWER(post_title) LIKE "%'.$filters['search'].'%"' . " OR " . 'ID LIKE "%'.$filters['search'].'%"';
				$whereIn = $wpdb->get_results($sql, ARRAY_A);
				if($whereIn){
					$whereInIds = [];
					foreach ($whereIn as $key => $value) {
						$whereInIds[] = $value['ID'];
					}

					$whereArr[] = "post_id IN (".implode(',', $whereInIds).")";
				}
		
			}






			$offset = ($page - 1) * $per_page;
			if(sizeof($whereArr) > 0)
				$where = "WHERE (" . implode(" AND ", $whereArr) . ")";

			$sql = "SELECT SQL_CALC_FOUND_ROWS *  FROM  $this->table_products $where ORDER BY id DESC limit $offset, $per_page";
			$records = $wpdb->get_results( $sql );
			$total_records = $wpdb->get_var("SELECT FOUND_ROWS() as total");

			if($records)
			{
				foreach ($records as $key => &$record) {	
					$record->post = [
						'title' => get_the_title($record->post_id),
						'thumbnail' => get_the_post_thumbnail_url($record->post_id),
						'post_type' => get_post_type($record->post_id),
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
				'data' => $records, 
				'pagination' => $pagination, 
				'success' => true
			]);
			die();
		}

		public function getProductByPostId($id){

			global $wpdb;
			$sql = "SELECT * FROM $this->table_products WHERE post_id = $id";
			$record = $wpdb->get_row( $sql );

			return $record;

		}
	}
?>