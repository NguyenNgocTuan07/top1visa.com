<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see              https://docs.woocommerce.com/document/template-structure/
 * @author           WooThemes
 * @package          WooCommerce/Templates
 * @version          3.0.0
 * @flatsome-version 3.16.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

//var_dump(count($product->get_price_html()));die;
$classes = array();
if($product->is_on_sale()) $classes[] = 'price-on-sale';
if(!$product->is_in_stock()) $classes[] = 'price-not-in-stock'; ?>
<div class="price-wrapper">
    <p class="price product-page-price <?php echo implode(' ', $classes); ?>">
  <?php echo $product->get_price_html(); ?></p>
</div>

<?php 
//var_dump($product->price);die;
?>

<?php if(isset($product->price) && $product->price): ?>
<div class="row">
      <?php //if(the_field('tong_chi_phi')):?>
      <div class="col-acf">Tổng chi phí: <?php echo the_field('tong_chi_phi'); ?></div><br/>
         <?php //endif;?>
       <?php //if(the_field('coc_truoc')):?>
      <div class="col-acf">Nhận cọc trước: <?php echo the_field('coc_truoc'); ?></div><br/>
       <?php //endif;?>
      <?php //if(the_field('phi_lanh_sự')):?>
      <div class="col-acf">Thanh toán lần 2: <?php echo the_field('phi_lanh_sự'); ?></div><br/>
  <?php //endif;?>
  <?php ///if(the_field('gia_dịch_vụ')):?>
      <div class="col-acf">Thanh toán lần 3: <?php echo the_field('gia_dịch_vụ'); ?></div><br/>
   <?php ///endif;?>
</div>
<?php endif;?>