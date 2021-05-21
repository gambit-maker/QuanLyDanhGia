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

    // get số nhóm tiêu chí 
    $nhomTieuChi = $infoSmallTable->getNhomTieuChi($lopHocPhan['MaHoatDongKhaoSat']); // return arr mã nhóm    


    //testin count value số nhóm tiêu chí
    // echo count($infoSmallTable->getCauHoiTrongNhomTieuChi('1', '2'));        
    // echo count($infoSmallTable->getNoiDungHinhThucPhanLoai('17'));
    foreach ($infoSmallTable->getCauHoiTrongNhomTieuChiV2('1') as $item) {
        print_r($item);
        echo "<br>";
    }
    echo "<br><br>";
    $arrGiaTriPhanLoai = array();


    foreach ($infoSmallTable->getNoiDungHinhThucPhanLoai('10') as $item) {
        $arrGiaTriPhanLoai[] = $item['NoiDungHinhThucPhanLoai'];
        print_r($item);
        echo "<br>";
    }
    print_r($arrGiaTriPhanLoai);
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


<div class="container pt-4">
    <table class="table-phieu">
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
                    <tr>
                        <th></th>
                        <th></th>
                        <?php
                        $noiDungHinhThucPhanLoai = $infoSmallTable->getNoiDungHinhThucPhanLoai($item['MaTieuChi']);
                        $soLuongPhanLoai = count($noiDungHinhThucPhanLoai);
                        // echo "Số lượng:" . $soLuongPhanLoai;
                        $arr = getArrGiaTriPhanLoai($infoSmallTable->getNoiDungHinhThucPhanLoai($item['MaTieuChi']));
                        ?>
                        <?php if ($soLuongPhanLoai === 1) : ?>
                            <th colspan="6">
                                <?php echo $noiDungHinhThucPhanLoai[0]['NoiDungHinhThucPhanLoai'];  ?>
                            </th>
                            <th colspan="6">
                                <?php echo $noiDungHinhThucPhanLoai[0]['NoiDungHinhThucPhanLoai'];  ?>
                            </th>

                        <?php elseif ($soLuongPhanLoai === 6) : ?>
                            <?php for ($y = 0; $y < 6; $y++) : ?>
                                <th colspan="1">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai'];  ?>
                                </th>
                            <?php endfor; ?>
                            <?php for ($y = 0; $y < 6; $y++) : ?>
                                <th colspan="1">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai'];  ?>
                                </th>
                            <?php endfor; ?>

                        <?php elseif ($soLuongPhanLoai === 3) : ?>
                            <?php for ($y = 0; $y < 3; $y++) : ?>
                                <th colspan="2">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai'];  ?>
                                </th>
                            <?php endfor; ?>
                            <?php for ($y = 0; $y < 3; $y++) : ?>
                                <th colspan="2">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai'];  ?>
                                </th>
                            <?php endfor; ?>

                        <?php
                        elseif ($soLuongPhanLoai === 5 && $arr !== $compareArr) : ?>

                            <?php for ($y = 0; $y < 4; $y++) : ?>
                                <th colspan="1">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai'];  ?>
                                </th>
                            <?php endfor; ?>
                            <th colspan="2">
                                <?php echo $noiDungHinhThucPhanLoai[4]['NoiDungHinhThucPhanLoai'];  ?>
                            </th>

                            <?php for ($y = 0; $y < 4; $y++) : ?>
                                <th colspan="1">
                                    <?php echo $noiDungHinhThucPhanLoai[$y]['NoiDungHinhThucPhanLoai'];  ?>
                                </th>
                            <?php endfor; ?>
                            <th colspan="2">
                                <?php echo $noiDungHinhThucPhanLoai[4]['NoiDungHinhThucPhanLoai'];

                                ?>
                            </th>

                            <?php
                            //elseif ($soLuongPhanLoai === 5 && $flag === TRUE) : 
                            ?>


                        <?php endif; ?>
                        <?php $compareArr = $arr; ?>
                    </tr>
                    <!-- bảng trên tiếp tục tạo 1 column vì nếu số lượng phân loại = 5 thì sẽ bỏ qua -->
                    <tr>
                        <th>
                            <?php
                            echo $stt;
                            $stt++;
                            ?>
                        </th>
                        <th>
                            Câu hỏi
                        </th>
                    </tr>
                <?php endforeach; ?>
            <?php endfor; ?>


            <!-- <tr>
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
            </tr> -->
        </tbody>

    </table>
</div>