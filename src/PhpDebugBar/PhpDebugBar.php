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
use PhpDebugBar\DataCollector\UserCollector;

class PhpDebugBar extends  DebugBar{

    protected $params;

    public function __construct()
    {
        $this->addCollector(new PhpInfoCollector());
        $this->addCollector(new MessagesCollector());
        $this->addCollector(new RequestDataCollector());
        $this->addCollector(new TimeDataCollector());
        $this->addCollector(new MemoryCollector());
        $this->addCollector(new ExceptionsCollector());
        $this->addCollector(new IpCollector());
        $this->addCollector(new UserCollector());
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }
    public function addParam($key,$params)
    {
        $this->params[$key] = $params;
        return $this;
    }

    /**
     *
     * @param $params
     * @return bool
     */
    public function mayBeDisplayed(){
        if(isset($this->params['render']))
            if($this->params['render']===true){
                return true;
            }
        if(isset($this->params['regExIp'])){
            $ip = $_SERVER['REMOTE_ADDR'];
            if(preg_match($this->params['regExIp'],$ip)){
                return true;
            }
        }

        return false;
    }
} 