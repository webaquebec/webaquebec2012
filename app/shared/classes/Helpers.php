<?php

/**
 * Various helpers.
 * Kind of a dump...
 */
class Helpers {

    /**
     * Enclose content in XML's CDATA.
     *
     * @static
     * @param $value string
     * @return string
     */
    static public function encloseInCdata($value){
        return "<![CDATA[".$value."]]>";
    }

    /**
     * Attempt to make content valid for xml encapsulation.
     *
     * @static
     * @param $value string
     * @return string
     */
    static public function sanitizeForXML($value){
        return htmlspecialchars($value);
    }

    /**
     * @static
     * @param $array array Of numbers
     * @return float
     */
    static public function average($array) {
        return array_sum($array) / count($array);
    }

    static public function secondsToTime($seconds, $separator=":"){
        $minutes = $seconds / 60;
        $seconds = $seconds % 60;

        $hours = $minutes / 60;
        $minutes = $minutes % 60;

        $seconds = floor($seconds);
        $minutes = floor($minutes);
        $hours = floor($hours);

        $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
        $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);
        $seconds = str_pad($seconds, 2, "0", STR_PAD_LEFT);

        $time = $hours . $separator . $minutes . $separator . $seconds;

        return $time;
    }

    /**
     * @static
     * @param $ip string
     * @return bool
     */
    static public function isValidIp($ip) {
        if (!empty($ip) && ip2long($ip) != -1) {
            $reserved_ips = array(
                array('0.0.0.0', '2.255.255.255'),
                array('10.0.0.0', '10.255.255.255'),
                array('127.0.0.0', '127.255.255.255'),
                array('169.254.0.0', '169.254.255.255'),
                array('172.16.0.0', '172.31.255.255'),
                array('192.0.2.0', '192.0.2.255'),
                array('192.168.0.0', '192.168.255.255'),
                array('255.255.255.0', '255.255.255.255')
            );

            foreach ($reserved_ips as $r) {
                $min = ip2long($r[0]);
                $max = ip2long($r[1]);
                if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
            }
            return true;

        } else {
            return false;
        }
    }

    /**
     * @static
     * @return string
     */
    static public function getClientIP() {
        if (isset($_SERVER["HTTP_CLIENT_IP"]) && self::isValidIp($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        }

        if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            foreach (explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
                if (self::isValidIp(trim($ip))) {
                    return $ip;
                }
            }
        }

        if (isset($_SERVER["HTTP_X_FORWARDED"]) && self::isValidIp($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];

        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]) && self::isValidIp($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];

        } elseif (isset($_SERVER["HTTP_FORWARDED"]) && self::isValidIp($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];

        } else {
            return $_SERVER["REMOTE_ADDR"];
        }
    }

    static public function byteFormat($bytes, $unit = "", $decimals = 2) {
        $units = array('B' => 0, 'KB' => 1, 'MB' => 2, 'GB' => 3, 'TB' => 4,
            'PB' => 5, 'EB' => 6, 'ZB' => 7, 'YB' => 8);

        $value = 0;
        if ($bytes > 0) {
            // Generate automatic prefix by bytes
            // If wrong prefix given
            if (!array_key_exists($unit, $units)) {
                $pow = floor(log($bytes)/log(1024));
                $unit = array_search($pow, $units);
            }

            // Calculate byte value by prefix
            $value = ($bytes/pow(1024,floor($units[$unit])));
        }

        // If decimals is not numeric or decimals is less than 0
        // then set default value
        if (!is_numeric($decimals) || $decimals < 0) {
            $decimals = 2;
        }

        // Format output
        return sprintf('%.' . $decimals . 'f '.$unit, $value);
    }
}
