<?php

namespace Library\Iscriptz;

/**
 * Interface Get Marvelle
 * @package Library\Iscriptz
 * this file provides the values
 * to connect to the back end data structure
 */
interface IConnect2Db
{
    /**
     * comment out the production block for development
     */
    // PRODUCTION
  /*  const CLIENTHOST = "107.180.44.139";
    const CLIENTUSER = "megaMarvo";
    const CLIENTPW = "Simply@New1972";*/

    /**
     * comment out the development block before pushing to production
     */
    // DEVELOPMENT
    const CLIENTHOST = "localhost";
    const CLIENTUSER = "root";
    const CLIENTPW = "TayTay@1972";

    //
    const CLIENTDB = "g3tMArv3LL3cOre";

}

?>