
<?php

/*
 * =======================================================================
 * FILE NAME:        categorie_chambre.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		categorie_chambre
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/categorie_chambre.php');

class categorie_chambre_controller {

    public $categorie_chambre_model;

    public function __construct() {
        $this->categorie_chambre_model = new categorie_chambre_model();
    }

    public function invoke_categorie_chambre() {

        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {

            $result = $this->categorie_chambre_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/categorie_chambre/View.php');
        }
        
        if (get('do') == 'viewall_details') {

            $result = $this->categorie_chambre_model->SelectAll_details($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/categorie_chambre/View_details.php');
        }
        
        if (get('do') == 'viewall_images') {

            $result = $this->categorie_chambre_model->SelectAll_images($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/categorie_chambre/View_images.php');
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->categorie_chambre_model->SelectAll();
            include(APP_FOLDER . '/views/admin/categorie_chambre/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->categorie_chambre_model->SelectOne(get('id_cat_cha'));
            include(APP_FOLDER . '/views/admin/categorie_chambre/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->categorie_chambre_model->AutoSearch(trim($qstring), 10, 'lib_cat_cha');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=categorie_chambre&id_cat_cha=' . $srow->id_cat_cha . '&do=details"><li class="list-group-item">' . $srow->lib_cat_cha . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $details = $this->categorie_chambre_model->SelectAll_details($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/categorie_chambre/Add.php');
        }
        
        elseif (get('do') == 'add_detail') {
            include(APP_FOLDER . '/views/admin/categorie_chambre/Add_details_ch.php');
        }
        elseif (get('do') == 'add_images') {
            include(APP_FOLDER . '/views/admin/categorie_chambre/Add_images.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('lib_cat_cha') == '') {
                    json_error('The field lib cat cha cannot be empty!');
                } elseif (post('hotel_id') == '') {
                    json_error('The field hotel id cannot be empty!');
                } else {
                    
                    if (!empty($_FILES['image'])) {
                        
                        $categorie_id = $this->categorie_chambre_model->InsertImage(post('lib_cat_cha'),post('tarif_ch'),$_SESSION['Paie_insert'], post('hotel_id'));
                        $details = '';
                        foreach(post('details') as $row1)
                        {
                         $details_ch_id = $row1;
                          $this->categorie_chambre_model->InsertDetailsCat($categorie_id, $details_ch_id);
                        }
                        
                        json_send('' . H_ADMIN . '&view=categorie_chambre&do=viewall&msg=add');
                        json_success('Process Completed');
                    }else{
                        $categorie_id = $this->categorie_chambre_model->Insert(post('lib_cat_cha'),post('tarif_ch'),$_SESSION['Paie_insert'], post('hotel_id'));
                        
                        
                        json_send('' . H_ADMIN . '&view=categorie_chambre&do=viewall&msg=add');
                        json_success('Process Completed');
                    }
                    
                }
            }
        }
        
        elseif (get('do') == 'addpro_detail') {
            if ($_POST) {
                //form validation
                if (post('icon') == '') {
                    json_error('The field lib cat cha cannot be empty!');
                } elseif (post('designation') == '') {
                    json_error('The field hotel id cannot be empty!');
                } else {
                    
                    $this->categorie_chambre_model->InsertDetails(post('icon'),post('designation'), post('hotel_id'));
                    json_send('' . H_ADMIN . '&view=categorie_chambre&do=viewall_details&msg=add');
                    json_success('Process Completed');
                    
                }
            }
        }
        
        elseif (get('do') == 'addpro_image') {
            if ($_POST) {
                //form validation
                $slide=1;
                $this->categorie_chambre_model->InsertImageSlide(post('description'),post('visible'),$slide, post('hotel_id'));
                json_send('' . H_ADMIN . '&view=categorie_chambre&do=viewall_images&msg=add');
                json_success('Process Completed');
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->categorie_chambre_model->SelectOne(get('id_cat_cha'));
            $details = $this->categorie_chambre_model->SelectAll_details($_SESSION['idsite']);
            $details_cat = $this->categorie_chambre_model->SelectAll_detailsCat(get('id_cat_cha'));
            include(APP_FOLDER . '/views/admin/categorie_chambre/Update.php');
        }
        elseif (get('do') == 'update_detail') {
            $rows = $this->categorie_chambre_model->SelectOneDetails(get('id_detail'));
            include(APP_FOLDER . '/views/admin/categorie_chambre/Update_details.php');
        }
        elseif (get('do') == 'update_img') {
            $rows = $this->categorie_chambre_model->SelectOneImage(get('id_img'));
            include(APP_FOLDER . '/views/admin/categorie_chambre/Update_images.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
               if (post('lib_cat_cha') == '') {
                    json_error('Veuillez entrer un nom!');
                }else{
                    if (!empty($_FILES['image'])) {
                        $this->categorie_chambre_model->UpdateImage(post('lib_cat_cha'), post('hotel_id'), post('tarif_ch'), post('id_cat_cha'));
                    } else {
                        $this->categorie_chambre_model->Update(post('lib_cat_cha'), post('hotel_id'), post('tarif_ch'), post('id_cat_cha'));
                    }
                    $this->categorie_chambre_model->UpdateDetailsCat(post('id_cat_cha'));
                    $details = '';
                    foreach(post('details') as $row1)
                    {
                     $details_ch_id = $row1;
                      $this->categorie_chambre_model->InsertDetailsCat(post('id_cat_cha'), $details_ch_id);
                    }
                    
                    json_send('' . H_ADMIN . '&view=categorie_chambre&id_cat_cha=' . post('id_cat_cha') . '&do=viewall&msg=update');
                    json_success('Process Completed');
                }
            }
        }
        
        elseif (get('do') == 'updateprodetail') {
            if ($_POST) {
                //form validation
               if (post('designation') == '') {
                    json_error('Veuillez entrer une designation!');
                }else{
                    $this->categorie_chambre_model->UpdateDetailsCh(post('icon'), post('designation'), post('id_detail'));
                    
                    json_send('' . H_ADMIN . '&view=categorie_chambre&do=viewall_details&msg=update');
                    json_success('Process Completed');
                }
            }
        }
        
        elseif (get('do') == 'updateproimage') {
            if ($_POST) {
                //form validation
               if (post('description') == '') {
                    json_error('Veuillez entrer une description!');
                }else{
                    if (!empty($_FILES['image'])) {
                        $this->categorie_chambre_model->UpdateImageSlider1(post('description'), post('visible'), post('hotel_id'), post('id_img'));
                    } else {
                        $this->categorie_chambre_model->UpdateImageSlider(post('description'), post('visible'), post('hotel_id'), post('id_img'));
                    }
                    
                    json_send('' . H_ADMIN . '&view=categorie_chambre&do=viewall_images&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->categorie_chambre_model->SelectOne(get('id_cat_cha'));
            include(APP_FOLDER . '/views/admin/categorie_chambre/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->categorie_chambre_model->TruncateTable('' . H_ADMIN . '&view=categorie_chambre&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/categorie_chambre/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id_cat_cha') and $dfile == '') {
                $del = $this->categorie_chambre_model->Delete(get('id_cat_cha'), '' . H_ADMIN . '&view=categorie_chambre&do=viewall&msg=delete');
            } elseif (get('id_cat_cha') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->categorie_chambre_model->Delete(get('id_cat_cha'), '' . H_ADMIN . '&view=categorie_chambre&do=viewall&msg=delete');
            } elseif (get('id_cat_cha') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=categorie_chambre&id_cat_cha=' . get('id_cat_cha') . '&do=update&msg=delete');
            }
        }
    }

//end invoke
}

//end class
?>
	