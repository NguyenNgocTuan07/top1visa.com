<?php
/*
Plugin Name: Tracking Pro
Plugin URI: https://thietkewebsite.dev
Description: Tracking đơn hàng visa
Version: 5.1
Requires at least: 5.0
Requires PHP: 5.2
Author: Vi Văn Lâm
Author URI: https://fb.com/vithanhlam
License: GPLv2 or later
Text Domain: 
*/
function vithanhlam_add_submenu_options() {
    add_submenu_page(
            'themes.php', 
            'Tracking Neko',
            'Tracking Neko', 
            'manage_options',
            'tracking-neko', 
            'vithanhlam_access_menu_options'
    );
}
function vithanhlam_access_menu_options(){
	
	if (!empty($_POST['save-theme-option']))
    {
        $vithanhlam_token = $_POST['vithanhlam_token'];
        $vithanhlam_chat_id = $_POST['vithanhlam_chat_id']; 
		

		update_option('vithanhlam_token', $vithanhlam_token);
		
		// $data = array(
			// 'key' => '123213231321',
			// 'url' => acf_get_home_url(),
		// );

		// $value = base64_encode( maybe_serialize( $data ) );
		
		
		// update_option('acf_pro_license', $value);
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 0,
			CURLOPT_URL => "https://api.telegram.org/bot$vithanhlam_token/getUpdates",
			CURLOPT_USERAGENT => 'vithanhlam',
			CURLOPT_SSL_VERIFYPEER => false
		));

		$resp = curl_exec($curl);

		//Kết quả trả tìm kiếm trả về dạng JSON
		$resp = json_decode($resp);

		print_r($resp);

		curl_close($curl);

		
		
		
		
		update_option('vithanhlam_chat_id', $vithanhlam_chat_id);
		vithanhlam_send_telegram('Kết nối thành công');
		
    } 

	$vithanhlam_token = get_option('vithanhlam_token');
	$vithanhlam_chat_id = get_option('vithanhlam_chat_id');
	
	?>
    <h1>Cấu Hình Telegram Nhắn Tin</h1>
	<p>Xem hướng dẫn lấy ID, Token, tại đây: https://wiki.matbao.net/kb/huong-dan-tao-bot-va-gui-thong-bao-telegram/, cần hỗ trợ Zalo 0987990030</p>
	<form class="option_vithanhlam_tracking" method="post" action="">
		<table>
			
			<tr>
				<td>Group ID</td>
				<td>
					<input type="text" name="vithanhlam_chat_id" value="<?php echo $vithanhlam_chat_id; ?>"/>
				</td>
			</tr>
			<tr>
				<td>Token Telegram</td>
				<td>
					<input type="text" name="vithanhlam_token" value="<?php echo $vithanhlam_token; ?>"/>
				</td>
			</tr>
			<tr>
            <td></td>
            <td>
					<input type="submit" name="save-theme-option" value="Lưu"/>
				</td>
			</tr>
			
		</table>
	</form>
	<style>
	form.option_vithanhlam_tracking table, form.option_vithanhlam_tracking input {
		width: 100%;
		padding: 10px;
	}
	</style>
<?php }

add_action('admin_menu', 'vithanhlam_add_submenu_options');


