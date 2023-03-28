<div
    style="
        height: 100% !important;
        width: 100% !important;
        min-width: 100%;
        box-sizing: border-box;
        color: #444;
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-weight: normal;
        padding: 0;
        margin: 0;
        margin: 0;
        font-size: 14px;
        line-height: 140%;
        background-color: #f1f1f1;
        text-align: center;
    "
>
    <table
        border="0"
        cellpadding="0"
        cellspacing="0"
        width="100%"
        height="100%"
        class="m_-2718794472276811243body"
        style="
            border-collapse: collapse;
            border-spacing: 0;
            vertical-align: top;
            height: 100% !important;
            width: 100% !important;
            min-width: 100%;
            box-sizing: border-box;
            background-color: #f1f1f1;
            color: #444;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-weight: normal;
            padding: 0;
            margin: 0;
            margin: 0;
            text-align: left;
            font-size: 14px;
            line-height: 140%;
        "
    >
        <tbody>
            <tr style="padding: 0; vertical-align: top; text-align: left;">
                <td
                    align="center"
                    valign="top"
                    style="
                        word-wrap: break-word;
                        border-collapse: collapse !important;
                        vertical-align: top;
                        color: #444;
                        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                        font-weight: normal;
                        padding: 0;
                        margin: 0;
                        margin: 0;
                        font-size: 14px;
                        line-height: 140%;
                        text-align: center;
                    "
                >
                    <table
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        class="m_-2718794472276811243container"
                        style="border-collapse: collapse; border-spacing: 0; padding: 0; vertical-align: top; width: 600px; margin: 0 auto 30px auto; margin: 0 auto 30px auto; text-align: inherit;"
                    >
                        <tbody>
                            <?php if ($settings['email']['logo']): ?>
                            <tr style="padding:0;vertical-align:top;text-align:left">
                                <td align="center" valign="middle" style="word-wrap:break-word;border-collapse:collapse!important;vertical-align:top;color:#444;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-weight:normal;margin:0;margin:0;font-size:14px;line-height:140%;text-align:center;padding:30px 30px 22px 30px">
                                    <img src="<?php echo $settings['email']['logo'] ?>" width="250" alt="WP Mail SMTP Logo" style="outline:none;text-decoration:none;max-width:100%;clear:both;display:inline-block!important;width:250px" class="CToWUd">
                                </td>
                            </tr>
                            <?php endif ?>
                            

                            <tr style="padding: 0; vertical-align: top; text-align: left;">
                                <td
                                    align="left"
                                    valign="top"
                                    class="m_-2718794472276811243content"
                                    style="
                                        word-wrap: break-word;
                                        border-collapse: collapse !important;
                                        vertical-align: top;
                                        color: #444;
                                        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                        font-weight: normal;
                                        margin: 0;
                                        margin: 0;
                                        text-align: left;
                                        font-size: 14px;
                                        line-height: 140%;
                                        background-color: #ffffff;
                                        padding: 60px 75px 45px 75px;
                                        border-right: 1px solid #ddd;
                                        border-bottom: 1px solid #ddd;
                                        border-left: 1px solid #ddd;
                                        border-top: 3px solid #809eb0;
                                    "
                                >
                                    <div >
                                        <p
                                            style="
                                                color: #444;
                                                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                                font-weight: normal;
                                                padding: 0;
                                                font-size: 14px;
                                                line-height: 140%;
                                                margin: 0 auto 16px auto;
                                                margin: 0 auto 16px auto;
                                                text-align: center;
                                            "
                                        >
                                            <img
                                                src="https://ci4.googleusercontent.com/proxy/_FrxL1_v-7Iwshuz1yqzxFtbsYUDK7j9mjQPU_zvg4gVPUWP57GpYb-lU67JkiAuMvHO5xmd6TRDpujFtZSBX-wv3pajlWs8SlJ-DTQC_OOAqOMzUsa40cin8pCTvVCLQkgf7qGRIZVf8h3pCnHW3kg=s0-d-e1-ft#https://taxitoanquoc24h.com/wp-content/plugins/wp-mail-smtp/assets/images/email/icon-check.png"
                                                width="70"
                                                alt="Success"
                                                style="outline: none; text-decoration: none; max-width: 100%; clear: both; display: block; margin: 0 auto 0 auto; margin: 0 auto 0 auto; width: 50px;"
                                                class="CToWUd"
                                            />
                                        </p>
                                        <p
                                            style="
                                                color: #444;
                                                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                                font-weight: normal;
                                                padding: 0;
                                                line-height: 140%;
                                                font-size: 20px;
                                               
                                                margin: 0 0 20px 0;
                                                margin: 0 0 20px 0;
                                            ">Bạn vừa nhận được phản hồi <?php echo get_bloginfo('name') ?>
                                        </p>
                                        <p
                                            style="
                                                color: #444;
                                                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                                font-weight: normal;
                                                padding: 0;
                                                text-align: left;
                                                line-height: 140%;
                                                margin: 0 0 15px 0;
                                                margin: 0 0 15px 0;
                                                font-size: 16px;
                                            "
                                        >
                                           Nội dung: <?php echo $message ?>
                                        </p>
                                        <p
                                            style="
                                                color: #444;
                                                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                                font-weight: normal;
                                                padding: 0;
                                                text-align: left;
                                                line-height: 140%;
                                                margin: 0 0 15px 0;
                                                margin: 0 0 15px 0;
                                                font-size: 16px;
                                            "
                                        >
                                            Phản hồi: <?php echo $reply ?>
                                        </p>
                                        
                                    </div>
                                </td>
                            </tr>

                            <tr style="padding: 0; vertical-align: top; text-align: left;">
                                <td
                                    align="left"
                                    valign="top"
                                    class="m_-2718794472276811243aside"
                                    style="
                                        word-wrap: break-word;
                                        border-collapse: collapse !important;
                                        vertical-align: top;
                                        color: #444;
                                        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                        font-weight: normal;
                                        margin: 0;
                                        margin: 0;
                                        font-size: 14px;
                                        line-height: 140%;
                                        background-color: #f8f8f8;
                                        border-top: 1px solid #dddddd;
                                        border-right: 1px solid #dddddd;
                                        border-bottom: 1px solid #dddddd;
                                        border-left: 1px solid #dddddd;
                                        text-align: center !important;
                                        padding: 30px 75px 25px 75px;
                                    "
                                >
                                    
                                    <center style="width: 100%;">
                                        <table style="border-collapse: collapse; border-spacing: 0; padding: 0; vertical-align: top; text-align: left; color: #e27730; width: 100% !important;">
                                            <tbody>
                                                <tr style="padding: 0; vertical-align: top; text-align: left;">
                                                    <td
                                                        style="
                                                            word-wrap: break-word;
                                                            border-collapse: collapse !important;
                                                            vertical-align: top;
                                                            color: #444;
                                                            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                                            font-weight: normal;
                                                            margin: 0;
                                                            margin: 0;
                                                            text-align: left;
                                                            font-size: 14px;
                                                            line-height: 100%;
                                                            padding: 20px 0 20px 0;
                                                        "
                                                    >
                                                        <table style="border-collapse: collapse; border-spacing: 0; padding: 0; vertical-align: top; text-align: left; width: 100% !important;">
                                                            <tbody>
                                                                <tr style="padding: 0; vertical-align: top; text-align: left;">
                                                                    <td
                                                                        style="
                                                                            word-wrap: break-word;
                                                                            border-collapse: collapse !important;
                                                                            vertical-align: top;
                                                                            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                                                            font-weight: normal;
                                                                            padding: 0;
                                                                            margin: 0;
                                                                            margin: 0;
                                                                            font-size: 14px;
                                                                            text-align: center;
                                                                            color: #ffffff;
                                                                            background: #e27730;
                                                                            border: 1px solid #c45e1b;
                                                                            border-bottom: 3px solid #c45e1b;
                                                                            line-height: 100%;
                                                                        "
                                                                    >
                                                                        <a
                                                                            href="<?php echo get_site_url() ?>"
                                                                            style="
                                                                                margin: 0;
                                                                                margin: 0;
                                                                                font-family: Helvetica, Arial, sans-serif;
                                                                                font-weight: bold;
                                                                                color: #ffffff;
                                                                                text-decoration: none;
                                                                                display: inline-block;
                                                                                border: 0 solid #c45e1b;
                                                                                line-height: 100%;
                                                                                padding: 14px 20px 12px 20px;
                                                                                font-size: 20px;
                                                                                text-align: center;
                                                                                width: 100%;
                                                                                padding-left: 0;
                                                                                padding-right: 0;
                                                                            "
                                                                            target="_blank"
                                                                           
                                                                        >
                                                                            Truy cập website
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="yj6qo"></div>
    <div class="adL"></div>
</div>
