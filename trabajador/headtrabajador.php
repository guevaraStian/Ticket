<?php
    session_start();
    //Si la variable "user_id" no esta llena entonces muestra la interface index.php de inicio de sesion
    include "../config/config.php";
    if (!isset($_SESSION['user_id'])&& $_SESSION['user_id']==null) {
        header("location: ../index.php");
    }

?>
<?php 
    $id=$_SESSION['user_id'];
    $query=mysqli_query($con,"SELECT * from user where id=$id");
    //Trae el nombre, y otros atibutos para mostrarlos en el encabezado
    while ($row=mysqli_fetch_array($query)) {
        $username = $row['username'];
        $name = $row['name'];
        $cedula = $row['cedula'];
        $profile_pic = $row['profile_pic'];
        $created_at = $row['created_at'];
        $agenciauser = $row['agenciauser'];
  
    }


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title." ".$name; ?> </title>

        <!-- Bootstrap -->
        <link href="../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../css/nprogress/nprogress.css" rel="stylesheet">
          <!-- iCheck -->
       <link href="../css/iCheck/skins/flat/green.css" rel="stylesheet">
       <!-- Datatables -->
        <link href="../css/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../css/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../css/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../css/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../css/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <!-- jQuery custom content scroller -->
        <link href="../css/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

        <!-- bootstrap-daterangepicker -->
        <link href="../css/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../css/custom.min.css" rel="stylesheet">

        <!-- MICSS button[type="file"] -->
        <link rel="stylesheet" href="../css/micss.css">

        <!-- librerias para crear la grafica -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                          <a href="iniciotrabajador.php" class="site_title"><i class="fa fa-ticket"></i> <span>Ticket </span></a>
                        </div>
                        <div class="clearfix"></div>

                            <!-- menu profile quick info -->
                                <div class="profile clearfix">
                                    <div class="profile_pic">
                                        <img src="../images/profiles/logo.png" alt="<?php echo $name;?>" class="img-circle profile_img">
                                    </div>
                                    <div class="profile_info">
                                        <span>Bienvenido,</span>
                                        <h2><?php echo $name;?></h2>
                                    </div>
                                </div>
                            <!-- /menu profile quick info -->

                        <br />