<?php
if ( ! defined( 'ABSPATH' ) ) exit;
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
?>
<form action="" method="post">
    <h3>Pinecone</h3>
    <div class="wpaicg-alert">
        <h3>Steps</h3>
        <p>1. First watch this video tutorial <a href="https://www.youtube.com/watch?v=NPMLGwFQYrY" target="_blank">here</a>.</p>
        <p>2. Get your API key from <a href="https://www.pinecone.io/" target="_blank">Pinecone</a>.</p>
        <p>3. Create an Index on Pinecone.</p>
        <p>4. Make sure to set your dimension to <b>1536</b>.</p>
        <p>5. Make sure to set your metric to <b>cosine</b>.</p>
        <p>6. Enter your data.</p>
        <p>7. Go to Settings - ChatGPT tab and select Embeddings method.</p>
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
                    <label><input<?php echo in_array('post',$wpaicg_builder_types) ? ' checked':'';?> type="checkbox" name="wpaicg_builder_types[]" value="post">&nbsp;Posts</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input<?php echo in_array('page',$wpaicg_builder_types) ? ' checked':'';?> type="checkbox" name="wpaicg_builder_types[]" value="page">&nbsp;Pages</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    if(class_exists('WooCommerce')):
                        ?>
                        <label><input<?php echo in_array('product',$wpaicg_builder_types) ? ' checked':'';?> type="checkbox" name="wpaicg_builder_types[]" value="product">&nbsp;Products</label>
                    <?php
                    endif;
                    ?>
                </div>
            </td>
        </tr>
    </table>
    <button class="button button-primary" name="wpaicg_save_builder_settings">Save</button>
</form>
