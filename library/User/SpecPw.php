<?php

// file created on 9/25/2015
// this class will be the special passwords checker
// this special password is create after registration is completed.

namespace Library\Users;
use library\Users\User;
use appcms\controller\Userdemographics;

class SpecPw
{

    public
        $specExplodeEmail,
        $specMonth,
        $specYear,
        $specStateFirst,
        $specStateLast,
        $specCityFirst,
        $exploded_Email,
        $specZipCodeFirst,
        $curruserInfo,
        $userId,
        $userEmail,
        $userRegMonth,
        $userRegYear,
        $userMemberType,
        $userDemoInfo,
        $userState,
        $userCity,
        $userZipCode;
    
    public function __construct()
    {
        $this->curruserInfo = new User();
        $this->userId = $this->curruserInfo->data()->id;

        $this->userDemoInfo = new Userdemographics();
        $this->userDemoInfo->find($this->userId);
    }

    public function createSpecPw($id){

        $this->userMemberType = $this->curruserInfo->data()->regMem_Type;
        $this->userEmail = $this->curruserInfo->data()->regMem_E1;
        $this->userRegMonth = $this->curruserInfo->data()->regMem_Month;
        $this->userRegYear = $this->curruserInfo->data()->regMem_Year;

        $this->userState = $this->userDemoInfo->data()->regMem_State;
        $this->userCity = $this->userDemoInfo->data()->regMem_City;
        $this->userZipCode = $this->userDemoInfo->data()->regMem_Zipcode;

        // get state abbrev
        $this->specStateFirst = substr(strtolower($this->userState), -2, 1);
        $this->specStateLast = substr(strtoupper($this->userState), -1);

        // get city first three characters
        $this->specCityFirst = substr(strtolower($this->userCity), -2, 3);

        // get zip code first three digits
        $this->specZipCodeFirst = substr(strtolower($this->userZipCode), -2, 3);

        // explode email
        $this->specExplodeEmail = explode("@", $this->userEmail);

        // get the second portion of email should be
        $this->exploded_Email = explode(".", $this->specExplodeEmail[1]);

        //
        $this->specEmail = substr(ucfirst($this->exploded_Email[0]), 0, 3);

        // get register Month and Year
        $this->specMonth = ucfirst($this->userRegMonth);
        $this->specYear = substr($this->userRegYear, - 2);

    }
}