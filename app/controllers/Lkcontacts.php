<?php
namespace Vokuro\Controllers;

use Vokuro\Models\Contacts;
use Vokuro\Forms\ContactForm;

class AddshopController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateBefore('private');
    }

    public function indexAction()
    {
        echo 111;
    }
}