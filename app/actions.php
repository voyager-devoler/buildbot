<?php
/**
 * Description of actions
 *
 * @author voyager
 */
class actions {
    /**
     * 
     * @param string $building_label
     * @return bool action success state
     */
    public function startBuilding($building_label)
    {
        $building = new Model_Building(getBuildingIdByLabel($building_label));
        // проверка по ресурсам
        foreach($building->getResources(1) as $res_id=>$need_quantity)
        {
            //if (Model_Player)
        }
        // проверка по деньгам
        
        $target_building = Model_Player::getInstance()->getFreeTargetBuilding('builderhouse');
        if ($target_building == FALSE)
        {
            
        }
    }
    
    public function startUpgrade($building_id)
    {
        
    }
    
    public function startProduction($building_id, $product_id)
    {
        
    }
    
    public function collectProducts($building_id)
    {
        
    }
    
    public function collectMoney($building_id)
    {
        
    }
    
    public function finishBuilding($building_id)
    {
        
    }

    public function finishUpgrade($building_id)
    {
        
    }

    public function initPlayer()
    {
        $player = Model_Player::getInstance();
        $all_products_ids = dbLink::getDB()->selectCol('select id from mi_products where 1');
        foreach ($all_products_ids as $pid)
        {
            $player->storage[$pid] = 0;
        }
    }
}
