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
     */
    public function renderForTable($input)
    {
        // If there is right field then call renderer of this field
        if ($input instanceof Application) {

            $input->field->setDefautlView('indexTable');
        }
    }
	
	 /**
     * The function is intended for cleaning html code
     * @return array
     */

    public function __async_clearHtml()
    {
        // Tags that do not change
        $allowed_tags = '<b><i><sup><sub><em><strong><u><br><p><table><tr><td><tbody><thead><h1><h2><h3><h4><img><a>';
        // Getting html value
        $html = json_decode(file_get_contents('php://input'), true);
        // Replace tags class
        $html = strip_tags($html['html'], $allowed_tags);
        // Replace tags class
        $html = preg_replace("/<([^>]*)(class)=(\"[^\"]*\"|'[^']*'|[^>]+)([^>]*)>/","<\$1>", $html);
        // Replace tags lang
        $html = preg_replace("/<([^>]*)(lang)=(\"[^\"]*\"|'[^']*'|[^>]+)([^>]*)>/","<\$1>", $html);
        // Replace tags style
        $html = preg_replace("/<([^>]*)(style)=(\"[^\"]*\"|'[^']*'|[^>]+)([^>]*)>/","<\$1>", $html);
        // Replace tags size
        $html = preg_replace("/<([^>]*)(size)=(\"[^\"]*\"|'[^']*'|[^>]+)([^>]*)>/","<\$1>", $html);
        // Replace all transfers and &nbsp;
        $html = str_replace(array("\r\n", "\r", "\n", '&nbsp;'), ' ', $html);
        // Replace empty tags p and b
        $html = str_replace(array("<p> </p>", "<p></p>", "<b> </b>", "<b></b>"), '', $html);
        // Added border to table
        $html = str_replace(array("<table"), '<table border="1"', $html);

        return array('status' => 1, 'data' => $html);
    }
}
