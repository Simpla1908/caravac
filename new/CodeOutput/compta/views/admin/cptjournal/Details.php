
  	<?php
  	/*
  	* =======================================================================
  	* FILE NAME:        Add.php
  	* DATE CREATED:  	18-04-2019
  	* FOR TABLE:  		cptjournal
  	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
  	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
  	* =======================================================================
  	*/
  	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
  	?>
  	 <style type="text/css">
      body {
          color: #404E67;
          background: #F5F7FA;
  		font-family: 'Open Sans', sans-serif;
  	}
  	.table-wrapper {
          background: #fff;
          padding: 20px;	
          box-shadow: 0 1px 1px rgba(0,0,0,.05);
      }
      .table-title {
          padding-bottom: 10px;
          margin: 0 0 10px;
      }
      .table-title h2 {
          margin: 6px 0 0;
          font-size: 22px;
      }
      .table-title .add-new {
          float: right;
  		height: 30px;
  		font-weight: bold;
  		font-size: 12px;
  		text-shadow: none;
  		min-width: 100px;
  		line-height: 13px;
      }
  	.table-title .add-new i {
  		margin-right: 4px;
  	}
      
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  	$('[data-toggle="tooltip"]').tooltip();
  	var actions = $("table td:last-child").html();
  	// Append table with add row form on add new button click
      $(".add-new").click(function(){
  		$(this).attr("disabled", "disabled");
  		var index = $("table tbody tr:last-child").index();
          var row = '<tr>' +
              '<td><input type="text" class="form-control" name="name" id="name"></td>' +
              '<td><input type="text" class="form-control" name="department" id="department"></td>' +
              '<td><input type="text" class="form-control" name="phone" id="phone"></td>' +
  			'<td>' + actions + '</td>' +
          '</tr>';
      	$("table").append(row);		
  		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
          $('[data-toggle="tooltip"]').tooltip();
      });
  	// Add row on add button click
  	$(document).on("click", ".add", function(){
  		var empty = false;
  		var input = $(this).parents("tr").find('input[type="text"]');
          input.each(function(){
  			if(!$(this).val()){
  				$(this).addClass("error");
  				empty = true;
  			} else{
                  $(this).removeClass("error");
              }
  		});
  		$(this).parents("tr").find(".error").first().focus();
  		if(!empty){
  			input.each(function(){
  				$(this).parent("td").html($(this).val());
  			});			
  			$(this).parents("tr").find(".add, .edit").toggle();
  			$(".add-new").removeAttr("disabled");
  		}		
      });
  	// Edit row on edit button click
  	$(document).on("click", ".edit", function(){		
          $(this).parents("tr").find("td:not(:last-child)").each(function(){
  			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
  		});		
  		$(this).parents("tr").find(".add, .edit").toggle();
  		$(".add-new").attr("disabled", "disabled");
      });
  	// Delete row on delete button click
  	$(document).on("click", ".delete", function(){
          $(this).parents("tr").remove();
  		$(".add-new").removeAttr("disabled");
      });
  });
  </script>
  	 
          <div class="table-wrapper">
              <div class="table-title">
                  <div class="row">
                      <div class="col-sm-6"><h2>Détails <b>Journal</b></h2></div>
                      <div class="col-sm-6" style="text-align:right;">
                <?php
                 if($rows->lettrer==0){
                 ?>
          			<a href="<?php echo H_ADMIN;?>&view=cptjournal&do=update&id=<?php echo $id;?>" class="btn btn-primary btn-flat" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-edit"></i> Modifier</a>
                <a id="<?php echo $id;?>" class="btn btn-danger btn-flat supjournal" ><i class="fa fa-trash-o"></i> Supprimer </a>

                <a id="<?php echo $id;?>" class="btn btn-primary btn-flat btnlettrer" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-edit"></i> Lettrer</a>
                <?php
                 }
                 ?>
                <a href="./main.php?pg=admin&view=impression&do=detailsjournal" id="btnprintdetjrnl"  class="btn btn-success btn-flat" target="_blank"><i class="fa fa-print"></i> Imprimer </a>
          	       </div>
                
              </div>
               <div class="col-lg-4">
             	<p><b>Type de journal</b></p>
             	<span><?php
               echo ucfirst($rows->typejournal);
               $_SESSION['typejournal']=ucfirst($rows->typejournal);
                ?></span>
              </div>
              <div class="col-lg-4">
              <p><b>Réference</b></p>
             	<span>
                <?php 
                echo  $rows->reference;
                $_SESSION['reference']=$rows->reference;
                ?>      
                </span>
              </div>
            <div class="col-lg-4">
            <p><b>Date</b></p>
            <span>
            <?php 
            echo dateAffiche($rows->dte);
            $_SESSION['dte']=dateAffiche($rows->dte);
             ?>
               
             </span>
           </div>
           <div class="col-lg-6">
            <br>
           <p><b>Description</b></p>
            <span>
              <?php 
              echo ucfirst($rows->description);
              $_SESSION['description']=ucfirst($rows->description);
                ?>
              
            </span>
             <br>
            <br>
             <br>
          </div>


              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Compte</th>
                          <th>Débit</th>
                          <th>Crédit</th>

                      </tr>
                  </thead>
                  <tbody>
                       <?php
                        //Mise en session pour impression
                        $_SESSION['details'] = array();
                        $_SESSION['details']['compte'] = array();
                        $_SESSION['details']['debit'] = array();
                        $_SESSION['details']['credit'] = array();
                        //fin mise en session
                        $Totald=0;
                        $Totalc=0;
                        $debit=0;
                        $credit=0;
                       foreach ($result as $rows) {
                        $data=INFOSFromAccountNumber($rows->compte_ecriture,$rows->long_compte,$bdd);
                        $libcompte=$rows->compte_ecriture.' '.$data['lib'];
                        ?>
                      <tr>
                          <td><?php echo ucfirst($libcompte); ?></td>
                          <td>
                          <?php
                          $debit=0;
                          if($rows->debit>0){
                         $debit=$rows->debit;
                         $devise=$rows->devise;
                         $Totald=$Totald+$debit;
                         echo afficheMontant($devise,$debit); 
                          }
                          ?>
                          </td>
                          <td>
                          <?php 
                          $credit=0;
                          if($rows->credit>0){
                          $credit=$rows->credit;
                          $devise=$rows->devise;
                          $Totalc=$Totalc+$credit;
                         echo afficheMontant($devise,$credit); 
                          }
                          ?>
                          </td>
                      </tr>
                      <?php
                      array_push($_SESSION['details']['compte'],ucfirst($libcompte));
                      array_push($_SESSION['details']['debit'],afficheMontant($devise,$debit));
                      array_push($_SESSION['details']['credit'],afficheMontant($devise,$credit));

                       } 
                     $_SESSION['Totald']=afficheMontant($devise,$Totald);
                     $_SESSION['Totalc']=afficheMontant($devise,$Totalc);
                       ?>
                      
                  </tbody>
                   <tfoot>
                        <tr>
                        <th >TOTAL</th>
                        <th ><?php echo afficheMontant($devise,$Totald);?></th>
                        <th ><?php echo afficheMontant($devise,$Totalc);?></th>
                        </tr>
                      </tfoot>
              </table>
          </div>
            <div class="modal fade" id="myModalsupjournal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Suppression Journal</h4>     
                  </div>
                      <div class="modal-body">
                       <input id="idecriture" name="idecriture" type="hidden" value="">           
                        <p>
                      Voulez-vous supprimer ce journal
                      </p>
                      </div>
                      <div class="modal-footer">
                          <button  class="btn btn-info" id="supjournaloui"><i class="fa fa-fw fa-thumbs-up"></i>&nbsp;Oui</button>
                          <button  class="btn btn-danger pull-right" id="supjournalnon"><i class="fa fa-fw fa-thumbs-down"></i>&nbsp;Non</button>

                      </div>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>