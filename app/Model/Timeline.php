<?php
/**
 * Description of Timeline
 *
 * @author voyager
 */
class Model_Timeline {
    protected static $_timeline = null;
    public $current_time;
    public $events = array();
    public $reserve = array();
    
    protected function __construct() {      
        $this->current_time = time();        
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
    
    public function getNearestEvent()
    {
        
    }
    
    public function getQuantityProductInProduction($product_id)
    {
        
    }
}
