<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<style>
    /* Container */
    .wpaicg_form_container {
        border: 1px solid #d1d1d1;
        border-radius: 5px;
        padding: 30px;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        max-width: auto;
    }

    /* Form elements */
    .wpaicg_form_container select,
    .wpaicg_form_container textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #d1d1d1;
        border-radius: 4px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    /* Buttons */
    .wpaicg_form_container button {
        padding: 10px 15px;
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 10px;
    }

    .wpaicg_form_container .wpaicg_generator_button {
        background-color: #2271B1;
        color: #ffffff;
        border: none;
    }

    .wpaicg_form_container .wpaicg_generator_stop {
        background-color: #dc3232;
        color: #ffffff;
        border: none;
        display: none;
    }

    /* Spinner */
    .wpaicg_form_container .spinner {
        display: inline-block;
        visibility: hidden;
        vertical-align: middle;
        margin-left: 5px;
    }

    /* Textarea */
    .wpaicg_prompt {
        height: auto !important;
        min-height: 100px;
        resize: vertical;
    }

    /* Notice text */
    .wpaicg_notice_text_pg {
        padding: 10px;
        background-color: #F8DC6F;
        text-align: left;
        margin-bottom: 12px;
        color: #000;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }
</style>
<div class="wpaicg_form_container">
<table class="form-table">
    <tbody>
    <tr>
        <th scope="row">Choose a category</th>
        <td>
            <select id="category_select" class="regular-text">
                <option value="">Select a category</option>
                <option value="wordpress">WordPress</option>
                <option value="blogging">Blogging</option>
                <option value="writing">Writing</option>
                <option value="ecommerce">E-commerce</option>
                <option value="online_business">Online Business</option>
                <option value="entrepreneurship">Entrepreneurship</option>
                <option value="seo">SEO</option>
                <option value="web_design">Web Design</option>
                <option value="social_media">Social Media</option>
                <option value="email_marketing">Email Marketing</option>
            </select>
        </td>
    </tr>
    <tr class="sample_prompts_row" style="display: none;">
        <th scope="row">Choose a sample prompt</th>
        <td>
            <select id="sample_prompts" class="regular-text">
                <option value="">Select a prompt</option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">Enter your prompt</th>
        <td>
            <textarea type="text" class="regular-text wpaicg_prompt">Write a product description about: Training Socks.</textarea>
            &nbsp;<button class="button wpaicg_generator_button"><span class="spinner"></span>Generate</button>
            &nbsp;<button class="button button-primary wpaicg_generator_stop">Stop</button>
        </td>
    </tr>
    <tr>
        <th scope="row">Result</th>
        <td>
            <?php
            wp_editor('','wpaicg_generator_result', array('media_buttons' => true, 'textarea_name' => 'wpaicg_generator_result'));
            ?>
            <p class="wpaicg-playground-buttons">
                <button class="button button-primary wpaicg-playground-save">Save as Draft</button>
                <button class="button wpaicg-playground-clear">Clear</button>
            </p>
        </td>
    </tr>
    </tbody>
</table>
</div>
<script>
    jQuery(document).ready(function ($){
        // Define the prompts
        var prompts = [
            {category: 'wordpress', prompt: 'Write a tutorial on how to create a custom WordPress theme from scratch.'},
            {category: 'blogging', prompt: 'Write a blog post about the top 10 blogging tips for beginners.'},
            {category: 'blogging', prompt: 'Write a blog post detailing the essential elements of a successful blog design and layout, focusing on user experience and visual appeal.'},
            {category: 'blogging', prompt: 'Write a blog post discussing the importance of authentic storytelling in blogging and how it can enhance audience engagement and brand loyalty.'},
            {category: 'blogging', prompt: 'Write a blog post about leveraging social media for blog promotion, including tips on cross-platform marketing and strategies for increasing blog visibility.'},
            {category: 'blogging', prompt: 'Write a blog post exploring the role of search engine optimization in blogging success, with a step-by-step guide on optimizing blog content for improved search rankings.'},
            {category: 'blogging', prompt: 'Write a blog post about the value of developing a consistent posting schedule and editorial calendar, sharing strategies for maintaining productivity and audience interest.'},
            {category: 'blogging', prompt: 'Write a blog post about the benefits and challenges of embracing a lean startup methodology, with actionable tips for implementing this approach in a new business venture.'},
            {category: 'writing', prompt: 'Write an article discussing the importance of storytelling in content marketing.'},
            {category: 'ecommerce', prompt: 'Write a product description for a new eco-friendly reusable water bottle.'},
            {category: 'online_business', prompt: 'Write a blog post about the key factors to consider when starting an online business.'},
            {category: 'entrepreneurship', prompt: 'Write an article on the essential skills every entrepreneur should develop.'},
            {category: 'seo', prompt: 'Write a guide on how to optimize your WordPress website for search engines.'},
            {category: 'web_design', prompt: 'Write an article about the importance of responsive web design in today\'s digital landscape.'},
            {category: 'social_media', prompt: 'Write a blog post about using social media effectively to promote your WordPress website.'},
            {category: 'email_marketing', prompt: 'Write a tutorial on how to set up an email newsletter using a WordPress plugin.'}
        ];
        // Function to handle category selection
        $('#category_select').on('change', function() {
            var selectedCategory = $(this).val();
            if (selectedCategory) {
                // Clear and populate the prompts dropdown
                $('#sample_prompts').html('<option value="">Select a prompt</option>');
                prompts.forEach(function(promptObj) {
                    if (promptObj.category === selectedCategory) {
                        $('#sample_prompts').append('<option value="' + promptObj.prompt + '">' + promptObj.prompt + '</option>');
                    }
                });
                $('.sample_prompts_row').show();
            } else {
                // Hide the prompts dropdown and clear its value
                $('.sample_prompts_row').hide();
                $('#sample_prompts').val('');
            }
        });

        // Function to handle sample prompt selection
        $('#sample_prompts').on('change', function() {
            var selectedPrompt = $(this).val();
            if (selectedPrompt) {
                // Clear the textarea and set the selected prompt
                $('.wpaicg_prompt').val(selectedPrompt);
            }
        });
        var wpaicg_generator_working = false;
        var eventGenerator = false;
        var wpaicg_limitLines = 1;
        function stopOpenAIGenerator(){
            $('.wpaicg-playground-buttons').show();
            $('.wpaicg_generator_stop').hide();
            wpaicg_generator_working = false;
            $('.wpaicg_generator_button .spinner').hide();
            $('.wpaicg_generator_button').removeAttr('disabled');
            eventGenerator.close();
        }
        $('.wpaicg_generator_button').click(function(){
            var btn = $(this);
            var title = $('.wpaicg_prompt').val();
            if(!wpaicg_generator_working && title !== ''){
                var count_line = 0;
                var wpaicg_generator_result = $('.wpaicg_generator_result');
                btn.attr('disabled','disabled');
                btn.find('.spinner').show();
                btn.find('.spinner').css('visibility','unset');
                wpaicg_generator_result.val('');
                wpaicg_generator_working = true;
                $('.wpaicg_generator_stop').show();
                eventGenerator = new EventSource('<?php echo esc_html(add_query_arg('wpaicg_stream','yes',site_url().'/index.php'));?>&title='+title);
                var editor = tinyMCE.get('wpaicg_generator_result');
                var basicEditor = true;
                if ( $('#wp-wpaicg_generator_result-wrap').hasClass('tmce-active') && editor ) {
                    basicEditor = false;
                }
                var currentContent = '';
                var wpaicg_newline_before = false;
                var wpaicg_response_events = 0;
                eventGenerator.onmessage = function (e) {
                    if(basicEditor){
                        currentContent = $('#wpaicg_generator_result').val();
                    }
                    else{
                        currentContent = editor.getContent();
                        currentContent = currentContent.replace(/<\/?p(>|$)/g, "");
                    }
                    if(e.data === "[DONE]"){
                        count_line += 1;
                        if(basicEditor) {
                            $('#wpaicg_generator_result').val(currentContent+'\n\n');
                        }
                        else{
                            editor.setContent(currentContent+'\n\n');
                        }
                        wpaicg_response_events = 0;
                    }
                    else{
                        var result = JSON.parse(e.data);
                        if(result.error !== undefined){
                            var content_generated = result.error.message;
                        }
                        else{
                            var content_generated = result.choices[0].delta !== undefined ? (result.choices[0].delta.content !== undefined ? result.choices[0].delta.content : '') : result.choices[0].text;
                        }
                        if((content_generated === '\n' || content_generated === ' \n' || content_generated === '.\n' || content_generated === '\n\n' || content_generated === '.\n\n') && wpaicg_response_events > 0 && currentContent !== ''){
                            if(!wpaicg_newline_before) {
                                wpaicg_newline_before = true;
                                if(basicEditor){
                                    $('#wpaicg_generator_result').val(currentContent+'<br /><br />');
                                }
                                else{
                                    editor.setContent(currentContent+'<br /><br />');
                                }
                            }
                        }
                        else if(content_generated === '\n' && wpaicg_response_events === 0  && currentContent === ''){

                        }
                        else{
                            wpaicg_newline_before = false;
                            wpaicg_response_events += 1;
                            if(basicEditor){
                                $('#wpaicg_generator_result').val(currentContent+content_generated);
                            }
                            else{
                                editor.setContent(currentContent+content_generated);
                            }
                        }
                    }
                    if(count_line === wpaicg_limitLines){
                        stopOpenAIGenerator();
                    }
                };
                eventGenerator.onerror = function (e) {
                };
            }
        });
        $('.wpaicg_generator_stop').click(function (){
            stopOpenAIGenerator();
        });
        $('.wpaicg-playground-clear').click(function (){
            // $('.wpaicg_prompt').val('');
            var editor = tinyMCE.get('wpaicg_generator_result');
            var basicEditor = true;
            if ( $('#wp-wpaicg_generator_result-wrap').hasClass('tmce-active') && editor ) {
                basicEditor = false;
            }
            if(basicEditor){
                $('#wpaicg_generator_result').val('');
            }
            else{
                editor.setContent('');
            }
        });
        $('.wpaicg-playground-save').click(function (){
            var wpaicg_draft_btn = $(this);
            var title = $('.wpaicg_prompt').val();
            var editor = tinyMCE.get('wpaicg_generator_result');
            var basicEditor = true;
            if ( $('#wp-wpaicg_generator_result-wrap').hasClass('tmce-active') && editor ) {
                basicEditor = false;
            }
            var content = '';
            if (basicEditor){
                content = $('#wpaicg_generator_result').val();
            }
            else{
                content = editor.getContent();
            }
            if(title === ''){
                alert('Please enter title');
            }
            else if(content === ''){
                alert('Please wait content generated');
            }
            else{
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php')?>',
                    data: {title: title, content: content, action: 'wpaicg_save_draft_post_extra'},
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function (){
                        wpaicg_draft_btn.attr('disabled','disabled');
                        wpaicg_draft_btn.append('<span class="spinner"></span>');
                        wpaicg_draft_btn.find('.spinner').css('visibility','unset');
                    },
                    success: function (res){
                        wpaicg_draft_btn.removeAttr('disabled');
                        wpaicg_draft_btn.find('.spinner').remove();
                        if(res.status === 'success'){
                            window.location.href = '<?php echo admin_url('post.php')?>?post='+res.id+'&action=edit';
                        }
                        else{
                            alert(res.msg);
                        }
                    },
                    error: function (){
                        wpaicg_draft_btn.removeAttr('disabled');
                        wpaicg_draft_btn.find('.spinner').remove();
                        alert('Something went wrong');
                    }
                });
            }
        })
    })
</script>
