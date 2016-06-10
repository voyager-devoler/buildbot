<?php
/**
 * Description of Timeline
 *
 * @author voyager
 */
class Model_Timeline {
    protected static $_timeline = null;
    private static $_timeline_log;
    public $current_time;
    public $events = array();
    public $reserve = array();
    
    protected function __construct() {      
        $this->current_time = time();
        self::$_timeline_log = new log2file('timeline.log');
    }
    
    public function add2log($text)
    {
        self::$_timeline_log->write($text);
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
    
    public function getNearestEventAndSkipTime()
    {
        if (count($this->events) == 0)
            return false;
        $nearest_event = null;
        foreach ($this->events as $event) /* @var $event Model_Event */
        {
            if (is_null($nearest_event) || $nearest_event->finish_time > $event->finish_time)
            {
                $nearest_event = $event;
            }
        }
        return $nearest_event;
    }
    
    public function getQuantityProductInProduction($product_id)
    {
        $quantity = 0;
        foreach ($this->events as $event)
        {
            if ($event->type == 'produce' && $event->product->id == $product_id)
                $quantity += $event->quantity;
        }
        return $quantity;
    }
    
    public function addProductionEvent($building_id, $product_id)
    {
        $event = new Model_Events_Produce($product_id, $building_id);
        $this->events[] = $event;
    }
    
    public function addBuildEvent()
    {
        
    }
}
