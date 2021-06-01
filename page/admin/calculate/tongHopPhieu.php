<?php
$arrGiaTriPhanLoai = array();
$stt = 1;  // Số thứ tự
$compareArr = array(); // array dùng để so sách các hình thức phân loại nếu trùng nhau
// lấy arr có giá trị hình thức phân loại VD getNoiDungHinhThucPhanLoai('2')
function getArrGiaTriPhanLoai($arr)
{
    $arrGiaTriPhanLoai = array();
    foreach ($arr as $item) {
        $arrGiaTriPhanLoai[] = $item['NoiDungHinhThucPhanLoai'];
    }
    return $arrGiaTriPhanLoai;
}

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
$maHoatDongKhaoSat = $lopHocPhan->checkHoatDongKhaoSatCoTrungNhau($arrLopHocPhan);
$maHoatDongKhaoSat = $maHoatDongKhaoSat[0]['MaHoatDongKhaoSat'];
$cacLopHocPhan = $lopHocPhan->checkHoatDongCuaCacPhieu($arrLopHocPhan, $maHoatDongKhaoSat);
$tenHoatDongKhaoSat = $infoSmallTable->getThongTinHoatDongKhaoSat($maHoatDongKhaoSat);
$soPhieuCuaLop = count($lopHocPhan->getPhieuNhieuLop($arrLopHocPhan));
$diemVaNoiDung = $infoSmallTable->getDiemVaNoiDungPhanLoai($maHoatDongKhaoSat);
$nhomTieuChi = $infoSmallTable->getNhomTieuChi($maHoatDongKhaoSat); // return arr mã nhóm  


?>
<style>
    /* Table cho hiển thị phiếu  */
    .table-phieu {
        font-family: arial, sans-serif;
        font-size: 0.9em;
        border-collapse: collapse;
        width: 100%;
    }

    .table-phieu thead th {
        text-align: center;
    }

    .table-phieu td,
    th {
        border: 1px solid black;
        text-align: left;
    }

    .centerItem {
        text-align: center;
    }
</style>


<h2 style="text-align: center;">Thống kê kết quả lấy ý kiến phản hồi từ người học</h2>
<h3 style="text-align: center;">Về hoạt động: <?php echo $tenHoatDongKhaoSat; ?></h3>
<h4 style="text-align: center;"><?php echo $tenHocKy; ?> <?php echo $namHoc; ?></h4>


