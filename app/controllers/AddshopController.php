<?php
namespace Vokuro\Controllers;

use Vokuro\Models\Shops;
use Vokuro\Forms\ShopForm;
use Phalcon\Tag;

class AddshopController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateBefore('private');
    }

    public function indexAction()
    {
        $this->view->form = new ShopForm();

        $form = new ShopForm(null);

        if ($this->request->isPost()) {

            if ($form->isValid($this->request->getPost()) == false) {

                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }

            } else {

                $user = new Shops([
                    'nameshop' => $this->request->getPost('nameshop', 'striptags'),
                    'adresshop' => $this->request->getPost('adresshop', 'striptags')
                ]);

                if (!$user->save()) {
                    $this->flash->error($user->getMessages());
                } else {

                    $this->flash->success("User was created successfully");

                    Tag::resetInput();
                }
            }
        }

        $this->view->form = $form;



    }

}

