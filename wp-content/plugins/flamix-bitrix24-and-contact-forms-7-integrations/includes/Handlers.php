<?php

namespace Flamix\Bitrix24\CF7;

class Handlers
{
    /**
     * Visited Page
     *
     * @return bool
     */
    public static function trace()
    {
        if (version_compare(PHP_VERSION, '7.2.0') < 0)
            return false;

        $title = @wp_title('', false);

        if (empty($title))
            $title = false;

        \Flamix\Bitrix24\Trace::init($title);
    }


    /**
     * Contact form 7 actions
     *
     * @param $contact_form
     * @return mixed
     */
    public static function cf7_send($contact_form)
    {
        $title = $contact_form->title;
        $submission = \WPCF7_Submission::get_instance();
        $posted_data = $submission->get_posted_data();
        $files = $submission->uploaded_files();

        /**
         * File
         */
        try {
            $files = Helpers::prepareFiles($files);
        } catch (\Exception $e) {
//            echo $e->getMessage();
            Helpers::sendError($e->getMessage());
        }

        $additional_data = array(
            'FIELDS' => array_merge($posted_data, $files, ['TITLE' => $title])
        );

        try {
            return Helpers::send($additional_data);
        } catch (\Exception $e) {
//            echo 'Error: ',  $e->getMessage();
            Helpers::sendError($e->getMessage());
        }
    }
}