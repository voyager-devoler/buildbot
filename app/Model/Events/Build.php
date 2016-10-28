<?php

/**
 * Description of Build
 *
 * @author voyager
 */
class Model_Events_Build extends Model_Event {
    public $target_building;
    public $building;
    
    public function __construct($building_type, $building_id) {
        $this->target_building = new Model_Building(getBuildingIdByLabel($building_type));
        $this->building = Model_Player::getInstance()->buildings[$building_id];
        if ($this->building->label != 'builderhouse')
            throw new Exception ("Incorrect building type {$this->building->label} to start building new {$building_type}");
        if ($this->building->state != 'ready')
            throw new Exception ("Incorrect building state {$this->building->state} in {$this->building->label} to start build new {$building_type}");
        foreach($this->target_building->getResources(1) as $resource_id=>$quantity) /* @var $ingredient Model_Ingredient */
        {
            Model_Player::getInstance()->storage[$resource_id]-= $quantity;
            if (Model_Player::getInstance()->storage[$resource_id]<0)
                throw new Exception ("Not enought rsources (id:{$resource_id}) to build {$building_type}");
        }
        parent::__construct('build', Model_Timeline::getInstance()->current_time, $this->target_building->getTime2Build(1));
        $this->building->state = 'production';
    }
    
    public function complete()
    {
        $this->state = 'completed';
        Model_Player::getInstance()->buildings[] = $this->target_building;
        $this->building->state = 'ready';
        Model_Timeline::getInstance()->add2log("{$this->target_building->label} building complete");
    }
}
