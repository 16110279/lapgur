 <?php include "../koneksi.php";
include "../class_lib.php";
$newkbm = new kbm; 
$newguru = new guru; 
$newkls = new kls; 
            $idkelas = $_GET['id_kelas'];

?>
<?php 
    session_start(); 
    // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['id_admin']=="") {
        header("location:index");
    }
    ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Datatable - srtdash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>


</head>

<body>
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="../assets/images/icon/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                            <nav>
                        <ul class="metismenu" id="menu">                            
                            <li>
                                <a href="dashmin" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Menu Admin</span></a>
                                <ul class="collapse">
                                     <li class="active"><a href="dashmin.kbm">KBM</a></li>                                                                           
                                     <li>
                                        <a href="#" aria-expanded="true">Nilai</a>
                                        <ul class="collapse">
                                            <li><a href="#">Keterampilan</a></li>
                                            <li><a href="#">Pengetahuan</a></li>
                                            <li><a href="#">Deskriptif</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="dashmin.guru">Guru</a></li>
                                     <li><a href="dashmin.mapel">Mapel</a></li>
                                     <li><a href="dashmin.kelas">Kelas</a></li>
                                     <li><a href="dashmin.siswa">Siswa</a></li>                       
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Cetak Laporan
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="dashgur.nk.php">Nilai Keterampilan</a></li>
                                    <li><a href="index3-horizontalmenu.html">Nilai Pengetahuan</a></li>
                                    <li><a href="index3-horizontalmenu.html">Nilai Deskriptif</a></li>

                                </ul>
                            </li>
                           </ul></li></ul>
                    </nav>z
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                         <div class="col-sm-4">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">Dashboard</h4>
                            </div>
                        </div>

                    <!-- profile info & task notification -->
                    <div class="col-sm-8 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="../assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php $sql = mysqli_query($koneksi,"select admin.nama_admin from admin
                         where admin.id_admin=" .$_SESSION['id_admin']);
        while($data = mysqli_fetch_array($sql)){?>
        <td><?php echo $data['nama_admin']; } ?>



                                <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Message</a>
                                <a class="dropdown-item" href="#">Settings</a>
                                <a class="dropdown-item" href="#">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
            <!-- page title area end -->
                      <!-- Textual inputs start -->
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Edit Wali Kelas</h4>




<?php
    $nomor = 1;
      $output = '';  
      $sql = "SELECT * from daftar_kelas where id_kelas=$idkelas"; 

      $result = mysqli_query($koneksi, $sql);  
      while($row = mysqli_fetch_array($result)){

?>
                                        <form method="post" action="">
                                        <div class="form-group">
                                            <input name="idk" class="form-control" type="text" hidden="" readonly="" value="<?php echo $row['id_kelas'];  ?>" id="example-text-input">                                            
                                            <label for="example-text-input" class="col-form-label">Nama Kelas </label>
                                            <input name="kelas" class="form-control" type="text" readonly="" value="<?php echo $row['alias_kelas'];  ?>" id="example-text-input">
                                            <label for="example-search-input" class="col-form-label">Nama Jurusan </label>
                                            <input name="jurusan" class="form-control" type="text" readonly="" value="<?php echo $row['nama_jurusan'];  ?>" id="example-text-input">                                                                                 
                                            <label  for="example-search-input" class="col-form-label">Wali Kelas : </label><br>
                                            <select name="guru" class="custome-select border-0 pr-3" >
                                                  <?php echo $newkls -> walisekarang($koneksi);
                                                  echo $newkls -> walilain($koneksi);
                                              ?>  

                                            </select>
                                        </div>
              
                                      <br>

                                      <button name="submit" type="submit" class="btn btn-primary mb-3">UPDATE</button>

                                      </form>

                                    </div>
                                </div>
                            </div></td>
                            <!-- Textual inputs end -->
                            <br>


                  <?php } ?>


<?php

if(isset($_POST['submit']))

{


$guru = $_POST['guru'];
$kelas = $_POST['idk'];


echo "ID guru : ";
echo $guru;
echo "<br>";
echo "N kelas : ";
echo $kelas;


//mysqli_query($koneksi,"insert into kbm (id_mapel,id_guru,id_kelas,id_semester,id_tahunajar) values('$mapel','$guru','$kelas','$semester','$tahunajar')");
mysqli_query($koneksi,"UPDATE `wali` SET `id_guru`=$guru WHERE id_kelas='$kelas'");
echo ("<script LANGUAGE='JavaScript'>
    window.alert('Succesfully Updated');
    window.location.href='';
    </script>");

}

?>








            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
 
    <!-- jquery latest version -->
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>
