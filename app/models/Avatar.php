<?php

namespace Vokuro\Models;

class Avatar extends BaseModel
{

    /**
     *
     * @var integer
     */
    protected $idavatar;

    /**
     *
     * @var string
     */
    protected $nameavatar;

    /**
     *
     * @var integer
     */
    protected $iduser;

    /**
     * Method to set the value of field idavatar
     *
     * @param integer $idavatar
     * @return $this
     */
    public function setIdavatar($idavatar)
    {
        $this->idavatar = $idavatar;

        return $this;
    }

    /**
     * Method to set the value of field nameavatar
     *
     * @param string $nameavatar
     * @return $this
     */
    public function setNameavatar($nameavatar)
    {
        $this->nameavatar = $nameavatar;

        return $this;
    }

    /**
     * Method to set the value of field iduser
     *
     * @param integer $iduser
     * @return $this
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Returns the value of field idavatar
     *
     * @return integer
     */
    public function getIdavatar()
    {
        return $this->idavatar;
    }

    /**
     * Returns the value of field nameavatar
     *
     * @return string
     */
    public function getNameavatar()
    {
        return $this->nameavatar;
    }

    /**
     * Returns the value of field iduser
     *
     * @return integer
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("vokuro");
        $this->setSource("avatar");
        $this->belongsTo('iduser', 'Vokuro\Models\Users', 'id', ['alias' => 'Users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'avatar';
    }

}
