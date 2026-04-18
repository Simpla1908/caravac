
  <?php
  /*
  * =======================================================================
  * FILE NAME:        View.php
  * DATE CREATED:   17-11-2017
  * FOR TABLE:      resemprunt
  * PRODUCED BY:    HEZECOM UltimateSpeed PHP CODE GENERATOR
  * AUTHOR:     Hezecom (http://hezecom.com) info@hezecom.net
  * =======================================================================
  */
  if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
  ?>
  <?php AjaxSearchSuggest(''.H_ADMIN_MAIN.'&view=resemprunt&do=autosearch');?>
  
  <div class="row">
            <div class="col-xs-12">
              <div class="box">
              
               <div class="box-header with-border">
               <h3 class="box-title">Détails avance</h3>
                <ul class="nav pull-right">
<a href="<?php echo H_ADMIN; ?>&view=resemprunt&employe_id=<?php echo $idemply;?>&do=view_av_d" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
  <a href="<?php echo H_ADMIN_MAIN;?>&view=resemprunt&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_PRINT;?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
  </ul>
  
   </div><!-- /.box-header -->
   <div class="box-body">
  <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE;?>" data-page-previous-text="<?php echo LANG_PREVIOUS;?>" data-page-next-text="<?php echo LANG_NEXT;?>">
  <thead>
    <tr>
    <th>Date</th>
    <th >Montant</th>
  </tr>
  </thead>
  <tbody>
     <?php
    $dte ='';
    $montrembourse =0;
  foreach($rows as $rows)
     {
        $dte =$rows->dterembourse;
        $montrembourse = montant_equivalent_bdd($rows->monnaierembourse,$_SESSION['Paie_affiche'],$rows->tauxremourse,$rows->montrembourse);   
        if($montrembourse>0){    
  ?>
  <tr>
  <td><?php echo dateAffiche($dte);?></td>
  <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montrembourse);?></td>
    </tr>
  <?php 
  }  
}
?>
  </tbody>
  <tfoot>
    <tr>
    <td colspan="6">
    <div class="pagination"><?php //echo $paging;?></div>
    </td>
    </tr>
</tfoot>
</table>
  </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->