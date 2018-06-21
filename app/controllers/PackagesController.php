<?php
/**
 * Created by PhpStorm.
 * User: kalin-mv
 * Date: 14.09.17
 * Time: 9:20
 */

namespace Vokuro\Controllers;

use Phalcon\Paginator\Adapter\Model as Paginator;
use Vokuro\Forms\CsvForm;
use Vokuro\Models\VkMainTable;
use Vokuro\Models\VkTable1;
use Vokuro\Result;
use Vokuro\Models\Product;

class PackagesController extends ControllerBase
{
    public function indexAction() {

        $numberPage = $this->request->getPost('page', 'int', 1);
        $perPage = $this->request->getPost('per_page', 'int', 8);
        $post = $this->request->getPost();

        if (empty($_POST["search"])) {
            $paginator = new Paginator(array(
                "data" => VkMainTable::findBySearchFilter($post),
                "limit" => $perPage,
                "page" => $numberPage
            ));
            $page = $paginator->getPaginate();
            $this->view->page = $page;
        }

        if (empty($_POST["prod"])) {
            $productPaginator = new Paginator(array(
                "data" => Product::findBySearchFilter($post),
                "limit" => $perPage,
                "page" => $numberPage
            ));
            $productPage = $productPaginator->getPaginate();
            $this->view->productPage = $productPage;
        }

        $this->view->form = new CsvForm();

        if (!$this->request->isAjax()) {
            $this->css(["bootstrap-datepicker.css", "packages_index"]);
            $this->js(["bootstrap-datepicker.js","bootstrap-typehead.js","packages_index.js"]);
            $this->init("packages.init()");
        } else {
            $this->result( array(
                'html' => $this->partial->render("packages/list", ["page" => $page]),
                'htmlProd' => $this->partial->render("packages/listProducts", ["page" => $productPage]),
                "page" => $numberPage
            ) );
        }
    }

    public function typeheadAction() {
        $result = array();
        if ($this->request->isAjax()) {
            $name = $this->request->getPost('package_id', 'string');
            $localities = VkTable1::findByPackageId($name);
            $result["packages"] = array();
            if ($localities->count() > 0) {
                foreach ($localities as $item) {
                    $result["packages"][$item->getPackageId()] = array(
                        "id" => $item->getPackageId(),
                        "typehead" => $item->getPackageId(),
                        "displayname" => $item->getPackageId()
                    );
                }
            }
        }
        $this->result($result);
    }

    public function validateAction() {
        $result = Result::to("", false);
        $post = $this->request->getPost();

        $items = VkMainTable::findBySearchFilter($post);
        if ($items->count() <= 0) {
            $result = Result::to("There is not any packages for this period of time");
        }
        $this->result($result);
    }

    public function exportAction() {
        $post = $this->request->get();

        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=packages.csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        $fh = fopen('php://output', 'rw');
        fputcsv($fh, [
            "did",
            "package_id",
            "first_name",
            "sure_name",
            "created_at",
            "address_1",
            "address_2",
            "postcode",
            "email",
            "sms",
            "txt",
            "mail",
            "transaction_id",
            "amount",
        ]);

        $items = VkMainTable::findBySearchFilter($post);
        foreach ( $items as $row ) {
            $t1 = $row->getVkTable1();
            $t2 = $row->getVkTable2();
            $t3 = $row->getVkTable3();
            $t4 = $row->getVkTable4();
            $line = [
                $t1->getDid(),
                $t1->getPackageId(),
                $t1->getFirstName(),
                $t1->getSureName(),
                $this->locale->format($t1->getCreatedAt()),
                $t2?$t2->getAddress1():"",
                $t2?$t2->getAddress2():"",
                $t2?$t2->getPostcode():"",
                $t3?$t3->getEmail():"",
                $t3?$t3->getSms():"",
                $t3?$t3->getTxt():"",
                $t3?$t3->getMail():"",
                $t4?$t4->getTransactionId():"",
                $t4?$t4->getAmount():""
            ];
            fputcsv($fh, $line);
        }
        rewind($fh);
        $csv = stream_get_contents($fh);
        fclose($fh);
        return $csv;
    }
}