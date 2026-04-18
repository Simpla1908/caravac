<?php
//include './bdd/connexion.php';
if (isset($_POST['valider'])) {
	
	$annee= $_POST['annee'];	
	 
}else{
	$annee=date('Y');
}

				 ?>
<div class="panel-heading">
    Analyse de la caisse de l'année <strong><?php echo $annee; ?>&nbsp;&nbsp;&nbsp;<a href="analyse_caisse_mois.php" class="alert-link">Mois</a></strong>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
    <?php require './Traitement/operation_affichage_analyse_caisse.php'; ?>
    <div class="table-responsive" >
        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-examplefx">
            <thead>
                <tr>
                    <th></th>
                    <th>ENTREE</th>
                    <th>SORTIE</th>
                    <th>SOLDE</th>
                </tr>
            </thead>
            <tbody>
                 <?php
                    $mois = date('m'); 
                    switch ($mois) { 
                    case 01 : 
                    echo '
                            <tr class="odd gradeX">
                                <td>Janvier</td>
                                <td>'.$montantUSD_entree_mois_janv . '$'. ' / '.$montantFC_entree_mois_janv . 'Fc'. '</td>
                                <td>'.$montantUSD_sortie_mois_janv . '$'. ' / '.$montantFC_sortie_mois_janv . 'Fc'. '</td>
                                <td>'.$soldeUSD_janv . '$'. ' / '.$soldeFC_janv . 'Fc'. '</td>
                            </tr>'; 
                    break; 
                    case 02 : 
                    echo '
                            <tr class="odd gradeX">
                                <td>Janvier</td>
                                <td>'.$montantUSD_entree_mois_janv . '$'. ' / '.$montantFC_entree_mois_janv . 'Fc'. '</td>
                                <td>'.$montantUSD_sortie_mois_janv . '$'. ' / '.$montantFC_sortie_mois_janv . 'Fc'. '</td>
                                <td>'.$soldeUSD_janv . '$'. ' / '.$soldeFC_janv . 'Fc'. '</td>
                            </tr>
                            <tr class="even gradeC">
                                <td>Février</td>
                                <td>'.$montantUSD_entree_mois_fevr . '$'. ' / '.$montantFC_entree_mois_fevr . 'Fc'. '</td>
                                <td>'.$montantUSD_sortie_mois_fevr . '$'. ' / '.$montantFC_sortie_mois_fevr . 'Fc'. '</td>
                                <td>'.$soldeUSD_fevr . '$'. ' / '.$soldeFC_fevr . 'Fc'. '</td>
                            </tr>'; 
                    break; 
                    case 03 : 
                    echo '
                            <tr class="odd gradeX">
                                <td>Janvier</td>
                                <td>'.$montantUSD_entree_mois_janv . '$'. ' / '.$montantFC_entree_mois_janv . 'Fc'. '</td>
                                <td>'.$montantUSD_sortie_mois_janv . '$'. ' / '.$montantFC_sortie_mois_janv . 'Fc'. '</td>
                                <td>'.$soldeUSD_janv . '$'. ' / '.$soldeFC_janv . 'Fc'. '</td>
                            </tr>
                            <tr class="even gradeC">
                                <td>Février</td>
                                <td>'.$montantUSD_entree_mois_fevr . '$'. ' / '.$montantFC_entree_mois_fevr . 'Fc'. '</td>
                                <td>'.$montantUSD_sortie_mois_fevr . ' $'. '/ '.$montantFC_sortie_mois_fevr . 'Fc'. '</td>
                                <td>'.$soldeUSD_fevr . ' $'. '/ '.$soldeFC_fevr . 'Fc'. '</td>
                            </tr>
                            <tr class="odd gradeA">
                                <td>Mars</td>
                                <td>'.$montantUSD_entree_mois_mars . '$'. ' / '.$montantFC_entree_mois_mars . 'Fc'. '</td>
                                <td>'.$montantUSD_sortie_mois_mars . '$'. ' / '.$montantFC_sortie_mois_mars . 'Fc'. '</td>
                                <td>'.$soldeUSD_mars . '$'. ' / '.$soldeFC_mars . 'Fc'. '</td>
                            </tr>'; 
                    break; 
                    case 04 : 
                    echo '
                            <tr class="odd gradeX">
                                <td>Janvier</td>
                                <td>'.$montantUSD_entree_mois_janv . '$'. ' / '.$montantFC_entree_mois_janv . 'Fc'. '</td>
                                <td>'.$montantUSD_sortie_mois_janv . '$'. ' / '.$montantFC_sortie_mois_janv . 'Fc'. '</td>
                                <td>'.$soldeUSD_janv . ' $'. '/ '.$soldeFC_janv . 'Fc'. '</td>
                            </tr>
                            <tr class="even gradeC">
                                <td>Février</td>
                                <td>'.$montantUSD_entree_mois_fevr . '$'. ' / '.$montantFC_entree_mois_fevr . 'Fc'. '</td>
                                <td>'.$montantUSD_sortie_mois_fevr . '$'. ' / '.$montantFC_sortie_mois_fevr . 'Fc'. '</td>
                                <td>'.$soldeUSD_fevr . '$'. ' / '.$soldeFC_fevr . 'Fc'. '</td>
                            </tr>
                            <tr class="odd gradeA">
                                <td>Mars</td>
                                <td>'.$montantUSD_entree_mois_mars . '$'. ' / '.$montantFC_entree_mois_mars . 'Fc'. '</td>
                                <td>'.$montantUSD_sortie_mois_mars . '$'. ' / '.$montantFC_sortie_mois_mars . 'Fc'. '</td>
                                <td>'.$soldeUSD_mars . '$'. ' / '.$soldeFC_mars . 'Fc'. '</td>
                            </tr>
                            <tr class="even gradeA">
                                <td>Avril</td>
                                <td>'.$montantUSD_entree_mois_avril . '$'. ' / '.$montantFC_entree_mois_avril . 'Fc'. '</td>
                                <td>'.$montantUSD_sortie_mois_avril . '$'. ' / '.$montantFC_sortie_mois_avril . 'Fc'. '</td>
                                <td>'.$soldeUSD_avril . '$'. ' / '.$soldeFC_avril . 'Fc'. '</td>
                            </tr>'; 
                    break;
                    case 05 : 
                    echo '
                            <tr class="odd gradeX">
                                <th>SOLDE TOTAL</th>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td class="center"><strong>150800$ / 600000Fc</strong></td>
                            </tr>
                            <tr class="odd gradeX">
                                    <th>Janvier</th>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                            </tr>
                            <tr class="even gradeC">
                                    <th>Février</th>
                                    <td>Internet Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mars</th>
                                    <td>Internet Explorer 5.5</td>
                                    <td>Win 95+</td>
                                    <td class="center">5.5</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Avril</th>
                                    <td>Internet Explorer 6</td>
                                    <td>Win 98+</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mai</th>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                    <td class="center">7</td>
                            </tr>'; 
                    break;
                    case 06 : 
                    echo '
                            <tr class="odd gradeX">
                                <th>SOLDE TOTAL</th>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td class="center"><strong>150800$ / 600000Fc</strong></td>
                            </tr>
                            <tr class="odd gradeX">
                                    <th>Janvier</th>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                            </tr>
                            <tr class="even gradeC">
                                    <th>Février</th>
                                    <td>Internet Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mars</th>
                                    <td>Internet Explorer 5.5</td>
                                    <td>Win 95+</td>
                                    <td class="center">5.5</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Avril</th>
                                    <td>Internet Explorer 6</td>
                                    <td>Win 98+</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mai</th>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                    <td class="center">7</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Juin</th>
                                    <td>AOL browser (AOL desktop)</td>
                                    <td>Win XP</td>
                                    <td class="center">6</td>
                            </tr>'; 
                    break;
                    case 07 : 
                    echo '
                            <tr class="odd gradeX">
                                <th>SOLDE TOTAL</th>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td class="center"><strong>150800$ / 600000Fc</strong></td>
                            </tr>
                            <tr class="odd gradeX">
                                    <th>Janvier</th>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                            </tr>
                            <tr class="even gradeC">
                                    <th>Février</th>
                                    <td>Internet Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mars</th>
                                    <td>Internet Explorer 5.5</td>
                                    <td>Win 95+</td>
                                    <td class="center">5.5</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Avril</th>
                                    <td>Internet Explorer 6</td>
                                    <td>Win 98+</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mai</th>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                    <td class="center">7</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Juin</th>
                                    <td>AOL browser (AOL desktop)</td>
                                    <td>Win XP</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Juillet</th>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.7</td>
                            </tr>'; 
                    break;
                    case 08 : 
                    echo '
                            <tr class="odd gradeX">
                                <th>SOLDE TOTAL</th>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td class="center"><strong>150800$ / 600000Fc</strong></td>
                            </tr>
                            <tr class="odd gradeX">
                                    <th>Janvier</th>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                            </tr>
                            <tr class="even gradeC">
                                    <th>Février</th>
                                    <td>Internet Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mars</th>
                                    <td>Internet Explorer 5.5</td>
                                    <td>Win 95+</td>
                                    <td class="center">5.5</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Avril</th>
                                    <td>Internet Explorer 6</td>
                                    <td>Win 98+</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mai</th>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                    <td class="center">7</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Juin</th>
                                    <td>AOL browser (AOL desktop)</td>
                                    <td>Win XP</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Juillet</th>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.7</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Août</th>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.8</td>
                            </tr>'; 
                    break;
                    case 09 : 
                    echo '
                            <tr class="odd gradeX">
                                <th>SOLDE TOTAL</th>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td class="center"><strong>150800$ / 600000Fc</strong></td>
                            </tr>
                            <tr class="odd gradeX">
                                    <th>Janvier</th>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                            </tr>
                            <tr class="even gradeC">
                                    <th>Février</th>
                                    <td>Internet Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mars</th>
                                    <td>Internet Explorer 5.5</td>
                                    <td>Win 95+</td>
                                    <td class="center">5.5</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Avril</th>
                                    <td>Internet Explorer 6</td>
                                    <td>Win 98+</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mai</th>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                    <td class="center">7</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Juin</th>
                                    <td>AOL browser (AOL desktop)</td>
                                    <td>Win XP</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Juillet</th>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.7</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Août</th>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.8</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Septembre</th>
                                    <td>Firefox 2.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.8</td>
                            </tr>'; 
                    break;
                    case 10 : 
                    echo '
                            <tr class="odd gradeX">
                                <th>SOLDE TOTAL</th>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td class="center"><strong>150800$ / 600000Fc</strong></td>
                            </tr>
                            <tr class="odd gradeX">
                                    <th>Janvier</th>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                            </tr>
                            <tr class="even gradeC">
                                    <th>Février</th>
                                    <td>Internet Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mars</th>
                                    <td>Internet Explorer 5.5</td>
                                    <td>Win 95+</td>
                                    <td class="center">5.5</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Avril</th>
                                    <td>Internet Explorer 6</td>
                                    <td>Win 98+</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mai</th>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                    <td class="center">7</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Juin</th>
                                    <td>AOL browser (AOL desktop)</td>
                                    <td>Win XP</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Juillet</th>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.7</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Août</th>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.8</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Septembre</th>
                                    <td>Firefox 2.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.8</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Octobre</th>
                                    <td>Firefox 3.0</td>
                                    <td>Win 2k+ / OSX.3+</td>
                                    <td class="center">1.9</td>
                            </tr>'; 
                    break;
                    case 11 : 
                    echo '
                            <tr class="odd gradeX">
                                <th>SOLDE TOTAL</th>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td class="center"><strong>150800$ / 600000Fc</strong></td>
                            </tr>
                            <tr class="odd gradeX">
                                    <th>Janvier</th>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                            </tr>
                            <tr class="even gradeC">
                                    <th>Février</th>
                                    <td>Internet Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mars</th>
                                    <td>Internet Explorer 5.5</td>
                                    <td>Win 95+</td>
                                    <td class="center">5.5</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Avril</th>
                                    <td>Internet Explorer 6</td>
                                    <td>Win 98+</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mai</th>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                    <td class="center">7</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Juin</th>
                                    <td>AOL browser (AOL desktop)</td>
                                    <td>Win XP</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Juillet</th>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.7</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Août</th>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.8</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Septembre</th>
                                    <td>Firefox 2.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.8</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Octobre</th>
                                    <td>Firefox 3.0</td>
                                    <td>Win 2k+ / OSX.3+</td>
                                    <td class="center">1.9</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Novembre</th>
                                    <td>Camino 1.0</td>
                                    <td>OSX.2+</td>
                                    <td class="center">1.8</td>
                            </tr>'; 
                    break;
                    case 12 : 
                    echo '
                            <tr class="odd gradeX">
                                <th>SOLDE TOTAL</th>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td><strong>150800$ / 600000Fc</strong></td>
                                <td class="center"><strong>150800$ / 600000Fc</strong></td>
                            </tr>
                            <tr class="odd gradeX">
                                    <th>Janvier</th>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                            </tr>
                            <tr class="even gradeC">
                                    <th>Février</th>
                                    <td>Internet Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mars</th>
                                    <td>Internet Explorer 5.5</td>
                                    <td>Win 95+</td>
                                    <td class="center">5.5</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Avril</th>
                                    <td>Internet Explorer 6</td>
                                    <td>Win 98+</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="odd gradeA">
                                    <th>Mai</th>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                    <td class="center">7</td>
                            </tr>
                            <tr class="even gradeA">
                                    <th>Juin</th>
                                    <td>AOL browser (AOL desktop)</td>
                                    <td>Win XP</td>
                                    <td class="center">6</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Juillet</th>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.7</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Août</th>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.8</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Septembre</th>
                                    <td>Firefox 2.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td class="center">1.8</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Octobre</th>
                                    <td>Firefox 3.0</td>
                                    <td>Win 2k+ / OSX.3+</td>
                                    <td class="center">1.9</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Novembre</th>
                                    <td>Camino 1.0</td>
                                    <td>OSX.2+</td>
                                    <td class="center">1.8</td>
                            </tr>
                            <tr class="gradeA">
                                    <th>Décembre</th>
                                    <td>Camino 1.5</td>
                                    <td>OSX.3+</td>
                                    <td class="center">1.8</td>
                            </tr>'; 
                    break;

                    /*default : 
                    echo 'Je ne sais pas qui vous êtes !!!';*/ 
                    } 
            ?>
                
            </tbody>
            <tfoot>
                <tr class="odd gradeX">
                    <th>Solde total</th>
                    <td><strong><?php echo $totalUSD_entree. ' $'. ' / '.$totalFC_entree . ' Fc'; ?></strong></td>
                    <td><strong><?php echo $totalUSD_sortie. ' $'. ' / '.$totalFC_sortie . ' Fc'; ?></strong></td>
                    <td class="center"><strong><?php echo $totalUSD_solde . ' $'. ' / '.$totalFC_solde . ' Fc'; ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.table-responsive -->
</div>
<!-- /.panel-body -->

                            