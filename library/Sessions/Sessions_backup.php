<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/15/16
 * Time: 12:00 AM
 */

namespace library\Sessions;

class SessionsBackup
{

    public $temp_session_name;

    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function delete($name)
    {
        if(self::exists($name)){
            unset($_SESSION[$name]);
        }
    }

    public static function get($name){
        return $_SESSION[$name];
    }

    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function flash($name, $string = ''){
        if(self::exists($name)){
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name, $string);
        }
        return '';
    }

    /*public function checkMemberSession()
    {
        //$memberURL_ID_chker = '';
        $_GET['m'];

        //$memberSession_E = $_SESSION['regMem_E1'];
        $memberSession_SpecPw = $_SESSION['regMem_Spec'];

        $memberURL_ID_chker = $_GET['m'];

        if(empty($memberSession_SpecPw)){

            header("location: contact.php");
        }

        // connect to db
        require_once('library/Iscriptz/iKony2db.php');

        // if connection is establish select db name
        mysqli_select_db($siteMem_konnect, $siteMem_cDb);


        $member_Id_chker_sql = mysqli_query($siteMem_konnect,
            "SELECT *
                 FROM regmember
                 WHERE regMem_SpecPw='$memberSession_SpecPw'
                 LIMIT 1")
        or die($siteMem_konnect);

        $rowcounter = mysqli_num_rows($member_Id_chker_sql);

        if($rowcounter == 0) {

            //  echo 'Found no member data <br />';
            // exit();

            // End Message
            mysqli_close($siteMem_konnect);

            header("location: about.php?m=$memberSession_SpecPw");

        }
        else if($rowcounter == 1){

            $storedMem_Id = '';
            $storedMem_Email = '';
            $storedMem_SpecPw = '';

            while ($row = mysqli_fetch_array($member_Id_chker_sql)) {

                $storedMem_Id = $row['regMem_Id'];
                $storedMem_Email = $row['regMem_E1'];
                $storedMem_SpecPw = $row['regMem_SpecPw'];

            }

            // check if current id in url matches stored id
            if($storedMem_Id  != $memberURL_ID_chker){
                 header("location: index.php");
             }
            // check if session email is a match to stored email
            if($storedMem_SpecPw !=  $memberSession_SpecPw){ // $memberSession_E
                header("location: index.php");
            }

        }

    }*/

   /* public function checkAdminUsersSession()
    {

        $adminURL_ID_chker;
        $_GET['hgmAdmin'];

        $adminSession_E = $_SESSION['adminMem_E1'];

        $adminURL_ID_chker = $_GET['hgmAdmin'];

        if($adminURL_ID_chker == ""){

            header("location: index.php");
        }

        // connect to db
        require_once('library/Iscriptz/iKony2db.php');

        // if connection is establish select db name
        mysqli_select_db($siteMem_konnect, $siteMem_cDb);


        $admin_Id_chker_sql = mysqli_query($siteMem_konnect,
            "SELECT *
                 FROM hgmAdminMembers
                 WHERE adminMem_Id='$adminURL_ID_chker'
                 LIMIT 1")
        or die($siteMem_konnect);

        $rowcounter = mysqli_num_rows($admin_Id_chker_sql);

        if($rowcounter == 0) {

            // End Message
            mysqli_close($siteMem_konnect);

            header("location: index.php");

        }
        elseif($rowcounter == 1){

            while ($row = mysqli_fetch_array($admin_Id_chker_sql)) {

                $storedAdmin_Id = $row['adminMem_Id'];
                $storedAdmin_Email = $row['adminMem_E1'];

            }

            // check if current id in url matches stored id
            if($storedAdmin_Id  != $adminURL_ID_chker){
                header("location: index.php");
            }
            if($storedAdmin_Email != $adminSession_E){
                header("location: index.php");
            }

        }

    }*/


}