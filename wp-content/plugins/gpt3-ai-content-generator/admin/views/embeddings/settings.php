<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
include __DIR__.'/builder_alert.php';
$wpaicg_embeddings_settings_updated = false;
if(isset($_POST['wpaicg_save_builder_settings'])){
    if(isset($_POST['wpaicg_pinecone_api']) && !empty($_POST['wpaicg_pinecone_api'])) {
        update_option('wpaicg_pinecone_api', sanitize_text_field($_POST['wpaicg_pinecone_api']));
    }
    else{
        delete_option('wpaicg_pinecone_api');
    }
    if(isset($_POST['wpaicg_pinecone_environment']) && !empty($_POST['wpaicg_pinecone_environment'])) {
        update_option('wpaicg_pinecone_environment', sanitize_text_field($_POST['wpaicg_pinecone_environment']));
    }
    else{
        delete_option('wpaicg_pinecone_environment');
    }
    if(isset($_POST['wpaicg_builder_enable']) && !empty($_POST['wpaicg_builder_enable'])){
        update_option('wpaicg_builder_enable','yes');
    }
    else{
        delete_option('wpaicg_builder_enable');
    }
    if(isset($_POST['wpaicg_builder_types']) && is_array($_POST['wpaicg_builder_types']) && count($_POST['wpaicg_builder_types'])){
        update_option('wpaicg_builder_types',\WPAICG\wpaicg_util_core()->sanitize_text_or_array_field($_POST['wpaicg_builder_types']));
    }
    else{
        delete_option('wpaicg_builder_types');
    }
    if(isset($_POST['wpaicg_instant_embedding']) && !empty($_POST['wpaicg_instant_embedding'])){
        update_option('wpaicg_instant_embedding',\WPAICG\wpaicg_util_core()->sanitize_text_or_array_field($_POST['wpaicg_instant_embedding']));
    }
    else{
        update_option('wpaicg_instant_embedding','no');
    }
    if(isset($_POST['wpaicg_builder_custom'])){
        $wpaicg_builder_customs = \WPAICG\wpaicg_util_core()->sanitize_text_or_array_field($_POST['wpaicg_builder_custom']);
        foreach ($wpaicg_builder_customs as $key=>$wpaicg_builder_custom) {
            update_option('wpaicg_builder_custom_'.$key,$wpaicg_builder_custom);
        }
    }
    $wpaicg_embeddings_settings_updated = true;
}
$wpaicg_pinecone_api = get_option('wpaicg_pinecone_api','');
$wpaicg_pinecone_environment = get_option('wpaicg_pinecone_environment','');
$wpaicg_builder_types = get_option('wpaicg_builder_types',[]);
$wpaicg_builder_enable = get_option('wpaicg_builder_enable','');
$wpaicg_instant_embedding = get_option('wpaicg_instant_embedding','yes');
if($wpaicg_embeddings_settings_updated){
    ?>
    <div class="notice notice-success">
        <p>Records updated successfully</p>
    </div>
    <?php
}
$wpaicg_all_post_types = get_post_types(array(
    'public'   => true,
    '_builtin' => false,
),'objects');
$wpaicg_custom_types = [];
foreach($wpaicg_all_post_types as $key=>$all_post_type){
    if($key != 'product'){
        $wpaicg_assigns = get_option('wpaicg_builder_custom_'.$key,'');
        $meta_keys = \WPAICG\wpaicg_util_core()->wpaicg_get_meta_keys($key);
        $taxonomies = \WPAICG\wpaicg_util_core()->wpaicg_existing_taxonomies($key);
        $post_type = array(
            'assigns' => $wpaicg_assigns,
            'label' => $all_post_type->label,
            'standard' => array(
                'wpaicgp_ID' => 'ID',
                'wpaicgp_post_title' => 'Title',
                'wpaicgp_post_content' => 'Content',
                'wpaicgp_post_excerpt' => 'Excerpt',
                'wpaicgp_post_date' => 'Date',
                'wpaicgp_post_type' => 'Post Type',
                'wpaicgp_post_parent' => 'Parent',
                'wpaicgp_post_status' => 'Status',
                'wpaicgp_permalink' => 'Permalink',
            ),
            'custom_fields' => $meta_keys,
            'taxonomies' => $taxonomies,
            'users' => array(
                'wpaicgauthor_user_login' => 'User Login',
                'wpaicgauthor_user_nicename' => 'Nicename',
                'wpaicgauthor_user_email' => 'Email',
                'wpaicgauthor_display_name' => 'Display Name',
            )
        );
        $wpaicg_custom_types[$key] = $post_type;
    }
}