add_action( 'woocommerce_order_details_before_order_table', 'vithanhlam_order_details' );
function vithanhlam_order_details( $order ) { 
$order_id = $order->ID;
$order_data = $order->get_data(); // The Order data


@$wc_get_order_notes = wc_get_order_notes($order_id);
@$wc_get_order_notes = array_reverse( $wc_get_order_notes, true );

// $customer_note = $order->get_customer_order_notes();
$order_report = get_field('order_report',$order_id);

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="box_tracking_by_neko section-content relative">
	<h2 class="title_h2"><i class="fa fa-file" aria-hidden="true"></i> Mã hồ sơ <?php echo $order->ID;?></h2>
	<div class="row profile_tracking">
		<div class="col medium-6 small-12 large-6">
			<h3>Nhân viên quản lý hồ sơ</h3>
			<p><i class="fa fa-user" aria-hidden="true"></i><strong> Tên:</strong> <?php echo get_field('ho_ten',$order_id);?></p>
			<p><i class="fa fa-phone-square" aria-hidden="true"></i> <strong>Điện Thoại:</strong> <?php echo get_field('dien_thoai',$order_id);?></p>
			<p><i class="fa fa-map-marker" aria-hidden="true"></i> <strong>Địa Chỉ:</strong> <?php echo get_field('dia_chi',$order_id);?></p>
		</div>
		<div class="col medium-6 small-12 large-6">
			<h3>Thông tin của tôi</h3>
			<p><i class="fa fa-user" aria-hidden="true"></i> <strong>Tên:</strong> <?php echo $order_data['billing']['first_name'];?> <?php echo $order_data['billing']['last_name'];?></p>
			<p><i class="fa fa-phone-square" aria-hidden="true"></i><strong> Điện Thoại:</strong> <?php echo $order_data['billing']['phone'];?></p>
			<p><i class="fa fa-map-marker" aria-hidden="true"></i> <strong>Địa Chỉ:</strong> <?php echo $order_data['billing']['address_1'];?></p></div>
	</div>
	<h2 class="title_h2"><i class="fa fa-bars" aria-hidden="true"></i> Quy Trình Hồ Sơ</h2>
	<div class="row">
		<div class="col medium-6 small-12 large-6">
		<div class="timeline">
		<?php foreach($order_report as $order_report_item) { 
		
		?>
			<div class="timeline-item">
			<div class="timeline-content">
			  <h2><i class="fa fa-check" aria-hidden="true"></i> <?php echo $order_report_item['title'];?></h2>
			  <p><?php echo $order_report_item['content'];?></p>
			  <span class="timeline-date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $order_report_item['date'];?></span>
			</div>
			</div>
		<?php } ?>
		</div>
		</div>
		<div class="col medium-6 small-12 large-6">
		
		<div class="chat-container">
		  <div class="chat-header">
			
		  </div>
		  <div class="chat-messages">
			<?php  foreach($wc_get_order_notes as $customer_note_item) {
		$date = date_create($customer_note_item->date_created);
		$data_new = date_format($date,"d/m/Y H:i:s");
				?>
			<div class="message <?php echo ($customer_note_item->customer_note == 1) ? 'dsadsa' : 'vxz';?>">
			  <div class="message-sender">
				<?php echo ($customer_note_item->added_by == 'system') ? '<i class="fa fa-user-secret" aria-hidden="true"></i> Khách Hàng' : '<i class="fa fa-user" aria-hidden="true"></i> Quản Trị';?>
			  </div>
			  <div class="message-text">
				<p class="text_chat"><?php echo $customer_note_item->content;?>
				<br>
				<span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $data_new;?></span>
				</p>
				
			  </div>
			</div>	
			<?php } ?>
			
			
		  </div>
		  <div class="chat-input">
			<form id="Send_Comment" action="" method="POST">
				<input name="action" type="hidden" value="send_chat_ajax"/>
				
				<div class="send_chat_form">
					<input class="text-input" type="text" name="text" placeholder="Nhập nội dung tin nhắn" />
					<div class="upload">
					  <label for="file-upload" class="file-upload-label">
						<i class="fa fa-upload" aria-hidden="true"></i>
						<p class="file-name"></p>
					  </label>
					  <input id="file-upload" type="file" class="file-upload-input" name="file" />
					</div>
				</div>	
				
			
				<input name="id" value="<?php echo $order_id;?>" type="hidden"/>
				<input name="_wpnonce" type="hidden" value="<?php echo wp_create_nonce('chat_xxxx'); ?>"/>
				
				
				


				<button id="btnSubmit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Gửi</button>
			</form>	
		  </div>
		</div>

	</div>
	</div>
</div>
<script>
const container = document.querySelector('.chat-container');
container.scrollTop = container.scrollHeight;
jQuery(document).ready(function(){
  jQuery('input[type="file"]').change(function(e){
    var fileName = e.target.files[0].name;
    jQuery('.file-name').text(fileName);
  });
});
</script>
<style>
label.file-upload-label {
    top: 7px;
    position: relative;
}
form#Send_Comment {
    width: 100%;
}
.send_chat_form {
    display: flex;
}
.upload {
    position: relative;
    display: inline-block;
    font-size: 30px;
    font-weight: bold;
    color: #fff;
    background-color: #2196f3;
    border-radius: 4px;
    padding: 2px 19px;
    cursor: pointer;
    height: 60px;
}

.file-upload-label {

  cursor: pointer;
}

