<?php
session_start();
include("../../bdd/connexion_mysql.php");
$hotel_id=$_SESSION['id_hotel'];
$per_page =24;
$sqlc = "show columns from stk_produit";
$rsdc = mysql_query($sqlc);
$cols = mysql_num_rows($rsdc);
$page = $_REQUEST['page'];
$start = ($page-1)*24;
$sql = "SELECT p.famille_id,f.designation,s.des, COUNT(p.idprod) AS article, SUM(p.pa*qte_initial) AS  valorisation
FROM stk_produit AS p, stk_famille AS f, stk_sous_famille AS s
WHERE p.famille_id=s.id_s_fam AND s.famille=f.idfamille AND p.pseudo_supp=0 AND f.hotel_id='$hotel_id'
GROUP BY p.famille_id ORDER BY f.designation limit $start,24";
$rsd = mysql_query($sql);
?>
<?php
while ($rows = mysql_fetch_assoc($rsd))
{?>
    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <b><?php $design=strtoupper($rows['des']); echo $design; ?></b>
            </div>
            <div class="panel-body">
                <p>Quantité&nbsp;:&nbsp;<font color="#428bd1"><?php echo $rows['article']; ?></font></p>
                <p>Famille&nbsp;:&nbsp;<font color="#428bd1"><?php echo $rows['designation']; ?></font></p>
            </div>
        </div>
    </div>
    <!-- /.col-lg-3 -->

<?php
}?>

<script type="text/javascript">
$(document).ready(function(){

    var Timer  = '';
    var selecter = 0;
    var Main =0;

    bring(selecter);

});

function bring ( selecter )
{
    $('div.shopp:eq(' + selecter + ')').stop().animate({
        opacity  : '1.0',
        height: '60px'

    },300,function(){

        if(selecter < 6)
        {
            clearTimeout(Timer);
        }
    });

    selecter++;
    var Func = function(){ bring(selecter); };
    Timer = setTimeout(Func, 20);
}

</script>