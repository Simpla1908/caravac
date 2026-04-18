<?php
if (!isset($_SESSION)) {
    session_start();
 }
 include_once '../../impression/mpdf60/mpdf.php';
 include '../../bdd/connexion.php';
    $company_id = $_SESSION['company_id'];
    //Selection des company
    $requete_company = $bdd->prepare("SELECT * FROM  t_company WHERE id_c=:company_id");
    $requete_company->BindParam(':company_id', $company_id);
    $requete_company->execute();
    while ($donnees = $requete_company->fetch()) {

        $nom_c = $donnees['nom_c'];
        $adresse_c = $donnees['adresse_c'];
        $ville = $donnees['ville'];
        $logo = $donnees['logo'];
        $idnat = $donnees['idnat'];
        $rccm = $donnees['rccm'];
        $num_impot = $donnees['num_impot'];
        $telephone = $donnees['phone'];
        $email_compagny = $donnees['email_company'];
        $compte_bancaire = $donnees['compte_bancaire'];
        $mention = $donnees['mention'];
    }
  ob_start();
?>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: Times New Roman;
        font-size: 10pt;
        color: #000;
    }

    #titre {
        margin-bottom: 5px;
    }

    #table {
        width: 100%;
        border-left: 0.5px solid #000;
        border-top: 0.5px solid #000;
        border-spacing: 0;
        border-collapse: collapse;
        font-family: helvetica;

    }

    #table th {
        background: #eee;
        border: 0.5px solid #000;
        height: 10px;
        padding: 1mm;
        text-transform: uppercase;
        /*font-weight:bold;*/
    }

    #table td {
        border-right: 0.5px solid #000;
        border-bottom: 0.5px solid #000;
        padding: 1mm;
    }

    .page {
        height: 297mm;
        width: 210mm;
        page-break-after: always;
    }

    #entete {
        text-align: center;
        /*text-transform: uppercase;*/
        padding-top: 10px;
        padding-bottom: 20px;
        font-family: helvetica;
    }

    #entete1 {
        margin-top: 10px;
        margin-right: 70px;
        text-align: center;
    }

</style>
 <div style="margin-left:900px;">
 <span >Date : <?php echo date('d/m/Y'); ?></span>
  </div>
 <div id="details" class="clearfix">
            <div id="client">
                <span class="name">Client :  <b><?php echo  strtoupper($_SESSION['partenaire']);?></b></span><br>
                <span class="name">Période : <b><?php echo $_SESSION['periode_fact_gl'];?></b></span><br>
                <span class="name">Type : <b><?php echo $_SESSION['type_fact_gl'];?></b></span><br>
            </div>

 </div>

<div id="content">
    <div id="entete">
        <h2><strong>FACTURE N° <?php echo $_SESSION['num_fact_gl'];?></strong> </h2>
    </div>
    <table align="center" id="table">
        <thead>
            <tr>
                 <th>#</th>
                <th>Noms</th>
                <th>Date</th>
                <th>Facture</th>
                <th>Mode</th>
                 <th>Montant</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $n = count($_SESSION['rows_resto']['i']);
            for ($i = 0; $i <= $n - 1; $i++) {
                ?>
                <tr class="odd gradeX">
                <td><?php echo $_SESSION['rows_resto']['i'][$i]; ?></td>
                <td><?php echo $_SESSION['rows_resto']['noms'][$i]; ?></td>
                <td><?php echo $_SESSION['rows_resto']['date'][$i];?></td>
                <td><?php echo $_SESSION['rows_resto']['facture'][$i];?></td>
               <td><?php echo $_SESSION['rows_resto']['mode'][$i];?></td>

                <td><?php echo $_SESSION['rows_resto']['montant'][$i];?></td>
                </tr>
                <?php
               }
                ?>
        </tbody>
         <tfoot>
          <tr>
          <td colspan="5">Total</td>
          <td><?php echo $_SESSION['totaux'];?></td>
          </tr>
        </tfoot>
    </table>
</div>
<?php
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    include './entete_pied_page.php';
    $mpdf = new mPDF('c','A4-L','','',15,15,30,20,5,5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Facturation_Restaurant.pdf", "I");
?>