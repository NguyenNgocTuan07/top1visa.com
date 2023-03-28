<?php



/*Code của Tuân*/
// Add custom link to My Account menu
add_filter( 'woocommerce_account_menu_items', 'my_custom_link', 99 );

function my_custom_link( $menu_links ){

    // Remove the logout link
  //  $logout = $menu_links['customer-logout'];
   // unset( $menu_links['customer-logout'] );

    // Insert your custom link
    $menu_links['cap-nhat-thong-tin-ds160-my'] = __( 'Cập nhật Thông Tin DS160', 'woocommerce' );
	$menu_links['cap-nhat-thong-tin-ds160-'] = __( 'Cập Nhật Thông Tin Visa Pháp', 'woocommerce' );

    // Insert the logout link back to the end of the menu
   // $menu_links['customer-logout'] = $logout;

    return $menu_links;

}

// Add endpoint for your custom page
add_action( 'woocommerce_account_my-custom-page_endpoint', 'my_custom_page_content' );

function my_custom_page_content() {
    // Add your custom content here
    echo '<p>This is my custom page content.</p>';
}

function change_order_text( $translated_text, $text, $domain ) {

   // var_dump($text);//die;

    if( $domain === 'woocommerce' && $text === 'Orders' ) {

        $translated_text = 'Hồ sơ của tôi';
    }
    return $translated_text;
}
add_filter( 'gettext', 'change_order_text', 20, 3 );
add_filter( 'woocommerce_order_button_text', 'my_custom_checkout_button_text' );

function my_custom_checkout_button_text() {
    return __( 'Làm ngay', 'woocommerce' );
}
function redirect_to_checkout_after_add_to_cart() {
    global $woocommerce;
    
    $checkout_url = $woocommerce->cart->get_checkout_url();
    
    return $checkout_url;
}

add_filter( 'woocommerce_add_to_cart_redirect', 'redirect_to_checkout_after_add_to_cart' );

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Làm ngay', 'woocommerce' ); 
}
// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Làm ngay', 'woocommerce' );
}
/*
* Add quick buy button go to checkout after click
* Author: levantoan.com
*/
add_action('woocommerce_after_add_to_cart_button','devvn_quickbuy_after_addtocart_button');
function devvn_quickbuy_after_addtocart_button(){
    global $product;
    ?>
    <style>
        .devvn-quickbuy button.single_add_to_cart_button.loading:after {
            display: none;
        }
        .devvn-quickbuy button.single_add_to_cart_button.button.alt.loading {
            color: #fff;
            pointer-events: none !important;
        }
        .devvn-quickbuy button.buy_now_button {
            position: relative;
            color: rgba(255,255,255,0.05);
        }
        .devvn-quickbuy button.buy_now_button:after {
            animation: spin 500ms infinite linear;
            border: 2px solid #fff;
            border-radius: 32px;
            border-right-color: transparent !important;
            border-top-color: transparent !important;
            content: "";
            display: block;
            height: 16px;
            top: 50%;
            margin-top: -8px;
            left: 50%;
            margin-left: -8px;
            position: absolute;
            width: 16px;
        }
    </style>
    <a href="#test" class="button buy_now_button"><?php _e('Yêu cầu gọi lại', 'devvn'); ?></a>
  <!--   <button type="button" class="button buy_now_button">
        <?php //_e('Yêu cầu gọi lại', 'devvn'); ?>

    </button> -->
    <input type="hidden" name="is_buy_now" class="is_buy_now" value="0" autocomplete="off"/>
    <script>
        jQuery(document).ready(function(){
            jQuery('body').on('click', '.buy_now_button', function(e){
                e.preventDefault();
            console.log("tuan");
                ///jQuery('.goilai').show();
                // var thisParent = jQuery(this).parents('form.cart');
                // if(jQuery('.single_add_to_cart_button', thisParent).hasClass('disabled')) {
                //     jQuery('.single_add_to_cart_button', thisParent).trigger('click');
                //     return false;
                // }
                // thisParent.addClass('devvn-quickbuy');
                // jQuery('.is_buy_now', thisParent).val('1');
                // jQuery('.single_add_to_cart_button', thisParent).trigger('click');
            });
        });
    </script>
    <?php
}
/*end*/
function custom_translate_text( $translated_text, $untranslated_text, $domain ) {
    if ( $untranslated_text == 'Cart' ) { // Đổi 'Cart' thành 'Giỏ Hàng' hoặc tên tương tự
        $translated_text = 'Hồ Sơ';
    }
    return $translated_text;
}
add_filter('gettext', 'replace_text');
add_filter('ngettext', 'replace_text');

