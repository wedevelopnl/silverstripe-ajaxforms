# SilverStripe Ajax Forms

## Introduction

Ajax forms for silverstripe, using jquery and jquery validate

## Requirements

* SilverStripe CMS ^4.0
* jQuery
* jQuery validate

## Installation

```
composer require "thewebmen/silverstripe-ajaxforms"
```

## How to use
Make sure you have jquery and jquery validate loaded on your pages with ajax forms.
Also include the following js file:
```
Requirements::javascript('thewebmen/silverstripe-ajaxforms:resources/js/ajaxforms.js');
```
Then create a form by extending the class TheWebmen\Ajaxforms\AjaxForm that returns an instance of the TheWebmen\Ajaxforms\AjaxFormResponse class on success.
### Form example
```
use TheWebmen\Ajaxforms\AjaxForm;
use SilverStripe\Control\RequestHandler;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\RequiredFields;

class ExampleForm extends AjaxForm {

    public function __construct(RequestHandler $controller = null)
    {
        $fields = new FieldList(array(
            TextField::create('MyField', 'This is a field')
        ));

        $actions = new FieldList(array(
           FormAction::create('handle', 'Send')
        ));

        $validator = new ExampleFormValidator(array(
            'MyField'
        ));

        parent::__construct($controller, 'MyField', $fields, $actions, $validator);
    }

    public function handle($data){
        $response = new \TheWebmen\Ajaxforms\AjaxFormResponse();
        return $response->redirect('http://www.google.nl');
    }

}

class ExampleFormValidator extends RequiredFields {

    public function php($data)
    {
        $valid = parent::php($data);
        if($data['MyField'] != 'Test'){
            $this->validationError(
                'MyField',
                'This field is only valid if the value is: Test',
                'required'
            );
            $valid = false;
        }
        return $valid;
    }

}
```
Form errors are displayed using jQuery validate, you can initiate your own jQuery validate to customize the settings or you can let the ajaxforms.js script handle this to use jQuery validate's default settings.

The class ".is-posting" is added to the form while it is positing, you should use this class to add some progress styling.

## Todo
* Improve documentation
* Add check if page exist for the redirectToPage response
