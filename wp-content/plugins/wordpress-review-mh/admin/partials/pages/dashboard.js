const template = `
<div class="q-mt-lg">
    <div v-if="!isLoading">
        
        <div class="dash-box text-center">
            <div class="item-m">
                <q-badge rounded color="red" :label="moderated.review" floating v-show="moderated.review != ''"/>
                <router-link to="/reviews" tag="div">
                    <q-img :src=" configs.site_url + '/wp-content/plugins/wordpress-review-mh/assets/images/rating.svg'" :ratio="1" />
                    <h6>Đánh giá</h6>
                </router-link>
            </div>
            <div class="item-m">
                <q-badge rounded color="red" :label="moderated.comment" floating v-show="moderated.comment != ''"/>
                <router-link to="/comments" tag="div">
                    <q-img :src=" configs.site_url + '/wp-content/plugins/wordpress-review-mh/assets/images/comment.svg'" :ratio="1" />
                    <h6>Hỏi đáp</h6>
                </router-link>

            </div>
            <div class="item-m">
                <router-link to="/products" tag="div">
                    <q-img :src=" configs.site_url + '/wp-content/plugins/wordpress-review-mh/assets/images/supply-chain.svg'" :ratio="1" />
                    <h6>Thống kế</h6>
                </router-link>
            </div>
            <div class="item-m">
                <router-link to="/settings" tag="div">
                    <q-img :src=" configs.site_url + '/wp-content/plugins/wordpress-review-mh/assets/images/settings.svg'" :ratio="1" />
                    <h6>Cài đặt</h6>
                </router-link>
            </div>
            <div class="item-m">
                <router-link to="/tools" tag="div">
                    <q-img :src=" configs.site_url + '/wp-content/plugins/wordpress-review-mh/assets/images/repair-tools.svg'" :ratio="1" />
                    <h6>Công cụ</h6>
                </router-link>
            </div>
        </div>
       
    </div>
</div>   
`;

const { RV_CONFIGS } = window 
export default {
    data: () => ({
    	isLoading: false,
        configs: RV_CONFIGS,
        moderated: {
            review: '',
            comment: '',
        }
    }),
   
    methods: {
    	
	},
	components:{

	},
    template: template,
    created(){
        //wp_rv_get_general_info
        axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_get_general_info' })).then(res => {
            const { moderated } = res.data
            this.moderated = moderated
        })
        this.$eventBus.$emit('set.page_title', 'WP Reviews MH');

    }

}