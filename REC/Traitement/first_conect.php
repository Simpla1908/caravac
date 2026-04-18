<?php
session_start();
if ($_SESSION['fconnect']==0 && $_SESSION['type_user'] == 1) { 
echo "true";
       } else{
echo "false";
       }