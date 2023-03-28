const template = `
<div class="q-mt-lg">
    <div v-if="!isLoading">
        

        <div class="row q-col-gutter-md">
            <div class="col-6">
                <p class="text-subtitle2">Cài đặt chung</p>
                <div> <q-toggle  v-model="settings.active.rating"  label="Kích hoạt tính năng Đánh giá" /> </div>
                <div> <q-toggle  v-model="settings.active.comment"  label="Kích hoạt tính năng Bình luận" /> </div>
                <div> <q-toggle  v-model="settings.turn_off_review_default"  label="Tắt đánh giá mặc định của sản phẩm" /> </div>
                <div> <q-toggle  v-model="settings.instead_of_my_review"  label="Thay thế đánh giá mặc định bằng Wordpress Review MH" /> </div>
                <div> <q-toggle  v-model="settings.is_time_ago"  label="Hiển thị thời gian theo loại: (1h trước, 1 ngày trước)" /> </div>
                <div> <q-toggle  v-model="settings.faq_schema"  label="FAQ Schema" /> </div>
                <div> <q-toggle  v-model="settings.cache"  label="Dành cho site sử dụng các Plugin Cache" /> </div>
                <div> <q-toggle  v-model="settings.customer_phone"  label="Bắt buộc nhập số điện thoại" /> </div>
                <p class="q-mt-lg text-subtitle2">Chặn spam</p>
                <div> <q-toggle  v-model="settings.limit.ip"  label="Dựa trên IP" /> </div>
                <!-- <div> <q-toggle  v-model="settings.captcha.active"  label="Google Captcha V2" /> </div> -->
                <div class="row q-col-gutter-md">
                    <q-input  v-if="settings.captcha.active" filled v-model="settings.captcha.site_key" dense label="Site Key" class="q-mb-md col-6"/>
                    <q-input v-if="settings.captcha.active" filled v-model="settings.captcha.server_key" dense label="Server Key" class="q-mb-md col-6"/>

                </div>
                <!-- <div> <q-toggle  v-model="settings.limit.phone"  label="Số điện thoại" /> </div> -->
                <p class="q-mt-lg text-subtitle2">Hiển thị thông tin sản phẩm</p>
                <div> <q-toggle  v-model="settings.product_show.reviews"  label="Hiển thị sao và tổng đánh giá trên sản phẩm" /> </div>
                <div> <q-toggle  v-model="settings.product_show.sold"  label="Hiển thị số lượng đã bán" /> </div>            
                
                <p class="q-mt-lg text-subtitle2">Gửi Email thông báo</p>
                <div>
                    <img width="120px" :src="settings.email.logo" v-if="settings.email.logo" @click="uploadEmailLogo"/>
                    <q-btn outline color="pink" label="Tải lên Logo trong Email" icon="polymer" v-else @click="uploadEmailLogo"/>
                </div>
                <div> <q-toggle  v-model="settings.email.active"  label="Thông báo Email cho Admin khi có người dùng Đánh giá và Bình Luận" /> </div>
                <div> <q-toggle  v-model="settings.email.admin_reply"  label="Thông báo Email cho người dùng khi Admin trả lời" /> </div>
                <div> <q-toggle  v-model="settings.email.order_completed"  label="Thông báo Email cho người mua khi đơn hàng thành công" /> </div>
                <p class="q-mt-lg text-subtitle2">Shortcode</p>

                <div><q-btn flat color="pink" @click="coppyShortcode('[wp_reviews_mh]')">[wp_reviews_mh]</q-btn> Sử dụng shortcode để đưa vào các vị trí hiển thị mong muốn, có thể áp dụng cho bất kì post_type, custom_post_type nào, click để Coppy</div>
                <div><q-btn flat color="pink" @click="coppyShortcode('[wp_reviews_mh_all]')">[wp_reviews_mh_all]</q-btn> Sử dụng shortcode này để hiển thị Đánh giá toàn bộ của website</div>
                <div><q-btn flat color="pink" @click="coppyShortcode('[wp_rv_product_single_meta]')">[wp_rv_product_single_meta]</q-btn> Sử dụng shortcode này để hiển thị đánh giá + số lượng đã bán ở Single</div>

                <q-btn color="primary"  icon="save" class="q-mb-lg q-mt-lg" label="Lưu" @click="save"/>
                
                
            </div>  
            <div class="col-6">
                <p  class="text-subtitle2">Cài đặt hiển thị</p>
                <q-input filled bottom-slots v-model="settings.admin.name" label="Tài khoản quản trị viên">
                    <template v-slot:before>
                    <q-avatar>
                        <img :src="settings.admin.avatar">
                    </q-avatar>
                    </template>
                    <template v-slot:after>
                    <q-btn round dense flat icon="photo_camera" @click="uploadAvatar"/>
                    </template>
                </q-input>

                <!-- <p>Số đánh giá hiển thị ban đầu</p> -->
                <q-input filled v-model="settings.per_page.review" label="Số đánh giá hiển thị / trang" class="q-mb-md"/>
                <q-input filled v-model="settings.per_page.comment" label="Số hỏi đáp hiển thị / trang" class="q-mb-md"/>

                <p>Số ảnh tối đa người dùng được tải lên</p>
                <q-list dense class="q-mb-md">
                    <q-item>
                        <q-item-section avatar>
                            <q-icon color="primary" name="collections" />
                        </q-item-section>
                        <q-item-section>                  
                        <q-slider
                            v-model="settings.limit.photos"
                            :min="0"
                            :max="10"
                            :step="1"
                            label
                            label-always
                            />
                        </q-item-section>
                    </q-item>
                </q-list>

                <p>Dung lượng tập tin tối đa</p>
                <q-list dense class="q-mb-md">
                    <q-item>
                        <q-item-section avatar>
                            <q-icon color="primary" name="collections" />
                        </q-item-section>
                        <q-item-section>                  
                        <q-slider
                            v-model="settings.limit.file_size"
                            :min="128"
                            :max="4096"
                            :step="256"
                            label
                            label-always
                            />
                        </q-item-section>
                    </q-item>
                </q-list>

                <q-input filled v-model="settings.label.buyed" label="Nhãn đã mua hàng" class="q-mb-md">
                    <template v-slot:prepend>
                        <q-icon name="verified" color="green"/>
                    </template>
                </q-input>


                <p>Cài đặt thông báo</p>
                <q-input filled v-model="settings.notify.review_success" label="Thông báo sau khi đánh giá thành công" class="q-mb-md"/>
                <q-input filled v-model="settings.notify.comment_success" label="Thông báo sau khi bình luận thành công" class="q-mb-md"/>
                <q-input filled v-model="settings.notify.reply" label="Thông báo sau khi trả lời đánh giá hoặc bình luận" class="q-mb-md"/>
                <p>Sheet API</p>
                <q-input filled v-model="settings.tool_api" label="" class="q-mb-md"/>


                
            </div>  

        </div>
    </div>
</div>   
`;

