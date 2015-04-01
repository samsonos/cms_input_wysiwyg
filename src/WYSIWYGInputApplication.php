<?php
/**
 * Created by Maxim Omelchenko <omelchenko@samsonos.com>
 * on 31.03.2015 at 19:31
 */

namespace samsoncms\input\wysiwyg;

class WYSIWYGInputApplication extends \samsoncms\input\InputApplication
{
    protected $id = 'samson_cms_input_wysiwyg';

    /**
     * Create field class instance
     *
     * @param string|\samson\activerecord\dbRecord $entity Class name or object
     * @param string|null $param $entity class field
     * @param int $identifier Identifier to find and create $entity instance
     * @param \samson\activerecord\dbQuery|null $dbQuery Database object
     * @return self
     */
    public function createField($entity, $param = null, $identifier = null, $dbQuery = null)
    {
        $this->field = new WYSIWYG($entity, $param, $identifier, $dbQuery);
        return $this;
    }

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
