
const template = `
<div>
    <div v-if="!isLoading">
        <div class="q-mt-md q-gutter-sm">
                
        </div>
        <empty-component v-if="records.length == 0 && isLoading == false"/>
        <template v-else>
        <div class="row q-col-gutter-md q-mb-md">
            <q-space/>
            <div class="col-4">
                    <q-input outlined v-model="filters.search"  label="Tìm kiếm theo tên, id sản phẩm" dense debounce="800"/>
            </div>
        </div>
        <q-markup-table flat bordered>
            <thead>
                <tr>
                    <th class="text-center" width="50px">ID</th>
                    <th class="text-left">Tiêu đề</th>
                    <th class="text-center">Ảnh</th>
                    <th class="text-center">Số lượt đánh giá</th>
                    <th class="text-center">Điểm trung bình</th>
                    <th class="text-right">Đã bán</th>
                    <th class="text-center">#</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(record, index) in records" :key="record.id">
                    <td class="text-center">{{ record.post_id }}</td>
                    <td class="text-left">
                        <a target="_blank" :href="record.post.link">{{record.post.title}}</a>
                    </td>
                    <td class="text-center"> 
                            <q-img  round :src="record.post.thumbnail" :ratio="1" width="60px" @click="openLightbox([record.post.thumbnail], record.id)"/>
                    </td>
                    <td class="text-center">{{ record.total }}</td>
                    <td class="text-center">
                        <q-rating :value="record.average" size="1.5em" :max="5" :color="record.stars < 4 ? 'red': 'green'" icon="star_border" icon-selected="star" icon-half="star_half"/>
                        <!-- {{ record.average }} -->
                    </td>
                    <td class="text-right">
                    {{ record.sold }}
                     <q-popup-edit v-model="record.sold" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="updateColumnStatus(record.id, index)">
                                    <q-input
                                        v-model="record.sold"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                    </q-popup-edit>
                    </td>
                    <td class="text-center">
                        <q-btn round color="primary" icon="launch" size="sm" @click="openURL(configs.site_url + '/wp-admin/post.php?post=' + record.post_id +'&action=edit')"></q-btn>
                        <q-btn round color="purple" icon="person" size="sm" @click="openURL(record.post.link)"></q-btn>
                    </td>
                </tr>
                
               
            </tbody>
        </q-markup-table>
        <div class="flex flex-center q-mt-lg">
            Số trang
            <q-pagination v-model="pagination.page" :max="pagination.max" direction-links boundary-links icon-first="skip_previous" icon-last="skip_next" icon-prev="fast_rewind" icon-next="fast_forward" :disabled="isLoading"></q-pagination>

            | Tổng {{pagination.total}} | Số bản ghi trên trang
            <q-btn-dropdown color="primary" :label="pagination.per_page" class="q-ml-xs">
                <q-list>

                    <q-item clickable v-close-popup>
                        <q-item-section @click="pagination.per_page = 10">
                            <q-item-label>10</q-item-label>
                        </q-item-section>
                    </q-item>

                    <q-item clickable v-close-popup>
                        <q-item-section @click="pagination.per_page = 20">
                            <q-item-label>20</q-item-label>
                        </q-item-section>
                    </q-item>

                    <q-item clickable v-close-popup>
                        <q-item-section @click="pagination.per_page = 50">
                            <q-item-label>50</q-item-label>
                        </q-item-section>
                    </q-item>

                    <q-item clickable v-close-popup>
                        <q-item-section @click="pagination.per_page = 100">
                            <q-item-label>100</q-item-label>
                        </q-item-section>
                    </q-item>

                </q-list>
            </q-btn-dropdown>
        </div>
    </div>
    </template>

    <div class="loading-m" v-else>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; display: block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <path
                fill="none"
                stroke="#e90c59"
                stroke-width="7"
                stroke-dasharray="42.76482137044271 42.76482137044271"
                d="M24.3 30C11.4 30 5 43.3 5 50s6.4 20 19.3 20c19.3 0 32.1-40 51.4-40 C88.6 30 95 43.3 95 50s-6.4 20-19.3 20C56.4 70 43.6 30 24.3 30z"
                stroke-linecap="round"
                style="transform: scale(0.5700000000000001); transform-origin: 50px 50px;"
            >
                <animate attributeName="stroke-dashoffset" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0;256.58892822265625"></animate>
            </path>
        </svg>
    </div>


</div>

`;

const { RV_CONFIGS } = window 
export default {
    data: () => ({
      records: [],
      configs: RV_CONFIGS,
      filters: {
          search: '',
          post_type: '',
          post_id: '',
          status: 1
      },
      
      isLoading: true,
      pagination: {
        page: 1,
        max: 1,
        per_page: 20,
        total: 0,
      },
      
      settings: {

      }
    }),
    methods: {
        openURL(url){
        		Quasar.utils.openURL(url)
       },
       updateColumnStatus(id, index){
            this.$q.dialog({
                title: 'Xác nhận',
                message: 'Cập nhật số lượng đã bán',
                cancel: true,
                persistent: true
            }).onOk(() => {
                axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_update_column', id, value: this.records[index].sold, column: 'sold', table: 'dmh_rv_products' })).then(res => { 
                    const {success, msg} = res.data
                    this.NOTIFY(msg, success);
                    
                    
                        this.records[index][column] = value
                })
            })
      },
      getProducts(){
        
          this.isLoading = true
          axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_get_products', page: this.pagination.page, per_page: this.pagination.per_page, filters: this.filters })).then(res => { 
            
            this.records = res.data.data
            
            this.pagination.total = res.data.pagination.total
            this.pagination.max = res.data.pagination.max_page
            this.isLoading = false
          })
      },
      openLightbox(attactments, id){
        this.$eventBus.$emit('open.lightbox', {attactments, id});
      },
	},
	components:{
    //CoolLightBox
	},
  template: template,
  watch:{
    'pagination.page': function(){
        this.getProducts()
    },
    'filters.search': function(){
      this.getProducts()
    },
    'pagination.per_page': function(){
      this.pagination.page = 1
      this.getProducts()
    }
  },
  created(){

    this.getProducts()
    this.$eventBus.$emit('set.page_title', 'Thống kê');

  }

}