function replace_text($translated) {
    $translated = str_ireplace('đơn Hàng', 'hồ sơ của tôi', $translated);
    return $translated;
}
add_filter( 'gettext', 'custom_translate_text', 20, 3 );
add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout($redirect_url) {
    if (isset($_REQUEST['is_buy_now']) && $_REQUEST['is_buy_now']) {
        $redirect_url = wc_get_checkout_url(); //or wc_get_cart_url()
    }
    return $redirect_url;
}
// Add custom Theme Functions here
/** Shortcode [my_shortcode_posts] */
add_shortcode( 'my_shortcode_posts_ditru', 'so36133962_get_all_posts_by_category1' );
function so36133962_get_all_posts_by_category1( $attr, $content = null )
{
    $args = array(
        'post_type'      => 'post', // set your custom post type
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        /** add more arguments such as taxonomy query i.e:

                'tax_query' => array( array(
                    'taxonomy' => 'genre', // set your taxonomy
                    'field'    => 'slug',
                    'terms'    => array( 'comedy','drama' ) // set your term taxonomy
                ) )
        */
    );

    $posts = new WP_Query( $args );

    /**
     * Prepare Posts
     *
     */
    $result = array();

    // The Loop
    if ( $posts->have_posts() )
    {
        while ( $posts->have_posts() )
        {
            $posts->the_post();
            /**
             * Get all item in a term taxonomy
             *
             */
            $categories = get_the_terms( get_the_ID(), 'category' /* set your term taxonomy */ );
            if ( ! $categories )
                continue;

            foreach ( $categories as $key => $category )
            {
                $term_name = $category->name;
                $term_slug = $category->slug;
                $term_id   = $category->term_id;
            }


            /**
             * Format html content
             *
             */
            $format = '<a href="%1$s" title="%2$s" class="post-%3$s">%4$s%2$s</span></a>';

            /**
             * Formatted string post content
             *
             */
            $content = sprintf( $format,
                get_permalink(),
                get_the_title(),
                get_the_ID(),
                $img_cover,
                get_the_title(),
                __( '', 'text-domain' )
            );

            /**
             * Set an array of each post for output loop
             *
             */
            $result[ $term_slug ][] = array(
                'post_id'      => get_the_ID(),
                'post_content' => $content,
                'term_name'    => $term_name,
                'term_id'      => $term_id
            );
        }
    }
    wp_reset_postdata(); // post reset

    /**
     * Check existing output
     *
     */
    if ( ! $result )
        return;

    /**
     * Output loop
     *
     */
    $output = '';
    foreach ( $result as $slug => $data )
    {
        $count = count( $data );
        for ( $i = 0; $i < $count; $i++ )
        {
            /**
             * Set data as object
             *
             */
            $post = ( object ) array_map( 'trim', $data[ $i ] );

            if ( 0 == $i )
            {
                /**
                 * Set category id and name
                 *
                 */
                $output .= '<div class="accordion accordion-chowordpress" rel="">';
                $output .= '<div class="accordion-item">
    <a href="#" class="accordion-title plain active">
      <button class="toggle" aria-label="Toggle">
        <i class="icon-angle-down"></i>
      </button>
      <span>' . esc_html( $post->term_name ) . '</span></a><div class="accordion-inner" style="display: block;">';
            }
            $output .= '' . $post->post_content . '';
        }
        $output .= '</div></div></div>';
    }

    return $output; // complete
}


