<?php

namespace TheWebmen\Ajaxforms;

use SilverStripe\Control\RequestHandler;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;

class AjaxForm extends Form
{

    public function __construct(RequestHandler $controller = null, $name = self::DEFAULT_NAME, FieldList $fields = null, FieldList $actions = null, $validator = null)
    {
        parent::__construct($controller, $name, $fields, $actions, $validator);

        $this->disableSecurityToken();
        $this->addExtraClass('ajaxform');
    }

}
