<?php
/**
 * Created by PhpStorm.
 * User: pwilv
 * Date: 3/11/2014
 * Time: 10:15
 */

namespace PhpDebugBar;
use DebugBar\DebugBar;

class PhpDebugBar extends  DebugBar{
    public function __construct()
    {
        $this->addCollector(new PhpInfoCollector());
        $this->addCollector(new MessagesCollector());
        $this->addCollector(new RequestDataCollector());
        $this->addCollector(new TimeDataCollector());
        $this->addCollector(new MemoryCollector());
        $this->addCollector(new ExceptionsCollector());
    }

} 