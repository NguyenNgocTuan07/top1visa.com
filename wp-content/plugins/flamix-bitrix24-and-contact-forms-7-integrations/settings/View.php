<?php namespace Flamix\Bitrix24\CF7; ?><div class="notice notice-error">
    <p>Install the Lead interceptor <a href="https://flamix.solutions/bitrix24/integrations/site/cf7.php#price" target="_blank">module in Bitrix24</a>!</p>
</div>
<div class="wrap">
    <h2>Bitrix24 Lead integrations with Contact Form 7</h2>

    <form method="post" action="options.php">
        <?php settings_fields(Settings::getOptionName('group')); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Bitrix24 domain name</th>
                <td><input type="text" name="<?php echo esc_html(Settings::getOptionName('lead_domain')); ?>" placeholder="company.bitrix24.com" value="<?php echo esc_html(Settings::getOption('lead_domain')); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row">Flamix plugin API key</th>
                <td><input type="text" name="<?php echo esc_html(Settings::getOptionName('lead_api')); ?>" placeholder="xxxxxx.....xxxxx" value="<?php echo esc_html(Settings::getOption('lead_api')); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row">Backup mailbox</th>
                <td><input type="text" name="<?php echo esc_html(Settings::getOptionName('lead_backup_email')); ?>" placeholder="backup@email.com" value="<?php echo esc_html(Helpers::get_backup_email()); ?>" /> When an error occurs, send a message to this mail</td>
            </tr>
        </table>

        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save') ?>" />
        </p>
    </form>

    <h2>Configurations</h2>
    <ul>
        <li>
            Status -
            <?php
                try {
                    $status = Helpers::send(['status' => 'check'], 'check');
                    if (!empty($status) && $status['status'] == 'success'): ?>
                        <span style="color: #46b450;">Working</span>
                    <?php else: ?>
                        <span style="color: #dc3232;">Bad Domain or API Key</span>
                    <?php endif; ?>
                <?php } catch (\Exception $e) { ?>
                    <span style="color: #dc3232;"><?php echo esc_html($e->getMessage()); ?></span>
                <?php } ?>
        </li>
        <li>
            WordPress Contact Form 7 activated -
            <?php if (Helpers::isPluginActive('contact-form-7/wp-contact-form-7.php')): ?>
                <span style="color: #46b450;">Yes</span>
            <?php else: ?>
                <span style="color: #dc3232;">No. You must install <a href="https://ru.wordpress.org/plugins/contact-form-7/" target="_blank">plugin</a>!</span>
            <?php endif; ?>
        </li>
        <li>
            CURL -
            <?php if (extension_loaded('curl')): ?>
                <span style="color: #46b450;">Enable</span>
            <?php else: ?>
                <span style="color: #dc3232;">Disabled</span>
            <?php endif; ?>
        </li>
        <li>
            PHP version 7.2+ (Catch and send UTM tags and Trace Page) -
            <?php if (version_compare(PHP_VERSION, '7.2.0') >= 0): ?>
                <span style="color: #46b450;">PHP <?php echo esc_html(PHP_VERSION);?></span>
            <?php else: ?>
                <span style="color: #dc3232;">Bad PHP version (<?php echo esc_html(PHP_VERSION);?>). Update on your hosting</span>
            <?php endif; ?>
        </li>
        <li>
            Backup email -
            <?php if (!empty(Helpers::get_backup_email()) && filter_var(Helpers::get_backup_email(), FILTER_VALIDATE_EMAIL)): ?>
                <span style="color: #46b450;">Valid</span>
            <?php else: ?>
                <span style="color: #dc3232;">Invalid</span>
            <?php endif; ?>
        </li>
    </ul>

    <h2>How its works</h2>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/goZAdrh_gHM" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>