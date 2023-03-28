<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$wpaicg_action = isset($_GET['action']) && !empty($_GET['action']) ? sanitize_text_field($_GET['action']) : '';
?>
<div class="wrap fs-section">
    <h2 class="nav-tab-wrapper">
        <a href="<?php echo admin_url('admin.php?page=wpaicg_forms')?>" class="nav-tab<?php echo empty($wpaicg_action) ? ' nav-tab-active':''?>">AI Forms</a>
        <a href="<?php echo admin_url('admin.php?page=wpaicg_forms&action=logs')?>" class="nav-tab<?php echo $wpaicg_action == 'logs' ? ' nav-tab-active':''?>">Logs</a>
        <a href="<?php echo admin_url('admin.php?page=wpaicg_forms&action=settings')?>" class="nav-tab<?php echo $wpaicg_action == 'settings' ? ' nav-tab-active':''?>">Settings</a>
    </h2>
    <div id="poststuff">
        <div id="fs_account">
            <?php
            if(empty($wpaicg_action)){
                include __DIR__.'/wpaicg_form_index.php';
            }
            if($wpaicg_action == 'logs'){
                include __DIR__.'/wpaicg_form_log.php';
            }
            if($wpaicg_action == 'settings'){
                include __DIR__.'/wpaicg_form_settings.php';
            }
            ?>
        </div>
    </div>
</div>
