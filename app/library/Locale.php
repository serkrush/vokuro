<?php
/**
 * Created by PhpStorm.
 * User: kalin-mv
 * Date: 7/29/15
 * Time: 12:43 PM
 */

namespace Vokuro;

use IntlDateFormatter;
use NumberFormatter;
use Phalcon\Mvc\User\Component;

class Locale extends Component {

    /**
     * @param null $timestamp
     * @return \DateTime
     */

    public function time($timestamp = null) {
        $date = new \DateTime();
        if (intval($timestamp) > 0) {
            $date->setTimestamp($timestamp);
        }
        return $date;
    }

    public function format($time = null, $datetype = IntlDateFormatter::SHORT, $timetype = IntlDateFormatter::SHORT) {
        $time = $this->time($time);
        $locale = "en_GB"; // here should be set user Locale from sessoin
        $timezone = "UTC"; // here should be set user time zone
        $ftm = new IntlDateFormatter($locale, $datetype, $timetype, $timezone);
        return $ftm->format($time);
    }

    public function number($value) {
        $locale = "en_GB";  // here should be set user Locale from session
        $fmt = new NumberFormatter($locale, NumberFormatter::DECIMAL);
        return $fmt->format($value);
    }

}