<?php
if ($_GET["TenChucVu"] === 'truongkhoa') {
    $maGiaoVien = $_SESSION['MaDangNhap'];
    $maKhoa = $infoSmallTable->getMaKhoaGiaoVien($maGiaoVien);
    $tenKhoa = $infoSmallTable->getTenKhoa($maKhoa);

    $namHoc = $infoSmallTable->getThongTinBang('NamHoc');
    $arrNamHoc = array();


    $hocKy = $infoSmallTable->getThongTinBang('HocKy');
    $arrHocKy = array();

    $boMon = $infoSmallTable->getThongTinBoMonCuaKhoa($maKhoa);
    $arrBoMon = array();
}

if ($_GET["TenChucVu"] === 'admin') {

    $khoa = $infoSmallTable->getThongTinBang('Khoa');
    $arrKhoa = array();

    $namHoc = $infoSmallTable->getThongTinBang('NamHoc');
    $arrNamHoc = array();


    $hocKy = $infoSmallTable->getThongTinBang('HocKy');
    $arrHocKy = array();

    $boMon = $infoSmallTable->getThongTinBang('bomon');
    $arrBoMon = array();
}



if (isset($_POST["submit"])) {

    if ($_GET["TenChucVu"] === 'admin') {
        $inputKhoa = $_POST["inputKhoa"];
        $maKhoa = $infoSmallTable->getMaKhoaTuTenKhoa($inputKhoa);
    }
    $inputBoMon = $_POST["inputBoMon"];
    $maBoMon = $infoSmallTable->getMaBoMon($inputBoMon, $maKhoa);
    $arrMaNhomHocPhan = array(); // mã các nhóm học phần trong bộ môn
    foreach ($maBoMon as $item) {
        $arrMaNhomHocPhan[] = $item['MaHocPhan'];
    }
    // print_r($arrMaNhomHocPhan);

    $inputNamHoc = $_POST["inputNamHoc"];
    $maNamHoc = $infoSmallTable->getMaNamHoc($inputNamHoc);

    $inputHocKy = $_POST["inputHocKy"]; // số liệu học kỳ chính là mã

    $cacLopHocPhan = $infoSmallTable->getArrLopHocPhan($arrMaNhomHocPhan, $maNamHoc, $inputHocKy);
    // foreach ($cacLopHocPhan as $item) {
    //     print_r($item);
    //     echo "<Br>";
    // }


    $stt = 1;
}

?>


<style>
    td,
    th {
        white-space: nowrap;
        overflow: hidden;
    }

    /* hide arrow input type number */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<?php if ($_GET["TenChucVu"] === 'truongkhoa') : ?>
    <h4 style="text-align: center;">Thống kê điểm của khoa <b><?php echo $tenKhoa; ?></b></h4>
<?php endif; ?>

