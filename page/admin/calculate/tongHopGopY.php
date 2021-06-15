<?php

$rootPath = $_SERVER['DOCUMENT_ROOT'] . "\\QuanLyDanhGia";
include_once $rootPath . './vendor/autoload.php';


function tinhPhanTram($soPhanTram, $tong)
{
    return $soPhanTram / $tong * 100;
}

$tenKhoa = '';
$tenBoMon = '';
$tenGiaoVien = '';
$monHoc = '';
$namHoc = '';
$tenHocKy = '';
if ($_SESSION['inputKhoa'] != null) {
    $tenKhoa = "Khoa: <b>" . $_SESSION['inputKhoa'] . "</b>";
}
if ($_SESSION['inputBoMon'] != null) {
    $tenBoMon = "Bộ môn: <b>" . $_SESSION['inputBoMon'] . "</b>";
}
if ($_SESSION['inputTenGiaoVien'] != null) {
    $tenGiaoVien = "Họ tên CBGD: <b>" .  $_SESSION['inputTenGiaoVien'] . "</b>";
}
if ($_SESSION['inputMonHoc'] != null) {
    $monHoc =  $_SESSION['inputMonHoc'];
}
if ($_SESSION['inputNamHoc'] != null) {
    $namHoc = "/ Năm học " . $_SESSION['inputNamHoc'];
    if ($_SESSION['inputDenNamHoc'] != null) {
        $namHoc .= '-' . $_SESSION['inputDenNamHoc'];
    }
}
if ($_SESSION['inputHocKy'] != null) {
    $tenHocKy = "Học kỳ " . $_SESSION['inputHocKy'];
}


$arrLopHocPhan = $_SESSION['arrMaLopHocPhan'];
$maHoatDongKhaoSat = $lopHocPhan->checkHoatDongKhaoSatCoTrungNhau($arrLopHocPhan); //áp dụng phân biệt nhiều hoạt động khảo sát nếu có
$maHoatDongKhaoSat = $maHoatDongKhaoSat[0]['MaHoatDongKhaoSat'];
$tenHoatDongKhaoSat = $infoSmallTable->getThongTinHoatDongKhaoSat($maHoatDongKhaoSat);
$phieuGopYCuaCaLop = $phieuKhaoSat->getPhieuGopYNhieuLop($arrLopHocPhan, $maHoatDongKhaoSat);
$tongSoPhieuCuaLop = count($phieuGopYCuaCaLop);


$thongTinPhanLop = $phieuKhaoSat->getNoiDungPhanLop();
$tenPhanLopJS = ""; // sử dụng cho dữ liệu của javascript chart
$SoPhanLopJS = "";
foreach ($thongTinPhanLop as $item) {
    $tenPhanLop = $item['PhanLop'];
    $tenPhanLopJS .= "'" . $tenPhanLop . "',";
    $soPhanLop = $phieuKhaoSat->demNoiDungPhanLopCuaNhieuLop($arrLopHocPhan, $tenPhanLop);
    // $soPhanLop = tinhPhanTram($soPhanLop, $tongSoPhieuCuaLop);
    $SoPhanLopJS .= $soPhanLop . ",";
}
$tenPhanLopJS = substr($tenPhanLopJS, 0, -1);
$SoPhanLopJS = substr($SoPhanLopJS, 0, -1);
// $SoPhanLopJS .= "," . $tongSoPhieuCuaLop;


$thongTinPhanLoai = $phieuKhaoSat->getNoiDungPhanLoai();
$tenPhanLoaiJS = "";
$soPhanLoaiJS = "";
foreach ($thongTinPhanLoai as $item) {
    $tenPhanLoai = $item['DanhGia'];
    $tenPhanLoaiJS .= "'" . $tenPhanLoai . "',";
    $soPhanLoai = $phieuKhaoSat->demNoiDungPhanLoaiCuaNhieuLop($arrLopHocPhan, $tenPhanLoai);
    $soPhanLoaiJS .= $soPhanLoai . ",";
}
$tenPhanLoaiJS = substr($tenPhanLoaiJS, 0, -1);
$soPhanLoaiJS = substr($soPhanLoaiJS, 0, -1);
// echo $soPhanLoaiJS . "<br>";
// echo $tenPhanLoaiJS;





if (isset($_POST["submitDownload"])) {
    $selectPhanLop = $_POST["selectPhanLop"]; // Data: phương pháp, thái độ, cơ sở vật chất, khác.
    $selectPhanLoai = $_POST["selectPhanLoai"]; // Data: negative, positive, none.
    // echo $selectPhanLop . "<br>" . $selectPhanLoai;
    if ($selectPhanLop === 'noValue') {
        $thongTinCacPhieuPhanLoai = $phieuKhaoSat->getPhieuGopYNhieuLopVoiNoiDungPhanLoai($arrLopHocPhan, $maHoatDongKhaoSat, $selectPhanLoai);
        $tenFile = $selectPhanLoai;
    } else {
        $thongTinCacPhieuPhanLoai = $phieuKhaoSat->getPhieuGopYNhieuLopVoiNoiDungPhanLoaiVaPhanLop($arrLopHocPhan, $maHoatDongKhaoSat, $selectPhanLop, $selectPhanLoai);
        $tenFile = $selectPhanLop . "_" . $selectPhanLoai;
    }

    // viết vào array để output file xlsx
    $arrFileXLSX = array();
    array_push($arrFileXLSX, array('STT', 'Nội dung', 'Phân lớp', 'Phân loại')); // header file
    $stt = 1;
    foreach ($thongTinCacPhieuPhanLoai as $item) {
        array_push(
            $arrFileXLSX,
            array($stt, $item['NoiDungGopY'], $item['PhanLop'], $item['DanhGia'])
        );
        $stt++;
    }
    $xlsx = SimpleXLSXGen::fromArray($arrFileXLSX);
    $xlsx->downloadAs($tenFile . '.xlsx');
}
?>



