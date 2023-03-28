const template = `
<div class="q-mt-lg">
    <div v-if="!isLoading">
        
        <div class="row q-col-gutter-md">
            <div class="col-4">
                <q-input type="number" filled min="1" v-model="increase" label="Nhập số ngày muốn tăng sau đó ấn Enter" @keyup.enter="increaseDate"/>
            </div>
            <div class="col-4">
               <!--<q-toggle v-model="value" label="Thiết lập thời gian tăng tự động hàng ngày lên 1 đơn vị" /> -->
            </div>
        <div>
       
    </div>
</div>   
`;


export default {
    data: () => ({
    	isLoading: false,
        value: false,
        increase: 1
    }),
   
    methods: {
    	increaseDate(){
            if(this.increase >= 1)
            {
                this.$q.dialog({
                    title: 'Xác nhận',
                    message: 'Tăng thời gian toàn bộ dữ liệu?',
                    cancel: true,
                    persistent: true
                }).onOk(() => {
                    this.$q.loading.show()
                    axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_tool_increase_date', increase: this.increase })).then(res => { 
                        const {success, msg} = res.data
                        this.NOTIFY(msg, success);
                        this.$q.loading.hide()

                    })
                })
            }
            else
                this.NOTIFY('Ngày tăng phải lớn hơn 1', false);
        }
	},
	components:{

	},
    template: template,
    created(){
       
    }

}