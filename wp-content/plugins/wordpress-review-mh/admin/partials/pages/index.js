
const template = `
<div>
    <div v-if="!isLoading">

    
       

        <div class="row q-col-gutter-md q-mt-md">
            
            <div class="col">
                
                    <q-btn :flat="filters.status == 2 || filters.status == 0 || filters.status == 3"  color="pink" label="Chờ duyệt" @click="filterStatus(1)"/>
                    <q-btn :flat="filters.status == 1 || filters.status == 2 || filters.status == 3" color="primary" label="Tất cả" @click="filterStatus(0)"/>
                    <q-btn :flat="filters.status == 1 || filters.status == 0 || filters.status == 3"  color="primary" label="Đã duyệt" @click="filterStatus(2)"/>
                    <q-btn :flat="filters.status == 1 || filters.status == 0 || filters.status == 2"  color="primary" label="Lưu trữ" @click="filterStatus(3)"/>
                    
                  
                
               
                <q-btn flat color="primary" icon="filter_alt" @click="showFilters"/>
                <q-btn flat color="pink" icon="refresh" @click="refreshAll"/>
            </div>
            <template v-if="filters.show_filter">
                <div class="col-2">
                    <q-input filled v-model="filters.search"  label="Tìm kiếm" dense debounce="800"/>
                </div>
                <div class="col-2">
                    <q-select filled v-model="filters.post_type" :options="options_posttypes" label="Post Type" dense emit-value  map-options/>
                </div>
                <div class="col-2">
                    <q-input filled v-model="filters.post_id"  label="Post ID" dense debounce="800"/>
                </div>
                <div class="col-1">
                    <q-btn  color="primary" label="Lọc" style="width: 100%" @click="resetPagiPageAndFilter"/>
                </div>
            
                
            </template>
            
        </div>
        <empty-component v-if="records.length == 0"/>
        <template v-else>
        <div class="order-item q-mt-md" v-for="(record, index) in records" :key="record.id">
            <div class="order-top q-pa-sm">
                <div class="flex-dp fz-12">
                    <div class="buyer-info">
                       
                        <q-chip>
                            <q-avatar>
                                <img src="https://banhang.shopee.vn/rootpages/static/vendor/copy/default-avatar.png">
                            </q-avatar>
                            {{record.customer_name}} 
                            <q-popup-edit v-model="record.customer_name" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="updateColumnStatus(record.id, 'customer_name', record.customer_name, index)">
                                    <q-input
                                        v-model="record.customer_name"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                            </q-popup-edit>
                        </q-chip>
                        <q-chip  icon="phone" v-if="record.customer_phone"> {{record.customer_phone}}  
                                <q-popup-edit v-model="record.customer_phone" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="updateColumnStatus(record.id, 'customer_phone', record.customer_phone, index)">
                                    <q-input
                                        v-model="record.customer_phone"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                                </q-popup-edit>
                        </q-chip>
                        <q-chip  icon="email" v-if="record.customer_email"> {{record.customer_email}}  
                                <q-popup-edit v-model="record.customer_email" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="updateColumnStatus(record.id, 'customer_email', record.customer_email, index)">
                                    <q-input
                                        v-model="record.customer_email"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                                </q-popup-edit>
                        </q-chip>
                        <q-chip >  {{record.ip}}  </q-chip>
                        <q-chip >  
                            {{record.created_at}}  
                            <q-popup-edit v-model="record.created_at" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="updateColumnStatus(record.id, 'created_at', record.created_at, index)">
                                    <q-input
                                        v-model="record.created_at"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                            </q-popup-edit>
                        </q-chip>
                       
                    </div>
                    <div class="buyer-info text-right">
                        <!--<q-icon name="verified" size="33px" color="grey"></q-icon>
                        <q-btn class="q-ml-sm" round color="green" icon="done" size="sm"></q-btn>
                        <q-btn class="q-ml-sm" round color="pink" icon="delete" size="sm"></q-btn>-->
                        <q-chip clickable :color="record.buyed == 2 ? 'green' : ''" :text-color="record.buyed == 2 ? 'white' : ''" icon="verified" @click="updateColumnStatus(record.id, 'buyed', record.buyed == 1 ? 2 : 1, index)">Đã mua hàng</q-chip>
                    </div>
                </div>
            </div>
            <div class="order-body flex-dp">
                <div class="list-products q-pa-md">
                    <div class="product-item flex-dp q-mb-sm">
                        <a :href="record.post.link" target="_blank"><img :src="record.post.image" width="70px" height="70px" /> </a>
                        <div class="product-name q-ml-md">
                            {{record.post.title}}
                           
                            <br />
                            <!-- <q-badge class="q-pa-xs" color="accent">Giá sản phẩm: 100,000 đ</q-badge> -->
                        </div>
                    </div>
                </div>
                <div class="total-cost q-pa-md">
                    <q-rating :value="record.stars" size="1.5em" :max="5" :color="record.stars < 4 ? 'red': 'green'" icon="star_border" icon-selected="star" @input="(value) => updateColumnStatus(record.id, 'stars', value, index)"/>
                    <div class="comment-m q-mt-md">
                        {{record.message}}
                        <q-popup-edit v-model="record.message" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="updateColumnStatus(record.id, 'message', record.message, index)">
                                    <q-editor
                                        v-model="record.message"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                        </q-popup-edit>
                    </div>

                    <div class="comment-photos q-gutter-xs q-mt-xs">
                        
                        <span class="wrap-img" v-for="(img, i) in record.attactments" :key="record.id + i">
                            <q-img round :src="srcImg(img)" :ratio="1" width="50px" @click="openLightbox(record.attactments, record.id)"/>
                            <q-btn color="pink" round icon="delete" size="sm"  class="delete-img" @click="removeImage(record.id, i)"/>
                        </span>
                        <q-btn flat style="color: #FF0080" round icon="add" @click="addImage(index)"/>
                        

                        <q-btn flat style="color: #FF0080" round icon="play_circle_outline" @click="openURL(record.video)" v-if="record.video"/>
                            
                    </div>
                </div>
                <div :class="record.hasOwnProperty('children') ? 'shipping-info q-pa-md flex' : 'shipping-info q-pa-md flex flex-center'">
                    <div class="seller-reply"></div>
                    <div v-if="record.hasOwnProperty('children')">
                        <div v-for="(reply, child_index) in record.children" class="cursor-pointer conversation-m">
                            <div v-if="reply.is_admin_message != 1" class="message-buttons">
                              
                              <q-btn-group  flat>
                                    <q-btn-dropdown flat auto-close  :color="reply.status == 2 ? 'green' : 'purple'" size="14px"  unelevated>
                                        <q-list padding style="width: 250px">

                                            <q-item clickable @click="updateColumnStatus(reply.id, 'status', 2, index, child_index)" v-if="reply.status != 2">
                                                <q-item-section avatar>
                                                    <q-avatar icon="done" color="green" text-color="white"/>
                                                </q-item-section>
                                                <q-item-section>
                                                <q-item-label>Duyệt</q-item-label>
                                                <q-item-label caption>Duyệt đánh giá</q-item-label>
                                                </q-item-section>
                                                <q-item-section side>
                                                    <q-icon name="info" color="amber" />
                                                </q-item-section>
                                            </q-item>

                                            <q-item clickable @click="removeReview(reply.id, index,  child_index)">
                                                <q-item-section avatar>
                                                    <q-avatar icon="delete" color="red" text-color="white"/>
                                                </q-item-section>
                                                <q-item-section>
                                                <q-item-label>Xóa</q-item-label>
                                                <q-item-label caption>Xóa đánh giá</q-item-label>
                                                </q-item-section>
                                                <q-item-section side>
                                                    <q-icon name="info" color="amber" />
                                                </q-item-section>
                                            </q-item>
                                        </q-list>
                                    </q-btn-dropdown>
                                </q-btn-group>
                            </div>
                            
                            <div class="wrap-message">
                                <q-popup-edit v-model="reply.message" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="editMessage(reply.id, reply.message)">
                                    <q-editor
                                        v-model="reply.message"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                                </q-popup-edit>
                                <q-chat-message
                                    :name="reply.is_admin_message == 1 ? settings.admin.name : reply.customer_name"
                                    :avatar="reply.is_admin_message != 1 ? avatar.user : avatar.admin"
                                    :sent="reply.is_admin_message != 1"
                                    :text="[reply.message]"
                                    :stamp="reply.date"
                                    :text-color="reply.is_admin_message == 1 ? 'white' : ''"
                                    :bg-color="reply.is_admin_message == 1 ? 'primary' : reply.status == 1 ? 'amber' : ''"
                                />
                            </div>
                            <div v-if="reply.is_admin_message == 1" class="message-buttons">
                              
                              <q-btn-group flat >
                                    <q-btn-dropdown auto-close flat :color="reply.status == 2 ? 'green' : 'purple'" size="14px">
                                        <q-list padding style="width: 250px">

                                            <q-item clickable @click="updateColumnStatus(reply.id, 'status', 2, index, child_index)" v-if="reply.status != 2">
                                                <q-item-section avatar>
                                                    <q-avatar icon="done" color="green" text-color="white"/>
                                                </q-item-section>
                                                <q-item-section>
                                                <q-item-label>Duyệt</q-item-label>
                                                <q-item-label caption>Duyệt đánh giá</q-item-label>
                                                </q-item-section>
                                                <q-item-section side>
                                                    <q-icon name="info" color="amber" />
                                                </q-item-section>
                                            </q-item>

                                            <q-item clickable @click="removeReview(reply.id, index,  child_index)">
                                                <q-item-section avatar>
                                                    <q-avatar icon="delete" color="red" text-color="white"/>
                                                </q-item-section>
                                                <q-item-section>
                                                <q-item-label>Xóa</q-item-label>
                                                <q-item-label caption>Xóa đánh giá</q-item-label>
                                                </q-item-section>
                                                <q-item-section side>
                                                    <q-icon name="info" color="amber" />
                                                </q-item-section>
                                            </q-item>
                                        </q-list>
                                    </q-btn-dropdown>
                                </q-btn-group>
                            </div>

                            
                        </div>
                        
                        
                        
                    </div>
                    <div class="text-center">
                            <q-btn flat color="primary" label="Trả lời" @click="showReviewForm(record.id, index)"/>
                    </div>
                </div>
                <div class="actions-m flex flex-center justify-content-center">
                    <template v-if="record.status == 1">
                        <q-btn class="q-ml-sm" round color="green" icon="done" size="sm"  @click="updateColumnStatus(record.id, 'status', 2, index)"> <q-tooltip>Duyệt đánh giá - bình luận</q-tooltip></q-btn>
                        <q-btn class="q-ml-sm" round color="pink" icon="folder" size="sm" @click="updateColumnStatus(record.id, 'status', 3, index)"> <q-tooltip>Chuyển vào lưu trữ</q-tooltip></q-btn>
                        <q-btn class="q-ml-sm" round color="purple" icon="remove" size="sm" @click="removeReview(record.id, index)"> <q-tooltip>Xóa đánh giá - bình luận</q-tooltip></q-btn>
                    </template>
                    
                    <q-btn-group rounded v-else>
                       
                        <q-btn-dropdown auto-close rounded :color="record.status == 2 ? 'green' : 'purple'" :label="record.status == 2 ? 'Đã duyệt' : 'Lưu trữ' "  :icon="record.status == 2 ? 'done' : 'source'" split>
                            <q-list padding style="width: 250px">

                                <q-item clickable @click="updateColumnStatus(record.id, 'status', 2, index)" v-if="record.status != 2">
                                    <q-item-section avatar>
                                        <q-avatar icon="done" color="green" text-color="white"/>
                                    </q-item-section>
                                    <q-item-section>
                                    <q-item-label>Duyệt</q-item-label>
                                    <q-item-label caption>Duyệt đánh giá</q-item-label>
                                    </q-item-section>
                                    <q-item-section side>
                                        <q-icon name="info" color="amber" />
                                    </q-item-section>
                                </q-item>

                                <q-item clickable @click="updateColumnStatus(record.id, 'status', 3, index)" v-if="record.status != 3">
                                    <q-item-section avatar>
                                        <q-avatar icon="folder" color="purple" text-color="white" />
                                    </q-item-section>
                                    <q-item-section>
                                    <q-item-label>Lưu trữ</q-item-label>
                                    <q-item-label caption>Chuyển vào Lưu trữ</q-item-label>
                                    </q-item-section>
                                    <q-item-section side>
                                        <q-icon name="info" color="amber" />
                                    </q-item-section>
                                </q-item>

                                <q-item clickable @click="removeReview(record.id, index)">
                                    <q-item-section avatar>
                                        <q-avatar icon="delete" color="red" text-color="white"/>
                                    </q-item-section>
                                    <q-item-section>
                                    <q-item-label>Xóa</q-item-label>
                                    <q-item-label caption>Xóa đánh giá</q-item-label>
                                    </q-item-section>
                                    <q-item-section side>
                                        <q-icon name="info" color="amber" />
                                    </q-item-section>
                                </q-item>
                            </q-list>
                        </q-btn-dropdown>
                    </q-btn-group>
                    
                </div>
            </div>
        </div>
        <div class="flex flex-center q-mt-lg">
            <template>
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
                </template>
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

    <q-dialog v-model="reply.show_dialog" persistent>
      <q-card style="width: 700px; max-width: 80vw">
        <q-card-section class="row items-center">
          <div class="text-h6">Phản hồi bình luận</div>
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />          

        </q-card-section>

        <q-separator />

        <q-card-section class="scroll">
       
            <q-input v-model="reply.message" filled autogrow label="Viết phản hồi của bạn tại đây"/>
        </q-card-section>

        <q-separator />

        <q-card-actions align="right">
          <q-btn flat label="Thoát" color="primary" v-close-popup />
          <q-btn flat label="Phản hồi" color="primary" @click="replyReview" />
        </q-card-actions>
      </q-card>
    </q-dialog>

</div>

`;