add_shortcode( 'my_shortcode_posts', 'so36133962_get_all_posts_by_category' );
function so36133962_get_all_posts_by_category( $attr, $content = null )
{
    $args = array(
        'post_type'      => 'post', // set your custom post type
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        /** add more arguments such as taxonomy query i.e:

                'tax_query' => array( array(
                    'taxonomy' => 'genre', // set your taxonomy
                    'field'    => 'slug',
                    'terms'    => array( 'comedy','drama' ) // set your term taxonomy
                ) )
        */
    );

    $posts = new WP_Query( $args );

    /**
     * Prepare Posts
     *
     */
    $result = array();

    // The Loop
    if ( $posts->have_posts() )
    {
        while ( $posts->have_posts() )
        {
            $posts->the_post();
            /**
             * Get all item in a term taxonomy
             *
             */
            $categories = get_the_terms( get_the_ID(), 'category' /* set your term taxonomy */ );
            if ( ! $categories )
                continue;

            foreach ( $categories as $key => $category )
            {
                $term_name = $category->name;
                $term_slug = $category->slug;
                $term_id   = $category->term_id;
            }


            /**
             * Format html content
             *
             */
            $format = '<a href="%1$s" title="%2$s" class="post-%3$s">%4$s%2$s</span></a>';

            /**
             * Formatted string post content
             *
             */
            $content = sprintf( $format,
                get_permalink(),
                get_the_title(),
                get_the_ID(),
                $img_cover,
                get_the_title(),
                __( '', 'text-domain' )
            );

            /**
             * Set an array of each post for output loop
             *
             */
            $result[ $term_slug ][] = array(
                'post_id'      => get_the_ID(),
                'post_content' => $content,
                'term_name'    => $term_name,
                'term_id'      => $term_id
            );
        }
    }
    wp_reset_postdata(); // post reset

    /**
     * Check existing output
     *
     */
    if ( ! $result )
        return;

    /**
     * Output loop
     *
     */
    $output = '';
    foreach ( $result as $slug => $data )
    {
        $count = count( $data );
        for ( $i = 0; $i < $count; $i++ )
        {
            /**
             * Set data as object
             *
             */
            $post = ( object ) array_map( 'trim', $data[ $i ] );

            if ( 0 == $i )
            {
                /**
                 * Set category id and name
                 *
                 */
                $output .= '<div class="accordion accordion-chowordpress" rel="">';
                $output .= '<div class="accordion-item">
    <a href="#" class="accordion-title plain">
      <button class="toggle" aria-label="Toggle">
        <i class="icon-angle-down"></i>
      </button>
      <span>' . esc_html( $post->term_name ) . '</span></a><div class="accordion-inner" style="display: none;">';
            }
            $output .= '' . $post->post_content . '';
        }
        $output .= '</div></div></div>';
    }

    return $output; // complete
}


add_action( 'wp_enqueue_scripts', 'dr_placeholder_form' );
function dr_placeholder_form() {

    wp_enqueue_script( 'placeholder-form',  get_stylesheet_directory_uri() . '/js/placeholder-form.js', array( 'jquery' ), '1.0.0', true );

}


//Bài viết liên quan
function chowordpress_baivietlienquan($content) {
  if (is_single()) {
    $content .= "<div class='clearfix'></div>";
    global $post;
    $categories = get_the_category($post->ID);
    if ($categories) {
      $category_ids = array();
      foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
      $args=array(
        'category__in' => $category_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page'=> 3, // Number of related posts that will be shown.
        'caller_get_posts'=>1
      );

      $my_query = new wp_query( $args );
      if( $my_query->have_posts() ) { 		
        $content .= '<div id="related_posts"><span class="widget-title "><span>BÀI LIÊN QUAN</span></span>';
        while( $my_query->have_posts() ) {
            		$my_query->the_post();
          $content .= '<div class="div_bailienquan"><div class="item_bailienquan"><a href="'. get_the_permalink().'">'. get_the_title().'</a></div></div>';
        } //End while
        $content .= "</div>";
      } //End if
    } //End if
  }
  return $content;
}
add_filter ('the_content', 'chowordpress_baivietlienquan', 0);


