<?php
/**
 * Created by PhpStorm.
 * User: kalin-mv
 * Date: 8/18/16
 * Time: 4:48 PM
 */

namespace Vokuro\Forms;


use Vokuro\Models\BaseModel;
use Phalcon\Forms\Form;

class BaseForm extends Form {

    /**
     * Prints messages for a specific element
     */
    public function messages($name) {

        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
                break;
            }
        }

        if ($this->_entity instanceof BaseModel){
            $messages = $this->_entity->getMessages();
            if ($messages) {
                foreach ($this->_entity->getMessages($name) as $message) {
                    if ($message->getField() == $name) {
                        $this->flash->error($message);
                        break;
                    }
                }
            }
        }
    }
    
    public function setData($option = array()) {
        $elements = $this->getElements();
        foreach ($elements as $item) {
            if (isset($option[$item->getName()])) {
                $item->setDefault($option[$item->getName()]);    
            }
        }
    }

    public function getData() {
        $result = array();
        $elements = $this->getElements();
        foreach ($elements as $item) {
            $result[$item->getName()] = $item->getValue();
        }
    }

    public function clearError() {
        $this->_messages = array();
    }

}