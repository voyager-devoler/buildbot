<?php
interface iEvent {
    public function complete();
}
/**
 * Description of Event
 *
 * @author voyager
 */
abstract class Model_Event implements iEvent {
    public $type;
    public $state;
    public $init_time;
    public $finish_time;
    
    public function __construct($type, $init_time, $length) {
        $this->type = $type;
        $this->init_time = $init_time;
        $this->finish_time = $init_time + $length;
        $this->state = 'in_progress';
    }
}
