<div class="review-comments wp-ajax-content" data-type="1">
	
	<?php if (isset($reviews) && sizeof($reviews)): ?>
	<?php $star_size = WP_RV_IS_MOBILE ? 14 : 18; $site_url = get_site_url() ?>

	<?php foreach ($reviews as $key => $review): ?>
	
	<div class="review-item">
		<div class="style__StyledComment-sc-103p4dk-5 hMjYZK review-comment">
		    <div class="review-comment__user">
		        <div class="review-comment__user-inner">
		            <div class="review-comment__user-avatar">
		                <div class="Avatar__StyledAvatar-sc-17zdycl-0 gDQSLG has-character" data-name="<?php echo htmlentities($review->customer_name) ?>">
							<span>LN</span>
		                </div>
		            </div>
		            <div>
		                <div class="review-comment__user-name"><?php echo htmlentities($review->customer_name) ?></div>
		                <div class="review-comment__user-date"><?php echo $review->customer_phone_hidden && strlen($review->customer_phone_hidden) > 6 ? htmlentities($review->customer_phone_hidden) . '.xxx' : 'Thành viên' ?></div>

		            </div>
		            
		        </div>
		        <!-- <div class="review-comment__user-info"><img src="https://salt.tikicdn.com/ts/upload/3b/1c/35/0f7846d27b98b8fda694c6e44270e875.png" />Nhận xét:&nbsp;<span>10 ngày</span></div> -->
		        <div class="review-comment__user-info"><img src="https://salt.tikicdn.com/ts/upload/84/41/b2/8c371b639b0d5f511b44bc20e9051210.png" />Đã nhận:&nbsp;<span class="rc-like-total"><?php echo htmlentities($review->likes) ?> </span> Lượt thích</div>

		    </div>
		    <div style="flex-grow: 1;">
		        <div class="review-comment__rating-title">
		            <div class="Stars__StyledStars-sc-15olgyg-0 dYhelp review-comment__rating">
		                <span>
		                    <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $star_size ?>" height="<?php echo $star_size ?>" viewBox="0 0 32 32">
		                        <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
		                    </svg>
		                </span>
		                <span>
		                    <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $star_size ?>" height="<?php echo $star_size ?>" viewBox="0 0 32 32">
		                        <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
		                    </svg>
		                </span>
		                <span>
		                    <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $star_size ?>" height="<?php echo $star_size ?>" viewBox="0 0 32 32">
		                        <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
		                    </svg>
		                </span>
		                <span>
		                    <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $star_size ?>" height="<?php echo $star_size ?>" viewBox="0 0 32 32">
		                        <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
		                    </svg>
		                </span>
		                <span>
		                    <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $star_size ?>" height="<?php echo $star_size ?>" viewBox="0 0 32 32">
		                        <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
		                    </svg>
		                </span>
		                <div style="width: <?php echo 20 * $review->stars ?>%;">
		                    <span>
		                        <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $star_size ?>" height="<?php echo $star_size ?>" viewBox="0 0 32 32">
		                            <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
		                        </svg>
		                    </span>
		                    <span>
		                        <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $star_size ?>" height="<?php echo $star_size ?>" viewBox="0 0 32 32">
		                            <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
		                        </svg>
		                    </span>
		                    <span>
		                        <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $star_size ?>" height="<?php echo $star_size ?>" viewBox="0 0 32 32">
		                            <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
		                        </svg>
		                    </span>
		                    <span>
		                        <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $star_size ?>" height="<?php echo $star_size ?>" viewBox="0 0 32 32">
		                            <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
		                        </svg>
		                    </span>
		                    <span>
		                        <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $star_size ?>" height="<?php echo $star_size ?>" viewBox="0 0 32 32">
		                            <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
		                        </svg>
		                    </span>
		                </div>
		            </div>
		            <a
		                class="review-comment__title"
		                href="javascript:void(0)"
		            >
		            	<?php echo $star_labels[$review->stars] ?>
		            </a>
		        </div>
		        <?php if ($review->buyed == 2): ?>
		        <div class="review-comment__seller-name-attributes">
		            <div class="review-comment__seller-name"><?php echo str_replace('{tick}', '<span class="review-comment__check-icon"></span>', $settings['label']['buyed']) ?></div>
		            <!-- <div class="review-comment__attributes"><span>Size 34</span></div> -->
		        </div>
		        <?php endif ?>

		        <div class="review-comment__content"><?php echo htmlentities($review->message) ?></div>
		        <?php if ($review->attactments || $review->video): ?>
		        <div class="review-comment__images">
		        	<?php if ($review->video): ?>
		        		
		        		<div data-fancybox="rv-images-<?php echo $review->id ?>" data-src="<?php echo $review->video ?>" href="javascript:;" class="rv-video-btn">
		        			<img src="<?php echo WP_RV_PLUGIN_URL ?>assets/images/video-player.svg" width="50px" alt="">
		        		</div>
		        	
		        	<?php endif ?>
		        	<?php if ($review->attactments): ?>
			        	<?php foreach ($review->attactments as $key => $r):
			        	 	$site_url  = str_replace('https://', '',  $site_url);
			        	    $site_url  = str_replace('http://', '',  $site_url);
			        	 	$src =  strpos($r, $site_url) !== false ? $r : $img_url . $r;
			        	?>
			        		
			        	<div
			        	 data-src="<?php echo $src ?>" data-fancybox="rv-images-<?php echo $review->id ?>"

			        	 data-view-id="pdp_product_review_view_photo" class="review-comment__image" style="background-image: url(<?php echo $src ?>);"></div>
			        	
			        	<?php endforeach ?>
		        	<?php endif ?>

		        </div>
		        <?php endif ?>

		        <div class="review-comment__created-date">
		            <span>Nhận xét vào <time class="timeago" datetime="<?php echo $review->date ?>"><?php echo $review->date ?></time></span>
		            
		        </div>
		        <span data-view-id="pdp_product_review_like_buton" class="review-comment__thank" data-id="<?php echo $review->id ?>" data-total="<?php echo $review->likes ?>">
		            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
		                <g fill="none" fill-rule="evenodd">
		                    <path d="M0 0H20V20H0z"></path>
		                    <path
		                        fill="#0d5cb6"
		                        fill-rule="nonzero"
		                        d="M14.252 17.063c.465 0 .863-.056 1.195-.167.443-.143.8-.387 1.071-.73.271-.343.429-.747.473-1.212.022-.254.006-.503-.05-.747.277-.443.404-.908.382-1.395-.01-.132-.038-.265-.083-.398.266-.398.393-.819.382-1.262 0-.166-.028-.332-.083-.498.155-.232.266-.481.332-.747l.067-.083v-.73l-.034-.083v-.05c-.022-.033-.033-.055-.033-.066-.166-.642-.531-1.069-1.096-1.279-.265-.088-.542-.133-.83-.133h-2.888c.044-.298.083-.525.116-.68.144-.742.116-1.4-.083-1.976-.078-.221-.21-.586-.399-1.096l-.149-.398c-.177-.443-.476-.753-.896-.93-.321-.144-.648-.216-.98-.216-.376 0-.742.095-1.096.283-.564.287-.84.747-.83 1.378.011.254.017.453.017.597.01.454.022.797.033 1.03 0 .055-.011.105-.033.149-.033.066-.091.172-.174.315l-.191.332c-.388.676-.681 1.174-.88 1.495-.133.199-.313.365-.54.498-.227.132-.423.215-.59.249l-.248.05H4.258c-.332 0-.614.116-.847.348-.232.233-.349.515-.349.847v6.11c0 .331.117.613.35.846.232.232.514.349.846.349h9.994zm0-1.196h-6.94l.017-6.441c.51-.244.908-.587 1.195-1.03V8.38c.21-.332.504-.836.88-1.51l.017-.017c.022-.034.1-.166.232-.399.011-.011.034-.044.067-.1.033-.055.055-.094.066-.116.155-.265.221-.548.2-.846-.012-.244-.023-.56-.034-.947v-.63c-.01-.067 0-.122.033-.167.022-.044.072-.088.15-.132.177-.089.354-.133.531-.133.166 0 .338.039.515.116.11.044.193.127.249.249.077.232.127.365.15.398.165.454.292.808.38 1.063.134.387.145.841.034 1.361-.033.188-.072.426-.116.714l-.232 1.395h4.3c.143 0 .287.022.431.066.166.067.277.216.332.448.011 0 .02.011.025.034.005.022.008.038.008.05v.232l-.033.133c-.033.121-.083.238-.15.348l-.315.465.15.531c.022.067.033.139.033.216.01.188-.05.37-.183.548l-.299.465.15.531c.01.055.022.105.033.15.011.22-.055.442-.2.664l-.265.415.1.415v.05c.033.143.044.282.033.414v.017c-.022.221-.094.404-.216.548-.122.155-.288.271-.498.349-.21.066-.487.1-.83.1zm-8.135 0h-1.86v-6.11h1.86v6.11z"
		                    ></path>
		                </g>
		            </svg>
		            <span>Like </span>
		        </span>


		        <?php if (!$review_all): ?>
		        	
		        <span data-view-id="pdp_product_review_reply_button" class="review-comment__reply" data-reply-id="<?php echo $review->id ?>">Gửi trả lời</span>
		        <?php if (isset($review->children) && sizeof($review->children)): ?>
		        	
		        <div class="review-comment__sub-comments">
		        	<?php foreach ($review->children as $key => $child): ?>
		        		
		            <div class="style__StyledSubComment-sc-103p4dk-6 fKaYwj review-sub-comment">
		                <div class="review-sub-comment__avatar-thumb">
		                	<?php if ($child->is_admin_message): ?>
		                    <div class="Avatar__StyledAvatar-sc-17zdycl-0 gDQSLG" >
		                        <img src="<?php echo $settings['admin']['avatar'] ?>"  />
		                    </div>
		                    <?php else: ?>
                                <div class="Avatar__StyledAvatar-sc-17zdycl-0 gDQSLG has-character" data-name="<?php echo htmlentities($child->customer_name) ?>">
                					<span>LN</span>
                                </div>
		                	<?php endif ?>
		                </div>
		                <div class="review-sub-comment__inner">
		                    <div class="review-sub-comment__avatar">
		                        <div class="review-sub-comment__avatar-name"><?php echo $child->is_admin_message == '1' ? $settings['admin']['name'] : htmlentities($child->customer_name) ?></div>
		                        <?php if ($child->is_admin_message): ?>
		                        <span class="review-sub-comment__check-icon"></span>
		                        <?php endif ?>
		                        
		                        <div class="review-sub-comment__avatar-date"><time class="timeago" datetime="<?php echo $child->date ?>"><?php echo $child->date ?></time></div>
		                
		                    </div>
		                    <div class="review-sub-comment__content">
		                        <div>
		                            <span><?php echo htmlentities($child->message) ?></span>
		                            <!-- <span class="show-more-content">Thu gọn</span> -->
		                        </div>
		                    </div>
		                </div>
		            </div>

		        	<?php endforeach ?>

		        </div>
		      
		        <?php endif ?>
		        <?php endif ?>
		        <?php if ($review_all): ?>
    	        <div class="" style="margin-top: 10px; font-size: 14px; line-height: 17px;">
    	        	<div class="_3oBYE2"><img alt="product-image" src="<?php echo $review->post['image']  ?>"><div class="_3Ev-Kw">
    	        		<span class="Th2W9d">Sản phẩm:</span>
    	        		<span class="_22zO4w"><?php echo $review->post['title'] ?></span>
    	        	</div></div>
    	        
                </div>
		        <?php endif ?>


		    </div>
		</div>

	</div>

	<?php endforeach ?>
	<?php else: ?>
		<?php if($isFilter): ?>
			<div>Không có đánh giá nào phù hợp với lựa chọn của bạn.</div>
		<?php else: ?>
			<div>Hãy là người đầu tiên đánh giá sản phẩm này.</div>
		<?php endif ?>
	<?php endif ?>

	
</div>

