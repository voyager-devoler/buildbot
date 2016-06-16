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
    
    /**
     * 
     * @param int $product_id
     * @param int $building_id
     * @throws Exception
     */
    public function __construct($product_id, $building_id) {
        $this->product = new Model_Product($product_id);
        $this->quantity = $this->product->base_amount;
        $this->building = Model_Player::getInstance()->buildings[$building_id];
        if ($this->building->id != $this->product->building_id)
            throw new Exception ("Incorrect building type {$this->building->label} to produce {$this->product->name}");
        if ($this->building->state != 'ready')
            throw new Exception ("Incorrect building state {$this->building->state} in {$this->building->label} to start produce {$this->product->name}");
        foreach($this->product->ingredients as $ingredient) /* @var $ingredient Model_Ingredient */
        {
            Model_Player::getInstance()->storage[$ingredient->id]-= $ingredient->base_quantity;
            if (Model_Player::getInstance()->storage[$ingredient->id]<0)
                throw new Exception ("Not enought {$ingredient->name} to produce {$this->product->name}");
        }
        parent::__construct('produce', Model_Timeline::getInstance()->current_time, $this->product->minutes);
        $this->building->state = 'production';
    }
    
    public function complete()
    {
        $this->state = 'completed';
        Model_Player::getInstance()->storage[$this->product->id] += $this->quantity;
        $this->building->state = 'ready';
    }
}
