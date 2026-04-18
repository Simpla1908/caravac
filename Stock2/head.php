<?php
if (!isset($_SESSION)) {
    session_start();
}
include './bdd/connexion.php';
include '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ebutelo | Stock</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="js/plugins/select2/select2.min.css">
    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/fanion2.png">
    <link rel="stylesheet" type="text/css" href="datepicker/jquery.datetimepicker.css">
    <!-- pour la pagination-->
    <link rel="stylesheet" type="text/css" media="screen" href="pagination/css.css" />
    <style>
        .loader222{
            background-image: url(images/ajax-loader.gif);
            background-repeat: no-repeat;
            background-position: center;
            height: 150px;
        }
    </style>
    <script type="text/javascript" src="pagination/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/JsBarcode.all.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            
            function showLoader() {

                $('.search-background').fadeIn(200);
            }

            function hideLoader() {

                $('.search-background').fadeOut(200);
            }
            ;

            $("#paging_button li").click(function () {

                showLoader();

                $("#paging_button li").css({'background-color': ''});
                $(this).css({'background-color': '#006699'});

                $("#content").load("pagination/data.php?page=" + this.id, hideLoader);

                return false;
            });

            $("#1").css({'background-color': '#006699'});
            showLoader();
            $("#content").load("pagination/data.php?page=1", hideLoader);

        });
    </script>
</head>