const { RV_CONFIGS } = window 
const filters_default = {
          show_filter: false,
          by_admin: '',
          search: '',
          post_type: '',
          post_id: '',
          status: 0,
          type: 1,
}

export default {
    data: () => ({
      records: [],
      filters: Object.assign({}, filters_default), 
      star: 3,
      isLoading: true,
      pagination: {
        page: 1,
        max: 1,
        per_page: 10,
        total: 0,
      },
      configs: RV_CONFIGS,
      avatar: {
        admin: `${RV_CONFIGS.site_url}/wp-content/plugins/wordpress-review-mh/assets/images/ninja.svg`,
        user: `${RV_CONFIGS.site_url}/wp-content/plugins/wordpress-review-mh/assets/images/profile.svg`,

      },
      reply: {
          show_dialog: false,
          id: null,
          message: null
      },
      settings: {

      },
      options_posttypes: [
          
      ]
    }),
    methods: {
      
      openLightbox(attactments, id){
        
        this.$eventBus.$emit('open.lightbox', {attactments: attactments.map(el => {return this.srcImg(el)}), id});
      },
      filterStatus(status){
          this.filters.status = status
          this.pagination.page = 1;
      },
      showFilters(){
          this.filters.show_filter = !this.filters.show_filter
          if(this.options_posttypes.length  == 0)
            axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_get_posttypes'})).then(res => {
                this.options_posttypes = res.data.data
            })
      },
      resetPagiPageAndFilter(){
          this.pagination.page = 1
          this.getReviews()
      },
      refreshAll(){
          console.log(Object.assign({}, filters_default));
          this.filters = Object.assign(filters_default, {status: 0})
          this.pagination.page = 1

      },
      getReviews(){
        
          this.isLoading = true
          axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_get_reviews', page: this.pagination.page, per_page: this.pagination.per_page, filters: this.filters })).then(res => { 
            
            this.records = res.data.data
            
            this.pagination.total = res.data.pagination.total
            this.pagination.max = res.data.pagination.max_page
            this.isLoading = false
          })
      },
      showReviewForm(id, index){
          this.reply.id = id
          this.reply.message = ''
          this.reply.show_dialog = true
          this.reply.index = index
      },
      editMessage(id, value){
        
          axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_update_column', id, value, column: 'message' })).then(res => {
              const {success, msg} = res.data
            this.NOTIFY(msg, success);
          })
      },
      replyReview(){
          if(this.reply.message == '')
          {
              this.NOTIFY('Phản hồi không thể để trống.', false);
              return;
          }
          this.$q.loading.show()
          axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData(Object.assign({action: 'wp_rv_admin_reply_review'}, this.reply))).then(res => {
              const {success, msg} = res.data
              this.NOTIFY(msg, success);
              if(success)
                //this.records[this.reply.index] = res.data.record
                this.$set(this.records, this.reply.index, res.data.record)
                this.reply.show_dialog = false
                this.$q.loading.hide()

          })
      },
      updateColumnStatus(id, column, value, index, child_index = -1){
          
          const star_msg = 'Bạn chắc chắn muốn thay đổi'
          let messages = {
              status: {
                  2: 'Duyệt đánh giá này',
                  3: 'Chuyển đánh giá này vào khu lưu trữ',
              },
              buyed: {
                  1: 'Chuyển sang trạng thái chưa mua hàng',
                  2: 'Chuyển sang trạng thái đã mua hàng',
              },
              stars: {1: star_msg, 2: star_msg, 3:star_msg, 4:star_msg, 5:star_msg},
              created_at: 'Thay đổi ngày tháng'
          };
          this.$q.dialog({
                title: 'Xác nhận',
                message: 'Bạn chắc chắn chứ',
                cancel: true,
                persistent: true
            }).onOk(() => {
                axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_update_column', id, value, column })).then(res => { 
                    const {success, msg} = res.data
                    this.NOTIFY(msg, success);
                    
                    if(child_index > -1){
                        console.log(this.records[index].children[child_index])
                        this.records[index].children[child_index][column] = value
                    }
                    else
                        this.records[index][column] = value
                })
            })
          
      },
      getPosttypes(){

      },
      removeReview(id, index, child_index = -1){
          this.$q.dialog({
                title: 'Xác nhận',
                message: 'Xóa đánh giá giá này?',
                cancel: true,
                persistent: true
            }).onOk(() => {
                axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_remove_review', ids: [id] })).then(res => { 
                    const {success, msg} = res.data
                    this.NOTIFY(msg, success);
                    if(success)
                        if(child_index > -1){
                            console.log(this.records[index].children)
                            console.log(index,child_index)
                            this.records[index].children.splice(child_index, 1)
                        }
                        else
                            this.records.splice(index, 1)
                })
            })
      },
      addImage(index){
    
        const file_frame = wp.media.frames.file_frame = wp.media({ title: 'Upload ảnh', library: { type: 'image' }, button: { text: 'Lựa chọn' }, multiple: true });

        file_frame.on('select',  () => {

            const attachment = file_frame.state().get('selection').map(attachment => {
                attachment = attachment.toJSON()
                this.records[index].attactments.push(attachment.url)
            });
            // const attachment = file_frame.state().get('selection').first().toJSON();
            // this.records[index].attactments.push(attachment.url)
            this.updateAttachments(this.records[index].id, 'attactments', JSON.stringify(this.records[index].attactments))
            
        });
        file_frame.open();

      },
      removeImage(record_id, image_index){
        const index = this.records.findIndex(el => el.id === record_id)
        if(index > -1){
            this.records[index].attactments.splice(image_index, 1)
            this.updateAttachments(this.records[index].id, 'attactments', JSON.stringify(this.records[index].attactments))
        }
      },
      updateAttachments(id, column, value){
        axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_update_column', id, value, column })).then(res => { 
            const {success, msg} = res.data
            this.NOTIFY(msg, success);
            
        })
      }
	},
	components:{
    //CoolLightBox
	},
  template: template,
  watch:{
    'pagination.page': function(){
        this.getReviews()
    },
    'filters.status': function(){
      this.getReviews()
    },
    'filters.search': function(){
      this.pagination.page = 1
      this.getReviews()
    },
    'pagination.per_page': function(){
      this.pagination.page = 1
      this.getReviews()
    }
  },
  created(){
    
    this.getSettings().then(data => {
        this.settings = this.deepMerge(this.settings, data);
        if(data.admin.avatar)
            this.avatar.admin = data.admin.avatar


        this.getReviews()
    })

    this.$eventBus.$emit('set.page_title', 'Quản lý đánh giá');

      
  }

}