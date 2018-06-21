<?php

namespace Vokuro\Models;

use Phalcon\Validation;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;

class VkTable3 extends BaseModel
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $did;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $email;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $sms;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $txt;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $mail;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field did
     *
     * @param integer $did
     * @return $this
     */
    public function setDid($did)
    {
        $this->did = $did;

        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method to set the value of field sms
     *
     * @param string $sms
     * @return $this
     */
    public function setSms($sms)
    {
        $this->sms = $sms;

        return $this;
    }

    /**
     * Method to set the value of field txt
     *
     * @param string $txt
     * @return $this
     */
    public function setTxt($txt)
    {
        $this->txt = $txt;

        return $this;
    }

    /**
     * Method to set the value of field mail
     *
     * @param string $mail
     * @return $this
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field did
     *
     * @return integer
     */
    public function getDid()
    {
        return $this->did;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field sms
     *
     * @return string
     */
    public function getSms()
    {
        return $this->sms;
    }

    /**
     * Returns the value of field txt
     *
     * @return string
     */
    public function getTxt()
    {
        return $this->txt;
    }

    /**
     * Returns the value of field mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("vokuro");
        $this->belongsTo('did', 'Vokuro\Models\VkMainTable', 'did', ['alias' => 'VkMainTable']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vk_table_3';
    }

}
