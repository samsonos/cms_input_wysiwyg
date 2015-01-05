<?php
namespace samson\cms\input;

/**
 * SamsonCMS WYSIWYG input field
 * @author Vitaly Iegorov<egorov@samsonos.com>
 */
class WYSIWYG extends Field
{
    /** @var string Module identifier */
    public $id = 'samson_cms_input_wysiwyg';

	/** Special CSS classname for nested field objects to bind JS and CSS */
	protected $cssclass = '__wysiwyg';

    public function __async_upload(){
        $result = array('status' => false);
        /** @var \samson\upload\Upload $upload  Pointer to uploader object */
        $upload = null;
        if (uploadFile($upload)) {
            $result['status'] = true;
            $result['tag'] = '<img src="'.$upload->fullPath().'">';
        }
        return $result;
    }
}