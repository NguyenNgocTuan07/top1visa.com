<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$wpaicg_action = isset($_GET['action']) && !empty($_GET['action']) ? sanitize_text_field($_GET['action']) : '';
?>
<div class="wrap fs-section">
    <h2 class="nav-tab-wrapper">
        <a href="<?php echo admin_url('admin.php?page=wpaicg_audio');?>" class="nav-tab<?php echo empty($wpaicg_action) ? ' nav-tab-active' : ''?>">Audio Converter</a>
        <a href="<?php echo admin_url('admin.php?page=wpaicg_audio&action=logs');?>" class="nav-tab<?php echo $wpaicg_action == 'logs' ? ' nav-tab-active' : ''?>">Logs</a>
    </h2>
</div>
<div id="poststuff">
    <?php
    if(empty($wpaicg_action)){
        include __DIR__.'/converter.php';
    }
    if($wpaicg_action == 'logs'){
        include __DIR__.'/logs.php';
    }
    ?>
</div>
