
<form class="write-review__inner">
    <div class="write-review__product">
        <img src=""  class="write-review__product-img" />
        <div class="write-review__product-wrap">
            <div class="write-review__product-name"></div>
            <!-- <div class="write-review__product-seller">Nhà bán ELTECH</div> -->
        </div>
    </div>
    <div class="write-review__reply--to">
    	<div class="review-comment__user-name"></div>
    	<div class="review-comment__content"></div>
    </div>
    <div class="write-review__heading">Vui lòng đánh giá</div>
    <div class="write-review__stars">
        <span class="write-review__star">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 32 32">
                <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
            </svg>
        </span>
        <span class="write-review__star">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 32 32">
                <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
            </svg>
        </span>
        <span class="write-review__star">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 32 32">
                <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
            </svg>
        </span>
        <span class="write-review__star">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 32 32">
                <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
            </svg>
        </span>
        <span class="write-review__star">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 32 32">
                <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
            </svg>
        </span>
    </div>

    <div class="write-review__rating-message"></div>
    <textarea rows="4" placeholder="Vì sao bạn thích sản phẩm?" class="write-review__input"></textarea>

    <div class="review-inputs">
    	<input placeholder="Họ tên*" type="text" class="review-input review-input__name">
    	<input placeholder="<?php echo $setting['customer_phone'] == 'true' ? 'Số điện thoại*' : 'Số điện thoại' ?>" type="text" class="review-input review-input__phone">
    	<input placeholder="Email" type="text" class="review-input review-input__email">
    </div>
    <div class="write-review__images">
    	
    </div>

    <?php if ($settings['captcha']['active'] == 'true'): ?>
    <div class='g-recaptcha' data-sitekey='<?php echo $settings['captcha']['site_key'] ?>' data-callback="onSubmit" data-size="invisible"></div>
    <!-- <div class='g-recaptcha' data-sitekey='<?php echo $settings['captcha']['site_key'] ?>' style="display: flex; justify-content: center;" data-size="invisible"></div> -->
    <?php endif ?>

    <div class="write-review__buttons">
        <input class="write-review__file" type="file" multiple="" />
        <button type="button" class="write-review__button write-review__button--image"><img src="<?php echo  WP_RV_PLUGIN_URL  ?>/assets/images/79e0539a981e363ba6ac5bfeef3c70da.png" /><span>Thêm ảnh</span></button>
        <button type="submit" class="write-review__button write-review__button--submit"><span>Gửi</span></button>
    </div>
</form>