?>
<style>
    .wpaicg_modal {
        width: 600px;
        left: calc(50% - 300px);
        height: 40%;
    }
    .wpaicg_modal_content{
        height: calc(100% - 103px);
        overflow-y: auto;
    }
    .wpaicg_assign_footer{
        position: absolute;
        bottom: 0;
        display: flex;
        justify-content: space-between;
        width: calc(100% - 20px);
        align-items: center;
        border-top: 1px solid #ccc;
        left: 0;
        padding: 3px 10px;
    }
</style>
<form action="" method="post">
    <h3>Pinecone</h3>
    <div class="wpaicg-alert">
        <h3>Steps</h3>
        <p>1. Begin by watching the video tutorial provided <a href="https://www.youtube.com/watch?v=NPMLGwFQYrY" target="_blank">here</a>.</p>
        <p>2. Obtain your API key from <a href="https://www.pinecone.io/" target="_blank">Pinecone</a>.</p>
        <p>3. Create an Index on Pinecone.</p>
        <p>4. Ensure your dimension is set to <b>1536</b>.</p>
        <p>5. Set your metric to <b>cosine</b>.</p>
        <p>6. Input your data.</p>
        <p>7. Navigate to Settings - ChatGPT tab and choose the Embeddings method.</p>
    </div>
    <table class="form-table">
        <tr>
            <th scope="row">Pinecone API</th>
            <td>
                <input type="text" class="regular-text" name="wpaicg_pinecone_api" value="<?php echo esc_attr($wpaicg_pinecone_api)?>">
            </td>
        </tr>
        <tr>
            <th scope="row">Pinecone Index</th>
            <td>
                <input type="text" class="regular-text" name="wpaicg_pinecone_environment" value="<?php echo esc_attr($wpaicg_pinecone_environment)?>">
                <p style="font-style: italic">Example: gptpowerai-de3f510.svc.us-east1-gcp.pinecone.io</p>
            </td>
        </tr>
    </table>
    <h3>Instant Embedding</h3>
    <p>Enable this option to get instant embeddings for your content. Go to your post, page or products page and select all your contents and click on Instant Embedding button.</p>
    <table class="form-table">
        <tr>
            <th scope="row">Enable:</th>
            <td>
                <div class="mb-5">
                    <label><input<?php echo $wpaicg_instant_embedding == 'yes' ? ' checked':'';?> type="checkbox" name="wpaicg_instant_embedding" value="yes">
                </div>
            </td>
        </tr>
    </table>
    <h3>Index Builder</h3>
    <p>You can use index builder to build your index. Difference between index builder and instant embedding is that once you complete the cron job, index builder will monitor your content and will update the index automatically.</p>
    <table class="form-table">
        <tr>
            <th scope="row">Cron Indexing</th>
            <td>
                <select name="wpaicg_builder_enable">
                    <option value="">No</option>
                    <option<?php echo esc_html($wpaicg_builder_enable) == 'yes' ? ' selected':'';?> value="yes">Yes</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">Build Index for:</th>
            <td>
                <div class="mb-5">
                    <div class="mb-5"><label><input<?php echo in_array('post',$wpaicg_builder_types) ? ' checked':'';?> type="checkbox" name="wpaicg_builder_types[]" value="post">&nbsp;Posts</label></div>
                    <div class="mb-5"><label><input<?php echo in_array('page',$wpaicg_builder_types) ? ' checked':'';?> type="checkbox" name="wpaicg_builder_types[]" value="page">&nbsp;Pages</label></div>
                    <?php
                    if(class_exists('WooCommerce')):
                        ?>
                        <div class="mb-5">
                            <label><input<?php echo in_array('product',$wpaicg_builder_types) ? ' checked':'';?> type="checkbox" name="wpaicg_builder_types[]" value="product">&nbsp;Products</label>
                        </div>
                    <?php
                    endif;
                    ?>
                    <?php
                    if(count($wpaicg_custom_types)){
                        foreach($wpaicg_custom_types as $key=>$wpaicg_custom_type){
                            ?>
                            <div class="mb-5">
                                <label>
                                    <input<?php echo \WPAICG\wpaicg_util_core()->wpaicg_is_pro() ? '' : ' disabled'?><?php echo in_array($key,$wpaicg_builder_types) && \WPAICG\wpaicg_util_core()->wpaicg_is_pro() ? ' checked':'';?> type="checkbox" name="wpaicg_builder_types[]" value="<?php echo esc_html($key)?>">&nbsp;<?php echo esc_html($wpaicg_custom_type['label'])?>
                                </label>
                                <input class="wpaicg_builder_custom_<?php echo esc_html($key)?>" type="hidden" name="<?php echo (\WPAICG\wpaicg_util_core()->wpaicg_is_pro()) ? 'wpaicg_builder_custom['.esc_html($key).']' : '';?>" value="<?php echo esc_html($wpaicg_custom_type['assigns'])?>">
                                <a<?php echo \WPAICG\wpaicg_util_core()->wpaicg_is_pro() ? '' : ' disabled'; ?>
                                        class="<?php echo \WPAICG\wpaicg_util_core()->wpaicg_is_pro() ? 'wpaicg_assignments' : '';?> wpaicg_assignments_<?php echo esc_html($key)?>"
                                        data-assigns="<?php echo esc_html($wpaicg_custom_type['assigns'])?>"
                                        data-post-type="<?php echo esc_html($key)?>"
                                        data-post-name="<?php echo esc_html($wpaicg_custom_type['label'])?>"
                                        data-custom-fields="<?php echo isset($wpaicg_custom_type['custom_fields']) && is_array($wpaicg_custom_type['custom_fields']) && count($wpaicg_custom_type['custom_fields']) ? esc_html(json_encode($wpaicg_custom_type['custom_fields'])) : ''?>"
                                        data-taxonomies="<?php echo isset($wpaicg_custom_type['taxonomies']) && is_array($wpaicg_custom_type['taxonomies']) && count($wpaicg_custom_type['taxonomies']) ? esc_html(json_encode($wpaicg_custom_type['taxonomies'])) : ''?>"
                                        data-users="<?php echo isset($wpaicg_custom_type['users']) && is_array($wpaicg_custom_type['users']) && count($wpaicg_custom_type['users']) ? esc_html(json_encode($wpaicg_custom_type['users'])) : ''?>"
                                        data-standards="<?php echo isset($wpaicg_custom_type['standard']) && is_array($wpaicg_custom_type['standard']) && count($wpaicg_custom_type['standard']) ? esc_html(json_encode($wpaicg_custom_type['standard'])) : ''?>"
                                        href="javascript:void(0)">
                                    [Select Fields]
                                </a>
                                <?php
                                if(!\WPAICG\wpaicg_util_core()->wpaicg_is_pro()){
                                ?>
                                    <span style="font-size: 13px;display: inline-block;margin: 0 5px;background: #ffba00;padding: 2px 5px;border-radius: 3px;color: #000;font-weight: bold;">Pro</span>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </td>
        </tr>
    </table>
    <button class="button button-primary" name="wpaicg_save_builder_settings">Save</button>
</form>
<?php
if(\WPAICG\wpaicg_util_core()->wpaicg_is_pro()):
?>
<script>
    jQuery(document).ready(function ($){
        function wpaicggetFields(btn){
            let custom_fields = btn.attr('data-custom-fields');
            let taxonomies = btn.attr('data-taxonomies');
            let users = btn.attr('data-users');
            let standards = btn.attr('data-standards');
            let fields = {};
            if(standards !== ''){
                standards = JSON.parse(standards);
                fields['1standards'] = standards;
            }
            if(custom_fields !== ''){
                custom_fields = JSON.parse(custom_fields);
                fields['2custom'] = {};
                $.each(custom_fields, function(idx, item){
                    fields['2custom'][item] = item.replace(/wpaicgcf_/g,'');
                })
            }
            if(taxonomies !== ''){
                taxonomies = JSON.parse(taxonomies);
                fields['3taxonomies'] = {};
                $.each(taxonomies, function(idx, item){
                    fields['3taxonomies'][item.label] = item.name;
                });
            }
            if(users !== ''){
                users = JSON.parse(users);
                fields['4users'] = users;
            }
            return fields;
        }
        $('.wpaicg_modal_close').click(function (){
            $('.wpaicg_modal_close').closest('.wpaicg_modal').hide();
            $('.wpaicg-overlay').hide();
        });
        function wpaicgAddField(fields, selected_field){
            let field_selected = false;
            let field_name = false;
            if(typeof selected_field !== "undefined"){
                field_selected = selected_field[0];
                field_name = selected_field[1].replace(/\\/g,'');
            }
            let html = '<div class="wpaicg_assign_field" style="display: flex;justify-content: space-between;padding: 5px;border: 1px solid #ccc;border-radius: 3px;margin-bottom: 10px;background: #f1f1f1;">';
            html += '<select class="regular-text">';
            $.each(fields, function (idx, item){
                if(idx === '1standards'){
                    html += '<optgroup label="Standard">';
                }
                if(idx === '2custom'){
                    html += '<optgroup label="Custom Fields">';
                }
                if(idx === '3taxonomies'){
                    html += '<optgroup label="Taxonomies">';
                }
                if(idx === '4users'){
                    html += '<optgroup label="Users">';
                }
                $.each(item, function(idy, name){
                    html += '<option'+(field_selected && field_selected === idy ? ' selected':'')+' value="'+idy+'">'+name+'</option>';
                })
                html += '</optgroup>';
            })
            html += '</select>';
            html += '<input type="text" class="regular-text" value="'+(field_name ?  field_name : '')+'" placeholder="Label">';
            html += '<span class="wpaicg_assign_delete dashicons dashicons-trash" style="height: 29px;width: 36px;background: #cf0000;border-radius: 2px;cursor: pointer;display: flex;align-items: center;justify-content: center;color: #fff;"></span>';
            html += '</div>';
            return html;
        }
        $(document).on('click','.wpaicg_assign_delete', function (e){
            $(e.currentTarget).parent().remove();
        })
        $(document).on('click','.wpaicg_assign_field_btn', function (e){
            let btn = $(e.currentTarget);
            let post_type = btn.attr('data-post-type');
            let assignBtn = $('.wpaicg_assignments_'+post_type);
            let fields = wpaicggetFields(assignBtn);
            let html = wpaicgAddField(fields);
            $('.wpaicg_assigns_fields').append(html);
        })
        $(document).on('click','.wpaicg_assignments', function (e){
            let btn = $(e.currentTarget);
            let content = '';
            let post_name = btn.attr('data-post-name');
            let post_type = btn.attr('data-post-type');
            let assigns = btn.attr('data-assigns');
            let fields = wpaicggetFields(btn);
            content += '<div class="wpaicg_assigns_fields" data-post-type="'+post_type+'">';
            if(assigns !== ''){
                let assigns_lists = [];
                assigns = assigns.split('||');
                $.each(assigns, function (idx, item){
                    let assign_item = item.split('##');
                    assigns_lists.push(assign_item[0]);
                    content += wpaicgAddField(fields,assign_item);
                });

            }
            content += '</div>';
            content += '<div class="wpaicg_assign_footer"><button data-post-type="'+post_type+'" class="button button-link-delete wpaicg_assign_field_btn" style="display: block;width: 48%;">Add Field</button>';
            content += '<button class="button button-primary wpaicg_assign_field_save" data-post-type="'+post_type+'" style="display: block;width: 48%">Save</button></div>';
            $('.wpaicg_modal_title').html('Select Fields: '+post_name);
            $('.wpaicg_modal_content').html(content);
            $('.wpaicg-overlay').show();
            $('.wpaicg_modal').show();
        });
        $(document).on('click','.wpaicg_assign_field_save', function (e){
            let btn = $(e.currentTarget);
            let post_type = btn.attr('data-post-type');
            let assigns = [];
            let has_error = false;
            $('.wpaicg_assigns_fields .wpaicg_assign_field').each(function (idx, item){
                let field_id = $(item).find('select').val();
                let field_name = $(item).find('input').val();
                if(field_name === ''){
                    has_error = 'Please insert all fields or remove empty fields';
                }
                else{
                    assigns.push(field_id+'##'+field_name);
                }
            })
            if(has_error){
                alert(has_error);
            }
            else{
                $('.wpaicg_builder_custom_'+post_type).val(assigns.join('||'));
                $('.wpaicg_assignments_'+post_type).attr('data-assigns',assigns.join('||'));
                $('.wpaicg_modal_content').empty();
                $('.wpaicg-overlay').hide();
                $('.wpaicg_modal').hide();
            }
        });
    })
</script>
<?php
endif;
?>