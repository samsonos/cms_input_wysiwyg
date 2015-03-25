<?php
namespace samsoncms\input\wysiwyg;

use samsoncms\input\Field;

/**
 * SamsonCMS WYSIWYG input field
 * @author Vitaly Iegorov<egorov@samsonos.com>
 */
class WYSIWYG extends Field
{
    /** @var  int Field type identifier */
    protected static $type = 8;

    /** @var string Module identifier */
    public $id = 'samson_cms_input_wysiwyg';

    /** @var string Special CSS classname for nested field objects to bind JS and CSS */
    protected $cssClass = '__wysiwyg';

    public function __async_upload()
    {
        $result = array('status' => false);
        /** @var \samsonphp\upload\Upload $upload  Pointer to uploader object */
        $upload = null;
        if (uploadFile($upload)) {
            $result['status'] = true;
            $result['tag'] = '<img src="' . $upload->fullPath() . '">';
        }
        return $result;
    }
}