const { RV_CONFIGS } = window 
export default {
    data: () => ({

    	isLoading: false,
        settings: {
            cache: false,
            customer_phone: true,
            faq_schema: true,
            active: {
                rating: true,
                comment: true
            },
            turn_off_review_default: false,
            instead_of_my_review: false,
            is_time_ago: true,
            admin: {
                avatar: 'https://cdn.quasar.dev/img/avatar5.jpg',
                name: 'Tên quản trị viên',
            },
            label: {
                buyed: 'Đã mua từ {tick} WP Reviews'
            },
            product_show: {
                reviews: true,
                sold: true,
            },
            limit: {
                ip: false,
                //phone: false,
                photos: 4,
                file_size: 2048
            },
            notify: {
                review_success: 'Đánh giá thành công, chờ phê duyệt',
                comment_success: 'Bình luận thành công, chờ phê duyệt',
                reply: 'Phản hồi thành công',
            },
            per_page: {
                review: 4,
                comment: 4,
            },
            captcha: {
                active: false,
                site_key: '',
                server_key: '',
            },
            email: {
                active: false,
                admin_reply: false,
                logo: '',
                order_completed: false
            },
            tool_api: 'https://api.dominhhai.com/my-plugins/wp-reviews-mh/sheet/'
        },
            
    }),
   
    methods: {
        
    	save() {
            this.$q.loading.show()
            axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({action: 'wp_rv_save_option',key: 'wp_rv_settings', data: this.settings})).then(res => {
                const {success, msg} = res.data
              
                this.NOTIFY(msg, success);
                this.$q.loading.hide()
                if(success)
                    window.wp_rv_settings = Object.assign({}, this.settings)
            })
        },
        uploadAvatar()
        {
            const file_frame = wp.media.frames.file_frame = wp.media({ title: 'Upload ảnh đại diện', library: { type: 'image' }, button: { text: 'Lựa chọn' }, multiple: false });

            file_frame.on('select',  () => {

                const attachment = file_frame.state().get('selection').first().toJSON();
                this.settings.admin.avatar = attachment.url
                
            });
            file_frame.open();
        },
        uploadEmailLogo()
        {
            const file_frame = wp.media.frames.file_frame = wp.media({ title: 'Upload ảnh logo cho Email', library: { type: 'image' }, button: { text: 'Lựa chọn' }, multiple: false });

            file_frame.on('select',  () => {

                const attachment = file_frame.state().get('selection').first().toJSON();
                this.settings.email.logo = attachment.url
                
            });
            file_frame.open();
        },
        coppyShortcode(sc){
            Quasar.utils.copyToClipboard(sc)
                this.NOTIFY('Coppy short_code thành công');

        }
	},
	components:{
        
	},
    template: template,
    created(){
     
        this.getSettings().then(data => {
            this.settings = this.deepMerge(this.settings, data);
        })
        this.$eventBus.$emit('set.page_title', 'Cài đặt');
       
    },
    destroyed(){
    }

}