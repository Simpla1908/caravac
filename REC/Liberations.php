<?php
class Liberations
{
private $pseudo;
private $email;
private $signature;
private $actif;
public function envoyerEMail($titre, $message)
{
mail($this->email, $titre, $message);
}
public function bannir()
{
$this->actif = false;
$this->envoyerEMail('Vous avez été banni', 'Ne revenez plus
!');
}
public function getPseudo()
{
return $this->pseudo;
}

public function yyyy()
{
	if( isset($_GET['num_reserv'])&&isset($_GET['id_client'])&&isset($_GET['nom_client'])&&isset($_GET['id_res'])&&isset($_GET['date_occ'])&&isset($_GET['date_lib'])&&isset($_GET['dte_a'])&&isset($_GET['dte_s'])){
				
				
				$num_reserv = $_GET['num_reserv'];
				$id_client = $_GET['id_client'];
				$nom_client = $_GET['nom_client'];
				$id_res = $_GET['id_res'];
				$date_occ = $_GET['date_occ'];
				$date_lib = $_GET['date_lib'];
				$dte_a = $_GET['dte_a'];
				$dte_s = $_GET['dte_s'];
			
			}
			
}
public function setPseudo($nouveauPseudo)
{
if (!empty($nouveauPseudo) AND strlen($nouveauPseudo) < 15)
{
$this->pseudo = $nouveauPseudo;
}
}  
}
?>