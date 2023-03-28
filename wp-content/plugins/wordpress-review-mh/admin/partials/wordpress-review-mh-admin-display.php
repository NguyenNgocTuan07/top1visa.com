<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://dominhhai.com/
 * @since      1.0.0
 *
 * @package    Wordpress_Review_Mh
 * @subpackage Wordpress_Review_Mh/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" type="text/css">

<link href="<?php echo WP_RV_PLUGIN_URL ?>/admin/css/animate.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo WP_RV_PLUGIN_URL ?>/admin/css/quasar.min.css" rel="stylesheet" type="text/css">


<script src="<?php echo WP_RV_PLUGIN_URL ?>/admin/js/vue.min.js"></script>
<script src="<?php echo WP_RV_PLUGIN_URL ?>/admin/js/quasar.umd.min.js"></script>
<script src="<?php echo WP_RV_PLUGIN_URL ?>/admin/js/vue-router.js"></script>
<script src="<?php echo WP_RV_PLUGIN_URL ?>/admin/js/axios.js"></script>
<script src="<?php echo WP_RV_PLUGIN_URL ?>/admin/js/fslightbox.umd.js"></script>

<script>
    window.quasarConfig = {
      brand: { // this will NOT work on IE 11
        primary: '',
        // ... or all other brand colors
      },
      notify: {}, // default set of options for Notify Quasar plugin
      loadingBar: {
        color: 'blue'
      }
      // ..and many more (check Installation card on each Quasar component/directive/plugin)
    }
    window.RV_CONFIGS = {
    	site_url: '<?php echo get_site_url() ?>',
    	ajax_url: '<?php echo admin_url('admin-ajax.php') ?>',
    	image_url: '<?php echo get_site_url() ?>/wp-content/uploads/wprv',
    }
</script>



<div id="q-app" class="wrap-mh">
	<div class="q-pa-md">

		<q-toolbar class="bg-primary text-white">
          <q-btn round dense icon="west" color="pink" class="q-mr-sm" to="/" v-show="$route.path != '/'"></q-btn>
		      <!-- <q-btn flat round dense icon="wifi_tethering" class="q-mr-sm" to="/" v-show="$route.path == '/'"></q-btn> -->
          <!-- <q-btn flat round dense icon="menu" class="q-mr-sm" to="/" v-show="$route.path == '/'"></q-btn> -->
		      <q-avatar to="/" class="quasar-logo" v-show="$route.path == '/'">
		        <img :src="logo">
            <!-- <img :src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg"> -->
		      </q-avatar>

		      <q-toolbar-title>{{page_title}}</q-toolbar-title>
		       <q-space></q-space>
		     <q-tabs>
    			  <q-route-tab to="/reviews" exact label="Đánh giá"></q-route-tab>
    			  <q-route-tab to="/comments" exact label="Bình luận"></q-route-tab>
    			  <q-route-tab to="/products" exact label="Thống kê"></q-route-tab>
    			  <q-route-tab to="/settings" exact label="Cài đặt"></q-route-tab>
    			  <q-route-tab to="/tools" exact label="Công cụ"></q-route-tab>
			   </q-tabs>

		      <q-btn flat round dense icon="whatshot" @click="openURL('https://dominhhai.com')"></q-btn>
	    </q-toolbar>
	   
	    <!-- <div class="q-card"> -->
	    	<fs-lightbox
	    		:toggler="lightbox.toggler"
	    		initialAnimation="scale-in-long"
	    		slideChangeAnimation="scale-in"
	    		:sources="lightbox.sources"
	    		:key="lightbox.id"
	    	></fs-lightbox>


      <transition  name="fade" mode="out-in">
	    	<router-view></router-view>
      </transition>
	    
	    	
	</div>
</div>