<style>
    caption {
        caption-side: top !important;
    }

    .noWarp {
        white-space: nowrap;
        overflow: hidden;
    }
</style>
<h2 style="text-align: center;">Thống kê kết quả lấy ý kiến góp ý từ người học</h2>
<h3 style="text-align: center;">Về hoạt động: <?php echo $tenHoatDongKhaoSat; ?></h3>
<h4 style="text-align: center;"><?php echo $tenHocKy; ?> <?php echo $namHoc; ?></h4>

<div class="container pt-4">
    <div class="row">
        <div class="col-sm-auto">
            <p> <?php echo $tenGiaoVien; ?></p>
        </div>
        <div class="col-sm-auto">
            <p><?php echo $tenBoMon; ?> </p>
        </div>
        <div class="col-sm-auto">
            <p><?php echo $tenKhoa; ?></p>
        </div>
    </div>
    <h6 style="font-size: medium;">Tổng số góp ý: <b><?php echo $tongSoPhieuCuaLop; ?></b> </h6>

    <h6>I. Thông tin trả lời và phân loại</h6>

    <table class="tfilter table table-hover">
        <thead>
            <tr>
                <th style="width: 56%">Nội dung góp ý</th>
                <th class="noWarp">Phân lớp</th>
                <th class="noWarp">Đánh giá</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($phieuGopYCuaCaLop as $item) : ?>
                <tr>
                    <td colspan="1"><?php echo $item['NoiDungGopY']; ?></td>
                    <td class="noWarp"><?php echo $item['PhanLop']; ?></td>
                    <td class="noWarp"><?php echo $item['DanhGia']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form action="" method="POST">
        <table class="m-auto pb-5">
            <tr>
                <!-- <td>Chọn kiểu phân lớp: </td> -->
                <td>
                    <select required class="form-select" name="selectPhanLop">
                        <option value="" disabled selected>Chọn phân lớp</option>
                        <?php foreach ($thongTinPhanLop as $item) : ?>
                            <option value="<?php echo $item['PhanLop'] ?>"><?php echo $item['PhanLop'] ?></option>
                        <?php endforeach; ?>
                        <option value="noValue">Không chọn</option>
                    </select>
                </td>
                <!-- <td>Chọn kiểu phân loại: </td> -->
                <td>
                    <select required class="form-select" name="selectPhanLoai">
                        <option value="" disabled selected>Chọn phân loại</option>
                        <?php foreach ($thongTinPhanLoai as $item) : ?>
                            <option value="<?php echo $item['DanhGia']; ?>"><?php echo $item['DanhGia']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input class="btn btn-sm btn-primary" type="submit" name="submitDownload" value="Tải dữ liệu"></td>
            </tr>
        </table>
    </form>
    <h6>II. Biểu đồ thống kê</h6>
    <div class="row">
        <div class="col">
            <canvas id="myChart"></canvas>
        </div>

        <div class="col">
            <canvas id="mySecondChart"></canvas>
        </div>
    </div>


</div>


<script>
    var tf = new TableFilter(document.querySelector('.tfilter'), {
        base_path: 'js/tablefilter/',
        paging: {
            results_per_page: ['Records: ', [10, 25, 50, 100]]
        },
        highlight_keywords: true,

        // aligns filter at cell bottom when Bootstrap is enabled
        // filters_cell_tag: 'th',
        btn_reset: {
            text: 'Clear'
        },
        // allows Bootstrap table styling
        themes: [{
            name: 'transparent'
        }],
        extensions: [{
            name: 'sort'
        }],
        rows_counter: true,
        col_0: 'none',
        // col_1: 'none',
        // col_2: 'none',

        // grid: false //hide filter bar    

    });
    tf.init();
</script>

<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',

        data: {
            labels: [<?php echo $tenPhanLopJS ?>],
            datasets: [{
                // label: 'Phân loại',
                data: [<?php echo $SoPhanLopJS ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1,
                hoverOffset: 4,
            }]
        },
        options: {

            plugins: {
                title: {
                    display: true,
                    text: 'Biểu đồ: Phân loại góp ý.',
                    position: 'bottom'
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                },
            },

            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true,
                    min: 0,
                    max: <?php echo $tongSoPhieuCuaLop; ?>,
                },
            }
        }
    });



    var ctx = document.getElementById('mySecondChart');
    var myChart = new Chart(ctx, {
        type: 'bar',

        data: {
            labels: [<?php echo $tenPhanLoaiJS ?>],
            datasets: [{
                // label: 'Phân loại',
                data: [<?php echo $soPhanLoaiJS ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1,
                hoverOffset: 4,
            }]
        },
        options: {

            plugins: {
                title: {
                    display: true,
                    text: 'Biểu đồ: Phân loại đánh giá.',
                    position: 'bottom'
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                },
            },

            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true,
                    min: 0,
                    max: <?php echo $tongSoPhieuCuaLop; ?>,
                },
            }
        }
    });
</script>