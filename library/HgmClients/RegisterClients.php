<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 5/25/17
 * Time: 11:20 PM
 */

namespace library\HgmClients;


use core\Controller;

class RegisterClients extends Controller
{
    private $parentUrl,
        $hgmDomain,
        $hgmRelPath,
        $regClientBaseDir;

    public function __construct(){

        $this->hgmDomain = getenv('HTTP_HOST');
        $this->hgmRelPath = '../public_html/' . $this->hgmDomain;
        $this->parentUrl = '../public_html/';
    }



}