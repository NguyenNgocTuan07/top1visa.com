const template = `
<div class="q-mt-lg">
    <div v-if="!isLoading">
       
        <div class="row q-col-gutter-md">
            <div class="col-7">
                <q-input v-model="sheet.id" label="SheetId" dense filled @keyup.enter="getTabs"/>
            </div>
            <div class="col-4">
                <q-select filled v-model="sheet.tab" :options="sheet.tabOptions" dense label="Tabs" />
            </div>
            <div class="col-1">
                <q-btn round color="primary" icon="sync" size="sm" @click="getTabs(true)"/>
                <q-btn round color="pink" class="q-ml-xs" icon="book" size="sm" @click="guide = !guide"/>
            </div>
        </div>
        <div class="q-mt-md">
            <q-markup-table separator="vertical" flat bordered wrap-cells>
                <thead>
                    <tr>
                    <th class="text-center" width="30px">STT</th>
                    <th class="text-center" width="50px">Post ID</th>
                 
                    <th class="text-left" width="250px">Nội dung</th>
                    <th class="text-left">Ảnh</th>
                    <th class="text-center" width="70px">Video</th>
                    <th class="text-left" width="250px">Trả lời</th>
                    <th class="text-left">Lượt thích</th>
                    <th class="text-left">Họ tên</th>
                    <th class="text-left" width="120px">Điện thoại</th>
                    <th class="text-left">Email</th>
                    <th class="text-center">Mua hàng</th>
                    <th class="text-left">Thời gian</th>
                    <th class="text-left">Thời gian trả lời</th>
                    <th class="text-left">#</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(record, i) in records" :key="record.phone">
                        <td class="text-center">{{i + 1}}</td>
                        <td class="text-center">
                            {{ record.post_id }}
                            <q-popup-edit v-model="record.post_id" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="editField(i, 'post_id', record.post_id)">
                                    <q-input
                                        v-model="record.post_id"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                            </q-popup-edit>
                        </td>
                        
                        <td class="text-left">
                            <div>
                                <q-rating :value="record.stars" size="1.3em" :max="5" :color="record.stars < 4 ? 'red': 'green'" icon="star_border" icon-selected="star" @input="(value) => editField(i, 'stars', value)"/>
                            </div>
                            <div>
                                {{ record.message }}
                                <q-popup-edit v-model="record.message" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="editField(i, 'message', record.message)">
                                        <q-editor
                                            v-model="record.message"
                                            min-height="5rem"
                                            autofocus
                                            @keyup.enter.stop
                                        />
                                </q-popup-edit>
                            </div>
                            
                        </td>
                        <td>
                            <q-btn flat style="color: #FF0080" round icon="add" @click="addImages(i)"/>
                           
                            <div class="comment-photos q-gutter-xs q-mt-xs">
                                <q-img v-for="(img, i) in record.attactments" :key="record.phone + i" round :src="img" :ratio="1" width="40px" @click="openLightbox(record.attactments, record.phone)"/>
                            </div>
                        
                        </td>
                        <td class="text-center">
                            <q-btn flat style="color: #FF0080" round icon="add" @click="addVideo(i)" v-if="!record.video"/>
                           
                            <div class="comment-photos q-gutter-xs q-mt-xs" v-else>
                                <q-btn flat style="color: #FF0080" round icon="play_circle_outline" @click="openURL(record.video)"/>
                            </div>
                        </td>
                        <td class="text-left">
                            {{ record.reply }}
                            <q-popup-edit v-model="record.reply" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="editField(i, 'reply', record.reply)">
                                    <q-editor
                                        v-model="record.reply"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                            </q-popup-edit>
                        </td>
                        <td class="text-left">
                            {{ record.likes }}
                            <q-popup-edit v-model="record.likes" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="editField(i, 'likes', record.likes)">
                                    <q-input
                                        v-model="record.likes"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                            </q-popup-edit>
                        </td>
                        <td class="text-left">
                            {{ record.name }}
                            <q-popup-edit v-model="record.name" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="editField(i, 'name', record.name)">
                                    <q-input
                                        v-model="record.name"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                            </q-popup-edit>
                        </td>
                        <td class="text-left">
                        

                                    <q-input
                                        v-model="record.phone"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                            
                        </td>
                        <td class="text-left">
                            {{ record.email }}
                            <q-popup-edit v-model="record.email" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="editField(i, 'email', record.email)">
                                    <q-input
                                        v-model="record.email"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                            </q-popup-edit>
                        </td>
                        <td class="text-center">
                            <q-icon name="verified" size="33px" class="cursor-pointer" :color="record.buyed == 2 ? 'green' : 'grey'" @click="record.buyed = record.buyed == 2 ? 1 : 2"></q-icon>
                        </td>
                        <td class="text-left">
                            {{ record.time }}
                            <q-popup-edit v-model="record.time" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="editField(i, 'time', record.time)">
                                    <q-input
                                        v-model="record.time"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                            </q-popup-edit>
                        </td>
                        <td class="text-left">
                            {{ record.time_reply }}
                            <q-popup-edit v-model="record.time" cover="fit" buttons label-set="Lưu" label-cancel="Thoát" @save="editField(i, 'time', record.time)">
                                    <q-input
                                        v-model="record.time_reply"
                                        min-height="5rem"
                                        autofocus
                                        @keyup.enter.stop
                                    />
                            </q-popup-edit>
                        </td>
                        <td>
                            <q-btn round color="pink" icon="delete" size="sm" @click="remove(i)" class="q-mr-xs q-mb-xs"/>
                            <q-btn round color="pink" icon="horizontal_rule" size="sm" @click="removeAttachmentsAndVideo(i)" class="q-mb-xs"> 
                                <q-tooltip>
                                    Xóa ảnh và video
                                </q-tooltip>
                            </q-btn>
                        </td>
                    </tr>
                </tbody>
            </q-markup-table>
            <q-btn color="primary"  icon="save" class="q-mb-lg q-mt-lg" label="Đăng" @click="create"/>
        </div>

    </div>
    <q-dialog v-model="guide">
          <q-card>
            <q-card-section>
              <div class="text-h6">Alert</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <p><b>Bước 1</b>: Tạo bản sao từ sheet mẫu https://docs.google.com/spreadsheets/d/1DopD962Bv0FgGqFpp75c53fs-m_4zAvPCZ5UoQvTj24</p>
                <p><b>Bước 2</b>: Chia sẻ sheet vừa tạo với Email: nham1688@nham1688-249203.iam.gserviceaccount.com</p>
                <p><b>Bước 3</b>: Coppy ID của sheet dán vào SheetId và ấn nút màu xanh biểu tượng xoay tròn để load ra các Tab</p>
                <p><b>Bước 4</b>: Khi cần load dữ liệu của Tab nào thì chọn Tab, sau đó đặt con trỏ chuột tại SheedId và ấn Enter</p>
            </q-card-section>

            <q-card-actions align="right">
              <q-btn flat label="OK" color="primary" v-close-popup />
            </q-card-actions>
          </q-card>
    </q-dialog>
</div>   
`;
const { RV_CONFIGS } = window 

