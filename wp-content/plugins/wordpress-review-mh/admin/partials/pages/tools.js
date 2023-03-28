const template = `
<div class="q-mt-lg">
    <div v-if="!isLoading">
        
        <div class="dash-box-2 text-center">
            <div class="item-m">
                <router-link to="/tool/sold-product" tag="div">
                    <q-img :src=" configs.site_url + '/wp-content/plugins/wordpress-review-mh/assets/images/box.svg'" :ratio="1" />
                    <h6>Thiết lập số lượng đã bán</h6>
                </router-link>
            </div>
            <div class="item-m">
                <router-link to="/tool/review" tag="div">
                    <q-img :src=" configs.site_url + '/wp-content/plugins/wordpress-review-mh/assets/images/3898850.png'" :ratio="1" />
                    <h6>Tạo đánh giá</h6>
                </router-link>
            </div>
            <div class="item-m">
                <router-link to="/tool/comment" tag="div">
                    <q-img :src=" configs.site_url + '/wp-content/plugins/wordpress-review-mh/assets/images/4470943.png'" :ratio="1" />
                    <h6>Tạo bình luận</h6>
                </router-link>
            </div>
            <div class="item-m">
                <router-link to="/tool/review-time" tag="div">
                    <q-img :src=" configs.site_url + '/wp-content/plugins/wordpress-review-mh/assets/images/calendar.svg'" :ratio="1" />
                    <h6>Thiết lập thời gian</h6>
                </router-link>
            </div>
            <div class="item-m" @click="resetAllData">
                    <q-img :src=" configs.site_url + '/wp-content/plugins/wordpress-review-mh/assets/images/reset.svg'" :ratio="1" />
                    <h6>Xóa toàn bộ dữ liệu</h6>
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
    	resetAllData(){
            this.$q.dialog({
                dark: true,
                title: 'Xóa toàn bộ dữ liệu',
                message: 'Bao gồm dữ liệu đánh giá, bình luận, thống kê, ảnh liên quan và cài đặt. Gõ wpreviewsmh để tiếp tục.',
                prompt: {
                model: '',
                type: 'text' // optional
                },
                cancel: true,
                persistent: true
            }).onOk(data => {
               if(data == 'wpreviewsmh')
               {
                   axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_reset_all_data' })).then(res => {
                       const {success, msg} = res.data
                       this.NOTIFY(msg, success);
                   })
               }
            })
        }
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

        this.$eventBus.$emit('set.page_title', 'Công cụ');

    }

}