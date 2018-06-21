<?php

namespace Vokuro\Models;

class VkTable1 extends BaseModel
{

    /**
     *
     * @var integer
     * @Primary
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
    protected $package_id;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=true)
     */
    protected $first_name;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=true)
     */
    protected $sure_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=20, nullable=true)
     */
    protected $created_at;

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
     * Method to set the value of field package_id
     *
     * @param integer $package_id
     * @return $this
     */
    public function setPackageId($package_id)
    {
        $this->package_id = $package_id;

        return $this;
    }

    /**
     * Method to set the value of field first_name
     *
     * @param string $first_name
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Method to set the value of field sure_name
     *
     * @param string $sure_name
     * @return $this
     */
    public function setSureName($sure_name)
    {
        $this->sure_name = $sure_name;

        return $this;
    }

    /**
     * Method to set the value of field created_at
     *
     * @param integer $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

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
     * Returns the value of field package_id
     *
     * @return integer
     */
    public function getPackageId()
    {
        return $this->package_id;
    }

    /**
     * Returns the value of field first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Returns the value of field sure_name
     *
     * @return string
     */
    public function getSureName()
    {
        return $this->sure_name;
    }

    /**
     * Returns the value of field created_at
     *
     * @return integer
     */
    public function getCreatedAt()
    {
        return $this->created_at;
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
        return 'vk_table_1';
    }


    public static function findByPackageId($name) {
        return self::query()
            ->andWhere("package_id LIKE '%".$name."%'")
            ->distinct("package_id")
            ->execute();
    }

    public static function findPackages() {
        return self::query()
            ->distinct("package_id")
            ->execute();
    }
}