export default {
    data: () => ({
    	isLoading: false,
        guide: false,
        sheet: {
            id: '1kiJkc8XAuNJZc4JAtRWODMNve3LFaVs87xc565VghKE',
            tab: '',
            tabOptions: []
        },
        records: [],
        vn: {
                days: 'Chủ Nhật_Thứ Hai_Thứ Ba_Thứ Tư_Thứ Năm_Thứ Sáu_Thứ Bảy'.split('_'),
                daysShort: 'CN_Th2_Th3_Th4_Th5_Th6_Th7'.split('_'),
                months: 'Tháng 1_Tháng 2_Tháng 3_Tháng 4_Tháng 5_Tháng 6_Tháng 7_Tháng 8_Tháng 9_Tháng 10_Tháng 11_Tháng 12'.split('_'),
                monthsShort: 'Tháng 1_Tháng 2_Tháng 3_Tháng 4_Tháng 5_Tháng 6_Tháng 7_Tháng 8_Tháng 9_Tháng 10_Tháng 11_Tháng 12'.split('_'),
                firstDayOfWeek: 1
            },
        settings: {}
    }),
   
    methods: {
        updateProxy() {
             this.proxyDate = this.date
        },

        save() {
              this.date = this.proxyDate
        },
        openLightbox(attactments, id){
        
            this.$eventBus.$emit('open.lightbox', {attactments: attactments.map(el => {return el}), id});
        },
        editField(index, key, value){
            console.log(value)
            this.records[index][key] = value
        },
        remove(i){
            this.records.splice(i, 1)
            this.NOTIFY('Xóa thành công')
        },
        addImages(index)
        {
            const file_frame = wp.media.frames.file_frame = wp.media({ title: 'Upload ảnh', library: { type: 'image' }, button: { text: 'Lựa chọn' }, multiple: true });

            file_frame.on('select',  () => {

                const attachment = file_frame.state().get('selection').map(attachment => {
                    attachment = attachment.toJSON()
                    this.records[index].attactments.push(attachment.url)
                });
                
                
            });
            file_frame.open();
        },
        addVideo(index)
        {
            const file_frame = wp.media.frames.file_frame = wp.media({ title: 'Upload ảnh', library: { type: 'video' }, button: { text: 'Lựa chọn' }, multiple: false });

            file_frame.on('select',  () => {

                const attachment = file_frame.state().get('selection').first().toJSON();
                console.log(attachment)
                this.records[index].video = attachment.url
                
            });
            file_frame.open();
        },
        removeAttachmentsAndVideo(i){
            this.records[i].attactments = []
            this.records[i].video = ''
        },
        create(){
            if(!this.records.length)
            {
                this.NOTIFY('Dữ liệu rỗng', false);
                return;
            }
            this.$q.dialog({
                title: 'Xác nhận',
                message: 'Tạo mới đánh giá?',
                cancel: true,
                persistent: true
            }).onOk(() => {
                this.$q.loading.show()
                axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({ action: 'wp_rv_tool_create_review', records: this.records })).then(res => { 
                    const {success, msg} = res.data
                    this.NOTIFY(msg, success);
                    this.$q.loading.hide()

                })
            })
        },
    	getTabs(flag = false){
            if(flag == true)
                this.sheet.tab = null

            if(!this.sheet.id){
                this.NOTIFY('Hãy điền SheetID', false);
                return;
            }
            if(this.sheet.tab)
            {
                axios(`${this.settings.tool_api}?id=${this.sheet.id}&tab=${this.sheet.tab}`).then(res => {
                try {
                    res.data.data.forEach(el => {
                        el.video = ''
                    })
                    this.records = res.data.data
                    this.NOTIFY('Lấy dữ liệu Thành công');
                    this.$q.localStorage.set('sheet', this.sheet)
                }
                catch(err) {
                    this.NOTIFY('Có lỗi xảy ra hãy kiểm tra lại ID sheet, và chia sẻ với Email hệ thống', false);

                }
                })

            }
            else
            {
                axios(`${this.settings.tool_api}?id=${this.sheet.id}`).then(res => {
                try {
                    this.sheet.tabOptions = res.data.tabs
                    this.sheet.tab = res.data.tabs[0]
                    this.NOTIFY('Lấy Tabs Thành công');

                }
                catch(err) {
                    this.NOTIFY('Có lỗi xảy ra hãy kiểm tra lại ID sheet, và chia sẻ với Email hệ thống', false);

                }
                })
            }
            
        }
	},
	components:{

	},
    template: template,
    created(){
        const sheet = this.$q.localStorage.getItem('sheet')
        console.log(sheet)
        if(sheet)
            this.sheet = sheet

        this.getSettings().then(data => {
            this.settings = this.deepMerge(this.settings, data);


        })
        
        this.$eventBus.$emit('set.page_title', 'Tạo đánh giá');

       
    }

}