<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://dominhhai.com/
 * @since      1.0.0
 * 
 * @package    Wordpress_Review_Mh
 * @subpackage Wordpress_Review_Mh/public/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php if ($settings['active']['rating'] == 'true'): ?>
<link rel="stylesheet" href="<?php echo WP_RV_URL ?>/wp-content/plugins/wordpress-review-mh/public/css/jquery.fancybox.min.css">	
<div class="wp-review-mh__title">ĐÁNH GIÁ - NHẬN XÉT TỪ KHÁCH HÀNG</div>
<div class="wp-reviews-mh <?php echo $review_all ? 'review-all' : '' ?>" data-type="1">
	<div class="customer-reviews__inner">
		<?php include __DIR__ . '/templates/tiki-theme/post-review-info.php' ?>
	</div>
	<div class="customer-reviews__inner">
		
		<?php if ($pagination['review']['total'] > 0): ?>
		<?php include __DIR__ . '/templates/tiki-theme/filter.php' ?>
		<?php endif ?>

		<?php include __DIR__ . '/templates/tiki-theme/reviews.php' ?>
		<?php 
			load_view('/public/partials/templates/tiki-theme/pagination.php', [

					'pagination' => $pagination['review'],
					'type'		 => 1,

			], true);
		?>
	</div>
</div>

<?php if (WP_RV_IS_MOBILE): ?>
<div class="reviews__mobile" data-type="1">
	<header class="HeaderPage__StyledHeaderSearch-sc-6s63ur-1 jdYFzj">
	    <button class="btn-back_modal" type="button">
	        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" size="30" height="30" width="30" xmlns="http://www.w3.org/2000/svg">
	            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
	        </svg>
	    </button>
	    <div class="HeaderPage__Title-sc-6s63ur-0 xOFEo">Nhận Xét Sản Phẩm</div>
	</header>
	<div class="styles__StyledReviewBlock-sc-1g3evgg-0 dFXzAh reviews-mobile">
		<div class="infinite-scroll-component" style="height: 730px; overflow: auto;">
				
		</div>
	</div>

</div>
<?php endif ?>

<?php endif ?>

<?php if ($settings['active']['comment'] == 'true' && !$review_all): ?>
<div class="wp-review-mh__title">BÌNH LUẬN - HỎI ĐÁP</div>
<div class="wp-reviews-mh" data-type="2"> 
<div class="wp-comments-box">
	<div class="customer-reviews__inner">
		<textarea name="" id="" cols="30" rows="3" class="comments-input_message" placeholder="Hãy viết bình luận của bạn tại đây."></textarea>
		<div class="customer-comments__input">
			<input type="text" placeholder="Họ tên" class="comments-input__name">
			<input type="text" placeholder="Email" class="comments-input__email">
			<a href="javascript:void(0)" class="rv-btn rv-btn-comment">Gửi</a>
		</div>
		<?php include __DIR__ . '/templates/tiki-theme/comments_.php' ?>
		<?php 
			load_view('/public/partials/templates/tiki-theme/pagination.php', [
				
					'pagination' => $pagination['comment'],
					'type'		 => 2,

			], true);
		?>
	</div>
</div>
</div>
<?php if (WP_RV_IS_MOBILE): ?>
	<div class="reviews__mobile" data-type="2">
		<header class="HeaderPage__StyledHeaderSearch-sc-6s63ur-1 jdYFzj">
		    <button class="btn-back_modal" type="button">
		        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" size="30" height="30" width="30" xmlns="http://www.w3.org/2000/svg">
		            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
		        </svg>
		    </button>
		    <div class="HeaderPage__Title-sc-6s63ur-0 xOFEo">BÌNH LUẬN - HỎI ĐÁP</div>
		</header>
		<div class="styles__StyledReviewBlock-sc-1g3evgg-0 dFXzAh reviews-mobile">
			<div class="infinite-scroll-component" style="height: 730px; overflow: auto;">
					
			</div>
		</div>

	</div>
<?php endif ?>



<?php endif ?>


<?php if ($settings['active']['rating'] == 'true' || $settings['active']['comment'] == 'true'): ?>
<div class="modal micromodal-slide modal-reply-m" id="modal-review" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1">
          <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-review-title">
            <header class="modal__header">
              <div class="modal__title" id="modal-review-title"> Đánh giá sản phẩm</div>
              <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-review-content">
				<?php include_once __DIR__ . '/templates/tiki-theme/review-form.php' ?>              	

            </main>
            <footer class="modal__footer"></footer>
          </div>
        </div>
</div>
<div class="loading-m">
         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;;display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
         <path fill="none" stroke="#e90c59" stroke-width="7" stroke-dasharray="42.76482137044271 42.76482137044271" d="M24.3 30C11.4 30 5 43.3 5 50s6.4 20 19.3 20c19.3 0 32.1-40 51.4-40 C88.6 30 95 43.3 95 50s-6.4 20-19.3 20C56.4 70 43.6 30 24.3 30z" stroke-linecap="round" style="transform:scale(0.5700000000000001);transform-origin:50px 50px">
           <animate attributeName="stroke-dashoffset" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0;256.58892822265625"></animate>
         </path>
         </svg>
</div>


<?php if ($settings['captcha']['active'] == 'true'): ?>
<script>
	
	function onSubmit(token) {
		console.log(token)
	}
</script>
<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>
<?php endif ?>


<!-- <script src="<?php echo WP_RV_URL ?>/wp-content/plugins/wordpress-review-mh/public/js/micromodal.min.js"></script>
<script src="<?php echo WP_RV_URL ?>/wp-content/plugins/wordpress-review-mh/public/js/jquery.fancybox.min.js"></script> -->

<input type="hidden" id="WP_RV_SITE_URL" value="<?php echo get_site_url(); ?>">
<input type="hidden" id="WP_RV_AJAX_URL" value="<?php echo admin_url('admin-ajax.php'); ?>">
<input type="hidden" id="WP_RV_POST_ID" value="<?php echo get_the_ID(); ?>">



<!-- // Remove all sensitive data -->
<?php 
	unset($settings['captcha']['server_key']);
	unset($settings['tool_api']);
?>
<input type="hidden" id="WP_RV_SETTINGS" value='<?php echo json_encode($settings) ?>'>
<?php 
	$logged_user = '';
	if ( is_user_logged_in() ) {
		$user = wp_get_current_user();
		$logged_user = [
			'customer_name' => $user->data->display_name,
			'customer_phone' => '',
			'customer_email' => $user->data->user_email,
		];
		$logged_user = json_encode($logged_user);

	}
?>
<input type="hidden" id="WP_RV_LOGGED_USER" value='<?php echo $logged_user ?>'>

<?php endif ?>








