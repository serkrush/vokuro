<?php

namespace Vokuro\Models;

class BaseModel extends \Phalcon\Mvc\Model
{

    /**
     * Return config object
     */
    public function config()
    {
        return $this->getDi()->getConfig();
    }

    /**
     * Return session object
     */
    public function session()
    {
        return $this->getDi()->getSession();
    }

    /**
     * @inheritdoc
     *
     * @access public
     * @static
     * @param array|string $parameters Query parameters
     * @return Phalcon\Mvc\Model\ResultsetInterface
     */
    public static function find($parameters = null)
    {
        $parameters = self::softDeleteFetch($parameters);
        return parent::find($parameters);
    }

    /**
     * @inheritdoc
     *
     * @access public
     * @static
     * @param array|string $parameters Query parameters
     * @return Phalcon\Mvc\Model
     */
    public static function findFirst($parameters = null)
    {
        $parameters = self::softDeleteFetch($parameters);
        return parent::findFirst($parameters);
    }

    /**
     * @inheritdoc
     *
     * @access public
     * @static
     * @param array|string $parameters Query parameters
     * @return mixed
     */
    public static function count($parameters = null)
    {
        $parameters = self::softDeleteFetch($parameters);

        return parent::count($parameters);
    }

    /**
     * @inheritdoc
     *
     * @access public
     * @static
     * @param array|string $parameters Query parameters
     * @return mixed
     */
    public static function sum($parameters = null)
    {
        $parameters = self::softDeleteFetch($parameters);

        return parent::sum($parameters);
    }


    /**
     * @inheritdoc
     *
     * @access public
     * @static
     * @param array|string $parameters Query parameters
     * @return mixed
     */
    public static function minimum($parameters = null)
    {
        $parameters = self::softDeleteFetch($parameters);

        return parent::minimum($parameters);
    }

    /**
     * @access protected
     * @static
     * @param array|string $parameters Query parameters
     * @return mixed
     */
    public static function softDeleteFetch($parameters = null)
    {
        if (method_exists(get_called_class(), 'getIsDeleted')) {
            $class = get_called_class();
            $deletedField = 'is_deleted';
            if ($parameters === null) {
                $parameters = $deletedField . ' = 0';
            } else if (is_array($parameters) === false && strpos($parameters, $deletedField) === false) {
                $parameters .= ' AND ' . $class . "." . $deletedField . ' = 0';
            } else if (is_array($parameters) === true) {
                if (isset($parameters[0]) === true && strpos($parameters[0], $deletedField) === false) {
                    $parameters[0] .= ' AND ' . $class . "." .$deletedField . ' = 0';
                } else if (isset($parameters['conditions']) === true && strpos($parameters['conditions'], $deletedField) === false) {
                    $parameters['conditions'] .= ' AND ' . $class . "." . $deletedField . ' = 0';
                } else if (!isset($parameters['conditions'])){
                    $parameters['conditions'] = $class . "." . $deletedField . ' = 0';
                }
            }
        }
        return $parameters;
    }

}