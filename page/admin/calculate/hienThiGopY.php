<?php
function tinhPhanTram($soPhanTram, $tong)
{
    return $soPhanTram / $tong * 100;
}

if (isset($_GET["MaLopHocPhan"])) {
    $maLopHocPhan = $_GET["MaLopHocPhan"];
    $lopHP = $infoSmallTable->getThongTinLopHocPhanTheoMaLop($maLopHocPhan);
    $tenHoatDongKhaoSat = $infoSmallTable->getThongTinHoatDongKhaoSat($lopHP['MaHoatDongKhaoSat']);
    $tenHocKy = $infoSmallTable->getThongTinHocKy($lopHP['MaHocKy']);
    $namHoc = $infoSmallTable->getThongTinNam($lopHP['MaNamHoc']);
    $tenGiaoVien = $infoSmallTable->getThongTinGiaoVien($lopHP['MaGiaoVien'], 'TenGiaoVien');
    $maBoMon = $infoSmallTable->getThongTinGiaoVien($lopHP['MaGiaoVien'], 'MaBoMon');
    $tenBoMon = $infoSmallTable->getThongTinBoMon($maBoMon, 'TenBoMon');

    $maKhoa = $infoSmallTable->getThongTinBoMon($maBoMon, 'MaKhoa');
    $tenKhoa = $infoSmallTable->getTenKhoa($maKhoa);



    // lấy thông tin câu hỏi mở của lớp
    $thongTinBangCauHoiMo = $phieuKhaoSat->getThongTinCauHoiMo($maLopHocPhan);

    $tongSoPhieuCuaLop = count($thongTinBangCauHoiMo);

    // lấy thông tin phân lớp của câu hỏi

    $thongTinPhanLop = $phieuKhaoSat->getNoiDungPhanLop($maLopHocPhan);
    $tenPhanLopJS = ""; // sử dụng cho dữ liệu của javascript chart
    $SoPhanLopJS = "";
    foreach ($thongTinPhanLop as $item) {
        $tenPhanLop = $item['PhanLop'];
        $tenPhanLopJS .= "'" . $tenPhanLop . "',";
        $soPhanLop = $phieuKhaoSat->demNoiDungPhanLop($maLopHocPhan, $tenPhanLop);
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
        $soPhanLoai = $phieuKhaoSat->demNoiDungPhanLoai($maLopHocPhan, $tenPhanLoai);
        $soPhanLoaiJS .= $soPhanLoai . ",";
    }
    $tenPhanLoaiJS = substr($tenPhanLoaiJS, 0, -1);
    $soPhanLoaiJS = substr($soPhanLoaiJS, 0, -1);
    // echo $soPhanLoaiJS . "<br>";
    // echo $tenPhanLoaiJS;
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

<h2 style="text-align: center;">Thống kê góp ý</h2>
<h3 style="text-align: center;">Về hoạt động: <?php echo $tenHoatDongKhaoSat; ?></h3>
<h4 style="text-align: center;">Học kỳ <?php echo $tenHocKy; ?> / Năm học <?php echo $namHoc . "-" . $namHoc + 1; ?></h4>

<div class="container pt-4">
    <div class="row gx-5">
        <div class="col-sm">
            <h6 style="font-size: medium;">Họ tên CBGD: <b> <?php echo $tenGiaoVien; ?></b></h6>
        </div>
        <div class="col-sm">
            <h6 style="font-size: medium;">Bộ môn: <b><?php echo $tenBoMon; ?></b> </h6>
        </div>
        <div class="col-sm">
            <h6 style="font-size: medium;">Khoa: <b><?php echo $tenKhoa; ?></b></h6>
        </div>
    </div>
    <h6 style="font-size: medium;">Tổng số góp ý: <b><?php echo $tongSoPhieuCuaLop; ?></b> </h6>

    <div class="row gx-5 pt-5">
        <div class="col-12">
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
                    <?php foreach ($thongTinBangCauHoiMo as $item) : ?>
                        <tr>
                            <td colspan="1"><?php echo $item['NoiDungGopY']; ?></td>
                            <td class="noWarp"><?php echo $item['PhanLop']; ?></td>
                            <td class="noWarp"><?php echo $item['DanhGia']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <div class="col">

            <div>
                <h6>II. Biểu đồ thống kê</h6>
                <canvas id="myChart"></canvas>
            </div>

            <div class="pt-5">
                <h6>III. Biểu đồ phân loại</h6>
                <canvas id="mySecondChart"></canvas>
            </div>

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
        col_0: 'none',
        col_1: 'none',
        col_2: 'none',

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