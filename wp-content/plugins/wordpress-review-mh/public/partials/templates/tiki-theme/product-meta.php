<?php if ($data->total > 0): ?>
<div class='wp_rv_product-loop__meta' data-stars="<?php echo $data->average ?>" data-sold="<?php echo $data->sold ?>">
		<?php if ($settings['product_show']['reviews'] == 'true'): ?>
			<div class="review-comment__rating-title">
			    <div class="Stars__StyledStars-sc-15olgyg-0 dYhelp review-comment__rating">
			        <span> <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 32 32"> <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path> </svg> 
			        </span> <span> <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 32 32"> <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path> </svg> 
			        </span> <span> <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 32 32"> <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path> </svg> </span> 
			        <span> <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 32 32"> <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path> </svg> </span> 
			        <span> <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 32 32"> <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path> </svg>
			        </span>
			        <div style="width: <?php echo 20 * $data->average + $margin_w ?>%;">
			            <span> <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 32 32"> <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path> </svg> </span> 
			            <span> <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 32 32"> <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path> </svg> </span> 
			            <span> <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 32 32"> <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path> </svg> </span> 
			            <span> <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 32 32"> <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path> </svg> </span> 
			            <span> <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 32 32"> <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path> </svg> </span> 
			        </div> 
			    </div>
			    
			    <span class="wp_rv-count-reviews">(<?php echo $data->total ?> <span class="wp_rv-review-label">đánh giá</span>) </span>
			    
			</div>
		<?php endif ?>
		<?php if ($settings['product_show']['sold'] == 'true'): ?>
		<span class="wp_rv-sold">
			Đã bán <?php echo $data->sold >= 1000 ? number_format($data->sold / 1000, 1) . 'k' : $data->sold ?>
		</span>
		<?php endif ?>

</div>
<?php endif ?>
