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
            text-transform: uppercase;
            padding-top: 10px;
            padding-bottom: 35px;
            font-family: Times New Roman;
        }
        #entete1 {
            height: 8px;
            margin-top: 80px;
        }
        #entete3 {
            margin-top: 50px;
            margin-right: 70px;
        }
        #entete2 {
            margin-top: 30px;
            /*margin-right: 70px;*/
        }
        #objet {
            margin-top: 45px;
            /*margin-right: 70px;*/
        }
        #objet1 {
            margin-top: 60px;
            width: 250px;
            /*margin-right: 70px;*/
        }
        #titleobj {
            border-bottom: 1px solid #000000; 
            vertical-align: bottom; 
            font-weight: bold; 
            font-size: 12pt;
        }
        #destinateur {
            /*border: 1px solid #000000;*/ 
            margin-top: -10px;
            margin-left: 450px;
            width: 250px;
            
        }
        #destinateur1 {
            /*border: 1px solid #000000;*/ 
            margin-top: -60px;
            margin-left: 450px;
            width: 250px;
            
        }
        .p{
           text-align: justify; 
        }

    </style>

    <div id="content">
        <div id="entete1" align="right"></div>
        <div id="entete3" align="right">
            Kinshasa, le <?php echo $dte; ?>
        </div>
        <div id="entete2">
            N/Réf.: <?php echo $ref; ?>
        </div>
        <div id="objet">
            Objet: <span id="titleobj">Notification <?php echo $sanction; ?></span>
            <?php if($nbrj>0){?>
             <div style="margin-left:45px">
            Début  : <?php echo $dte1; ?><br>
            Fin    : <?php echo $dte2; ?><br>
            Réprise : <?php echo $dter; ?>
            </div>
             <?php }  ?>
        </div>
        <div id="destinateur">
            <?php if($sexe=='M') { 
                echo 'A Monsieur'; 
                } else {
                 echo 'A Madame';    
                    } ?>
            <span style="font-weight: bold;"><?php echo $noms.', '; ?></span><br><?php echo $rue.'  Q/'.$quartier; ?> <br>
            <span id="titleobj"><?php echo $commune; ?>/<?php echo $ville; ?></span>
        </div>
        
        <p>
             <?php if($sexe=='M') { 
                echo 'Monsieur ,'; 
                } else {
                 echo 'Madame ,';    
                    } ?>
        </p>
        
        <p class='p'> <?php echo $comment; ?></p>
        <br>
        <br>
        <br>
        <br>
        
       
        <div id="destinateur1" align="center">
            <span id="titleobj">Département des Resources Humaines</span>
        </div>
        <?php
        if($imprimele==1){
        ?>
        <div id="entete1" align="center">
            <span>Imprimé, le <?php echo date('d/m/Y'); ?> par: </span><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?>
        </div>
          <?php
        }
        ?>
    </div>


