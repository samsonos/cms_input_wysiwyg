<?php
namespace samsoncms\input\wysiwyg;

use samsoncms\input\Field;

/**
 * SamsonCMS WYSIWYG input field
 * @author Vitaly Iegorov <egorov@samsonos.com>
 * @author Maxim Omelchenko <omelchenko@samsonos.com>
 */
class WYSIWYG extends Field
{
    /** @var string Special CSS classname for nested field objects to bind JS and CSS */
    protected $cssClass = '__wysiwyg';

    /**
     * @param $view
     * TODO #update 4
     */
    public function setDefautlView($view)
    {
        $this->defaultView = $view;
    }
}
