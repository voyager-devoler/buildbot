<?php
/**
 * Description of Produce
 *
 * @author voyager
 */
class Model_Events_Produce extends Model_Event {
    public $product;
    public $quantity;
    public $building;
    
    public function __construct($product_id, $building_id) {
        $this->product = new Model_Product($product_id);
        $this->building = Model_Player::getInstance()->buildings[$building_id];
        if ($this->building->id != $this->product->building_id)
            throw new Exception ("Incorrect building type {$this->building->label} to produce {$this->product->name}");
        if ($this->building->state != 'ready')
            throw new Exception ("Incorrect building state {$this->building->state} in {$this->building->label} to start produce {$this->product->name}");
        parent::__construct('produce', Model_Timeline::getInstance()->current_time, $this->product->minutes);
        $this->building->state = 'production';
    }
}
