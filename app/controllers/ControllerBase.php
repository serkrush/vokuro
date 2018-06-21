<?php
namespace Vokuro\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use Vokuro\Result;

/**
 * ControllerBase
 * This is the base controller for all controllers in the application
 *
 * @property \Vokuro\Auth\Auth auth
 */
class ControllerBase extends Controller
{
    /**
     * Array key valus for passing to client side.
     * All options available from Main class (main.js).
     *
     * @var array
     */
    private $_options = array();

    /**
     * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
     * public controller that is open to all.
     *
     * @param Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $this->assets->collection('css');
        $this->assets->collection('css_IE');
        $this->assets->collection('js');
        $this->assets->collection('main');
        $this->assets->collection('script');

        $this->view->setVar('init_js', "");
        $this->view->setTemplateBefore('public');
        $controllerName = $dispatcher->getControllerName();

        // Include main global JS for project
        $this->assets->collection('js')->addJs('js/main.js');

        // Only check permissions on private controllers
        if ($this->acl->isPrivate($controllerName)) {

            // Get the current identity
            $identity = $this->auth->getIdentity();

            // If there is no identity available the user is redirected to index/index
            if (!is_array($identity)) {

                $this->flash->notice('You don\'t have access to this module: private');

                $dispatcher->forward([
                    'controller' => 'index',
                    'action' => 'index'
                ]);
                return false;
            }

            // Check if the user have permission to the current option
            $actionName = $dispatcher->getActionName();
            if (!$this->acl->isAllowed($identity['profile'], $controllerName, $actionName)) {

                $this->flash->notice('You don\'t have access to this module: ' . $controllerName . ':' . $actionName);

                if ($this->acl->isAllowed($identity['profile'], $controllerName, 'index')) {
                    $dispatcher->forward([
                        'controller' => $controllerName,
                        'action' => 'index'
                    ]);
                } else {
                    $dispatcher->forward([
                        'controller' => 'user_control',
                        'action' => 'index'
                    ]);
                }

                return false;
            }

            $this->view->setTemplateBefore('private');
        }
    }

    public function afterExecuteRoute($dispatcher) {

        $options = json_encode($this->_options);
        $script = "jQuery(function () { try { m.init($options); } catch(e){ alert('VK TEST JS INIT ERROR: ' + e) }; });";
        $this->assets->collection('main')->addInlineJs($script);
    }

    /**
    * include CSS files to web page.
    */
    private function include_css($url_file, $browser = "") {
        if (file_exists(getcwd()."/".$url_file)) {
            switch($browser) {
                case "IE" :
                    $this->assets->collection('css_IE')->addCss($url_file);
                    break;
                default:
                    $this->assets->collection('css')->addCss($url_file);
                    break;
            }
        }
    }

    public function css($fileName) {
        if (!empty($fileName)) {
            $files = is_array($fileName)?$fileName:array($fileName);
            foreach ($files as $file) {
                $parts = pathinfo($file);
                $ext = empty($parts["extension"])?"css":$parts["extension"];
                $dir = isset($parts["dirname"]) && $parts["dirname"] != "."?$parts["dirname"]."/":"";
                $this->include_css("css/".$dir.$parts["filename"].".".$ext);     // Include base CSS file
                $this->include_css("css/".$dir.$parts["filename"].".ie.".$ext, "IE");  // Include base CSS file for IE.
            }
        }
    }

    /*
    * include Java Script files to web page.
    */
    public function js($fileName) {
        if (!empty($fileName)) {
            $files = is_array($fileName)?$fileName:array($fileName);
            foreach ($files as $file) {
                $parts = pathinfo($file);
                $ext = empty($parts["extension"])?"js":$parts["extension"];
                $dir = isset($parts["dirname"]) && $parts["dirname"] != "."?$parts["dirname"]."/":"";
                $file = "js/".$dir.$parts["filename"].".".$ext;
                if (file_exists(getcwd()."/".$file)) {
                    $this->assets->collection('js')->addJs($file);
                }
            }
        }
    }

    /*
     * initialization of Java Script files
     */
    public function init($init) {
        if (!empty ($init)) {
            $script = "";
            $init = is_array($init)?$init:array($init);
            foreach ($init as $value) {
                $script .= trim($value).";";
            }
            if (strlen($script) > 0) {
                $script = "jQuery(function () { try { $script } catch(e){ alert('MIS JS INIT ERROR: ' + e) }; });\n";
                $this->assets->collection('script')->addInlineJs($script);
            }
        }
    }

    public function options($options) {
        if (isset($options["strings"])) {
            throw new \Exception('You can use "strings" key in options array. Please use another name.');
        }
        if (!empty ($options) && is_array($options)){
            $this->_options = array_merge($this->_options, $options);
        }
    }

    public function result($data = null) {
        if ($this->request->isAjax()) {
            $this->view->disable();
            $result = Result::get($data);
            if (ob_get_contents()) ob_end_clean();
            echo(json_encode($result));
        }
    }
}
