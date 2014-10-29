# TODO

# Utilisation

## instance de la debugbar (bar vide)  ou de la bar standard (contient déja des collector)
 
 $debugbar = new StandardDebugBar();
 //$debugbar = new DebugBar();

//création de l'id de request (ici c'est l'id de session)
$debugbar->setRequestIdGenerator(new \DebugBar\RequestSessionId());

//création d'un file storage

  $debugbar->setStorage(new \DebugBar\Storage\FileStorage('/logs/test_dev/'));

// Collector user

  $debugbar->addCollector(new \PhpDebugBar\UserCollector());

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

//collector time
$debugbar['time']->startMeasure('longop', '1function render()');
usleep(500000);

$debugbar['time']->startMeasure('sleep', 'une autre mesure');
usleep(500000);
$debugbar['time']->stopMeasure('sleep');

//collector message
$debugbar["messages"]->addMessage(date("Y/m/d") . ' : msg');

//collector exeception
$debugbar['exceptions']->addException(new Exception('my exception', 1236554));

//peut etre utilisé à la place du collector config
$generic1         = array('part1' => 'debug part1', 'part2' => 'debug part2', 'part3' => 'debug part3');
$debugbar->addCollector(new \PhpDebugBar\GenericCollector('debug1'));
$debugbar->getCollector('debug1')->addMessage($generic1);

$generic2         = array('part1' => 'debug part1', 'part2' => 'debug part2', 'part3' => 'debug part3');
$debugbar->addCollector(new \PhpDebugBar\GenericCollector('debug2'));
$debugbar->getCollector('debug2')->addMessage($generic2);

//on stop le long timer
$debugbar['time']->stopMeasure('longop');

//récup du js
$debugbarRenderer = $debugbar->getJavascriptRenderer();

//à afficher avant la balise de fin </body> ou assigner à la vue, ...
echo $debugbarRenderer->renderHead();
echo $debugbarRenderer->render();