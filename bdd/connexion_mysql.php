<?php

$connection = @mysql_connect("localhost", "root", "E1b2u3t4e5l6o@") or die("impossible de se connecter.<br>\n Erreur MySQL'" . mysql_error() . "'");
mysql_select_db('caravacdb') or die("impossible de selectionner la base spécifiée.<br>\n Erreur MySQL'" . mysql_error() . "'");
