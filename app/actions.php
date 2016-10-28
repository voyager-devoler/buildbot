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
        $enought_res_to_start = true;
        foreach($building_for_build->getResources(1) as $res_id=>$need_quantity)
        {
            if (Model_Player::getInstance()->storage[$res_id] 
                + Model_Timeline::getInstance()->getQuantityProductInProduction($res_id) 
                - Model_Timeline::getInstance()->reserve[$res_id] < $need_quantity)
            {// нужно запустить еще в производство
                $res = new Model_Product($res_id);
                Model_Timeline::getInstance()->add2log("I don't have anought resource {$res->name}");
                $enought_res_to_start = false;
                $this->startProduction($res_id);
            }
        }
        if ($enought_res_to_start == false)
            return false;
        // проверка по деньгам
        
        $target_building_id = Model_Player::getInstance()->getFreeTargetBuildingId('builderhouse');
        if ($target_building_id === FALSE)
        {
            Model_Timeline::getInstance()->add2log("All builderhouses are busy");
            return FALSE;
        }
        return Model_Timeline::getInstance()->addBuildEvent($target_building_id, $building_label);
    }
    
//    public function startUpgrade($building_id)
//    {
//        
//    }
    
    /**
     * 
     * @param int $product_id
     * @return Model_Events_Produce
     */
    public function startProduction($product_id)
    {
        $product_for_produce = new Model_Product($product_id);
        $product_for_produce->fillIngredients();
        $enought_res_to_start = true;
        foreach ($product_for_produce->ingredients as $ingridient_id=>$ingredient) /* @var $ingredient Model_Ingredient */
        {
            $proficit = Model_Player::getInstance()->storage[$ingridient_id]
                + Model_Timeline::getInstance()->getQuantityProductInProduction($product_id)
                - Model_Timeline::getInstance()->reserve[$product_id];
            if ($proficit < $ingredient->base_quantity)
            {// запускаем производство
                $enought_res_to_start = false;
                $prod_event = $this->startProduction($product_id);
                if ($prod_event !== false)
                {
                    if ($prod_event->quantity > $ingredient->base_quantity - $proficit)
                        $reserve_add = $ingredient->base_quantity - $proficit;
                    else
                        $reserve_add = $prod_event->quantity;
                    Model_Timeline::getInstance()->reserve[$product_id] += $reserve_add;
                }
            }
        }
        if ($enought_res_to_start)
        {
            $label = getBuildingLabelById($product_for_produce->building_id);
            $target_building_id = Model_Player::getInstance()->getFreeTargetBuildingId($label);
            if ($target_building_id === FALSE)
            {
                Model_Timeline::getInstance()->add2log("All {$label}s are busy");
                return false;
            }
            return Model_Timeline::getInstance()->addProductionEvent($target_building_id, $product_id);
        }
    }
    
//    public function collectProducts($building_id)
//    {
//        
//    }
    
    public function collectMoney($building_id)
    {
        
    }
    
//    public function finishBuilding($building_id)
//    {
//        
//    }
//
//    public function finishUpgrade($building_id)
//    {
//        
//    }

    public function initPlayer()
    {
        $player = Model_Player::getInstance();
        $all_products_ids = dbLink::getDB()->selectCol('select id from mi_products where 1');
        foreach ($all_products_ids as $pid)
        {
            $player->storage[$pid] = 0;
            Model_Timeline::getInstance()->reserve[$pid] = 0;
        }
        $player->storage[2] = 125;
        $player->storage[6] = 75;
        $player->storage[7] = 90;
        $player->storage[12] = 50;
        $player->storage[3] = 50;
        $player->buildings[] = new Model_Building(getBuildingIdByLabel('builderhouse'));
    }
}
