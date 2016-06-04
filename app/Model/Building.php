<?php

class Model_Building extends Model_Abstract
{
    protected $_tablename = 'mi_buildings';
    public $id;
    public $name;
    public $label;
    
    public function getResources($level)
    {
        return dbLink::getDB()->select('select res_id as ARRAY_KEY, res_quantity from mi_buildings_levels where bid=?d and level=?d',$this->id,$level);
    }
    
}

