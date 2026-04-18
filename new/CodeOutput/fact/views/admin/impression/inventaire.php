<style>
    *
    {
        margin:0;
        padding:0;
        font-family:helvetica;
        font-size:10pt;
        color:#000; 
    }
    #titre
    {
        margin-bottom:5px;
    }
    #table
    {
        width:100%;
        border-left: 0.5px solid #000;
        border-top: 0.5px solid #000;
        border-spacing:0;
        border-collapse: collapse; 
        font-family: helvetica; 

    }
    #table th
    {
        background:#eee;
        border:0.5px solid #000;
        height:10px;
        padding: 1mm;
        text-transform: uppercase;
        /*font-weight:bold;*/
    }
    #table td{
        border-right: 0.5px solid #000;
        border-bottom: 0.5px solid #000;
        padding: 1mm;
    }
    .page
    {
        height:297mm;
        width:210mm;
        page-break-after:always;
    }
    #entete{
        text-align: center;
        text-transform: uppercase;
        padding-top: 35px;
        padding-bottom: 15px;
        font-family: helvetica;
    }
    #entete1{
        margin-top: 55px;
        margin-right: 70px;
    }
</style>

<div id="content">
    <div id="entete1" align="right">
        <span>Kinshasa, </span><?php echo 'le '. date('d/m/Y'); ?>
    </div>
    <div id="entete">
        <h3><u> INVENTAIRE <?php echo 'DU '.$_SESSION['dteinventaire']; ?></u></h3>
    </div>
    <table  border="1" align="center" id="table">
        <thead>
            <tr>
               <th>N°</th>
               <th>ARTICLE</th>
                <th>QTE DISPO</th>
                <th>PAU</th>
                <th>PVU</th>
                <th>MARGE</th>
               <th>VALEUR EN STOCK</th>
           </tr>
       </thead>
       <tbody>
            <?php include(APP_FOLDER . '/views/admin/stk__mouvement/datainventaire.php'); ?>
       </tbody>
       <tfoot>
           <tr>
                <th colspan="6">Total</th>
                <th><?php echo  afficheMontant($m_affiche,$valstock)?></th>
            </tr>
       </tfoot>  
    </table>
</div>
