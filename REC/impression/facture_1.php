<?php
include_once '../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
session_start();
?>
<?php
$company_id = $_SESSION['company_id'];
$id_hotel=$_SESSION['id_hotel'];


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



    <div class="container outer-section">
        
       
        <div id="print-area">
                  <div class="row pad-top font-big">
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <img src="assets/img/logo.png" alt="Free Bootstrap Invoice Logo" />
                </div>
                      <div  style="margin-top: -100px; margin-left: 150px;">
                    <strong>Support : </strong>info@yourdomain.com
                    <br />
                    <strong>Call :</strong>+01-345-908-55-89<br />
                    <strong>Fax :</strong>+456-345-908-559<br />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <strong>Design Bootstrap Technologies  </strong>
                    <br />
                    Address : 234/90, New York Street
                    <br />
                    United States.<br />
                </div>

            </div>
            <br />
            <hr />
            <div class="row text-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    This is an electronic generated receipt , for any issues please contact &nbsp;<strong> info@your domain.com</strong>

                </div>
            </div>
            <hr />

            <div class="row ">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    Client Details :
                    <h4><strong>Justin Neogo Cater</strong></h4>
                    <h4>678, Lamen Trees Lane,Boston Bay</h4>
                    <h4>United States - 2018976</h4>
                    <h4><strong>Email: </strong>justindemo@domain.com</h4>
                    <h4><strong>Call: </strong>+01-90-89-56-00</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h4>Payment Details :</h4>
                    <h4><strong>Invoice No: </strong>#10009</h4>
                    <h4>Invoice Date:  23rd Jan 2015</h4>
                    <h4>Purchased On:  21st Jan 2015</h4>
                    <h4><strong>Amount Paid : </strong>672 USD</h4>
                    <h4><strong>Delivery Status : </strong>Completed</h4>
                </div>
            </div>
            <hr />
            <br />
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Perticulars</th>
                                    <th>Quantity.</th>
                                    <th>Unit Price</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Plugin Development</td>
                                    <td>2</td>
                                    <td>100 USD</td>
                                    <td>200 USD</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Wordpress Installation</td>
                                    <td>1</td>
                                    <td>300 USD</td>
                                    <td>300 USD</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Hosting Space</td>
                                    <td>1</td>
                                    <td>25 USD</td>
                                    <td>25 USD</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Website Design</td>
                                    <td>1</td>
                                    <td>75 USD</td>
                                    <td>75 USD</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                    Total Amount Without Applying Any Taxes : 
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <strong>600 USD </strong>
                </div>
                <hr />
                <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                    Total Amount After Applying Any Taxes ( 12.50 % ) : 
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <strong>672 USD </strong>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <strong>IMPORTANT INSTRUCTIONS :
                    </strong>
                    <h5># This is an electronic receipt so doesn't require any signature.</h5>
                    <h5># All perticulars are listed with 10.50 % taxes , so if any issue please contact us immediately.</h5>
                    <h5># You can contact us between 10:am to 6:00 pm on all working days.</h5>
                </div>
            </div>

        </div>
        <hr />
        <div class="row pad-bottom">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <a href="#" class="btn btn-primary ">Print Invoice</a>
                &nbsp;&nbsp;&nbsp;
              <a href="#" class="btn btn-success ">Download</a>

                <h5>Note : You can print and download invoice by clicking above. </h5>
            </div>
        </div>
    </div>
   


<?php
$body = ob_get_clean();
$body = iconv("UTF-8","UTF-8//IGNORE",$body);

//Entete et pied de page
include './entete_pied_page.php';
$stylesheet = file_get_contents('bootstrap.css'); // external css
$stylesheet1 = file_get_contents('style.css'); // external css
$mpdf = new mPDF('c','A4','','',15,15,30,20,5,5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($stylesheet1,1);
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($body);
$mpdf->Output("Facture.pdf", "I");