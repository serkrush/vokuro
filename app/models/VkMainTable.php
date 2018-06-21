<?php
namespace Vokuro\Models;

class VkMainTable extends BaseModel
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $did;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $user_id;

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
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
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
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasOne('did', 'Vokuro\Models\VkTable1', 'did', ['alias' => 'VkTable1']);
        $this->hasOne('did', 'Vokuro\Models\VkTable2', 'did', ['alias' => 'VkTable2']);
        $this->hasOne('did', 'Vokuro\Models\VkTable3', 'did', ['alias' => 'VkTable3']);
        $this->hasOne('did', 'Vokuro\Models\VkTable4', 'did', ['alias' => 'VkTable4']);
        $this->belongsTo('user_id', 'Vokuro\Models\Users', 'id', ['alias' => 'Users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vk_main_table';
    }

    public static function findBySearchFilter($filter) {
        $query = self::query();

        $main = "Vokuro\Models\VkMainTable";
        $table1 = "Vokuro\Models\VkTable1";

        $query->join($table1, "$table1.did = $main.did");

        $to_time = intval($filter["to_time"]);
        $from_time = intval($filter["from_time"]);
        if (isset($filter["from_time"]) && isset($filter["to_time"])) {
            $to_time = max(intval($filter["to_time"]), intval($filter["from_time"]));
            $from_time = min(intval($filter["to_time"]), intval($filter["from_time"]));
        }

        if (!empty($filter["package_id"])) {
            $query->andWhere("$table1.package_id LIKE '%" . $filter["package_id"] ."%'");
        }

        if ($from_time > 0) {
            $query->andWhere("$table1.created_at >= :from_time:",  array('from_time' => $from_time));
        }

        if ($to_time > 0) {
            $query->andWhere("$table1.created_at <= :to_time:",  array('to_time' => $to_time));
        }

        $query->orderBy("$table1.created_at");
        return $query->execute();

    }

}
