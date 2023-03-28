<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$wpaicg_action = isset($_GET['action']) && !empty($_GET['action']) ? sanitize_text_field($_GET['action']) : '';
?>

<div class="wrap fs-section">
    <h2 class="nav-tab-wrapper">
        <a href="<?php echo admin_url('admin.php?page=wpaicg_chatgpt')?>" class="nav-tab<?php echo empty($wpaicg_action) ? ' nav-tab-active': ''?>">Shortcode</a>
        <a href="<?php echo admin_url('admin.php?page=wpaicg_chatgpt&action=widget')?>" class="nav-tab<?php echo $wpaicg_action == 'widget' ? ' nav-tab-active': ''?>">Widget</a>
        <a href="<?php echo admin_url('admin.php?page=wpaicg_chatgpt&action=bots')?>" class="nav-tab<?php echo $wpaicg_action == 'bots' ? ' nav-tab-active': ''?>">Chat Bots</a>
        <a href="<?php echo admin_url('admin.php?page=wpaicg_chatgpt&action=logs')?>" class="nav-tab<?php echo $wpaicg_action == 'logs' ? ' nav-tab-active': ''?>">Logs</a>
    </h2>
    <div id="poststuff">
        <div id="fs_account">
            <?php
            if(empty($wpaicg_action)):
                include __DIR__.'/wpaicg_chat_shortcode.php';
            elseif($wpaicg_action == 'widget'):
                include __DIR__.'/wpaicg_chat_widget_settings.php';
            elseif($wpaicg_action == 'bots'):
                include __DIR__.'/wpaicg_chatbots.php';
            elseif($wpaicg_action == 'logs'):
                include __DIR__.'/wpaicg_chatlog.php';
            endif;
            ?>
        </div>
    </div>
</div>
