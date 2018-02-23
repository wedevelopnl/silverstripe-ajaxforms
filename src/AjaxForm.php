<?php

namespace TheWebmen\Ajaxforms;

use SilverStripe\Control\RequestHandler;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;

/**
 * Class AjaxForm
 * @package TheWebmen\Ajaxforms
 */
class AjaxForm extends Form
{

    /**
     * AjaxForm constructor.
     * @param RequestHandler|null $controller
     * @param string $name
     * @param FieldList|null $fields
     * @param FieldList|null $actions
     * @param null $validator
     */
    public function __construct(RequestHandler $controller = null, $name = self::DEFAULT_NAME, FieldList $fields = null, FieldList $actions = null, $validator = null)
    {
        parent::__construct($controller, $name, $fields, $actions, $validator);

        $this->disableSecurityToken();
        $this->addExtraClass('ajaxform');
    }

}
