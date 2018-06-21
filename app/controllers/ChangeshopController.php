<?php
namespace Vokuro\Controllers;

use Phalcon\Paginator\Adapter\Model as Paginator;
use Vokuro\Models\Shops;
use Vokuro\Forms\ShopForm;
use Vokuro\Result;

class ChangeShopController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateBefore('private');
    }

    public function indexAction()
    {
        $numberPage = $this->request->getPost('page', 'int', 1);
        $perPage = $this->request->getPost('per_page', 'int', 8);
        $post = $this->request->getPost();

        $paginator = new Paginator(array(
            "data" => Shops::findBySearchFilter($post),
            "limit" => $perPage,
            "page" => $numberPage
        ));
        $page = $paginator->getPaginate();
        $this->view->page = $page;

        $this->view->form = new ShopForm();

        if (!$this->request->isAjax()) {
            $this->css(["bootstrap-datepicker.css", "packages_index"]);

            $this->assets->addCss("//use.fontawesome.com/releases/v5.0.13/css/all.css", false);
            $this->js(["bootstrap-datepicker.js","bootstrap-typehead.js","orderTable.js","shop_index.js"]);
            $this->init("shops.init()");
        } else {
            $this->result( array(
                'html' => $this->partial->render("changeShop/listShop", ["page" => $page,
                                                                         "orderByColumn" => $post[orderByColumn],
                                                                         "orderByDirection" => $post[orderByDirection]]),
                "page" => $numberPage
            ) );
        }

    }

    public function deleteAction()
    {
        $r = Result::to("Request not ajax");
        if ($this->request->isAjax()) {
            $r['message'] = 'Shop was not found';
            $post = $this->request->getPost();
            $vShop = Shops::findFirstByIdshop($post[idshop]);
            if (!$vShop->delete()) {
                $r['message'] = 'Shop not delete';
                $this->flash->error($vShop->getMessages());
            } else {
                $r = Result::to("Shop was deleted successfully", true);
            }
        }
        $this->result($r);

    }

    public function updateAction() {
        $r = Result::to("Request not ajax");
        if ($this->request->isAjax()) {
            $r['message'] = 'Shop was not found';
            $post = $this->request->getPost();
            $vShop = Shops::findFirstByIdshop($post[idshop]);
            if ($vShop instanceof Shops) {
                $form = new ShopForm($vShop);
                $vShop->assign([
                    'nameshop' => $post[nameshop],
                    'adresshop' => $post[adresshop]
                ]);
//                foreach ($form->getMessages() as $message) {
//                    $this->flash->error($message);
//                }
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $r['message'] = $message;
                        break;
                    }
                }else {
                    if (!$vShop->save()) {
                        $this->flash->error($vShop->getMessages());
                    } else {
                        $r = Result::to("Shop was updated successfully", true);
                    }
                }
            }
        }
        $this->result($r);
    }
}

