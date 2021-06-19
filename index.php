<?php
session_start();
ob_start(); // tải file thành công sau khi thêm ob_start
// lỗi gặp phải và khác phục được 'Cannot modify header information - headers already sent by (output started at'

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Dashboard Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!-- Chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Super filter -->
    <script src="js/tablefilter/tablefilter.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="/js/tablefilter/style/tablefilter.css" /> -->

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/customTable.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sidebar.css">

</head>

<?php
require('function.php');
if ($_GET["TenChucVu"]) {
    $tenChucVu = $_GET["TenChucVu"];
}
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}
$tenGiaoVien = NULL;
if ($tenChucVu === 'giaovien') {
    $tenGiaoVien = $infoSmallTable->getThongTinGiaoVien($_SESSION['MaDangNhap'], 'TenGiaoVien');
    $tenCV = "Giáo Viên";
}

if ($tenChucVu === 'truongbomon') {
    $tenGiaoVien = $infoSmallTable->getThongTinGiaoVien($_SESSION['MaDangNhap'], 'TenGiaoVien');
    $tenCV = "Trưởng bộ môn";
}
if ($tenChucVu === 'truongkhoa') {
    $tenGiaoVien = $infoSmallTable->getThongTinGiaoVien($_SESSION['MaDangNhap'], 'TenGiaoVien');
    $tenCV = "Trưởng Khoa";
}

if ($tenChucVu === 'admin' || $tenChucVu === 'nhanvien') {
    if ($tenChucVu === 'nhanvien') {
        $tenCV = "Nhân Viên";
    }
    if ($tenChucVu === 'admin') {
        $tenCV = "Admin";
    }
    $tenGiaoVien = $account->getTenNhanVien($_SESSION['MaDangNhap'], 'NhanVien', 'MaNhanVien');
}

