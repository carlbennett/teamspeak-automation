<?php

namespace CarlBennett\TS3Bot\Libraries;

use \CarlBennett\MVC\Libraries\Term;
use \CarlBennett\TS3Bot\Libraries\Bot;
use \TeamSpeak3_Exception as TS3Exception;

class Complaints {

    public static function get() {
        try {
            $complaintList = Bot::$ts3->complaintList();
            Term::stdout('Getting list of complaints...' . PHP_EOL);
        } catch (TS3Exception $err) {
            if ($err->getMessage() === 'database empty result set') {
                $complaintList = array();
            } else {
                $complaintList = null;
                Term::stderr('Failed to receive complaints list' . PHP_EOL);
                Term::stderr((string) $err . PHP_EOL);
            }
        }
        if ($complaintList !== null) {
            Term::stdout(sprintf(
                'Complaints received: %d' . PHP_EOL, count($complaintList)
            ));
        }
        return $complaintList;
    }

}
