<?php
namespace Vokuro\Controllers;

class ContactsController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
    }
}