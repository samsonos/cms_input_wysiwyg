<?php
namespace samsoncms\input\wysiwyg;

use samsoncms\input\Field;

/**
 * SamsonCMS WYSIWYG input field
 * @author Vitaly Iegorov<egorov@samsonos.com>
 */
class WYSIWYG extends Field
{
//    /** @var  int Field type identifier */
//    protected static $type = 8;
//
//    /** @var string Module identifier */
//    public $id = 'samson_cms_input_wysiwyg';

    /** @var string Special CSS classname for nested field objects to bind JS and CSS */
    protected $cssClass = '__wysiwyg';
}
