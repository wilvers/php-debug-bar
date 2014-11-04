<?php
/**
 * Created by PhpStorm.
 * User: pwilv
 * Date: 4/11/2014
 * Time: 13:56
 */

namespace PhpDebugBar\DataCollector;


class IpCollector  extends \DebugBar\DataCollector\DataCollector implements \DebugBar\DataCollector\Renderable {

    protected $serverIp = 0;
    protected $name = 'ip';


    public function __construct() {
        $this->setServerIp($_SERVER["SERVER_ADDR"]);
    }

    /**
     * @return int
     */
    public function getServerIp()
    {
        return $this->serverIp;
    }

    /**
     * @param int $serverIp
     */
    public function setServerIp($serverIp)
    {
        $this->serverIp = $serverIp;
        return $this;
    }



    public function collect()
    {
        return array(
            'serverIp' => $this->getServerIp(),
        );
    }

    public function getName()
    {
        return $this->name;
    }

    public function getWidgets()
    {
        $name = $this->getName();
        return array(
            "$name" => array(
                "icon" => "signal",
                "tooltip" => "Server IP",
                "map" => "$name.serverIp",
                "default" => "null"
            )
        );
    }
} 