<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;
$wpaicg_log_page = isset($_GET['wpage']) && !empty($_GET['wpage']) ? sanitize_text_field($_GET['wpage']) : 1;
$search = isset($_GET['search']) && !empty($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
$where = '';
if(!empty($search)) {
    $where .= $wpdb->prepare(" AND `data` LIKE %s", '%' . $wpdb->esc_like($search) . '%');
    $where .= $wpdb->prepare(" OR `prompt` LIKE %s", '%' . $wpdb->esc_like($search) . '%');
}
$query = "SELECT * FROM ".$wpdb->prefix."wpaicg_form_logs WHERE 1=1".$where;
$total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
$total = $wpdb->get_var( $total_query );
$items_per_page = 20;
$offset = ( $wpaicg_log_page * $items_per_page ) - $items_per_page;
$wpaicg_logs = $wpdb->get_results( $query . " ORDER BY created_at DESC LIMIT ${offset}, ${items_per_page}" );
$totalPage         = ceil($total / $items_per_page);
?>
<style>
    .wpaicg_modal{
        top: 5%;
        height: 90%;
        position: relative;
    }
    .wpaicg_modal_content{
        max-height: calc(100% - 103px);
        overflow-y: auto;
    }
</style>
<form action="" method="get">
    <input type="hidden" name="page" value="wpaicg_forms">
    <input type="hidden" name="action" value="logs">
    <div class="wpaicg-d-flex mb-5">
        <input style="width: 100%" value="<?php echo esc_html($search)?>" class="regular-text" name="search" type="text" placeholder="Type for search">
        <button class="button button-primary">Search</button>
    </div>
</form>
<table class="wp-list-table widefat fixed striped table-view-list posts">
    <thead>
    <tr>
        <th>Form</th>
        <th>ID</th>
        <th>Prompt</th>
        <th>Page</th>
        <th>Model</th>
        <th>Duration</th>
        <th>Token</th>
        <th>Estimated</th>
        <th>Created At</th>
    </tr>
    </thead>
    <tbody class="wpaicg-builder-list">
    <?php
    if($wpaicg_logs && is_array($wpaicg_logs) && count($wpaicg_logs)){
        foreach ($wpaicg_logs as $wpaicg_log) {
            $source = '';
            $wpaicg_ai_model = $wpaicg_log->model;
            $wpaicg_usage_token = $wpaicg_log->tokens;
            if($wpaicg_log->source > 0){
                $source = get_the_title($wpaicg_log->source);
            }
            if($wpaicg_ai_model === 'gpt-3.5-turbo') {
                $wpaicg_estimated = 0.002 * $wpaicg_usage_token / 1000;
            }
            if($wpaicg_ai_model === 'gpt-4') {
                $wpaicg_estimated = 0.06 * $wpaicg_usage_token / 1000;
            }
            if($wpaicg_ai_model === 'gpt-4-32k') {
                $wpaicg_estimated = 0.12 * $wpaicg_usage_token / 1000;
            }
            else{
                $wpaicg_estimated = 0.02 * $wpaicg_usage_token / 1000;
            }
            ?>
            <tr>
                <td><?php echo esc_html($wpaicg_log->name)?></td>
                <td><?php echo esc_html($wpaicg_log->prompt_id)?></td>
                <td><a class="wpaicg-view-log" href="javascript:void(0)" data-content="<?php echo esc_html($wpaicg_log->data)?>" data-prompt="<?php echo esc_html($wpaicg_log->prompt)?>"><?php echo esc_html(substr($wpaicg_log->prompt,0,100))?>..</a></td>
                <td><?php echo esc_html($source)?></td>
                <td><?php echo esc_html($wpaicg_ai_model)?></td>
                <td><?php echo esc_html(WPAICG\WPAICG_Content::get_instance()->wpaicg_seconds_to_time((int)$wpaicg_log->duration))?></td>
                <td><?php echo esc_html($wpaicg_usage_token)?></td>
                <td>$<?php echo esc_html($wpaicg_estimated)?></td>
                <td><?php echo esc_html(date('d.m.Y H:i',$wpaicg_log->created_at))?></td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>
<div class="wpaicg-paginate">
    <?php
    if($totalPage > 1){
        echo paginate_links( array(
            'base'         => admin_url('admin.php?page=wpaicg_forms&action=logs&wpage=%#%'),
            'total'        => $totalPage,
            'current'      => $wpaicg_log_page,
            'format'       => '?wpage=%#%',
            'show_all'     => false,
            'prev_next'    => false,
            'add_args'     => false,
        ));
    }
    ?>
</div>
<script>
    jQuery(document).ready(function ($){
        $('.wpaicg_modal_close').click(function (){
            $('.wpaicg_modal_close').closest('.wpaicg_modal').hide();
            $('.wpaicg-overlay').hide();
        });
        $('.wpaicg-view-log').click(function (){
            let html = '';
            let content = $(this).attr('data-content');
            content = content.trim();
            content = content.replace(/\n/g, "<br />");
            content = content.replace(/\\/g,'');
            $('.wpaicg_modal_title').html('View Form Log');
            html += '<p><strong>Prompt:</strong> '+$(this).attr('data-prompt')+'</p>';
            html += '<strong>Response</strong>';
            html += '<div>';
            html += content.trim();
            html += '</div>';
            $('.wpaicg_modal_content').html(html);
            $('.wpaicg-overlay').show();
            $('.wpaicg_modal').show();

        })
    })
</script>
