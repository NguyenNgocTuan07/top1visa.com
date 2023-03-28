<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<h3>Settings</h3>
<div class="wpaicg-custom-parameters-content">
    <div class="wpaicg-form-field">
        <label><strong>Template:</strong></label>
        <select class="wpaicg_custom_template_select regular-text">
            <?php
            foreach ($wpaicg_templates as $key=>$wpaicg_template){
                echo '<option class="wpaicg_custom_template_'.esc_html($key).'" data-parameters="'.esc_html(json_encode($wpaicg_template['content'], JSON_UNESCAPED_UNICODE)).'" value="'.esc_html($key).'">'.esc_html($wpaicg_template['title']).'</option>';
            }
            ?>
        </select>
    </div>
    <div class="wpaicg-form-field">
        <label><strong>Name:</strong></label>
        <input type="text" class="regular-text wpaicg_custom_template_title" name="title" placeholder="Enter a Template Name">
    </div>
    <div class="wpaicg-form-field">
        <label><strong>Post Type:</strong></label>
        <select name="template[post_type]" class="regular-text wpaicg_custom_template_post_type">
            <option value="post">Post</option>
            <option<?php echo isset($wpaicg_parameters['post_type']) && $wpaicg_parameters['post_type'] == 'page' ? ' selected' :''?> value="page">Page</option>
        </select>
    </div>
    <div class="wpaicg-form-field">
        <label><strong>Model:</strong></label>
        <select name="template[model]" class="regular-text wpaicg_custom_template_model">
            <?php
            foreach($wpaicg_custom_models as $wpaicg_custom_model){
                echo '<option'.($wpaicg_custom_model == $wpaicg_parameters['model'] ? ' selected':'').' value="'.esc_html($wpaicg_custom_model).'">'.esc_html($wpaicg_custom_model).'</option>';
            }
            ?>
        </select>
    </div>
    <div id="gpt4-notice" class="wpaicg-form-field" style="display:none;">
        <p style="color: red;">Please note that GPT-4 is currently in limited beta, which means that access to the GPT-4 API from OpenAI is available only through a waiting list and is not open to everyone yet. You can sign up for the waiting list at <a href="https://openai.com/waitlist/gpt-4-api" target="_blank">here</a>.</p>
    </div>
    <?php
    foreach(array('temperature','max_tokens','top_p','best_of','frequency_penalty','presence_penalty') as $item){
        ?>
        <div class="wpaicg-form-field">
            <label><strong><?php echo esc_html(ucwords(str_replace('_',' ',$item))) ?>:</strong></label>
            <input type="text" value="<?php echo esc_html($wpaicg_parameters[$item])?>" class="wpaicg_custom_template_<?php echo esc_html($item)?>" name="template[<?php echo esc_html($item)?>]" style="width: 80px">
        </div>
        <?php
    }
    ?>
    <div class="wpaicg-mb-10">
        <label class="mb-5" style="display: block"><strong>Prompt for Title:</strong></label>
        <textarea class="wpaicg_custom_template_prompt_title" name="template[prompt_title]" rows="2"><?php echo esc_html($wpaicg_parameters['prompt_title'])?></textarea>
        <p style="margin-top: 0;font-size: 13px;font-style: italic;">Ensure <code>[count]</code> and <code>[topic]</code> is included in your prompt.</code></p>
    </div>
    <div class="wpaicg-mb-10">
        <label class="mb-5" style="display: block"><strong>Prompt for Sections:</strong></label>
        <textarea class="wpaicg_custom_template_prompt_section" name="template[prompt_section]" rows="2"><?php echo esc_html($wpaicg_parameters['prompt_section'])?></textarea>
        <p style="margin-top: 0;font-size: 13px;font-style: italic;">Ensure <code>[count]</code> and <code>[title]</code> is included in your prompt.</code></p>
    </div>
    <div class="wpaicg-mb-10">
        <label class="mb-5" style="display: block"><strong>Prompt for Content:</strong></label>
        <textarea class="wpaicg_custom_template_prompt_content" name="template[prompt_content]" rows="5"><?php echo esc_html($wpaicg_parameters['prompt_content'])?></textarea>
        <p style="margin-top: 0;font-size: 13px;font-style: italic;">Ensure <code>[title]</code>, <code>[sections]</code> and <code>[count]</code> is included in your prompt.</code></p>
    </div>
    <div class="wpaicg-mb-10">
        <label class="mb-5" style="display: block"><strong>Prompt for Excerpt:</strong></label>
        <textarea class="wpaicg_custom_template_prompt_excerpt" name="template[prompt_excerpt]" rows="2"><?php echo esc_html($wpaicg_parameters['prompt_excerpt'])?></textarea>
        <p style="margin-top: 0;font-size: 13px;font-style: italic;">Ensure <code>[title]</code> is included in your prompt.</code></p>
    </div>
    <div class="wpaicg-mb-10">
        <label class="mb-5" style="display: block"><strong>Prompt for Meta:</strong></label>
        <textarea class="wpaicg_custom_template_prompt_meta" name="template[prompt_meta]" rows="2"><?php echo esc_html($wpaicg_parameters['prompt_meta'])?></textarea>
        <p style="margin-top: 0;font-size: 13px;font-style: italic;">Ensure <code>[title]</code> is included in your prompt.</code></p>
    </div>
    <div style="display: flex;justify-content: space-between">
        <div>
            <button style="display: none" type="button" class="button button-primary wpaicg_template_update">Update</button>
            <button type="button" class="button button-primary wpaicg_template_save">Save Template</button>
        </div>
        <button type="button" class="button button-link-delete wpaicg_template_delete" style="display: none">Delete</button>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const modelSelect = document.querySelector('.wpaicg_custom_template_model');
    const gpt4Notice = document.getElementById('gpt4-notice');

    modelSelect.addEventListener('change', function () {
        if (this.value === 'gpt-4' || this.value === 'gpt-4-32k') {
            gpt4Notice.style.display = 'block';
        } else {
            gpt4Notice.style.display = 'none';
        }
    });
});
</script>