<script type='module'>
      /*
        Example kicking off the UI. Obviously, adapt this to your specific needs.
        Assumes you have a <div id="q-app"></div> in your <body> above
       */
       import dashboardPage from '<?php echo WP_RV_PLUGIN_URL ?>/admin/partials/pages/dashboard.js';
       import indexPage from '<?php echo WP_RV_PLUGIN_URL ?>/admin/partials/pages/index.js';
       import commentsPage from '<?php echo WP_RV_PLUGIN_URL ?>/admin/partials/pages/comments.js';
       import settingsPage from '<?php echo WP_RV_PLUGIN_URL ?>/admin/partials/pages/settings.js';
       import productsPage from '<?php echo WP_RV_PLUGIN_URL ?>/admin/partials/pages/products.js';
       import toolsPage from '<?php echo WP_RV_PLUGIN_URL ?>/admin/partials/pages/tools.js';
       import toolReviewPage from '<?php echo WP_RV_PLUGIN_URL ?>/admin/partials/pages/tools/review.js';
       import toolCommentPage from '<?php echo WP_RV_PLUGIN_URL ?>/admin/partials/pages/tools/comment.js';
       import toolSoldProduct from '<?php echo WP_RV_PLUGIN_URL ?>/admin/partials/pages/tools/sold-product.js';
       import toolReviewTime from '<?php echo WP_RV_PLUGIN_URL ?>/admin/partials/pages/tools/review-time.js';
       import emptyComponent from '<?php echo WP_RV_PLUGIN_URL ?>/admin/partials/components/data-empty.js';
       // import VueEasyLightbox from 'https://unpkg.com/vue-easy-lightbox@next/dist/vue-easy-lightbox.esm.min.js';
       const EventBus = new Vue()

       const router = new VueRouter({
           routes: [
	           { path: '/', component: dashboardPage }, // Root Index
             { path: '/reviews', component: indexPage }, 
             { path: '/comments', component: commentsPage }, 
	           { path: '/settings', component: settingsPage }, 
             { path: '/products', component: productsPage }, 
             { path: '/tools', component: toolsPage }, 
             { path: '/tool/review', component: toolReviewPage }, 
             { path: '/tool/comment', component: toolCommentPage }, 
             { path: '/tool/sold-product', component: toolSoldProduct }, 
             { path: '/tool/review-time', component: toolReviewTime }, 
            
             ]
       });
       Vue.prototype.$eventBus = EventBus
       Vue.component('empty-component', emptyComponent)
       Vue.mixin({
         methods:{
          openURL(url){
            Quasar.utils.openURL(url)
          },
         	buildFormData(formData, data, parentKey) {
	 	        if (data && typeof data === 'object' && !(data instanceof Date) && !(data instanceof File)) {
	 	          Object.keys(data).forEach(key => {
	 	            this.buildFormData(formData, data[key], parentKey ? `${parentKey}[${key}]` : key);
	 	          });
	 	        } else {
	 	          const value = data == null ? '' : data;

	 	          formData.append(parentKey, value);
	 	        }
	 	      },
	 	    jsonToFormData(data) {
	 	        const formData = new FormData();

	 	        this.buildFormData(formData, data);

	 	        return formData;
 	        },
 	        NOTIFY(msg, type = 1){
 	        	this.$q.notify({
			        message: msg,
			        color: type == 1 ? 'green' : 'red',
			        position: 'top',
			        timeout: 2000
			      })	
 	        },
          srcImg(src){
            let site_url = RV_CONFIGS.site_url.replace('https', '');
            site_url = site_url.replace('http', '');
            if(src == null)
              return ''
            if(src.toString().indexOf(site_url) > -1)
              return src
            else
              return RV_CONFIGS.image_url + '/h' + src
          },
 	        deepMerge(target, source) {
 	                    Object.entries(source).forEach(([key, value]) => {
 	                        if (value && typeof value === 'object') {
 	                            this.deepMerge(target[key] = target[key] || {}, value);
 	                            return;
 	                        }
 	                        target[key] = value;
 	                    });
 	                    return target;
            },
            getSettings(){
            	return new Promise((resolve, reject) => {
                if(window.hasOwnProperty('wp_rv_settings'))
                    resolve(window.wp_rv_settings)
                else
                {
                    axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({action: 'wp_rv_get_option', key: 'wp_rv_settings'})).then(res => { 
                            
                      const {success, data} = res.data
                      if(success && data)
                      { 
                        window.wp_rv_settings = data
                        data.cache = data.cache == 'true' ? true : false
                        data.active.rating = data.active.rating == 'true' ? true : false
                        data.active.comment = data.active.comment == 'true' ? true : false
                        data.turn_off_review_default = data.turn_off_review_default == 'true' ? true : false
                        data.instead_of_my_review = data.instead_of_my_review == 'true' ? true : false
                        data.limit.ip = data.limit.ip == 'true' ? true : false
                        data.limit.phone = data.limit.phone == 'true' ? true : false
                        data.product_show.reviews = data.product_show.reviews == 'true' ? true : false
                        data.product_show.sold = data.product_show.sold == 'true' ? true : false
                        data.product_show.real_sold = data.product_show.real_sold == 'true' ? true : false
                        data.captcha.active = data.captcha.active == 'true' ? true : false
                        data.is_time_ago = data.is_time_ago == 'true' ? true : false
                        data.email.active = data.email.active == 'true' ? true : false
                        data.email.admin_reply = data.email.admin_reply == 'true' ? true : false
                        data.email.order_completed = data.email.order_completed == 'true' ? true : false
                        data.faq_schema = data.faq_schema == 'true' ? true : false
                        data.customer_phone = data.customer_phone == 'true' ? true : false
                        resolve(data)
                                                          
                      }
                    })
                }
            		
            	})
            }
         }
       })

      new Vue({
      	router,
        el: '#q-app',
        data: function () {
          return {
            page_title: 'WP Reviews MH',
          	lightbox: {
          		toggler: false,
          		sources: [],
          		id: 0
          	},
            logo: `${window.RV_CONFIGS.site_url}/wp-content/plugins/wordpress-review-mh/assets/images/virus.svg`
            // configs: window.RV_CONFIGS
          	
          }
        },
        methods: {
        	openLightBox(data){
        		this.lightbox.id = data.id
        		this.lightbox.sources = data.attactments
        		this.lightbox.toggler = !this.lightbox.toggler
        		// console.log(123);
        	},
          setPageTitle(title){
            this.page_title = title
          }
        },
        components:{

        },
        created(){
        	EventBus.$on('set.page_title', this.setPageTitle);

          EventBus.$on('open.lightbox', this.openLightBox);
        	this.getSettings().then(data => {})
        }
        // 
      });




      //Set Height Div Wrap
      const setViewPort = () => {
	      const vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
	      document.querySelector(".wrap-mh").style.minHeight = `${vh - 120}px`;
      }
      window.onresize = () => {
      	setViewPort();
      }
      setViewPort();

      //Fix Admin Href 
      const aList = document.querySelectorAll('#adminmenu a');
      aList.forEach(el => {
      	const href = el.getAttribute("href");
      	el.href = window.RV_CONFIGS.site_url + '/wp-admin/' + href;
      })
      document.querySelector('.toplevel_page_wp_reviews_mh img').classList.add("rotating");
      document.title = 'WP Reviews MH'

      document.querySelector('body').classList.add("wp-review-q-app");

</script>