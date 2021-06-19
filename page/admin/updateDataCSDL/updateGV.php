<?php
if ($_GET["TenChucVu"] === 'admin') {


    if (isset($_GET["MaGiaoVien"])) {
        $maGiaoVien = $_GET["MaGiaoVien"];
        $maGiaoVienCheckInput = $maGiaoVien;
        $tenGiaoVien = $infoSmallTable->getThongTinGiaoVien($maGiaoVien, "TenGiaoVien");
        $matKhauGiaoVien = $infoSmallTable->getThongTinGiaoVien($maGiaoVien, "MatKhau");
        $maChucVu = $infoSmallTable->getThongTinGiaoVien($maGiaoVien, "MaChucVu");
        $maBoMon = $infoSmallTable->getThongTinGiaoVien($maGiaoVien, "MaBoMon");


        $chucVu = $infoSmallTable->getBangchucVuTheoNhom("gv");
        $boMon = $infoSmallTable->getThongTinBang("BoMon");


        if (isset($_POST["submitUpdateGV"])) {
            $maGiaoVienNew = $_POST["inputMaGiaoVien"];
            $tenGiaoVien = $_POST["inputTenGiaoVien"];
            $matKhauGiaoVien = $_POST["inputMatKhau"];
            $maChucVu = $_POST["selectChucVu"];
            $maBoMon = $_POST["selectBoMon"];


            if ($maGiaoVienCheckInput === $maGiaoVien) {
                $lopHocPhan->updateGiaoVien($maGiaoVienNew, $maGiaoVienCheckInput, $tenGiaoVien, $matKhauGiaoVien, $maChucVu, $maBoMon);
            } elseif (!$lopHocPhan->checkGiaoVienCoTrongDB($maGiaoVien)) {
                $lopHocPhan->updateGiaoVien($maGiaoVienNew, $maGiaoVienCheckInput, $tenGiaoVien, $matKhauGiaoVien, $maChucVu, $maBoMon);
            } else {
                echo "mã giáo viên trùng nhau";
            }
        }
    }




    $khoa = $infoSmallTable->getThongTinBang("Khoa");

    // if (isset($_POST["submitThemGiaoVien"])) {
    //     $maGiaoVien = $_POST["inputMaGiaoVien"];
    //     $tenGiaoVien = $_POST["inputTenGiaoVien"];
    //     $matKhau = $_POST["inputMatKhau"];
    //     $maChucVu = $_POST["selectChucVu"];
    //     $maBoMon = $_POST["selectBoMon"];

    //     if (!$lopHocPhan->checkGiaoVienCoTrongDB($maGiaoVien)) {
    //         $lopHocPhan->themGiaoVien($maGiaoVien, $tenGiaoVien, $matKhau, $maChucVu, $maBoMon);
    //     } else {
    //         echo "Giáo viên đã có trong DB";
    //     }
    // }
}

?>

<form action="" method="post" style="width:50%;margin-left:20%">
    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Mã giáo viên: </label>
        <div class="col-8">
            <input required class="form-control" type="text" name="inputMaGiaoVien" placeholder="nhập mã giáo viên" value="<?php if (isset($_POST["submitUpdateGV"])) {
                                                                                                                                echo $maGiaoVienNew;
                                                                                                                            } else {
                                                                                                                                echo $maGiaoVien;
                                                                                                                            } ?>">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Tên giáo viên: </label>
        <div class="col-8">
            <input required class="form-control" type="text" name="inputTenGiaoVien" placeholder="nhập tên giáo viên" value="<?php echo $tenGiaoVien; ?>">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Mật khẩu: </label>
        <div class="col-8">
            <input required class="form-control" type="text" name="inputMatKhau" placeholder="nhập mật khẩu" value="<?php echo $matKhauGiaoVien; ?>">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Chức vụ: </label>
        <div class="col-8">
            <select required class="form-select" name="selectChucVu">
                <option value="" disabled selected>Chọn chức vụ</option>
                <?php foreach ($chucVu as $item) : ?>
                    <option <?php
                            if ($maChucVu === $item['MaChucVu']) {
                                echo "selected";
                            } ?> value="<?php echo $item['MaChucVu'] ?>">
                        <?php
                        if ($item['TenChucVu'] === 'giaovien') {
                            echo "Giáo viên";
                        } elseif ($item['TenChucVu'] === 'truongbomon') {
                            echo "Trưởng bộ môn";
                        } elseif ($item['TenChucVu'] === 'truongkhoa') {
                            echo "Trưởng khoa";
                        } else {
                            echo $item['TenChucVu'];
                        }
                        ?>
                    </option>

                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Bộ môn: </label>
        <div class="col-8">
            <select required class="form-select" name="selectBoMon">
                <option value="" disabled selected>Chọn bộ môn</option>
                <?php foreach ($boMon as $item) : ?>
                    <option <?php
                            if ($maBoMon === $item['MaBoMon']) {
                                echo "selected";
                            } ?> value="<?php echo $item['MaBoMon'] ?>"><?php echo $item['TenBoMon'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>



    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="submit" name="submitUpdateGV" class="btn btn-warning" value="Update giáo viên">
        </div>
    </div>
</form>