const template = `
<div class="q-mt-lg">
    <div v-if="!isLoading">
        <p>Nhập giá trị ngẫu nhiên:</p>
        <div class="row q-col-gutter-md">
            <div class="col-6">
                <q-input type="number" filled v-model="min" label="Min" class="q-mb-md"/>
            </div>
            <div class="col-6">
               <q-input type="number" filled v-model="max" label="Max" class="q-mb-md"/>
            </div>

        </div>
        <q-btn color="primary"  icon="save" class="q-mb-lg q-mt-lg" label="Thực hiện" @click="generate"/>
       
    </div>
</div>   
`;

const { RV_CONFIGS } = window 
export default {
    data: () => ({
    	isLoading: false,
        configs: RV_CONFIGS,
        category_id: null,
        min: 10,
        max: 100,
    }),
   
    methods: {
    	generate(){
            this.$q.loading.show()
            axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_tool_sold_product', min: this.min, max: this.max})).then(res => { 

                const {success, msg} = res.data
                this.NOTIFY(msg, success);
                 this.$q.loading.hide()
            })
        }
	},
	components:{

	},
    template: template,
    created(){
        
        this.$eventBus.$emit('set.page_title', 'Thiết lập đã bán sản phẩm');

    }

}