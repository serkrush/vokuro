<?php
namespace Vokuro\Forms;

use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;

class ShopForm extends Form
{

    public function initialize($entity = null, $options = null)
    {

        // In edition the id is hidden
        if (isset($options['edit']) && $options['edit']) {
            $idshop = new Hidden('idshop');
        } else {
            $idshop = new Text('idshop');
        }

        $this->add($idshop);

        $nameshop = new Text('nameshop', [
            'placeholder' => 'Name'
        ]);

        $nameshop->addValidators([
            new PresenceOf([
                'message' => 'The name is required'
            ])
        ]);

        $this->add($nameshop);

        $adresshop = new TextArea('adresshop', [
            'placeholder' => 'Address'
        ]);

        $adresshop->addValidators([
            new PresenceOf([
                'message' => 'The address is required'
            ])
        ]);

        $this->add($adresshop);

    }
}
