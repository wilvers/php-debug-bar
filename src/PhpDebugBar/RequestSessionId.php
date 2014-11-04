<?php

namespace PhpDebugBar;

/**
 * Description of RequestSessionId
 *
 * @author pwilv
 */
class RequestSessionId implements \DebugBar\RequestIdGeneratorInterface {

    //put your code here
    public function generate() {
        return session_id();
    }

}
