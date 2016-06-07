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
        $building_for_build = new Model_Building(getBuildingIdByLabel($building_label));
        // проверка по ресурсам
        foreach($building_for_build->getResources(1) as $res_id=>$need_quantity)
        {
            if (Model_Player::getInstance()->storage[$res_id] 
                + Model_Timeline::getInstance()->getQuantityProductInProduction($res_id) 
                - Model_Timeline::getInstance()->reserve[$res_id] < $need_quantity)
            {// нужно запустить еще в производство
                $this->startProduction($product_id);
            }
        }
        // проверка по деньгам
        
        $target_building = Model_Player::getInstance()->getFreeTargetBuilding('builderhouse');
        if ($target_building == FALSE)
        {
            return FALSE;
        }
    }
    
    public function startUpgrade($building_id)
    {
        
    }
    
    public function startProduction($product_id)
    {
        $product_for_produce = new Model_Product($product_id);
        foreach ($product_for_produce->ingridients as $ingridient_id=>$ingridient_quantity)
        {
            
        }
        $target_building = Model_Player::getInstance()->getFreeTargetBuilding(getBuildingLabelById($product_for_produce->building_id));
        if ($target_building == FALSE)
        {
            return false;
        }
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
