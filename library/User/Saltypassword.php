<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/19/17
 * Time: 12:23 PM
 */

namespace library\Users;


class Saltypassword
{
    public function __construct(){}

    /**
     * Before filter which is useful for login authentication
     *
     * @return void
     */
    protected function before(){}

    /**
     * After filter which could potentially be good for destroying sessions
     *
     * @return void
     */
    protected function after(){}

}