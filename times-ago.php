  /**
     * 
     * @param type $unix_date
     * @param type $now
     * @return type
     */
    public function time_ago($unix_date, $now = null) {
        $unix_date = strtotime($unix_date);
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        if (!empty($now)) {
            $now = strtotime($now);
        } else {
            $now = time();
        }

        // is it future date or past date
        if ($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense = "ago";
        } else {
            $difference = $unix_date - $now;
            $tense = "from now";
        }
        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference, 0, PHP_ROUND_HALF_UP);
//                $difference = round($difference,2);
        if ($difference != 1) {
            $periods[$j].= "s";
        }
        return "$difference $periods[$j] {$tense}";
    }


Call it using $this->time_ago($unix_date, $now);
