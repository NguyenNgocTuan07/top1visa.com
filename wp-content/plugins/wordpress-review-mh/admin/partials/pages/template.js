const template = `
<div class="q-mt-lg">
    <div v-if="!isLoading">
        <div> <q-toggle  v-model="settings.wp_rv_active"  label="Kích hoạt Plugin" /> </div>
        <div> <q-toggle  v-model="settings.wp_rv_turn_off_review_default"  label="Tắt đánh giá mặc định của sản phẩm" /> </div>
        <div> <q-toggle  v-model="settings.wp_rv_instead_of_my_review"  label="Thay thế đánh giá mặc định bằng Wordpress Review MH" /> </div>
       
    </div>
</div>   
`;


export default {
    data: () => ({
    	isLoading: false,
        settings: {
            wp_rv_active: false,
            wp_rv_turn_off_review_default: false,
            wp_rv_instead_of_my_review: false,
        }
    }),
   
    methods: {
    	
	},
	components:{

	},
    template: template,
    created(){
        axios.post('/wp-admin/admin-ajax.php', this.jsonToFormData({action: 'get_dfi_option', key: 'dfi_settings'})).then(res => {	
    		
   				const {success, data} = res.data
	    		if(success && data)
	    		{	
	    			this.settings = data
	    		}
    			
    		
        })
    }

}