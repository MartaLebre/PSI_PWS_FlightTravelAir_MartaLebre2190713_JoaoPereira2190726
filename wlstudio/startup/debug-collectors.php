<?php
use Pd\Diagnostics\CacheInfoPanel;
use Pd\Diagnostics\DatabaseInfoPanel;
use Tracy\Debugger;


$cachePanel = new CacheInfoPanel($microtime);
Debugger::getBar()->addPanel($cachePanel);


$dbPanel = new DatabaseInfoPanel($dbp);
Debugger::getBar()->addPanel($dbPanel);
$profiler = new Netpromotion\Profiler\Adapter\TracyBarAdapter();
Debugger::getBar()->addPanel($profiler);


Debugger::$strictMode = true; // display all errors
