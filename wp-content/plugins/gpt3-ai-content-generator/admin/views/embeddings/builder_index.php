<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<h3>Indexed Pages</h3>
<?php
if($wpaicg_builder_types && is_array($wpaicg_builder_types) && count($wpaicg_builder_types)){
    foreach($wpaicg_builder_types as $wpaicg_builder_type){
        $sql_count_data = "SELECT COUNT(p.ID) FROM ".$wpdb->posts." p WHERE p.post_type='".$wpaicg_builder_type."' AND p.post_status = 'publish'";
        $total_data = $wpdb->get_var($sql_count_data);
        $sql_done_data = "SELECT COUNT(p.ID) FROM ".$wpdb->postmeta." m LEFT JOIN ".$wpdb->posts." p ON p.ID=m.post_id WHERE p.post_type='".$wpaicg_builder_type."' AND p.post_status = 'publish' AND m.meta_key='wpaicg_indexed' AND m.meta_value IN ('error','skip','yes')";
        $total_converted = $wpdb->get_var($sql_done_data);
        if($total_data > 0){
            $percent_process = ceil($total_converted*100/$total_data);
            ?>
            <div class="wpaicg-builder-process wpaicg-builder-process-<?php echo esc_html($wpaicg_builder_type)?>">
                <strong>
                    <?php
                    if($wpaicg_builder_type == 'post'){
                        echo 'Posts';
                    }
                    elseif($wpaicg_builder_type == 'page'){
                        echo 'Pages';
                    }
                    elseif($wpaicg_builder_type == 'product'){
                        echo 'Products';
                    }
                    else{
                        echo ucwords(str_replace(array('-','_'),'',$wpaicg_builder_type));
                    }
                    ?>
                    <small class="wpaicg-numbers">(<?php echo esc_html($total_converted)?>/<?php echo esc_html($total_data)?>)</small>
                </strong>
                <div class="wpaicg-builder-process-content">
                    <span class="wpaicg-percent" style="width: <?php echo esc_html($percent_process)?>%"></span>
                </div>
            </div>
            <?php
        }
    }
}
?>
<?php
$wpaicg_embedding_page = isset($_GET['wpage']) && !empty($_GET['wpage']) ? sanitize_text_field($_GET['wpage']) : 1;
$wpaicg_embeddings = new WP_Query(array(
    'post_type' => 'wpaicg_builder',
    'posts_per_page' => 40,
    'paged' => $wpaicg_embedding_page,
    'order' => 'DESC',
    'orderby' => 'meta_value',
    'meta_key' => 'wpaicg_start'
));

?>
<div class="tablenav top">
    <div class="alignleft actions bulkactions">
        <a href="<?php echo admin_url('admin.php?page=wpaicg_embeddings&action=builder&sub=reindexall')?>" class="button button-primary">Re-Index All</a>
        <button class="button button-primary btn-reindex-builder">Re-Index Selected</button>
        <a onclick="return confirm('Warning! All indexes will be deleted from Pinecone and elsewhere. Are you sure?')" href="<?php echo admin_url('admin.php?page=wpaicg_embeddings&action=builder&sub=deleteall')?>" class="button wpaicg-danger-btn">Delete Everything</a>
    </div>
</div>
<div class="tablenav top">
    <div class="alignleft actions bulkactions">
        Indexed (<?php echo esc_html($wpaicg_total_indexed)?>) |
        <a href="<?php echo admin_url('admin.php?page=wpaicg_embeddings&action=builder&sub=errors')?>">Failed (<?php echo esc_html(count($wpaicg_total_errors))?>)</a> |
        <a href="<?php echo admin_url('admin.php?page=wpaicg_embeddings&action=builder&sub=skip')?>">Skipped (<?php echo esc_html(count($wpaicg_total_skips))?>)</a>
    </div>
</div>
<table class="wp-list-table widefat fixed striped table-view-list posts">
    <thead>
    <tr>
        <td id="cb" class="manage-column column-cb check-column" scope="col"><input type="checkbox" class="wpaicg-select-all"></td>
        <th>Title</th>
        <th>Token</th>
        <th>Estimated</th>
        <th>Source</th>
        <th>Status</th>
        <th>Start</th>
        <th>Completed</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody class="wpaicg-builder-list">
    <?php
    if($wpaicg_embeddings->have_posts()){
        foreach ($wpaicg_embeddings->posts as $wpaicg_embedding){
            include __DIR__.'/builder_item.php';
        }
    }
    ?>
    </tbody>
