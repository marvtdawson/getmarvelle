<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/1/17
 * Time: 8:30 AM
 */

namespace library;


class Date
{
    public $numbermonth,
            $numberday,
            $numberyear,
            $abbrvday,
            $abbrvyear,
            $fullmonth,
            $fullday,
            $fullyear,
            $abbrvmonth;

    public $datevalues = array();

    public function __construct()
    {
        $this->numbermonth = date('m');
        $this->numberday = date('d');
        $this->numberyear = date('y');

        $this->abbrvmonth = date('M');
        $this->abbrvday = date('D');

        $this->fullday = date('l');
        $this->fullmonth = date('F');
        $this->fullyear = date('Y');

        // add values to array variable
        $this->datevalues = array($this->numbermonth,
                                  $this->numberday,
                                  $this->numberyear,
                                  $this->abbrvmonth,
                                  $this->abbrvday,
                                  $this->fullmonth,
                                  $this->fullday,
                                  $this->fullyear);

        // return the
        return $this->datevalues;
    }

}