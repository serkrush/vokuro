<?php

namespace Vokuro\Models;

class VkTable4 extends BaseModel
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
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $transaction_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $amount;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $field_1;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $field_2;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $field_3;

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
     * Method to set the value of field transaction_id
     *
     * @param integer $transaction_id
     * @return $this
     */
    public function setTransactionId($transaction_id)
    {
        $this->transaction_id = $transaction_id;

        return $this;
    }

    /**
     * Method to set the value of field amount
     *
     * @param integer $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Method to set the value of field field_1
     *
     * @param string $field_1
     * @return $this
     */
    public function setField1($field_1)
    {
        $this->field_1 = $field_1;

        return $this;
    }

    /**
     * Method to set the value of field field_2
     *
     * @param string $field_2
     * @return $this
     */
    public function setField2($field_2)
    {
        $this->field_2 = $field_2;

        return $this;
    }

    /**
     * Method to set the value of field field_3
     *
     * @param string $field_3
     * @return $this
     */
    public function setField3($field_3)
    {
        $this->field_3 = $field_3;

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
     * Returns the value of field transaction_id
     *
     * @return integer
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    /**
     * Returns the value of field amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Returns the value of field field_1
     *
     * @return string
     */
    public function getField1()
    {
        return $this->field_1;
    }

    /**
     * Returns the value of field field_2
     *
     * @return string
     */
    public function getField2()
    {
        return $this->field_2;
    }

    /**
     * Returns the value of field field_3
     *
     * @return string
     */
    public function getField3()
    {
        return $this->field_3;
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
        return 'vk_table_4';
    }

}