.file-upload-input {
  display: none;
}
.file-name {
    width: 139px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    position: relative;
    top: -37px;
    left: 28px;
    font-size: 21px;
}

.fa-cloud-upload-alt {
  font-size: 18px;
}

button#btnSubmit {
    background: #1e73be;
    width: 100%;
    padding: 0px;
}
input.text-input {
    padding: 18px !important;
    height: 60px !important;
    background: #ffdbdb;
}
.chat-messages::-webkit-scrollbar {
    width: 5px;
    background-color: #b9d2d5;
}
.chat-messages::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
}
.chat-messages::-webkit-scrollbar-thumb
{
	background-color: #F90;	
	background-image: -webkit-linear-gradient(45deg,
	rgba(255, 255, 255, .2) 25%,
	transparent 25%,
	transparent 50%,
	rgba(255, 255, 255, .2) 50%,
	rgba(255, 255, 255, .2) 75%,
	transparent 75%,
	transparent)
}


p.text_chat span {
    font-size: 11px;
    color: #ffe7b0;
}
.chat-input {
    background: #fff;
    padding: 15px;
    border-radius: 5px;
}
.message.dsadsa {
    margin-left: 70px;
    text-align: right;
}
.message.vxz {
    margin-right: 75px;
}
.message.vxz .message-text {
    background: #00000063;
    color: #fff;
    box-shadow: -2px 4px 10px #bf5621;
}
ol.woocommerce-OrderUpdates.commentlist.notes {
    display: none;
}
.box_tracking_by_neko.section-content.relative p {
    margin: 0px;
}
.row.profile_tracking {
    padding: 30px;
    background: #fff;
    margin: 0px !important;
}
.row.profile_tracking h3 {
    border-bottom: solid 1px #ccc;
    text-transform: uppercase;
    font-size: 15px;
    margin-bottom: 25px;
    color: #ff0052;
}
.row.profile_tracking p {
    padding: 4px;
    font-size: 15px;
    border-bottom: dotted 2px #ccc;
}
.row.profile_tracking i {
    background: #1e73be;
    padding: 3px 5px;
    width: 20px;
    margin-right: 5px;
    border-radius: 5px;
    color: #fff;
	text-align: center;
}
.message-text {
 
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    margin-right: 20px;
	
}

p.timedate {
    font-size: 12px;
}
.message.dsadsa .message-sender {
    margin-right: 20px;
}
.timeline {
  position: relative;
  margin: 40px 0;
  padding: 0;
  list-style: none;
}

.timeline:before {
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  left: 40px;
  width: 2px;
  background-color: #000;
  margin: 0;
}

.timeline-item {
  margin: 0;
  padding: 20px 0;
  position: relative;
}

.timeline-content {
    padding: 20px;
    background-color: #fff;
    position: relative;
    border-radius: 6px;
}

