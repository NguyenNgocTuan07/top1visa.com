<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$wpaicg_xml_enabled = extension_loaded('xml');
if(!$wpaicg_xml_enabled){
    ?>
    <div class="wpaicg-alert">
        <p style="color: #f00">
            Please enable XML php extension
        </p>
    </div>
    <?php
}
?>
<?php
$wpaicg_crojob_rss_last_time = get_option('_wpaicg_crojob_rss_last_time','');
$wpaicg_cron_rss_added = get_option('_wpaicg_cron_rss_added','');
if(isset($_POST['wpaicg_delete_running'])){
    update_option('_wpaicg_crojob_rss_last_time', time());
    @unlink(WPAICG_PLUGIN_DIR.'wpaicg_rss.txt');
    echo '<script>window.location.reload()</script>';
    exit;
}

?>
<div class="wpaicg-alert">
    <?php
    if(empty($wpaicg_cron_rss_added)):
        ?>
        <h4>Important</h4>
        <p>
            You must configure a <a href="https://www.hostgator.com/help/article/what-are-cron-jobs" target="_blank">Cron Job</a> on your hosting/server.
            If this is not done, the Bulk Editor feature will not be available for use.
        </p>
    <?php
    endif;
    ?>
    <?php
    if(empty($wpaicg_cron_rss_added)){
        echo '<p style="color: #f00"><strong>It appears that you have not activated Cron Job on your server, which means you will not be able to use the Bulk Editor feature. If you have already activated Cron Job, please allow a few minutes to pass before refreshing the page.</strong></p>';
    }
    else{
        echo '<p style="color: #10922c"><strong>Great! It looks like your Cron Job is running properly. You should now be able to use the Bulk Editor.</strong></p>';
    }
    ?>
    <?php
    if(!empty($wpaicg_crojob_rss_last_time)):
        $wpaicg_current_timestamp = time();

        $wpaicg_time_diff = human_time_diff( $wpaicg_crojob_rss_last_time, $wpaicg_current_timestamp );

        if ( strpos( $wpaicg_time_diff, 'hour' ) !== false ) {
            $wpaicg_output = str_replace( 'hours', 'hours', $wpaicg_time_diff );
        } elseif ( strpos( $wpaicg_time_diff, 'day' ) !== false ) {
            $wpaicg_output = str_replace( 'days', 'days', $wpaicg_time_diff );
        } elseif ( strpos( $wpaicg_time_diff, 'min' ) !== false ) {
            $wpaicg_output = str_replace( 'minutes', 'minutes', $wpaicg_time_diff );
        } else {
            $wpaicg_output = $wpaicg_time_diff;
        }
        ?>
        <p>The last time, the Cron Job ran on your website <?php echo esc_html(date('Y-m-d H:i:s',$wpaicg_crojob_rss_last_time))?> (<?php echo esc_html($wpaicg_output)?> ago)</p>
    <?php
    endif;
    ?>
    <?php
    //    if(empty($wpaicg_cron_added)):
    ?>
    <hr>
    <p></p>
    <p><strong>Cron Job Configuration</strong></p>
    <p></p>
    <p>If you are using Linux/Unix server, copy below code and paste it into crontab. Read detailed guide <a href="<?php echo esc_url("https://gptaipower.com/how-to-add-cron-job/"); ?>" target="_blank">here</a>.</p>
    <p><code>0 * * * * php <?php echo esc_html(ABSPATH)?>index.php -- wpaicg_rss=yes</code></p>
    <p>Please note 0 * * * * means this cron job will run every hour. You can change it to 0 */2 * * * to run every 2 hours. You can also change it to 0 0 * * * to run every day.</p>
    <p>Once you setup the cronjob <b>you need to wait for 1 hour</b> to see the results.</p>
    <?php
    //    endif;
    ?>
</div>
<div class="wpaicg-alert">
<p>Please remember: It's important to say that using this module for content based on <b><u>news sources</b></u> is not a good idea. It works better for <b><u>blog posts</b></u>. News is about recent events, and GPT models might give wrong information, make up details, and imagine things. So, don't use this module for news-related content.</p>
<br>
<p>For example, imagine you use CNN as your RSS source, and our plugin gets the newest news from CNN, like "300 million jobs could be affected by latest wave of AI, says Goldman Sachs". Our plugin will make a blog post with that title, and the content will be made by GPT. But, the content made by GPT might not be right and could have imagined things. Because it is a very recent event. So, don't use this module for news-related content.</p>
<br>
<p>On the other hand, imagine you use an RSS from a blog talking about YouTube-related content, like "how to create a successful YouTube channel". Our plugin will make a blog post with that title, and the content will be made by GPT. In this case, the content made by GPT will be more correct and won't have imagined things.</p>
</div>

