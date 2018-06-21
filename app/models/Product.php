<?php

namespace Vokuro\Models;

class Product extends BaseModel
{

    /**
     *
     * @var integer
     */
    protected $product_id;

    /**
     *
     * @var integer
     */
    protected $package_id;

    /**
     *
     * @var string
     */
    protected $product_name;

    /**
     *
     * @var string
     */
    protected $price;

    /**
     *
     * @var integer
     */
    protected $product_count;

    /**
     *
     * @var integer
     */
    protected $created_at;

    /**
     *
     * @var integer
     */
    protected $update_at;

    /**
     * Method to set the value of field product_id
     *
     * @param integer $product_id
     * @return $this
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;

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
     * Method to set the value of field product_name
     *
     * @param string $product_name
     * @return $this
     */
    public function setProductName($product_name)
    {
        $this->product_name = $product_name;

        return $this;
    }

    /**
     * Method to set the value of field price
     *
     * @param string $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Method to set the value of field product_count
     *
     * @param integer $product_count
     * @return $this
     */
    public function setProductCount($product_count)
    {
        $this->product_count = $product_count;

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
     * Method to set the value of field update_at
     *
     * @param integer $update_at
     * @return $this
     */
    public function setUpdateAt($update_at)
    {
        $this->update_at = $update_at;

        return $this;
    }

    /**
     * Returns the value of field product_id
     *
     * @return integer
     */
    public function getProductId()
    {
        return $this->product_id;
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
     * Returns the value of field product_name
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * Returns the value of field price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the value of field product_count
     *
     * @return integer
     */
    public function getProductCount()
    {
        return $this->product_count;
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
     * Returns the value of field update_at
     *
     * @return integer
     */
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("vokuro");
        $this->setSource("products");
        $this->belongsTo('package_id', 'Vokuro\Models\VkTable1', 'id', ['alias' => 'Package']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'products';
    }

    public function beforeValidationOnCreate() {
        $this->created_at = time();
    }

    public function beforeValidationOnUpdate() {
        $this->update_at = time();
    }

    public static function findBySearchFilter($filter) {

        $query = self::query();

        if (!empty($filter["pkg_id"])) {
            $query->andWhere(" package_id = " . $filter["pkg_id"]);
        }

        return $query->execute();

    }

    public static function findMy($filter) {
        $query = self::query();
        return $query->execute();
    }

}