.timeline-date {
  display: block;
  color: #ff0018;
  font-style: italic;
  font-size: 12px;
  margin-top: 10px;
}
.timeline-content h2 {
    text-align: left !important;
    font-size: 15px;
    color: #ff0052;
    background: #fff7f7;
    padding: 5px;
}
h2.title_h2 {
    font-size: 16px;
    padding: 10px 10px;
    background: #e9e9e9;
    margin: 20px 0px;
    text-align: left;
}
.box_tracking_by_neko {
    padding: 40px;
    background: #fff;
    margin-top: 20px;
    margin-bottom: 40px;
    border: solid 1px #ccc;
}
.box_tracking_by_neko {
    padding: 40px;
    background: #eee;
    margin-top: 20px;
    margin-bottom: 40px;
}
.box_tracking_by_neko h2 {

    text-transform: uppercase;
}
.chat-container {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 800px;
  border-radius: 5px;
  padding: 10px;
  background: linear-gradient(135deg, #a59526 0%, #0994ce 86%);
}
.chat-messages .message-sender {
    font-size: 13px;
    color: #fff;
}

.chat-header {
  text-align: center;
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
}

.chat-messages {
  height: 100%;
  overflow-y: scroll;
  scroll-behavior: smooth;
  margin-bottom: 25px;
}

.message {
  margin-bottom: 10px;
}

.message-sender {
  font-weight: bold;
  margin-bottom: 5px;
}

.message-text {
    background-color: #eeeeee57;
    padding: 10px;
    border-radius: 5px;
    color: #fff;
    box-shadow: 2px 5px 8px #f3e15d;
}

.chat-input {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
table.woocommerce-table.woocommerce-table--order-details.shop_table.order_details {
    display: none;
}
section.woocommerce-customer-details {
    display: none;
}
h2.woocommerce-order-details__title {
    display: none;
}
.chat-input input[type="text"] {
  flex: 1;
  height: 30px;
  padding: 5px;
  border-radius: 5px;
  border: none;
  margin-right: 10px;
}

.chat-input button {
  height: 30px;
  padding: 5px 10px;
  border-radius: 5px;
  border: none;
  background-color: #ccc;
  color: #fff;
  cursor: pointer;
}

.chat-input button:hover {
  background-color: #666;
}
button#btnSubmit:disabled {
    background: #333;
}
button#btnSubmit i {
    font-size: 20px;
}
p.order-again {
    DISPLAY: NONE;
}
@media only screen and (max-width: 48em) { 
	.box_tracking_by_neko {
		padding: 0px !important;
		background: #eee;
		margin-top: 20px;
		margin-bottom: 40px;
	}
	.message.dsadsa {
		margin-left: 0px;
		text-align: right;
	}
	.message.vxz {
		margin-right: 0px;
	}
	.timeline-content {
		padding: 20px;
		background-color: #fff;
		position: relative;
		border-radius: 6px;
		margin: 10px;
	}
}
</style>
<script>
jQuery(document).ready(function () {
 
	jQuery("#btnSubmit").click(function (event) {
		jQuery("#btnSubmit").prop("disabled", true);
		jQuery("#btnSubmit").html('<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>');
		var mydiv = jQuery(".chat-messages");
		mydiv.scrollTop(mydiv.prop("scrollHeight"));
		event.preventDefault();
		var form = jQuery('#Send_Comment')[0];
		var data = new FormData(form);
 
		jQuery.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			url: "<?php echo get_home_url();?>/wp-admin/admin-ajax.php",
			data: data,
			processData: false,
			contentType: false,
			cache: false,
			timeout: 800000,
			success: function (data) {
				json_alert = data.data;
				jQuery(".text-input").val('');
				jQuery(".file_upload").val('');
				// jQuery(".chat-messages").append('<div class="message dsadsa"><div class="message-sender"> <i class="fa fa-user" aria-hidden="true"></i> system </div><div class="message-text"><p class="text_chat">'+json_alert.text+'<br> <span><i class="fa fa-clock-o" aria-hidden="true"></i> 22/03/2023 10:26:00</span></p></div></div>');
				jQuery("#btnSubmit").html('<i class="fa fa-paper-plane" aria-hidden="true"></i> Gửi');
				jQuery("#btnSubmit").prop("disabled", false);
				var mydiv = jQuery(".chat-messages");
				mydiv.scrollTop(mydiv.prop("scrollHeight"));
			},
			error: function (e) {

			}
		});
		
 
	});
	// setInterval(function(){load_ajax_chat()}, 2000);
	function load_ajax_chat() {
		jQuery.get("<?php echo get_home_url();?>/wp-admin/admin-ajax.php?action=load_chat_ajax", function(data, status){
			jQuery(".chat-messages").html(data);
		});
		var mydiv = jQuery(".chat-messages");
		mydiv.scrollTop(mydiv.prop("scrollHeight"));
	}
 
});
</script>
<?php


}



add_action("wp_ajax_send_chat_ajax", "vithanhlam_send_chat_ajax");
add_action("wp_ajax_nopriv_send_chat_ajax", "vithanhlam_send_chat_ajax");

function vithanhlam_send_chat_ajax() {
	global $woocommerce;
	$text = (isset($_POST['text']))?esc_attr($_POST['text']) : '';
	$order_id = $_POST['id'];
	
	if(!wp_verify_nonce( $_POST['_wpnonce'], 'chat_xxxx' )) {
		wp_send_json_success('fb.com/vithanhlam');
		die();
	} 
	
	if($text == '') {
		$return = array(
			'message' => 'Vui lòng nhập nội dung',
			'data'      => '',
			'error' => 1,
		);
		wp_send_json_success( $return );
		die();
	}
	
	if(!empty($_FILES['file']['name'])) {
        $uploaded_file = $_FILES['file'];
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($uploaded_file, $upload_overrides);
        if($movefile && !isset($movefile['error'])) {
            // echo "Tải tệp lên thành công!";
			$filess = ' <a target="_blank" href="'.$movefile['url'].'"> <i class="fa fa-download" aria-hidden="true"></i> Download</a>';
        } else {
            // echo "Lỗi khi tải tệp lên: " . $movefile['error'];
        }
    }
	
	
	$order = new WC_Order( $order_id);
	$order->add_order_note($text. $filess,'customer');
	$order->save();
	
	$telegram = 'OrderID '.$order_id.': '.$text. $filess;
	
	vithanhlam_send_telegram($telegram);
	
	$return = array(
		'message' => 'Gửi tin nhắn thành công',
		'data'      => '',
		'error' => 1,
		'text' => $text,
	);
	wp_send_json_success( $return );
	die();
}


