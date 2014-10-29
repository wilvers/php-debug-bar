<?php

namespace DebugBar;

/**
 * Description of RequestIdGenerator
 *
 * @author pwilv
 */
class RequestSessionId implements RequestIdGeneratorInterface {

    //put your code here
    public function generate() {
        return session_id();
    }

}