class Auto_Save_Images{
 
    function __construct(){     
        
        add_filter( 'content_save_pre',array($this,'post_save_images') ); 
    }
    
    function post_save_images( $content ){
        if( ($_POST['save'] || $_POST['publish'] )){
            set_time_limit(240);
            global $post;
            $post_id=$post->ID;
            $preg=preg_match_all('/<img.*?src="(.*?)"/',stripslashes($content),$matches);
            if($preg){
                foreach($matches[1] as $image_url){
                    if(empty($image_url)) continue;
                    $pos=strpos($image_url,$_SERVER['HTTP_HOST']);
                    if($pos===false){
                        $res=$this->save_images($image_url,$post_id);
                        $replace=$res['url'];
                        $content=str_replace($image_url,$replace,$content);
                    }
                }
            }
        }
        remove_filter( 'content_save_pre', array( $this, 'post_save_images' ) );
        return $content;
    }
    
    function save_images($image_url,$post_id){
        $file=file_get_contents($image_url);
        $post = get_post($post_id);
        $posttitle = $post->post_title;
        $postname = sanitize_title($posttitle);
        $im_name = "$postname-$post_id.jpg";
        $res=wp_upload_bits($im_name,'',$file);
        $this->insert_attachment($res['file'],$post_id);
        return $res;
    }
    
    function insert_attachment($file,$id){
        $dirs=wp_upload_dir();
        $filetype=wp_check_filetype($file);
        $attachment=array(
            'guid'=>$dirs['baseurl'].'/'._wp_relative_upload_path($file),
            'post_mime_type'=>$filetype['type'],
            'post_title'=>preg_replace('/\.[^.]+$/','',basename($file)),
            'post_content'=>'',
            'post_status'=>'inherit'
        );
        $attach_id=wp_insert_attachment($attachment,$file,$id);
        $attach_data=wp_generate_attachment_metadata($attach_id,$file);
        wp_update_attachment_metadata($attach_id,$attach_data);
        return $attach_id;
    }
}
new Auto_Save_Images();
/*
* CODE THU GỌN NỘI DUNG SẢN PHẨM CHO THEME FLATSOME
*/
add_action('wp_footer','mdsco_readmore_flatsome');
function mdsco_readmore_flatsome(){
    ?>
    <style>
        .single-product div#tab-description {
            overflow: hidden;
            position: relative;
        }
        .single-product .tab-panels div#tab-description.panel:not(.active) {
            height: 0 !important;
        }
        .mdsco_readmore_flatsome {
            text-align: center;
            cursor: pointer;
            position: absolute;
            z-index: 9999;
            bottom: 0;
            width: 100%;
            background: #fff;
        }
        .mdsco_readmore_flatsome:before {
            height: 55px;
            margin-top: -45px;
            content: "";
            background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
            background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 100%);
            background: linear-gradient(to bottom, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff00', endColorstr='#ffffff',GradientType=0 );
            display: block;
        }
        .mdsco_readmore_flatsome a {
            color: #318A00;
            display: block;
        }
        .mdsco_readmore_flatsome a:after {
            content: '';
            width: 0;
            right: 0;
            border-top: 6px solid #318A00;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            display: inline-block;
            vertical-align: middle;
            margin: -2px 0 0 5px;
        }
    </style>
    <script>
        (function($){
            $(document).ready(function(){
                $(window).on('load', function(){
                    if($('.single-product div#tab-description').length > 0){
                        var wrap = $('.single-product div#tab-description');
                        var current_height = wrap.height();
                        var your_height = 300;
                        if(current_height > your_height){
                            wrap.css('height', your_height+'px');
                            wrap.append(function(){
                                return '<div class="mdsco_readmore_flatsome"><a title="Xem thêm" href="javascript:void(0);">Xem thêm</a></div>';
                            });
                            $('body').on('click','.mdsco_readmore_flatsome', function(){
                                wrap.removeAttr('style');
                                $('body .mdsco_readmore_flatsome').remove();
                            });
                        }
                    }
                });
            });
        })(jQuery);
    </script>
    <?php
}