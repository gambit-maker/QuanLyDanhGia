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

    //Tính số phiếu của mỗi lớp
    $soPhieuCuaLop = count($phieuKhaoSat->getPhieuKhaoSatTheoMaLop($lopHP['MaLopHocPhan']));

    //get điểm và nội dung phân loại
    $diemVaNoiDung = $infoSmallTable->getDiemVaNoiDungPhanLoai($lopHP['MaHoatDongKhaoSat']);

    // get số nhóm tiêu chí 
    $nhomTieuChi = $infoSmallTable->getNhomTieuChi($lopHP['MaHoatDongKhaoSat']); // return arr mã nhóm    


    //testin count value số nhóm tiêu chí
    // echo count($infoSmallTable->getCauHoiTrongNhomTieuChi('1', '2'));        
    // echo count($infoSmallTable->getNoiDungHinhThucPhanLoai('17'));
    // foreach ($infoSmallTable->getCauHoiTrongNhomTieuChiV2('1') as $item) {
    //     print_r($item);
    //     echo "<br>";
    // }
    // echo "<br><br>";
    $arrGiaTriPhanLoai = array();


    // foreach ($infoSmallTable->getNoiDungHinhThucPhanLoai('10') as $item) {
    //     $arrGiaTriPhanLoai[] = $item['NoiDungHinhThucPhanLoai'];
    //     print_r($item);
    //     echo "<br>";
    // }
    // print_r($arrGiaTriPhanLoai);
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


    $arrPhieuKhaoSat = $lopHocPhan->getPhieuKhaoSat($lopHP['MaLopHocPhan']);
    // foreach ($arrPhieuKhaoSat as $item) {
    //     echo "<br>";
    //     print_r($item);
    //     echo "<br>";
    // }
}
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
<h4 style="text-align: center;">Học kỳ <?php echo $tenHocKy; ?> / Năm học <?php echo $namHoc . "-" . $namHoc + 1; ?></h4>
<div class="container pt-5 ">
    <div class="row">
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

            <!-- <tr>
                <th colspan="14">I. Thông tin sinh viên</th>
            </tr> -->
            <!-- PHP code display detail info of ChiTietPhieu tương ứng với mỗi phiếu -->
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
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaLop(
                                        $lopHP['MaLopHocPhan'],
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
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaLop(
                                        $lopHP['MaLopHocPhan'],
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
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaLop(
                                        $lopHP['MaLopHocPhan'],
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
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaLop(
                                        $lopHP['MaLopHocPhan'],
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
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaLop(
                                        $lopHP['MaLopHocPhan'],
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
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaLop(
                                        $lopHP['MaLopHocPhan'],
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
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaLop(
                                        $lopHP['MaLopHocPhan'],
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
                                $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaLop(
                                    $lopHP['MaLopHocPhan'],
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
                                    $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaLop(
                                        $lopHP['MaLopHocPhan'],
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
                                $soTieuChi = $lopHocPhan->getThongTinChiTietKetQuaCauHoiCuaLop(
                                    $lopHP['MaLopHocPhan'],
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
                <?php
                $tong = 0;
                $tongDiemHeSoNhan = 0;
                ?>
                <th class="centerItem" colspan="2"">TỔNG CỘNG</th>
                <?php
                $arrHinhThucPhanLoaiNhom2 = $infoSmallTable->getHinhThucPhanLoai($nhomTieuChi = 2);
                $arrHinhThucPhanLoaiNhom3 = $infoSmallTable->getHinhThucPhanLoai($nhomTieuChi = 3);

                for ($i = 0; $i < count($arrHinhThucPhanLoaiNhom2) - 1; $i++) :
                ?>
                <th class=" centerItem">
                    <?php
                    $tieuChiDay = $infoSmallTable->getCountHinhThucPhanLoai($lopHP['MaLopHocPhan'], $arrHinhThucPhanLoaiNhom2[$i]['NoiDungHinhThucPhanLoai']);
                    $yKienKhac = $infoSmallTable->getCountHinhThucPhanLoai($lopHP['MaLopHocPhan'], $arrHinhThucPhanLoaiNhom3[$i]['NoiDungHinhThucPhanLoai']);
                    $tongDiem = count($tieuChiDay) + count($yKienKhac);
                    $tong += $tongDiem;
                    echo $tongDiem;
                    if (count($tieuChiDay) !== 0) {
                        $heSoNhan = $tieuChiDay[0]['Diem'];
                        $tongDiemHeSoNhan += $tongDiem * $heSoNhan;
                    }

                    ?>
                </th>

            <?php endfor; ?>

            <th class=" centerItem" colspan=" 2">
                <?php
                // cột này dùng để tách colspan 2 vì ở trên col span chỉ có 1, làm vậy cho dễ nhìn
                $tieuChiDay = $infoSmallTable->getCountHinhThucPhanLoai($lopHP['MaLopHocPhan'], $arrHinhThucPhanLoaiNhom2[4]['NoiDungHinhThucPhanLoai']);
                $yKienKhac = $infoSmallTable->getCountHinhThucPhanLoai($lopHP['MaLopHocPhan'], $arrHinhThucPhanLoaiNhom3[4]['NoiDungHinhThucPhanLoai']);
                $tongDiem = count($tieuChiDay) + count($yKienKhac);
                $tong += $tongDiem;
                echo $tongDiem;

                if (count($tieuChiDay) !== 0) {
                    $heSoNhan = $tieuChiDay[0]['Diem'];
                    $tongDiemHeSoNhan += $tongDiem * $heSoNhan;
                }
                ?>
            </th>

            <?php for ($i = 0; $i < count($arrHinhThucPhanLoaiNhom2) - 1; $i++) : ?>
                <th class="centerItem">
                    <?php
                    $tieuChiDay = $infoSmallTable->getCountHinhThucPhanLoai($lopHP['MaLopHocPhan'], $arrHinhThucPhanLoaiNhom2[$i]['NoiDungHinhThucPhanLoai']);
                    $yKienKhac = $infoSmallTable->getCountHinhThucPhanLoai($lopHP['MaLopHocPhan'], $arrHinhThucPhanLoaiNhom3[$i]['NoiDungHinhThucPhanLoai']);
                    $tongDiem = count($tieuChiDay) + count($yKienKhac);
                    echo round(tinhPhanTram($tongDiem, $tong), 2);
                    ?>
                </th>
            <?php endfor; ?>

            <th class="centerItem" colspan=" 2">
                <?php
                $tieuChiDay = $infoSmallTable->getCountHinhThucPhanLoai($lopHP['MaLopHocPhan'], $arrHinhThucPhanLoaiNhom2[4]['NoiDungHinhThucPhanLoai']);
                $yKienKhac = $infoSmallTable->getCountHinhThucPhanLoai($lopHP['MaLopHocPhan'], $arrHinhThucPhanLoaiNhom3[4]['NoiDungHinhThucPhanLoai']);
                $tongDiem = count($tieuChiDay) + count($yKienKhac);
                echo round(tinhPhanTram($tongDiem, $tong), 2);
                ?>
            </th>

            </tr>


        </tbody>
    </table>
    <h5><b>II. Kết luận:</b></h5>
    <div class="px-5">
        <?php
        $diemTB =  number_format($tongDiemHeSoNhan / $tong, 2);
        $xepLoai = "";
        if ($diemTB >= 4.5) {
            $xepLoai = "T + A";
        } elseif ($diemTB < 4.5 && $diemTB > 4) {
            $xepLoai = "T - A";
        } else {
            $xepLoai = "T - B";
        }

        ?>
        <h6 style="font-size: medium;">Điểm TB: <?php echo $diemTB; ?> .</h6>

        <h6 style="font-size: medium;">Xếp loại: <?php echo $xepLoai; ?> .</h6>
    </div>
</div>