<div>
    <form action="" method="POST">
        <table class="m-auto">
            <?php if ($_GET["TenChucVu"] === 'admin') : ?>
                <td style="text-align: right;">Khoa: </td>
                <td>
                    <?php
                    foreach ($khoa as $item) {
                        $arrKhoa[] = '"' . $item['TenKhoa'] . '"';
                    }
                    ?>
                    <div class="autocomplete input-group-sm">
                        <input required id="myInputKhoa" class="form-control" type="text" name="inputKhoa" placeholder="Tìm khoa" value="<?php if (!empty($inputKhoa)) echo $inputKhoa; ?>">
                    </div>
                </td>
            <?php endif; ?>

            <tr>
                <td style="text-align: right;">Bộ môn: </td>
                <td>
                    <?php
                    foreach ($boMon as $item) {
                        $arrBoMon[] = '"' . $item['TenBoMon'] . '"';
                    }
                    ?>
                    <div class="autocomplete input-group-sm">
                        <input required id="myInputBoMon" class="form-control" type="text" name="inputBoMon" placeholder="Tìm bộ môn" value="<?php if (!empty($inputBoMon)) echo $inputBoMon; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">Năm học:</td>
                <td>
                    <?php
                    foreach ($namHoc as $item) {
                        $arrNamHoc[] = '"' . $item['ThoiGian']  . '"';
                    }
                    ?>
                    <div class="autocomplete input-group-sm">
                        <input required id="myInputNamHoc" class="form-control" type="number" name="inputNamHoc" placeholder="Năm học" value="<?php if (!empty($inputNamHoc)) echo $inputNamHoc; ?>">
                    </div>

                </td>
            </tr>
            <tr>
                <td style="text-align: right;">Học kỳ:</td>
                <td>
                    <?php
                    foreach ($hocKy as $item) {
                        $arrHocKy[] = '"' . $item['TenHocKy']  . '"';
                    }
                    ?>
                    <div class="autocomplete input-group-sm">
                        <input required id="myInputHocKy" min="1" max="3" class="form-control" type="number" name="inputHocKy" placeholder="Học kỳ" value="<?php if (!empty($inputHocKy)) echo $inputHocKy; ?>">
                    </div>
                </td>
            </tr>

            <tr>
                <td></td>
                <td><input class="btn btn-sm btn-primary" name="submit" type="submit" value="Xem bảng tổng kết"></td>
            </tr>

        </table>
    </form>

    <?php if (isset($_POST["submit"])) : ?>
        <div class="pt-5">
            <table class="table table-strip table-bordered">
                <tr>
                    <th>TT</th>
                    <th>Mã GV</th>
                    <th>Họ tên giáo viên</th>
                    <th>Số phiếu phản hồi</th>
                    <th style="width: 20%;">Số phiếu phản hồi có giá trị</th>
                    <th>Điểm TB</th>
                    <th>Xếp loại</th>
                </tr>
                <?php foreach ($cacLopHocPhan as $item) : ?>
                    <tr>
                        <td>
                            <?php
                            echo $stt;
                            $stt++;
                            ?>
                        </td>
                        <td>
                            <?php echo $item['MaGiaoVien']; ?>
                        </td>
                        <td>
                            <?php echo $infoSmallTable->getThongTinGiaoVien($item['MaGiaoVien']); ?>
                        </td>
                        <td>
                            <?php
                            $soPhieuKhaoSat = $lopHocPhan->getPhieuKhaoSat($item['MaLopHocPhan']);
                            echo count($soPhieuKhaoSat);
                            ?>
                        </td>
                        <td>
                            <?php
                            $soPhieuKhaoSat = $lopHocPhan->getPhieuKhaoSat($item['MaLopHocPhan']);
                            echo count($soPhieuKhaoSat);
                            ?>
                        </td>


                        <?php
                        $tong = 0;
                        $tongDiemHeSoNhan = 0;
                        $arrHinhThucPhanLoaiNhom2 = $infoSmallTable->getHinhThucPhanLoai($nhomTieuChi = 2);
                        $arrHinhThucPhanLoaiNhom3 = $infoSmallTable->getHinhThucPhanLoai($nhomTieuChi = 3);
                        for ($i = 0; $i < count($arrHinhThucPhanLoaiNhom2); $i++) {
                            $tieuChiDay = $infoSmallTable->getCountHinhThucPhanLoai($item['MaLopHocPhan'], $arrHinhThucPhanLoaiNhom2[$i]['NoiDungHinhThucPhanLoai']);
                            $yKienKhac = $infoSmallTable->getCountHinhThucPhanLoai($item['MaLopHocPhan'], $arrHinhThucPhanLoaiNhom3[$i]['NoiDungHinhThucPhanLoai']);
                            $tongDiem = count($tieuChiDay) + count($yKienKhac);
                            $tong += $tongDiem;

                            if (count($tieuChiDay) !== 0) {
                                $heSoNhan = $tieuChiDay[0]['Diem'];
                                $tongDiemHeSoNhan += $tongDiem * $heSoNhan;
                            }
                        }
                        ?>
                        <td>
                            <?php
                            $diemTB =  number_format($tongDiemHeSoNhan / $tong, 2);
                            echo $diemTB;
                            ?>
                        </td>
                        <td>
                            <?php
                            $xepLoai = "";
                            if ($diemTB >= 4.5) {
                                $xepLoai = "T + A";
                            } elseif ($diemTB < 4.5 && $diemTB > 4) {
                                $xepLoai = "T - A";
                            } else {
                                $xepLoai = "T - B";
                            }

                            echo $xepLoai;
                            ?>
                        </td>

                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>


    <script>
        $(function() {

            <?php if ($_GET["TenChucVu"] === 'admin') : ?>
                var arrKhoa = [
                    <?php echo implode(",", $arrKhoa) ?>
                ];
                $("#myInputKhoa").autocomplete({
                    source: arrKhoa,
                    minLength: 0,
                    scroll: true
                }).focus(function() {
                    $(this).autocomplete("search", "");
                });
            <?php endif; ?>


            var arrBoMon = [
                <?php echo implode(",", $arrBoMon) ?>
            ];
            $("#myInputBoMon").autocomplete({
                source: arrBoMon,
                minLength: 0,
                scroll: true
            }).focus(function() {
                $(this).autocomplete("search", "");
            });

            var arrNamHoc = [
                <?php echo implode(",", $arrNamHoc) ?>
            ];
            $("#myInputNamHoc").autocomplete({
                source: arrNamHoc,
                minLength: 0,
                scroll: true
            }).focus(function() {
                $(this).autocomplete("search", "");
            });

            var arrHocKy = [
                <?php echo implode(",", $arrHocKy) ?>
            ];
            $("#myInputHocKy").autocomplete({
                source: arrHocKy,
                minLength: 0,
                scroll: true
            }).focus(function() {
                $(this).autocomplete("search", "");
            });
        });
    </script>
</div>