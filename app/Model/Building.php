<?php

class Model_Building extends Model_Abstract
{
    protected $_tablename = 'mi_buildings';
    public $id;
    public $name;
    public $label;
    public $state = 'ready';
    
    public function getResources($level)
    {
        return dbLink::getDB()->selectCol('select res_id as ARRAY_KEY, res_quantity from mi_buildings_levels where bid=?d and level=?d',$this->id,$level);
    }
    
    public function getTime2Build($level)
    {
        return 30; // отакот пока...
    }
    
}

