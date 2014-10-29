<?php

/**
 * Created by PhpStorm.
 * User: pwilv
 * Date: 23/10/2014
 * Time: 12:29
 */

namespace DebugBar;

class GenericCollector extends \DebugBar\DataCollector\DataCollector implements \DebugBar\DataCollector\Renderable {

    protected $name;
    protected $messages = array();

    public function __construct($name) {
        $this->name = $name;
    }

    function getName() {
        return $this->name;
    }

    function getMessages() {
        return $this->messages;
    }

    function setName($name) {
        $this->name = $name;
        return $this;
    }

    function setMessages($messages) {
        $this->messages = $messages;
        return $this;
    }

    function addMessage($message) {
        //$this->messages[] = $this->stringify($message);
        $this->messages[] = $this->getDataFormatter()->formatVar($message);
        return $this;
    }

    public function stringify($message) {
        $s = "";
        foreach ($message as $property => $value) {
            $s.='' . $property . ' : ' . $value . "\n";
        }
        return $s;
    }

    /*     * **************************************** */

    public function collect() {
        $msg = $this->getMessages();
        return array(
            'count' => count($msg),
            'messages' => $msg
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
