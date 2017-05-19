<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 11/19/16
 * Time: 10:39 AM
 */

$to = '7705302929@vtext.com';
$from = 'marvintdawson@gmail.com';
$message = 'This is a test text Marvo!';
$headers = 'From: '.$from.'\n';
mail($to, '', $message, $headers);

?>