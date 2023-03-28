<!-- Dynamic Price Set -->
<?php if ( isset($data['dynamicData']['used']) && $data['dynamicData']['used'] != ''): ?>
  <span class="ihc-checkout-page-used-label"><?php echo $data['messages']['ihc_checkout_dynamic_price-set'];?>:</span>
  <span class="ihc-checkout-page-used-code"><?php echo ihc_format_price_and_currency( $data['currency'], $data['dynamicData']['used']) ;?></span>
   <span class="ihc-checkout-page-used-remove ihc-js-checkout-page-do-remove-dynamic-price" data-coupon="<?php echo $data['dynamicData']['used'];?>"><?php echo $data['messages']['ihc_checkout_remove'];?></span>
<?php endif;?>
