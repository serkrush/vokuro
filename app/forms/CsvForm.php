<?php
/**
 * Created by PhpStorm.
 * User: kalin-mv
 */

namespace Vokuro\Forms;


use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Vokuro\Models\VkTable1;

class CsvForm extends BaseForm
{

    public function initialize() {

        $fromTime = new Text('from_time', array(
          'class' => 'form-control',
          'placeholder' => "Date..."
        ));
        $fromTime->setLabel('From Time');
        $fromTime->addFilter("int");
        $this->add($fromTime);

        $toTime = new Text('to_time', array(
            'class' => 'form-control',
            'placeholder' => "Date..."
        ));
        $toTime->setLabel('To Time');
        $toTime->addFilter("int");
        $this->add($toTime);

        $select = new Select('package_id', VkTable1::findPackages(), array(
            'using' => array(
                'package_id',
                'package_id'
            ),
            'useEmpty' => true,
            'emptyText' => '...',
            'emptyValue' => ''
        ));
        $select->setLabel("Package ID");
        $select->addValidators(array(
            new PresenceOf(array('message' => "Package ID is required"))
        ));
        $this->add($select);
    }

}

