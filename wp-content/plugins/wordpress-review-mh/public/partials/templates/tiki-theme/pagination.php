<div class="customer-reviews__pagination" data-type="<?php echo $type ?>">
<?php 
    $pagination_ = getSmartPageNumbers($pagination['page'],$pagination['max_page']);
	if($pagination['max_page'] > 1):
?>
    <ul class="Navigation__Wrapper-dgcpmq-0 kiFxlu">
        <?php if($pagination['page'] > 1):  ?>
        <li>
            <a class="prev-mm">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z"></path></svg>
            </a>
        </li>
        <?php endif ?>

    	<?php for ($i=0; $i < sizeof($pagination_); $i++):?>
        <li><a data-page="<?php echo $pagination_[$i] ?>" class="btn-pagi-m <?php echo $pagination_[$i] == $pagination['page'] ? 'active' : '' ?>"><?php echo $pagination_[$i] ?></a></li>
    	<?php endfor ?>

        <?php if($pagination['max_page'] > $pagination['page']):  ?>
        <li>
            <a class="next-mm">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path>
                </svg>
            </a>
        </li>
        <?php endif ?>

    </ul>
    <div class="customer-reviews__pagination--mobile">
    	<div class="customer-reviews__pagination--mobile--button open-reviews-box">Xem tất cả <?php echo $type == 1 ? 'đánh giá' : 'bình luận' ?></div>
        <div class="customer-reviews__pagination--mobile--button customer-reviews--load_more">Tải thêm <?php echo $type == 1 ? 'đánh giá' : 'bình luận' ?></div>
    </div>
<?php endif ?>
</div>