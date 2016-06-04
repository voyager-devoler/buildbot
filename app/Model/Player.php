<?php
/**
 * Description of Player
 *
 * @author voyager
 */
class Model_Player extends Model_AbstractStatic {
    private static $_player = null;
    
    public $id;
    public $money = 0;
    public $storage = array();
    public $buildings = array();
    public $events = array();
    
    protected $_tablename = 'mi_players';
    
    /**
     * 
     * @return Model_Player
     */
    public static function getInstance()
    {
        if (is_null(self::$_player))
        {
            self::$_player = new static(CURRENT_PLAYER_ID);
        }
        return self::$_player;
    }
    
    public function changeMoney($val)
    {
        $player->setRowValue('money', $this->money + $val);
    }
    
    public function getFreeTargetBuilding($building_type)
    {
        
    }
    
    public function checkEnoughtResources($res_id, $need_quantity)
    {
        if (!array_key_exists($res_id, $this->storage))
            return false;
        return $this->storage[$res_id]>=$need_quantity;
    }
}
