
		<div class="customer-comments wp-ajax-content" data-type="2">

				<?php if (isset($comments) && sizeof($comments)): ?>
				<?php foreach ($comments as $key => $review): ?>
				<div class="customer-comment__item parent-reply-item">
					<div class="customer-comment__item-user">
						<div class="review-sub-comment__avatar-thumb">
		                    <div class="Avatar__StyledAvatar-sc-17zdycl-0 gDQSLG has-character" data-name="<?php echo htmlentities($review->customer_name) ?>">
		    					<span></span>
		                    </div>
			            </div>
			            <div class="customer-comment__item-name">
				            <span><?php echo htmlentities($review->customer_name) ?></span>
				   
			            	
			            </div>
						
					</div>
					<div class="customer-comment__content">
						
			            <?php echo htmlentities($review->message) ?>
					</div>
					<div class="customer-comment__action">
						<a href="javascript:void(0)" class="respondent rv-comment_reply" data-reply-id="<?php echo $review->id ?>">Trả lời</a> -
						 <a href="javascript:void(0)" class="time"><time class="timeago" datetime="<?php echo $review->date ?>"><?php echo $review->date ?></time></a>
					</div>
					<?php if (isset($review->children) && sizeof($review->children)): ?>
			        <div class="listreply">
	        			<div class="review-comment__sub-comments">
				        	<?php foreach ($review->children as $key => $child): ?>
	        					        			        		
	        	            <div class="style__StyledSubComment-sc-103p4dk-6 fKaYwj review-sub-comment parent-reply-item">
	        	                
	        	                <div class="review-sub-comment__inner">
	        	                    <div class="review-sub-comment__avatar">
	        	                    	<div class="review-sub-comment__avatar-thumb">
        				                	<?php if ($child->is_admin_message): ?>
        				                    <div class="Avatar__StyledAvatar-sc-17zdycl-0 gDQSLG" >
        				                        <img src="<?php echo $settings['admin']['avatar'] ?>" />
        				                    </div>
        				                    <?php else: ?>
        		                                <div class="Avatar__StyledAvatar-sc-17zdycl-0 gDQSLG has-character" data-name="<?php echo htmlentities($child->customer_name) ?>">
        		                					<span>LN</span>
        		                                </div>
        				                	<?php endif ?>
                		                   
                			            </div>
	        	                        <div class="customer-comment__item-name <?php echo $child->is_admin_message == '1' ? 'item-name-admin' : '' ?>">
	        	                        	<?php echo $child->is_admin_message == '1' ? $settings['admin']['name'] : htmlentities($child->customer_name) ?>
	        	                        	<span class="review-sub-comment__check-icon"></span> 
	        	                        </div>
	        	                        
	        	                        <!-- <div class="review-sub-comment__avatar-date"><?php echo $child->date ?></div> -->
	        	                        <!-- <div class="review-sub-comment__avatar-date">19 tháng 01, 2021</div> -->
	        	                    </div>
	        	                    <div class="customer-comment__content">
	        	                            <span><?php echo htmlentities($child->message) ?></span>
	        	                            <!-- <span class="show-more-content">Thu gọn</span> -->
	        	                    </div>
	        	                    
	        	                    <div class="customer-comment__action" data-cl="0">
	        	                    	<a href="javascript:void(0)" class="respondent rv-comment_reply" data-reply-id="<?php echo $review->id ?>">Trả lời</a>
	        	                    	<a href="javascript:void(0)" class="time"><time class="timeago" datetime="<?php echo $review->date ?>"><?php echo $child->date ?></time></a>
	        	                    	<!-- <a href="javascript:void(0)" class="time"><?php echo htmlentities($child->date) ?> </a> -->
	        	                    </div>
	        	                </div>
	        	            </div>
				        	<?php endforeach ?>

	        					        	
	        	        </div>
			        </div>
				    <?php endif ?>

				</div>

				<?php endforeach ?>
				<?php else: ?>
					Chưa có bình luận nào
				<?php endif ?>

		</div>

		
		
