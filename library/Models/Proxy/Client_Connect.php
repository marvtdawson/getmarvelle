<?php
/**
 * this client connection class works with the
 * below namespace class
 * the purpose of this file is to provide a simple
 * connection through a single class and interface
 *
 */
namespace Library\Models\Proxy\Client_Connect;

class Client_Connect
{

    private $system_hookup;

    public function __constructor()
    {
        $this->system_hookup->Universal_Connect->clientDoConnect();
    }

}