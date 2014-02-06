<?php

namespace LammCore\Stdlib;

class Solr
{

    public static function convertDate($date)
    {
        if (strpos($date, "/") !== false) $date = explode("/", $date);

        elseif (strpos($date, "-") !== false) $date = explode("-", $date);
        elseif (strpos($date, " ") !== false) $date = explode(" ", $date);

        if (count($date) != 3) return "";
        if (strlen($date[0]) == 4) {
            $tmp = $date[0];
            $date[0] = $date[2];
            $date[2] = $tmp;
        }

        return $date[2] . "-" . $date[1] . "-" . $date[0] . "T00:00:00Z";

    }
}
