<?php
/**
 * Created by PhpStorm.
 * User: pwilv
 * Date: 3/11/2014
 * Time: 10:15
 */

namespace PhpDebugBar;
use DebugBar\DebugBar;
use DebugBar\DataCollector\PhpInfoCollector;
use DebugBar\DataCollector\MessagesCollector;
use DebugBar\DataCollector\TimeDataCollector;
use DebugBar\DataCollector\RequestDataCollector;
use DebugBar\DataCollector\MemoryCollector;
use DebugBar\DataCollector\ExceptionsCollector;
use PhpDebugBar\DataCollector\IpCollector;

class PhpDebugBar extends  DebugBar{
    public function __construct()
    {
        $this->addCollector(new PhpInfoCollector());
        $this->addCollector(new MessagesCollector());
        $this->addCollector(new RequestDataCollector());
        $this->addCollector(new TimeDataCollector());
        $this->addCollector(new MemoryCollector());
        $this->addCollector(new ExceptionsCollector());
        $this->addCollector(new IpCollector());
    }

} 