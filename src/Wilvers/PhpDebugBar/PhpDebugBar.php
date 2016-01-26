<?php

/**
 * Created by PhpStorm.
 * User: pwilv
 * Date: 3/11/2014
 * Time: 10:15
 */

namespace Wilvers\PhpDebugBar;

use DebugBar\DebugBar;
use DebugBar\DataCollector\PhpInfoCollector;
use DebugBar\DataCollector\MessagesCollector;
use DebugBar\DataCollector\TimeDataCollector;
use DebugBar\DataCollector\RequestDataCollector;
use DebugBar\DataCollector\MemoryCollector;
use DebugBar\DataCollector\ExceptionsCollector;
use Wilvers\PhpDebugBar\DataCollector\IpCollector;
use Wilvers\PhpDebugBar\DataCollector\UserCollector;
use Wilvers\PhpDebugBar\DataCollector\GenericCollector;

class PhpDebugBar extends DebugBar {

    protected $params;

    public function __construct() {
        $this->addCollector(new PhpInfoCollector());
        $this->addCollector(new MessagesCollector());
        $this->addCollector(new RequestDataCollector());
        $this->addCollector(new TimeDataCollector());
        $this->addCollector(new MemoryCollector());
        $this->addCollector(new ExceptionsCollector());
        $this->addCollector(new IpCollector());
        $this->addCollector(new UserCollector());
        $this->addCollector(new GenericCollector('debugBarInfos'));
        $this->addCollector(new GenericCollector('dump'));
    }

    /**
     * @return mixed
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
        $this->params = $params;
        return $this;
    }

    public function addParam($key, $params) {
        $this->params[$key] = $params;
        return $this;
    }

    /**
     *
     * @param $params
     * @return bool
     */
    public function mayBeDisplayed() {
        if (isset($this->params['regExIp'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
            $this->getCollector("debugBarInfos")->addMessage('$_SERVER[REMOTE_ADDR] : ' . $_SERVER['REMOTE_ADDR']);
            $this->getCollector("debugBarInfos")->addMessage('$this.params[regExIp] : ' . $this->params['regExIp']);
            if (preg_match($this->params['regExIp'], $ip)) {
                return $this->params['render'];
            }
        }
        return false;
    }

    /**
     * Returns a JavascriptRenderer for this instance
     *
     * @param string $baseUrl
     * @param string $basePathng
     * @return JavascriptRenderer
     */
    public function getCustomJavascriptRenderer($baseUrl = null, $basePath = null) {
        if ($this->jsRenderer === null) {
            $this->jsRenderer = new \Wilvers\PhpDebugBar\JavascriptRenderer($this, $baseUrl, $basePath);
        }
        return $this->jsRenderer;
    }

}
