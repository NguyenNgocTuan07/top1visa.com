<div class='wp_rv_product_info'>

				
            <div class="Stars__StyledStars-sc-15olgyg-0 dYhelp">
 
				<span>
				    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 32 32">
				        <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
				    </svg>
				</span>
				<span>
				    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 32 32">
				        <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
				    </svg>
				</span>
				<span>
				    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 32 32">
				        <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
				    </svg>
				</span>
				<span>
				    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 32 32">
				        <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
				    </svg>
				</span>
				<span>
				    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 32 32">
				        <path fill="none" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
				    </svg>
				</span>
				<div style="width: <?php echo isset($data->average) ?  20 * $data->average + $margin_w : 0 ?>%;">
				    <span>
				        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 32 32">
				            <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
				        </svg>
				    </span>
				    <span>
				        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 32 32">
				            <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
				        </svg>
				    </span>
				    <span>
				        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 32 32">
				            <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
				        </svg>
				    </span>
				    <span>
				        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 32 32">
				            <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
				        </svg>
				    </span>
				    <span>
				        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 32 32">
				            <path fill="#FDD835" fill-rule="evenodd" stroke="#FFB500" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
				        </svg>
				    </span>
				</div>
			</div>
				<span class='wp_rv_total' style="<?php echo $settings['product_show']['sold'] == 'false' ? 'border:0' : ''; ?>">( <strong><?php echo isset($data->total) ? $data->total : 0 ?></strong> đánh giá)</span>
				<?php if ($settings['product_show']['sold'] == 'true'): ?>
				<span class='wp_rv_sold'><strong>
					<?php echo isset($data->sold) ? $data->sold > 1000 ? number_format($data->sold / 1000, 1) . 'k' : $data->sold : 0 ?></strong> Đã bán</span>

				<?php endif ?>
</div>