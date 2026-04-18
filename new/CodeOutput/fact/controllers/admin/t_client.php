
	<?php

	/*
	* =======================================================================
	* FILE NAME:        t_client.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_client
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/

	if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');

	include(APP_FOLDER . '/models/objects/t_client.php');

	class t_client_controller
	{
		public $t_client_model;

		public function __construct()
		{
			$this->t_client_model = new t_client_model();
		}

		public function invoke_t_client()
		{

			//SELECT ALL //////////////////////////////////	
			if (get('do') == 'viewall') {
				$result = $this->t_client_model->SelectAll($_SESSION['idsite']);
				include(APP_FOLDER . '/views/admin/t_client/View.php');
			}


			//EXPORT ////////////////////////////////////////////////////	
			if (get('do') == 'export') {
				$result = $this->t_client_model->SelectAll();
				include(APP_FOLDER . '/views/admin/t_client/Export.php');
			}

			//Expeort2
			elseif (get('do') == 'export2') {
				$rows = $this->t_client_model->SelectOne(get('id_client'));
				include(APP_FOLDER . '/views/admin/t_client/Export2.php');
			}
			//SEARCH SUGGEST ////////////////////////////////////////////////////	
			elseif (get('do') == 'autosearch') {
				$qstring = post('qstring');
				if (strlen($qstring) > 0) {
					$autosearch = $this->t_client_model->AutoSearch(trim($qstring), 10, 'code');
					echo ' <div class=widget><ul class="list-group">';
					foreach ($autosearch as $srow) {
						echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=t_client&id_client=' . $srow->id_client . '&do=details"><li class="list-group-item">' . $srow->code . '</li></a>
	</span>';
					}
					echo '</ul></div>';
				}
			}


			//ADD //////////////////////////////////////////////////
			elseif (get('do') == 'add') {
				include(APP_FOLDER . '/views/admin/t_client/Add.php');
			}

			//ADD PROCESS //////////////////////////////////////////////////
			elseif (get('do') == 'addpro') {
				if ($_POST) {
					//form validation
					if (post('nom_client') == '') {
						json_error('Veuillez entrer le nom!');
					} elseif (post('sexe_client') == '') {
						json_error('The field sexe client cannot be empty!');
					} elseif (post('adresse_provenance_client') == '') {
						json_error("Veuillez entrer l'adresse");
					} elseif (post('email_client') == '') {
						json_error("Veuillez entrer l'Email");
					} elseif (post('telephone_client') == '') {
						json_error('Veuillez entrer le numéro de téléphone!');
					} elseif (post('type') == '') {
						json_error('The field type cannot be empty!');
					} elseif (post('id_hotel') == '') {
						json_error('The field id hotel cannot be empty!');
					} else {
						$this->t_client_model->InsertFacturation(post('designation'), post('nom_client'), post('sexe_client'), post('adresse_provenance_client'), post('email_client'), post('telephone_client'), post('type'), post('id_hotel'));
						json_send('' . H_ADMIN . '&view=t_client&do=viewall&msg=add');
						json_success('Process Completed');
					}
				}
			}

			//UPDATE //////////////////////////////////////////////////
			elseif (get('do') == 'update') {
				$rows = $this->t_client_model->SelectOne(get('id_client'));
				if ($rows->suffixcompt == null) {
					include(APP_FOLDER . '/views/admin/t_client/Update.php');
				} else {
					include(APP_FOLDER . '/views/admin/t_client/Update2.php');
				}
			}

			//UPDATE PROCESS //////////////////////////////////////////////////
			elseif (get('do') == 'updatepro') {
				if ($_POST) {
					$bdd = HDB::hus();
					//form validation
					if (post('nom_client') == '') {
						json_error('Veuillez entrer le nom!');
					} elseif (post('sexe_client') == '') {
						json_error('The field sexe client cannot be empty!');
					} elseif (post('adresse_provenance_client') == '') {
						json_error("Veuillez entrer l'adresse");
					} elseif (post('email_client') == '') {
						json_error("Veuillez entrer l'Email");
					} elseif (post('telephone_client') == '') {
						json_error('Veuillez entrer le numéro de téléphone!');
					} elseif (post('type') == '') {
						json_error('The field type cannot be empty!');
					} elseif (post('id_hotel') == '') {
						json_error('The field id hotel cannot be empty!');
					} else {
						$this->t_client_model->UpdateFacturation(post('designation'), post('nom_client'), post('sexe_client'), post('adresse_provenance_client'), post('email_client'), post('telephone_client'), post('type'), post('id_hotel'), post('id_client'), post('suffixcompt'));

						if (post('updatenumcpte') == 1) {
							$numberincre = $_SESSION['numberincreaccountnumber'];
							$numberincre += 1;
							$libelle = "compteclient";
							setnumerotation($_SESSION['id_hotel'], $libelle, $numberincre, $bdd);
						}


						json_send('' . H_ADMIN . '&view=t_client&do=viewall&msg=update');
						json_success('Process Completed');
					}
				}
			}

			//DETAILS //////////////////////////////////////////////
			elseif (get('do') == 'details') {
				$rows = $this->t_client_model->SelectOne(get('id_client'));
				include(APP_FOLDER . '/views/admin/t_client/Details.php');
			}

			//TRUNCATE ///////////////////////////////////////////////
			elseif (get('do') == 'truncate') {
				$this->t_client_model->TruncateTable('' . H_ADMIN . '&view=t_client&do=viewall&msg=truncate');
				include(APP_FOLDER . '/views/admin/t_client/View.php');
			}

			//DELETE /////////////////////////////////////////////////
			elseif (get('do') == 'delete') {
				$dfile = get('dfile');
				if (get('id_client') and $dfile == '') {
					$del = $this->t_client_model->Delete(get('id_client'), '' . H_ADMIN . '&view=t_client&do=viewall&msg=delete');
				} elseif (get('id_client') and $dfile != '' and get('fdel') == '') {
					delete_files(UPLOAD_PATH . get('dfile'));
					delete_files(THUMB_PATH . get('dfile'));
					$del = $this->t_client_model->Delete(get('id_client'), '' . H_ADMIN . '&view=t_client&do=viewall&msg=delete');
				} elseif (get('id_client') and $dfile != '' and get('fdel') != '') {
					delete_files(UPLOAD_PATH . get('dfile'));
					delete_files(THUMB_PATH . get('dfile'));
					send_to('' . H_ADMIN . '&view=t_client&id_client=' . get('id_client') . '&do=update&msg=delete');
				}
			}
		} //end invoke
	} //end class
	?>
	