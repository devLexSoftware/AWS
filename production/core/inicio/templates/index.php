<?php include("production/config/bloque.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<!--<link rel="icon" href="images/favicon.ico" type="image/ico" />-->

    <title>  Workshop Studio Premiere </title>

    <!-- Bootstrap -->
    <link href="../../../workshop.com/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../../workshop.com/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../../workshop.com/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../../workshop.com/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../../../workshop.com/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../../../workshop.com/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../../../workshop.com/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../../workshop.com/build/css/custom.min.css" rel="stylesheet">


    <script type="text/javascript">
      window.onload=function(){
        query=window.location.search.substring(1);
        q=query.split("&");
        vars=[];
        for(i=0;i<q.length;i++){
          x=q[i].split("=");
          k=x[0];
          v=x[1];
          vars[k]=v;
        }
        abrir(vars['p'],vars['ref']);
      };
</script>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><span>Workshop Studio Premiere</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../../../workshop.com/pictures/WorkshopLogo.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>Norberto Morales</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menú</h3>
                <ul class="nav side-menu">
                <li ><a href="index.php?p=cotizaciones" >Cotizaciones</a></li>
                <li><a href="index.php?p=obras">Obras</a></li>
                  <li><a href="index.php?p=clientes"><i class=""></i> Clientes <span class=""></span></a></li>
                  <li><a href="index.php?p=compras"><i class=""></i> Compras <span class=""></span></a></li>
                  <li><a href="index.php?p=proveedores"><i class=""></i> Proveedores <span class=""></span></a></li>
                  <li><a href="index.php?p=empleados"><i class=""></i>Empleados <span class=""></span></a></li>
                  <li><a ><i class=""></i>Grupos</i></a></li>
                </ul>
              </div>

              <div class="menu_section">
                <h3>About Us</h3>
                <ul class="nav side-menu">
                  <li><a ><i class=""></i> Version <span class=""></span></a></li>

                  <li><a href="index.php?p=soporte" ><i class=""></i> Soporte <span class=""></span></a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class=""></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../../../workshop.com/pictures/WorkshopLogo.png" alt="">Arq. Norberto Morales González
                  </a>

                    <li><a href="production/config/salir.php"><i class="pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- Page content -->
        <div class="right_col" role="main">
          <!-- top tiles for works-->
          

            <div class="content-wrapper">
              <div class="container-fluid">
                <div class="row">
                  <div id="divContenido" class="form-group col-md-12">
                      
                  </div>
                  </div>
                </div>                
              </div>              
            </div>

        </div>
        <!-- /page content -->

            





        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <strong>
              Copyright &copy; 2018 <a href=""> Lex Software</a>
            </strong>
            All Rights Reserved.
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>


    <!-- jQuery -->
    <script src="../../../workshop.com/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../../workshop.com/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../../workshop.com/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../../workshop.com/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../../../workshop.com/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../../../workshop.com/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../../../workshop.com/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../../../workshop.com/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../../../workshop.com/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../../../workshop.com/vendors/Flot/jquery.flot.js"></script>
    <script src="../../../workshop.com/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../../../workshop.com/vendors/Flot/jquery.flot.time.js"></script>
    <script src="../../../workshop.com/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../../../workshop.com/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../../../workshop.com/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../../../workshop.com/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../../../workshop.com/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../../../workshop.com/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../../../workshop.com/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../../../workshop.com/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../../../workshop.com/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../../../workshop.com/vendors/moment/min/moment.min.js"></script>
    <script src="../../../workshop.com/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../../workshop.com/build/js/custom.min.js"></script>

    <!-- Navegacion -->
    <script src="../../../workshop.com/production/components/js/files/General.js"></script>

    <script src="../../../workshop.com/vendors/datatables/jquery.dataTables.js"></script>
    <script src="../../../workshop.com/vendors/datatables/dataTables.bootstrap4.js"></script>
    <script src="../../../workshop.com/production/components/js/files/compras/general.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


<script type="text/javascript">
var n = 0;
 $(document).ready(function() {
        $('#mostrar').click(function() {
            $('#target').slideToggle("fast");
            if(n == 0){
                $("#mostrar").text("Ocultar formulario");
                n = 1;
            }
            else{
                $("#mostrar").text("Mostrar formulario");
                n = 0;
            }
        });
    });
</script>
  </body>
</html>
