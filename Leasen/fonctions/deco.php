<?php

session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 if(isset($_SESSION['USER'])){
    unset($_SESSION['USER']);
    header('Location: http://localhost/leasen/index.php');
    exit();
 }
 else{
    header('Location: http://localhost/leasen/index.php');
    exit();
 }
