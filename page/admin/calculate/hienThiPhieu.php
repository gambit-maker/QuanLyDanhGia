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

    <div class="row">

    </div>
</div>
<table>
    <thead></thead>
</table>