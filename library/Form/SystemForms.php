<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/29/16
 * Time: 4:43 PM
 */

namespace library\Form;


class SystemForms
{

    public $formId;
    public $csfToken_Pre;
    public $csfToken_Pre_rand;
    public $csfToken_Suf;
    public $csfToken_Suf_rand;
    public $csfToken;
    public $getTable;
    public $getPre;
    public $getSuf;

    public function setPrefix()
    {
        $this->csfToken_Pre_rand = mt_rand(2500, 125000);
        return $this->csfToken_Pre_rand;
    }

    public function setSuffix()
    {
        //$this->csfToken_Suf_rand = mt_rand(7500, 80000);
        $this->csfToken_Suf_rand = 'lick';
        return $this->csfToken_Suf_rand;
    }

    public function testForm()
    {
        //$getTable =
        $this->formId = 20;
        $this->csfToken_Pre = $this->csfToken_Pre_rand;
        $this->csfToken_Suf = $this->csfToken_Suf_rand;
        $this->csfToken = $this->csfToken_Pre.$this->csfToken_rand.$this->formId.$this->csfToken_Suf;
        return $this->csfToken;
    }

    public function adminForm()
    {
        $this->formId = 21;
        $this->csfToken_Pre = $this->csfToken_Pre_rand;
        $this->csfToken_Suf = $this->csfToken_Suf_rand;
        $this->csfToken = $this->csfToken_Pre.$this->csfToken_rand.$this->formId.$this->csfToken_Suf;
        return $this->csfToken;
    }

    public function contactForm()
    {
        $this->formId = 22;
        $this->csfToken_Pre = $this->csfToken_Pre_rand;
        $this->csfToken_Suf = $this->csfToken_Suf_rand;
        $this->csfToken = $this->csfToken_Pre.$this->csfToken_rand.$this->formId.$this->csfToken_Suf;
        return $this->csfToken;
    }

    public function loginForm()
    {
        $this->formId = 23;
        $this->csfToken_Pre = $this->csfToken_Pre_rand;
        $this->csfToken_Suf = $this->csfToken_Suf_rand;
        $this->csfToken = $this->csfToken_Pre.$this->csfToken_rand.$this->formId.$this->csfToken_Suf;
        return $this->csfToken;
    }

    public function registerForm()
    {
        $this->formId = 24;
        $this->csfToken_Pre = $this->csfToken_Pre_rand;
        $this->csfToken_Suf = $this->csfToken_Suf_rand;
        $this->csfToken = $this->csfToken_Pre.$this->csfToken_rand.$this->formId.$this->csfToken_Suf;
        return $this->csfToken;
    }

    public function subscribeForm()
    {
        $this->formId = 25;
        $this->csfToken_Pre = $this->csfToken_Pre_rand;
        $this->csfToken_Suf = $this->csfToken_Suf_rand;
        $this->csfToken = $this->csfToken_Pre.$this->csfToken_rand.$this->formId.$this->csfToken_Suf;
        return $this->csfToken;
    }

    public function forgotPasswordForm()
    {
        $this->formId = 26;
        $this->csfToken_Pre = $this->csfToken_Pre_rand;
        $this->csfToken_Suf = $this->csfToken_Suf_rand;
        $this->csfToken = $this->csfToken_Pre.$this->csfToken_rand.$this->formId.$this->csfToken_Suf;
        return $this->csfToken;
    }

}