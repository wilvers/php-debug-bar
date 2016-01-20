<?php
/**
 * Created by PhpStorm.
 * User: pwilv
 * Date: 4/11/2014
 * Time: 10:09
 */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_warnings', 1);

require_once('vendor/autoload.php');

/* * ******************************* new debug bar ******************************** */
$debugbar = new \Wilvers\PhpDebugBar\PhpDebugBar();

//var_dump($debugbar);die;
$debugbar->setRequestIdGenerator(new \Wilvers\PhpDebugBar\RequestSessionId());
$debugbar->setStorage(new \DebugBar\Storage\FileStorage('/logs/test_dev/'));

$debugbar->addCollector(new \Wilvers\PhpDebugBar\DataCollector\UserCollector());

$a = array(
    "id" => 256,
    "name" => "pat atrac",
    "login" => "patatrac",
    "email" => "patatrac@deboeck.com"
);
$debugbar->getCollector('Users')->addUser($a);
$a = array(
    "name" => 'patrice Wilvers',
    "id" => '12354',
    "cplt" => 'hehehe'
);
$debugbar->getCollector('Users')->addUser($a);

/* * ******************************* Collector time ******************************** */
$debugbar['time']->startMeasure('longop', '1function render()');
usleep(500000);

$debugbar['time']->startMeasure('sleep', 'une autre mesure');
usleep(500000);
$debugbar['time']->stopMeasure('sleep');

/* * ******************************* Collector message ******************************** */
$debugbar["messages"]->addMessage(date("Y/m/d") . ' : msg');

/* * ******************************* Collector exeception ******************************** */
$debugbar['exceptions']->addException(new Exception('my exception', 1236554));
/* * ******************************* Collector config ******************************** */


/* * ******************************* Collector generic ******************************** */
$generic1 = array('part1' => 'debug part1', 'part2' => 'debug part2', 'part3' => 'debug part3');
$debugbar->addCollector(new \PhpDebugBar\DataCollector\GenericCollector('debug1'));
$debugbar->getCollector('debug1')->addMessage($generic1);

$generic2 = array('part1' => 'debug part1', 'part2' => 'debug part2', 'part3' => 'debug part3');
$debugbar->addCollector(new \PhpDebugBar\DataCollector\GenericCollector('debug2'));
$debugbar->getCollector('debug2')->addMessage($generic2);

/* * ******************************* Compilation du js ******************************** */
$debugbarRenderer = $debugbar->getJavascriptRenderer();

function mdToHtml($str) {
    if (preg_match('/^# /', $str)) {
        $str = str_replace('# ', '', $str);
        $tag = 'h1';
    }
    if (preg_match('/^## /', $str)) {
        $str = str_replace('## ', '', $str);
        $tag = 'h2';
    }
    if (preg_match('/^ {4,}/', $str)) {
        $str = preg_replace(' {3}', '', $str);
        $str = str_replace(' ', '&nbsp;', $str);
        $tag = 'div';
    }


    if (!empty($tag))
        $str = "<$tag class=\"md\">" . $str . "</$tag>";

    return $str;
}
?><!DOCTYPE HTML>
<html>
    <head>
        <title>Example d'utilisation de la debug bar</title>
    </head>
    <style>
        body{font-size: 12px; margin-top: 12px;}
        h1{margin-bottom: 10px;margin-top: 10px;}
        h2{margin: 8px 0px 8px 5px; }
        h3,h4,h5,h6{margin: 6px 0px 6px 10px;}
        div.md{margin-left:15px;background-color: #eeeeee; }
    </style>
    <body>
        <h1>Contenu du fichier readme.md</h1>
<?php
$readme = file('src/PhpDebugBar/readme.md');
foreach ($readme as $md) {
    echo mdToHtml($md);
}

//on stop le long timer
$debugbar['time']->stopMeasure('longop');

//Render du js et du htm avant la balise de fin
echo $debugbarRenderer->renderHead();
echo $debugbarRenderer->render();
?>

    </body>

</html>