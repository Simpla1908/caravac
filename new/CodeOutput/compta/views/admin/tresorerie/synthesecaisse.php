
  <?php
  /*
   * =======================================================================
   * FILE NAME:        Add.php
   * DATE CREATED:    18-04-2019
   * FOR TABLE:     cptjournal
   * PRODUCED BY:   HEZECOM UltimateSpeed PHP CODE GENERATOR
   * AUTHOR:      Hezecom (http://hezecom.com) info@hezecom.net
   * =======================================================================
   */
  if (!defined('VALID_DIR'))
      die('You are not allowed to execute this file directly');
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
  </style>

  <form action="<?php echo H_ADMIN_MAIN . '&view=cptjournal&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
      <div class="table-wrapper">
          <div class="table-title">
              <div class="row">
                  <div class="col-sm-8"><h2> <b>Synthèse Tresorerie</b></h2></div>
                  <div class="col-sm-4">
                  <ul class="nav pull-right">
                      <button type="submit" class="btn btn-primary btn-flat pull-right" id="btngeneresynthesecaisse" name="btngeneresynthesecaisse"><i class="fa fa-save"></i> Valider</button>
                      <a href="./main.php?pg=admin&view=impression&do=synthesecaisse" target="_blank" id="btnprintsynthesecaisse" class="btn btn-danger btn-flat"><i class="fa fa-print"></i> Imprimer </a>

                  </ul>
                  </div>

              </div>
          </div>
         <div class="output"></div>
          <div class="row">
               <div class="col-lg-2 form-group">
                  <label>Du</label>
                  <input type="text" id="dte1" name="dte1" class="form-control datepicker2" value="">
              </div>
              <div class="col-lg-2 form-group">
                  <label>Au</label>
                  <input type="text" id="dte2" name="dte2" class="form-control datepicker2" value="">
              </div>
              <div class="col-lg-2 form-group">
                  <label>Devise</label>
                  <select id="devise" name="devise" class="form-control choz">
                      <option value=""></option>
                      <option value="fc">CDF</option>
                      <option value="usd">USD</option>
                  </select>
              </div>
          </div>
          <br><br>
          <div class="row" id="resultgeneresynthesecaisse">
            
          </div>
      </div>
  </form>