<div class="container pt-5 ">
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

    <h5><b>I. Kết quả thống kê:</b></h5>
    <p>Số phiếu phản hồi: <b><?php echo $soPhieuCuaLop; ?></b></p>


    <!-- hiên thị thông tin điểm phân loại của các tiêu chí đánh giá -->
    <table style="width:100%;">

        <tr>
            <?php
            $count = 1;
            foreach ($diemVaNoiDung as $item) {

                echo "<td>" . "<b>" . $item['NoiDungHinhThucPhanLoai'] . "</b>" . ": " . $item['NoiDungChiTiet'] . " (" . $item['Diem'] . "đ)" . "</td>";
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

<div class="container pt-4 pb-5">
    <table class="table-phieu table">
        <thead>
            <tr>
                <th style="width: 1%;">TT</th>
                <th style="width: 40%;">Tiêu chí</th>
                <th colspan="6" style="width: 20%;">Số phiếu phản hồi theo mức độ</th>
                <th colspan="6" style="width: 20%;">Tỷ lệ(%)</th>
            </tr>
        </thead>
        <tbody>

            <?php
            for ($i = 0; $i < count($nhomTieuChi); $i++) : ?>
                <tr>
                    <th colspan='14'>
                        <?php
                        //get tên nhóm tiêu chí với mã nhóm
                        $maNhom = $nhomTieuChi[$i]['MaNhomTieuChi'];
                        echo $infoSmallTable->getTenNhom($maNhom);
                        ?>
                    </th>
                </tr>

                <?php
                //get câu hỏi trong 1 nhóm tiêu chí
                $cauHoiTrongNhom = $infoSmallTable->getCauHoiTrongNhomTieuChiV2($maNhom);

                foreach ($cauHoiTrongNhom as $item) : //Mỗi Item là 1 câu hỏi 
                ?>

                    <?php
                    $noiDungHinhThucPhanLoai = $infoSmallTable->getNoiDungHinhThucPhanLoai($item['MaTieuChi']);
                    $soLuongPhanLoai = count($noiDungHinhThucPhanLoai);
                    // echo "Số lượng:" . $soLuongPhanLoai;
                    $arr = getArrGiaTriPhanLoai($infoSmallTable->getNoiDungHinhThucPhanLoai($item['MaTieuChi']));
                    ?>
                    <?php if ($soLuongPhanLoai === 2) : //Đối với nhóm chỉ có 2 tiêu chí VD Nam, Nữ
                    ?>
                        <tr>
                            <th></th>
                            <th></th>
                            <?php for ($y = 0; $y < 2; $y++) : ?>
                                <th class="centerItem" colspan="3">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungChiTiet'];  ?>
                                </th>
                            <?php endfor; ?>
                            <?php for ($y = 0; $y < 2; $y++) : ?>
                                <th class="centerItem" colspan="3">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungChiTiet'];  ?>
                                </th>
                            <?php endfor; ?>
                        </tr>




                    <?php elseif ($soLuongPhanLoai === 6) : //đối với nhóm có 6 tiêu chí 
                    ?>
                        <tr>
                            <th></th>
                            <th></th>
                            <?php for ($y = 0; $y < 6; $y++) : ?>
                                <th class="centerItem" colspan="1">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai'];  ?>
                                </th>
                            <?php endfor; ?>
                            <?php for ($y = 0; $y < 6; $y++) : ?>
                                <th class="centerItem" colspan="1">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai'];  ?>
                                </th>
                            <?php endfor; ?>
                        </tr>


                    <?php elseif ($soLuongPhanLoai === 3) : // 3 tiêu chí VD 80, 50, DUOI50 
                    ?>
                        <tr>
                            <th></th>
                            <th></th>
                            <?php for ($y = 0; $y < 3; $y++) : ?>
                                <th class="centerItem" colspan="2">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai'];  ?>
                                </th>
                            <?php endfor; ?>
                            <?php for ($y = 0; $y < 3; $y++) : ?>
                                <th class="centerItem" colspan="2">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai'];  ?>
                                </th>
                            <?php endfor; ?>
                        </tr>


                    <?php elseif ($soLuongPhanLoai === 5 && $arr !== $compareArr) : ?>
                        <tr>
                            <th></th>
                            <th></th>
                            <?php for ($y = 0; $y < 4; $y++) : ?>
                                <th class="centerItem" colspan="1">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai'];  ?>
                                </th>
                            <?php endfor; ?>
                            <th class="centerItem" colspan="2">
                                <?php echo $noiDungHinhThucPhanLoai[4]['NoiDungHinhThucPhanLoai'];  ?>
                            </th>

                            <?php for ($y = 0; $y < 4; $y++) : ?>
                                <th class="centerItem" colspan="1">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai'];  ?>
                                </th>
                            <?php endfor; ?>
                            <th class="centerItem" colspan="2">
                                <?php echo $noiDungHinhThucPhanLoai[4]['NoiDungHinhThucPhanLoai']; ?>
                            </th>
                        </tr>


                        <?php
                        // elseif ($soLuongPhanLoai === 5 && $arr === $compareArr) :
                        ?>


                    <?php endif; ?>
                    <?php $compareArr = $arr; // kiểm tra trùng các tiêu chí RD, D, TDD để không lặp lại cột
                    ?>
                    <tr>
                        <th>
                            <?php
                            echo $stt;
                            $stt++;
                            ?>
                        </th>
                        <th>
                            <?php
                            echo $item['NoiDung'];
                            ?>
                        </th>

                        <?php if ($soLuongPhanLoai === 2) : ?>
                            <?php for ($y = 0; $y < 1; $y++) :
                                // $y = 2 nếu phân biệt được nam nữ dùng hoặc if cũng được ψ(｀∇´)ψ
                            ?>
                                <th class="centerItem" colspan="6">
                                    <?php
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaNhieuLop(
                                        $arrLopHocPhan,
                                        $item['MaTieuChi'],
                                        $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai']
                                    );
                                    $soTieuChi = count($soTieuChi);
                                    echo $soTieuChi;
                                    ?>
                                </th>
                            <?php endfor; ?>

                            <?php for ($y = 0; $y < 1; $y++) : ?>
                                <th class="centerItem" colspan="6">
                                    <?php
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaNhieuLop(
                                        $arrLopHocPhan,
                                        $item['MaTieuChi'],
                                        $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai']
                                    );
                                    $soTieuChi = count($soTieuChi);
                                    echo round(tinhPhanTram($soTieuChi, $soPhieuCuaLop), 2);
                                    ?>
                                </th>
                            <?php endfor; ?>

                        <?php elseif ($soLuongPhanLoai === 6) : ?>
                            <?php for ($y = 0; $y < 6; $y++) : ?>
                                <th class="centerItem" colspan="1">
                                    <?php
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaNhieuLop(
                                        $arrLopHocPhan,
                                        $item['MaTieuChi'],
                                        $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai']
                                    );
                                    $soTieuChi = count($soTieuChi);
                                    echo $soTieuChi;
                                    ?>
                                </th>
                            <?php endfor; ?>

                            <?php for ($y = 0; $y < 6; $y++) : ?>
                                <th class="centerItem" colspan="1">
                                    <?php
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaNhieuLop(
                                        $arrLopHocPhan,
                                        $item['MaTieuChi'],
                                        $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai']
                                    );
                                    $soTieuChi = count($soTieuChi);
                                    echo round(tinhPhanTram($soTieuChi, $soPhieuCuaLop), 2);
                                    ?>
                                </th>
                            <?php endfor; ?>

                        <?php elseif ($soLuongPhanLoai === 3) : ?>
                            <?php for ($y = 0; $y < 3; $y++) : ?>
                                <th class="centerItem" colspan="2">
                                    <?php
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaNhieuLop(
                                        $arrLopHocPhan,
                                        $item['MaTieuChi'],
                                        $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai']
                                    );
                                    $soTieuChi = count($soTieuChi);
                                    echo $soTieuChi;
                                    ?>
                                </th>
                            <?php endfor; ?>

                            <?php for ($y = 0; $y < 3; $y++) : ?>
                                <th class="centerItem" colspan="2">
                                    <?php
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaNhieuLop(
                                        $arrLopHocPhan,
                                        $item['MaTieuChi'],
                                        $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai']
                                    );
                                    $soTieuChi = count($soTieuChi);
                                    echo round(tinhPhanTram($soTieuChi, $soPhieuCuaLop), 2);
                                    ?>
                                </th>
                            <?php endfor; ?>

                        <?php elseif ($soLuongPhanLoai === 5) : ?>
                            <?php for ($y = 0; $y < 4; $y++) : ?>
                                <th class="centerItem" colspan="1">
                                    <?php
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaNhieuLop(
                                        $arrLopHocPhan,
                                        $item['MaTieuChi'],
                                        $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai']
                                    );
                                    $soTieuChi = count($soTieuChi);
                                    echo $soTieuChi;
                                    ?>
                                </th>
                            <?php endfor; ?>
                            <th class="centerItem" colspan="2">
                                <?php
                                $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaNhieuLop(
                                    $arrLopHocPhan,
                                    $item['MaTieuChi'],
                                    $noiDungHinhThucPhanLoai[4]['NoiDungHinhThucPhanLoai']
                                );
                                $soTieuChi = count($soTieuChi);
                                echo $soTieuChi;
                                ?>
                            </th>

                            <?php for ($y = 0; $y < 4; $y++) : ?>
                                <th class="centerItem" colspan="1">
                                    <?php
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaNhieuLop(
                                        $arrLopHocPhan,
                                        $item['MaTieuChi'],
                                        $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai']
                                    );
                                    $soTieuChi = count($soTieuChi);
                                    echo round(tinhPhanTram($soTieuChi, $soPhieuCuaLop), 2);
                                    ?>
                                </th>
                            <?php endfor; ?>

                            <th class="centerItem" colspan="2">
                                <?php
                                $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaNhieuLop(
                                    $arrLopHocPhan,
                                    $item['MaTieuChi'],
                                    $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai']
                                );
                                $soTieuChi = count($soTieuChi);
                                echo round(tinhPhanTram($soTieuChi, $soPhieuCuaLop), 2);
                                ?>
                            </th>



                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endfor; ?>
            <tr>
                <?php $tong = 0; ?>
                <th class="centerItem" colspan="2"">TỔNG CỘNG</th>
                <?php
                // chỉ tính 2 nhóm tiêu chí cho phần tổng kết
                $arrHinhThucPhanLoaiNhom2 = $infoSmallTable->getHinhThucPhanLoai($nhomTieuChi = 2);
                $arrHinhThucPhanLoaiNhom3 = $infoSmallTable->getHinhThucPhanLoai($nhomTieuChi = 3);

                for ($i = 0; $i < count($arrHinhThucPhanLoaiNhom2) - 1; $i++) :
                ?>
                <th class=" centerItem">
                    <?php
                    $tieuChiDay = $infoSmallTable->getCountHinhThucPhanLoaiTrongNhieuLop($arrLopHocPhan, $arrHinhThucPhanLoaiNhom2[$i]['NoiDungHinhThucPhanLoai']);
                    $yKienKhac = $infoSmallTable->getCountHinhThucPhanLoaiTrongNhieuLop($arrLopHocPhan, $arrHinhThucPhanLoaiNhom3[$i]['NoiDungHinhThucPhanLoai']);
                    $tongDiem = count($tieuChiDay) + count($yKienKhac);
                    $tong += $tongDiem;
                    echo $tongDiem;
                    ?>
                </th>

            <?php endfor; ?>

            <th class=" centerItem" colspan=" 2">
                <?php
                $tieuChiDay = $infoSmallTable->getCountHinhThucPhanLoaiTrongNhieuLop($arrLopHocPhan, $arrHinhThucPhanLoaiNhom2[4]['NoiDungHinhThucPhanLoai']);
                $yKienKhac = $infoSmallTable->getCountHinhThucPhanLoaiTrongNhieuLop($arrLopHocPhan, $arrHinhThucPhanLoaiNhom3[4]['NoiDungHinhThucPhanLoai']);
                $tongDiem = count($tieuChiDay) + count($yKienKhac);
                $tong += $tongDiem;
                echo $tongDiem;
                ?>
            </th>

            <?php for ($i = 0; $i < count($arrHinhThucPhanLoaiNhom2) - 1; $i++) : ?>
                <th class="centerItem">
                    <?php
                    $tieuChiDay = $infoSmallTable->getCountHinhThucPhanLoaiTrongNhieuLop($arrLopHocPhan, $arrHinhThucPhanLoaiNhom2[$i]['NoiDungHinhThucPhanLoai']);
                    $yKienKhac = $infoSmallTable->getCountHinhThucPhanLoaiTrongNhieuLop($arrLopHocPhan, $arrHinhThucPhanLoaiNhom3[$i]['NoiDungHinhThucPhanLoai']);
                    $tongDiem = count($tieuChiDay) + count($yKienKhac);
                    echo round(tinhPhanTram($tongDiem, $tong), 2);
                    ?>
                </th>
            <?php endfor; ?>

            <th class="centerItem" colspan=" 2">
                <?php
                $tieuChiDay = $infoSmallTable->getCountHinhThucPhanLoaiTrongNhieuLop($arrLopHocPhan, $arrHinhThucPhanLoaiNhom2[4]['NoiDungHinhThucPhanLoai']);
                $yKienKhac = $infoSmallTable->getCountHinhThucPhanLoaiTrongNhieuLop($arrLopHocPhan, $arrHinhThucPhanLoaiNhom3[4]['NoiDungHinhThucPhanLoai']);
                $tongDiem = count($tieuChiDay) + count($yKienKhac);
                echo round(tinhPhanTram($tongDiem, $tong), 2);
                ?>
            </th>

            </tr>

        </tbody>

    </table>
</div>