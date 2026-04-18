<?php
//     // First you need to connect to your database
//$hostname_connection = "localhost";
//$database_connection = "kabe_hotel_db";
//$username_connection = "root";
//$password_connection = " ";
//$connection = mysql_connect($hostname_connection, $username_connection, $password_connection) or trigger_error(mysql_error(),E_USER_ERROR); 
//mysql_select_db($database_connection, $connection);
//
//// Select multiple pieces of data from a database
//$query = "SELECT id_client, nom_client FROM `t_client` ";
//  if(isset($_POST['query'])){
//      $q='k';
//    $query .= ' WHERE nom_client LIKE "%'.$q.'%"' ;
//  }
//$rs = mysql_query($query) or die(mysql_error());
//
//// And put it into a json array
//$return = array();  
//while ($rs_db['query'] = mysql_fetch_assoc($rs)){
////
//$return[] = $rs_db['query']['nom_client'].'#'.$rs_db['query']['id_client'];    
//};
//$json = json_encode($return);
//print_r($json);

if (!isset($_SESSION)) {
    session_start();
}
$_SESSION['partenaire']=135;
  $mysqli = new mysqli("localhost", "root", " ", "kabe_hotel_db");
 
  // check connection
  if ($mysqli->connect_errno){
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }
 
  $query = 'SELECT nom_c FROM t_company';
 
  if(isset($_POST['query'])){
    // Add validation and sanitization on $_POST['partenaire'] here
      $q='k';
    // Now set the WHERE clause with LIKE query
    $query .= ' WHERE nom_c LIKE "%'.$q.'%"';
  }
 
  $return = array();
 
  if($result = $mysqli->query($query)){
    // fetch object array
    while($obj = $result->fetch_object()) {
      $return[] = $obj->nom_c;
    }
    // free result set
    $result->close();
  }
 
  // close connection
  $mysqli->close();
 
  $json = json_encode($return);
  print_r($json);