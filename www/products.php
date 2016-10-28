<?php
require_once '../config.php';

if (!isset($_GET['p']))
{
    dbLink::getDB()->select('select * from products where 1');
    
}
