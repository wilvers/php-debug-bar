# Utilisation
## Instance de la debugbar (bar vide)  
    $debugbar = new StandardDebugBar();
     
## Bar standard (contient déja différents collector)
    $debugbar = new DebugBar();

## Création de l'id de request (ici c'est l'id de session)
    $debugbar->setRequestIdGenerator(new \DebugBar\RequestSessionId());
## Création d'un file storage
    $debugbar->setStorage(new \DebugBar\Storage\FileStorage('/logs/test_dev/'));

## Collector user
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

## Collector time
    $debugbar['time']->startMeasure('longop', '1function render()');
    usleep(500000);

    $debugbar['time']->startMeasure('sleep', 'une autre mesure');
    usleep(500000);
    $debugbar['time']->stopMeasure('sleep');
    
    ...
    
    //on stop le long timer 
    $debugbar['time']->stopMeasure('longop');

## Collector message
    $debugbar["messages"]->addMessage(date("Y/m/d") . ' : msg');

## Collector exeception
    $debugbar['exceptions']->addException(new Exception('my exception', 1236554));

## Collector config

## Collector generic
    $generic1         = array('part1' => 'debug part1', 'part2' => 'debug part2', 'part3' => 'debug part3');
    $debugbar->addCollector(new \PhpDebugBar\GenericCollector('debug1'));
    $debugbar->getCollector('debug1')->addMessage($generic1);

    $generic2         = array('part1' => 'debug part1', 'part2' => 'debug part2', 'part3' => 'debug part3');
    $debugbar->addCollector(new \PhpDebugBar\GenericCollector('debug2'));
    $debugbar->getCollector('debug2')->addMessage($generic2);


## Compilation du js
    $debugbarRenderer = $debugbar->getJavascriptRenderer();

## Render du js et du htm avant la balise de fin </body> ou assigner à la vue, ...
    echo $debugbarRenderer->renderHead();
    echo $debugbarRenderer->render();