<?php

namespace Vokuro\Models;

class VkTable2 extends BaseModel
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
     * @Column(type="string", length=255, nullable=true)
     */
    protected $address_1;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $address_2;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $postcode;

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
     * Method to set the value of field address_1
     *
     * @param string $address_1
     * @return $this
     */
    public function setAddress1($address_1)
    {
        $this->address_1 = $address_1;

        return $this;
    }

    /**
     * Method to set the value of field address_2
     *
     * @param string $address_2
     * @return $this
     */
    public function setAddress2($address_2)
    {
        $this->address_2 = $address_2;

        return $this;
    }

    /**
     * Method to set the value of field postcode
     *
     * @param string $postcode
     * @return $this
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

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
     * Returns the value of field address_1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address_1;
    }

    /**
     * Returns the value of field address_2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address_2;
    }

    /**
     * Returns the value of field postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
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
        return 'vk_table_2';
    }

    public function getFullAddress() {
        $result = "";
        if (!empty($this->postcode)) {
            $result .= $this->postcode . ", ";
        }
        if (!empty($this->address_1)) {
            $result .= $this->address_1;
        }
        return $result;
    }
}
