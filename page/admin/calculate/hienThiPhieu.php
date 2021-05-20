<?php
if (isset($_GET["MaLopHocPhan"])) {
    $maLopHocPhan = $_GET["MaLopHocPhan"];
    $lopHocPhan = $infoSmallTable->getThongTinLopHocPhanTheoMaLop($maLopHocPhan);
    $tenHoatDongKhaoSat = $infoSmallTable->getThongTinHoatDongKhaoSat($lopHocPhan['MaHoatDongKhaoSat']);
    $tenHocKy = $infoSmallTable->getThongTinHocKy($lopHocPhan['MaHocKy']);
    $namHoc = $infoSmallTable->getThongTinNam($lopHocPhan['MaNamHoc']);
    $tenGiaoVien = $infoSmallTable->getThongTinGiaoVien($lopHocPhan['MaGiaoVien'], 'TenGiaoVien');

    $maBoMon = $infoSmallTable->getThongTinGiaoVien($lopHocPhan['MaGiaoVien'], 'MaBoMon');
    $tenBoMon = $infoSmallTable->getThongTinBoMon($maBoMon, 'TenBoMon');

    $maKhoa = $infoSmallTable->getThongTinBoMon($maBoMon, 'MaKhoa');
    $tenKhoa = $infoSmallTable->getTenKhoa($maKhoa);

    //Tính số phiếu của mỗi lớp
    $soPhieuCuaLop = count($phieuKhaoSat->getPhieuKhaoSatTheoMaLop($lopHocPhan['MaLopHocPhan']));

    //get điểm và nội dung phân loại
    $diemVaNoiDung = $infoSmallTable->getDiemVaNoiDungPhanLoai($lopHocPhan['MaHoatDongKhaoSat']);
}
?>



<h2 style="text-align: center;">Thống kê kết quả lấy ý kiến phản hồi từ người học</h2>
<h3 style="text-align: center;">Về hoạt động: <?php echo $tenHoatDongKhaoSat; ?></h3>
<h4 style="text-align: center;">Học kỳ <?php echo $tenHocKy; ?> / Năm học <?php echo $namHoc . "-" . $namHoc + 1; ?></h4>

<div class="container pt-5">
    <div class="row">
        <div class="col-sm">
            <p>Họ tên CBGD: <b> <?php echo $tenGiaoVien; ?></b></p>
        </div>
        <div class="col-sm">
            <p>Bộ môn: <b><?php echo $tenBoMon; ?></b> </p>
        </div>
        <div class="col-sm">
            <p>Khoa: <b><?php echo $tenKhoa; ?></b></p>
        </div>
    </div>

    <h5><b>I. Kết quả thống kê:</b></h5>
    <p>Số phiếu phản hồi: <b><?php echo $soPhieuCuaLop; ?></b></p>


    <!-- hiên thị thông tin điểm phân loại của các tiêu chí đánh giá -->
    <table style="width:100%;">

        <tr>
            <?php
            $count = 1;
            foreach ($diemVaNoiDung as $item) {

                echo "<td>" . $item['NoiDungHinhThucPhanLoai'] . "</b>" . ": " . $item['NoiDungChiTiet'] . " (" . $item['Diem'] . "đ)" . "</td>";
                if ($count % 4 === 0) {
                    echo  "</tr><tr>";
                }
                $count++;
            }
            // echo "</tr>";
            ?>
        </tr>
    </table>


</div>


<div class="container pt-4">
    <table class="table-phieu">
        <thead>
            <tr>
                <th>TT</th>
                <th style="width: 40%;">Tiêu chí</th>
                <th colspan="6" style="width: 20%;">Số phiếu phản hồi theo mức độ</th>
                <th colspan="6" style="width: 20%;">Tỷ lệ(%)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th colspan="14">I. Thông tin sinh viên</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th colspan="3">NAM</th>
                <th colspan="3">NU</th>
                <th colspan="3">NAM</th>
                <th colspan="3">NU</th>
            </tr>
            <tr>
                <th>1</th>
                <th>Giới tính</th>
                <th colspan="3">182</th>
                <th colspan="3">173</th>
                <th colspan="3">51.27</th>
                <th colspan="3">48.73</th>
            </tr>

            <tr>
                <th colspan="14">II. Thông tin về dạy và học</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>XS</th>
                <th>GIOI</th>
                <th>KHA</th>
                <th>TB</th>
                <th>YEU</th>
                <th>HK1</th>
                <th>XS</th>
                <th>GIOI</th>
                <th>KHA</th>
                <th>TB</th>
                <th>YEU</th>
                <th>HK1</th>
            </tr>
            <tr>
                <th>2</th>
                <th>Xếp loại học lực học kỳ qua nếu có</th>
                <th>7</th>
                <th>21</th>
                <th>90</th>
                <th>129</th>
                <th>10</th>
                <th>98</th>
                <th>1.97</th>
                <th>5.92</th>
                <th>25.35</th>
                <th>36.34</th>
                <th>2.82</th>
                <th>27.61</th>
            </tr>
        </tbody>

    </table>
</div>