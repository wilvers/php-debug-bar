<?php

namespace DebugBar;

/**
 * Description of RequestSessionId
 *
 * @author pwilv
 */
class RequestSessionId implements RequestIdGeneratorInterface {

    //put your code here
    public function generate() {
        return session_id();
    }

}
