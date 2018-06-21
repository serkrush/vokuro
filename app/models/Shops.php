<?php

namespace Vokuro\Models;

class Shops extends BaseModel
{

    /**
     *
     * @var integer
     */
    protected $idshop;

    /**
     *
     * @var string
     */
    protected $nameshop;

    /**
     *
     * @var string
     */
    protected $adresshop;

    /**
     * Method to set the value of field idshop
     *
     * @param integer $idshop
     * @return $this
     */
    public function setIdshop($idshop)
    {
        $this->idshop = $idshop;

        return $this;
    }

    /**
     * Method to set the value of field nameshop
     *
     * @param string $nameshop
     * @return $this
     */
    public function setNameshop($nameshop)
    {
        $this->nameshop = $nameshop;

        return $this;
    }

    /**
     * Method to set the value of field adresshop
     *
     * @param string $adresshop
     * @return $this
     */
    public function setAdresshop($adresshop)
    {
        $this->adresshop = $adresshop;

        return $this;
    }

    /**
     * Returns the value of field idshop
     *
     * @return integer
     */
    public function getIdshop()
    {
        return $this->idshop;
    }

    /**
     * Returns the value of field nameshop
     *
     * @return string
     */
    public function getNameshop()
    {
        return $this->nameshop;
    }

    /**
     * Returns the value of field adresshop
     *
     * @return string
     */
    public function getAdresshop()
    {
        return $this->adresshop;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("vokuro");
        $this->setSource("shops");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'shops';
    }

    public static function findBySearchFilter($filter) {

        $query = self::query();

        if (!empty($filter["nameshop"])) {
            $query->andWhere(" nameshop = \"" . $filter["nameshop"] . "\"");
        }
        if (!empty($filter["adresshop"])) {
            $query->andWhere(" adresshop = \"" . $filter["adresshop"] . "\"");
        }

        if (!empty($filter["orderByDirection"])) {
            $query->orderBy($filter["orderByColumn"] . " " . $filter["orderByDirection"]);
        }

        return $query->execute();

    }

}