?>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4>Page content</h4>
            </div>

            <ul class="list-unstyled components">
                <p>Page</p>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php?TenChucVu=<?php echo $tenChucVu; ?>">
                        <span data-feather="home"></span>
                        Trang chủ
                    </a>
                </li>
                <?php if ($tenChucVu === 'admin') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=data">
                            <span data-feather="file"></span>
                            Import dữ liệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=calculate">
                            <span data-feather="shopping-cart"></span>
                            Xem thống kê
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=thongkenangcao">
                            <span data-feather="shopping-cart"></span>
                            Thống kê nâng cao
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($tenChucVu == 'giaovien' || $tenChucVu === 'truongbomon' || $tenChucVu === 'truongkhoa') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=ratingInfo">
                            <span data-feather="users"></span>
                            Xem đánh giá
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($tenChucVu === 'truongkhoa' || $tenChucVu === 'admin') : ?>
                    <li class="nav-item">
                        <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=ThongKeDiemKhoa" class=" nav-link">Thống kê điểm khoa</a>
                    </li>
                <?php endif; ?>
            </ul>

            <?php if ($tenChucVu === 'admin') : ?>
                <ul class="list-unstyled components">
                    <p>Database</p>
                    <li class="nav-item">
                        <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=DBlopHocPhan" class=" nav-link">Danh sách các lớp học phần</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=DBMonHoc" class=" nav-link">Danh sách môn học</a>
                    </li>
                    <li>
                        <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=DBNamHoc" class=" nav-link">Danh Sách năm học</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=DBGiaoVien" class=" nav-link">Danh sách giáo viên</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=DBChucVu" class=" nav-link">Danh sách chức vụ</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=DBKhoa" class=" nav-link">Danh sách khoa</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=DBBoMon" class=" nav-link">Danh sách bộ môn</a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=DBNhanVien" class=" nav-link">Danh sách nhân viên</a>
                    </li>


                </ul>
            <?php endif; ?>


            <ul class="list-unstyled CTAs">
                <li>
                    <a href="login.php" class="download">Sign out </a>
                </li>
                <!-- <li>
                    <a href="login.php" class="article">Sign out</a>
                </li> -->
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <!-- <span>Toggle Sidebar</span> -->
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav m-auto">

                            <li class="nav-item">
                                <h4><a class="nav-link" href="#"><?php echo $tenCV . ": " . $tenGiaoVien; ?></a></h4>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#"><?php echo $tenGiaoVien; ?></a>
                            </li> -->

                        </ul>
                    </div>
                </div>
            </nav>

            <?php
            if (isset($page)) {
                switch ($page) {
                    case 'data':
                        include('page/admin/insert/data.php');
                        break;
                    case 'calculate':
                        include('page/admin/calculate/calculate.php');
                        break;
                    case 'ratingInfo':
                        // include('page/teacher/ratingInfo.php');
                        include('page/admin/calculate/calculate.php');
                        break;
                    case 'htPhieu':
                        include('page/admin/calculate/hienThiPhieu.php');
                        break;
                    case 'htGopY':
                        include('page/admin/calculate/hienThiGopY.php');
                        break;
                    case 'thongkenangcao':
                        include('page/admin/calculate/thongKeNangCao.php');
                        break;
                    case 'tonghopketqua':
                        include('page/admin/calculate/tongHopPhieu.php');
                        break;
                    case 'tonghopketquagopy':
                        include('page/admin/calculate/tongHopGopY.php');
                        break;
                    case 'ThongKeDiemKhoa':
                        include('page/admin/calculate/thongKeDiemKhoa.php');
                        break;

                        // DBControl
                    case 'DBlopHocPhan':
                        include('page/admin/DBControl/DBLopHocPhan.php');
                        break;
                    case 'DBMonHoc':
                        include('page/admin/DBControl/DBMonHoc.php');
                        break;
                    case 'DBNamHoc':
                        include('page/admin/DBControl/DBNamHoc.php');
                        break;
                    case 'DBGiaoVien':
                        include('page/admin/DBControl/DBGiaoVien.php');
                        break;
                    case 'DBChucVu':
                        include('page/admin/DBControl/DBChucVu.php');
                        break;
                    case 'DBKhoa':
                        include('page/admin/DBControl/DBKhoa.php');
                        break;
                    case 'DBBoMon':
                        include('page/admin/DBControl/DBBoMon.php');
                        break;
                    case 'DBNhanVien':
                        include('page/admin/DBControl/DBNhanVien.php');
                        break;

                        // adaDataCSDL
                    case 'themMonHoc':
                        include('page/admin/addDataCSDL/themMonHoc.php');
                        break;
                    case 'themNamHoc':
                        include('page/admin/addDataCSDL/themNamHoc.php');
                        break;
                    case 'themGiaoVien':
                        include('page/admin/addDataCSDL/themGiaoVien.php');
                        break;
                    case 'themChucVu':
                        include('page/admin/addDataCSDL/themChucVu.php');
                        break;
                    case 'themKhoa':
                        include('page/admin/addDataCSDL/themKhoa.php');
                        break;
                    case 'themBoMon':
                        include('page/admin/addDataCSDL/themBoMon.php');
                        break;
                    case 'themNhanVien':
                        include('page/admin/addDataCSDL/themNhanVien.php');
                        break;



                        //update data                    
                    case 'updateMonHoc':
                        include('page/admin/updateDataCSDL/updateMonHoc.php');
                        break;
                    case 'updateGV':
                        include('page/admin/updateDataCSDL/updateGV.php');
                        break;

                    case 'updateKhoa':
                        include('page/admin/updateDataCSDL/updateKhoa.php');
                        break;

                    case 'updateNamHoc':
                        include('page/admin/updateDataCSDL/updateNamHoc.php');
                        break;


                    case 'updateChucVu':
                        include('page/admin/updateDataCSDL/updateChucVu.php');
                        break;

                    case 'updateBoMon':
                        include('page/admin/updateDataCSDL/updateBoMon.php');
                        break;

                    case 'updateNhanVien':
                        include('page/admin/updateDataCSDL/updateNhanVien.php');
                        break;

                    default:
                        # code...
                        break;
                }
            }
            ?>


        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>

</body>

</html>