add_action("wp_ajax_load_chat_ajax", "vithanhlam_load_chat");
add_action("wp_ajax_nopriv_load_chat_ajax", "vithanhlam_load_chat");
function vithanhlam_load_chat() { 
@$wc_get_order_notes = wc_get_order_notes($order_id);
@$wc_get_order_notes = array_reverse( $wc_get_order_notes, true );
?>
<?php  foreach($wc_get_order_notes as $customer_note_item) {
$date = date_create($customer_note_item->date_created);
$data_new = date_format($date,"d/m/Y H:i:s");

		?>
	<div class="message <?php echo ($customer_note_item->customer_note == 1) ? 'dsadsa' : 'vxz';?>">
	  <div class="message-sender">
		<i class="fa fa-user" aria-hidden="true"></i> <?php echo $customer_note_item->added_by;?>
	  </div>
	  <div class="message-text">
		<p class="text_chat"><?php echo $customer_note_item->content;?>
		<br>
		<span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $data_new;?></span>
		</p>
		
	  </div>
	</div>	
	<?php } ?>
<?php die(); }

function vithanhlam_send_telegram($text) {
	$vithanhlam_token = get_option('vithanhlam_token');
	$vithanhlam_chat_id = get_option('vithanhlam_chat_id');
	
	$curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => "https://api.telegram.org/bot$vithanhlam_token/sendMessage",
        CURLOPT_USERAGENT => 'ZWeb.vn',
        CURLOPT_POST => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => http_build_query(array(
            'chat_id' => $vithanhlam_chat_id,
            'text' => $text,
        ))
    ));
    $resp = curl_exec($curl);
    $resp = json_decode($resp);
    return ($resp->ok);
    curl_close($curl);
}





add_action('acf/init', 'vithanhlam_field_groups');
function vithanhlam_field_groups() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group(array(
			'key' => 'group_641a83c23526b',
			'title' => 'Order',
			'fields' => array(
				array(
					'key' => 'field_641a83c39821a',
					'label' => 'Order_Report',
					'name' => 'order_report',
					'aria-label' => '',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'layout' => 'table',
					'pagination' => 0,
					'min' => 0,
					'max' => 0,
					'collapsed' => '',
					'button_label' => 'Add Row',
					'rows_per_page' => 20,
					'sub_fields' => array(
						array(
							'key' => 'field_641a83f59821b',
							'label' => 'Title',
							'name' => 'title',
							'aria-label' => '',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'maxlength' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'parent_repeater' => 'field_641a83c39821a',
						),
						array(
							'key' => 'field_641a83fd9821c',
							'label' => 'Date',
							'name' => 'date',
							'aria-label' => '',
							'type' => 'date_time_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'display_format' => 'd/m/Y g:i a',
							'return_format' => 'd/m/Y g:i a',
							'first_day' => 1,
							'parent_repeater' => 'field_641a83c39821a',
						),
						array(
							'key' => 'field_641a84079821d',
							'label' => 'Content',
							'name' => 'content',
							'aria-label' => '',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 1,
							'delay' => 0,
							'parent_repeater' => 'field_641a83c39821a',
						),
					),
				),
				array(
					'key' => 'field_641a8464b94fc',
					'label' => 'Họ Tên',
					'name' => 'ho_ten',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
				array(
					'key' => 'field_641a8477b94fd',
					'label' => 'Điện Thoại',
					'name' => 'dien_thoai',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
				array(
					'key' => 'field_641a847fb94fe',
					'label' => 'Địa Chỉ',
					'name' => 'dia_chi',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'shop_order',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
			'show_in_rest' => 0,
		));
	}

}