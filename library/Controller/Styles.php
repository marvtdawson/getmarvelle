<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 4/2/17
 * Time: 8:09 AM
 */

namespace Library\Controller;


class Styles
{

    public static $styles;

    public static function styleType(){

        self::$styles  = array(
            "BAY" => "BAY AREA",
            "BOOMB" => "BOOM BAP",
            "CHOP"=>"CHOPPED and SCREWED",
            "DIRTY"=>"DIRTY SOUTH",
            "ECOAST"=>"EAST COAST",
            "INTER"=>"INTERNATIONAL",
            "KRUMP"=>"KRUMP",
            "LYRICAL"=>"LYRICAL",
            "SAUCY"=>"SAUCY",
            "TRAP"=>"TRAP",
            "WCOAST" => "WEST COAST"
        );

        return self::$styles;
    }

}