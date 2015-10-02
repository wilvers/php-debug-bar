<?php

/**
 * Created by PhpStorm.
 * User: pwilv
 * Date: 23/10/2014
 * Time: 12:29
 */

namespace Wilvers\PhpDebugBar\DataCollector;

class UserCollector extends \DebugBar\DataCollector\DataCollector implements \DebugBar\DataCollector\Renderable {

    protected $name;
    protected $user;

    public function __construct($name = 'Users') {
        $this->name = $name;
    }

    /**
     * @param string $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    /**
     * @param mixed $user
     */
    public function addUser($user) {
        $this->user[] = $this->stringify($user);
        //$this->user[] = $this->getDataFormatter()->formatVar($user);
        return $this;
    }

    public function stringify($user) {
        $s = "";
        foreach ($user as $property => $value) {
            $s.='' . $property . ' : ' . $value . "\n";
        }
        return $s;
    }

    /*     * **************************************** */

    public function collect() {
        $users = $this->getUser();
        return array(
            'count' => count($users),
            'messages' => $users
        );
    }

    public function getWidgets() {
        $name = $this->getName();
        return array(
            "$name" => array(
                'icon' => 'list-alt',
                "widget" => "PhpDebugBar.Widgets.VariableListWidget",
//                "widget" => "PhpDebugBar.Widgets.KVListWidget",
                "map" => "$name.messages",
                "default" => "[]"
            ),
            "$name:badge" => array(
                "map" => "$name.count",
                "default" => "null"
            )
        );
    }

}
