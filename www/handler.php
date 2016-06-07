<?php
class BuildingBusyException extends Exception {}
class InsufficientResourcesException extends Exception {}
class InsufficientMoneyException extends Exception {}

define ('CURRENT_PLAYER_ID', 1);
$targets = array(
    'build:h1',
    'build:farm',
    'build:h1',
    'build:mine',
    'build:mill',
    'build:h2'
);
require_once '../config.php';

$wlog = new log2file('wlog.log');
$wlog->write('Start');
$actions = new actions();
$actions->initPlayer();
$wlog->write('New player has been inited');
do{
    foreach ($targets as $target_key=>$current_target)
    {
        list($action,$params) = explode(':',$current_target);
        $wlog->write("I have to {$action} {$params}");
        if ($actions->startBuilding($params))
        {
            $wlog->write("Start building {$params}");
            unset($targets[$target_key]);
        }
        
    }
}
while (count($targets)>0);
$wlog->write('I won!');
    
function getBuildingIdByLabel($label)
{
    return dbLink::getDB()->selectCell('select id fom mi_buildings where label=?',$label);
}

function getBuildingLabelById($building_id)
{
    return dbLink::getDB()->selectCell('select label fom mi_buildings where id=?d',$building_id);
}