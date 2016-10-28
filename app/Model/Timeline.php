<?php
/**
 * Description of Timeline
 *
 * @author voyager
 */
class Model_Timeline {
    protected static $_timeline = null;
    private static $_timeline_log;
    public $current_time = 0;
    public $events = array();
    public $reserve = array();
    
    protected function __construct() {      
        self::$_timeline_log = new log2file('timeline.log');
    }
    
    public function add2log($text)
    {
        self::$_timeline_log->write($this->current_time." min: ".$text);
    }
    
    /**
     * 
     * @return Model_Timeline
     */
    public static function getInstance()
    {
        if (is_null(self::$_timeline))
            self::$_timeline = new self;
        return self::$_timeline;
    }
    
    /**
     * 
     * @return Model_Event
     */
    public function getNearestEventAndSkipTime()
    {
        if (count($this->events) == 0)
            return false;
        $nearest_event = null;
        foreach ($this->events as $event) /* @var $event Model_Event */
        {
            if ($event->state == 'in_progress' && (is_null($nearest_event) || $nearest_event->finish_time > $event->finish_time))
            {
                $nearest_event = $event;
            }
        }
        $this->current_time = $nearest_event->finish_time;
        return $nearest_event;
    }
    
    public function getQuantityProductInProduction($product_id)
    {
        $quantity = 0;
        foreach ($this->events as $event) /* @var $event Model_Event */
        {
            if ($event->type == 'produce' && $event->state == 'in_progress' && $event->product->id == $product_id)
                $quantity += $event->quantity;
        }
        return $quantity;
    }
    
    /**
     * 
     * @param int $building_id
     * @param int $product_id
     * @return \Model_Events_Produce
     */
    public function addProductionEvent($building_id, $product_id)
    {
        $event = new Model_Events_Produce($product_id, $building_id);
        $this->events[] = $event;
        return $event;
    }
    
    public function addBuildEvent($building_id, $target_building_type)
    {
        $event = new Model_Events_Build($target_building_type, $building_id);
        $this->events[] = $event;
        return $event;
    }
}
