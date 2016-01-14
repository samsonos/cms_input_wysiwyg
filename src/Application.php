<?php
/**
 * Created by Maxim Omelchenko <omelchenko@samsonos.com>
 * on 31.03.2015 at 19:31
 */

namespace samsoncms\input\wysiwyg;

/**
 * SamsonCMS WYSIWYG input module
 * @author Maxim Omelchenko <omelchenko@samsonos.com>
 */
class Application extends \samsoncms\input\Application
{
    /** @var int Field type number */
    public static $type = 8;

    /** @var string SamsonCMS field class */
    protected $fieldClass = '\samsoncms\input\wysiwyg\WYSIWYG';

    public function init(array $params = array())
    {
        \samsonphp\event\Event::subscribe('samson.cms.input.table.render', array($this, 'renderForTable'));
    }

    /**
     * Function to upload images into WYSIWYG
     *
     * @return array Asynchronous result
     */
    public function __async_upload()
    {
        /** @var array $result Asynchronous result array */
        $result = array('status' => false);
        /** @var \samsonphp\upload\Upload $upload  Pointer to uploader object */
        $upload = null;
        // If file was uploaded
        if (uploadFile($upload)) {
            $result['status'] = true;
            $result['tag'] = '<img src="' . $upload->fullPath() . '">';
        }
        // Return result
        return $result;
    }

    /**
     * Change view of wysiwyg for changing dysplaying of field on table row
     * TODO #update 3
     */
    public function renderForTable($input)
    {
        // If there is right field then call renderer of this field
        if ($input instanceof Application) {

            $input->field->setDefautlView('indexTable');
        }
    }
}