</table>
<div class="wpaicg-paginate">
    <?php
    echo paginate_links( array(
        'base'         => admin_url('admin.php?page=wpaicg_embeddings&action=builder&wpage=%#%'),
        'total'        => $wpaicg_embeddings->max_num_pages,
        'current'      => $wpaicg_embedding_page,
        'format'       => '?wpage=%#%',
        'show_all'     => false,
        'prev_next'    => false,
        'add_args'     => false,
    ));
    ?>
</div>
<script>
    jQuery(document).ready(function ($){
        var wpaicgCurrentPage = <?php echo esc_html($wpaicg_embedding_page);?>;
        $('.wpaicg_modal_close').click(function (){
            $('.wpaicg_modal_close').closest('.wpaicg_modal').hide();
            $('.wpaicg-overlay').hide();
        });
        setInterval(function (){
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php')?>',
                data: {action: 'wpaicg_builder_list', wpage: wpaicgCurrentPage},
                dataType: 'JSON',
                success: function (res){
                    if(res.status === 'success'){
                        $('.wpaicg-builder-list').html(res.html);
                        $('.wpaicg-paginate').html(res.paginate);
                        if(res.types.length){
                            $.each(res.types, function (idx, type){
                                var type_item = $('.wpaicg-builder-process-'+type.type);
                                type_item.find('.wpaicg-numbers').html('('+type.text+')')
                                type_item.find('.wpaicg-percent').width(type.percent+'%');
                            })
                        }
                    }
                }
            })
        },10000);
        $(document).on('click','.wpaicg-embedding-content',function (e){
            var btn = $(e.currentTarget);
            var content = btn.attr('data-content');
            content = content.replace(/\n/g,'<br>');
            $('.wpaicg_modal_title').html('Embedding Content');
            $('.wpaicg_modal_content').html(content);
            $('.wpaicg-overlay').show();
            $('.wpaicg_modal').show();
        });
        function wpaicgLoading(btn){
            btn.attr('disabled','disabled');
            if(!btn.find('spinner').length){
                btn.append('<span class="spinner"></span>');
            }
            btn.find('.spinner').css('visibility','unset');
        }
        function wpaicgRmLoading(btn){
            btn.removeAttr('disabled');
            btn.find('.spinner').remove();
        }
        $(document).on('click','.wpaicg_reindex' ,function (e){
            var btn = $(e.currentTarget);
            var id = btn.attr('data-id');
            var conf = confirm('Are you sure?');
            if(conf){
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php')?>',
                    data: {action: 'wpaicg_builder_reindex', id: id},
                    dataType: 'JSON',
                    type: 'POST',
                    beforeSend: function (){
                        wpaicgLoading(btn);
                    },
                    success: function (res){
                        wpaicgRmLoading(btn);
                        if(res.status === 'success'){
                            $('#wpaicg-builder-'+id+' .builder-status').html('<span style="color: #d73e1c;font-weight: bold;"><?php echo esc_html(__('Pending','gpt3-ai-content-generator'))?></span>');
                            btn.remove();
                        }
                        else{
                            alert(res.msg);
                        }
                    },
                    error: function (){
                        wpaicgRmLoading(btn);
                        alert('Something went wrong');
                    }
                })
            }
        });
        $(document).on('click','.wpaicg_delete' ,function (e){
            var btn = $(e.currentTarget);
            var id = btn.attr('data-id');
            var conf = confirm('Are you sure?');
            if(conf){
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php')?>',
                    data: {action: 'wpaicg_builder_delete', id: id},
                    dataType: 'JSON',
                    type: 'POST',
                    beforeSend: function (){
                        wpaicgLoading(btn);
                    },
                    success: function (res){
                        wpaicgRmLoading(btn);
                        if(res.status === 'success'){
                            $('#wpaicg-builder-'+id).remove();
                        }
                        else{
                            alert(res.msg);
                        }
                    },
                    error: function (){
                        wpaicgRmLoading(btn);
                        alert('Something went wrong');
                    }
                })
            }
        });
    })
</script>
