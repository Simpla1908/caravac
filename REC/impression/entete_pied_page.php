<?php

$header = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="60%" align="left"><img height="60" src="../images/logo_entreprise/'.$logo.'" /></td>
<td width="50%" align="right"><span style="font-size:12pt;">{PAGENO}</span></td>
</tr></table>
';
$footer = '<div align="center" style="font-family:mono; font-size:10pt; font-style:italic; border-top: 0.03cm solid #000000;">'
        . $_SESSION['adresse_hotel'].'<br>'
        . 'Email: '. $_SESSION['mail'].' Tél.: '.$_SESSION['phone'].'<br>'
        . 'ID.Nat.: '.$_SESSION['idnat'].' RCCM.: '.$_SESSION['rccm'].'<br>'
        .'</div>';
?>
<!--<img height="50" src="../images/logo_entreprise/logo_TMB64.png" />-->