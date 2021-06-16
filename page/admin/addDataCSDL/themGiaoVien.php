<?php
if ($_GET["TenChucVu"] === 'admin') {

    $chucVu = $infoSmallTable->getBangchucVuTheoNhom("gv");
    $boMon = $infoSmallTable->getThongTinBang("BoMon");
    $khoa = $infoSmallTable->getThongTinBang("Khoa");

    if (isset($_POST["submitThemGiaoVien"])) {
        $maGiaoVien = $_POST["inputMaGiaoVien"];
        $tenGiaoVien = $_POST["inputTenGiaoVien"];
        $matKhau = $_POST["inputMatKhau"];
        $maChucVu = $_POST["selectChucVu"];
        $maBoMon = $_POST["selectBoMon"];

        if (!$lopHocPhan->checkGiaoVienCoTrongDB($maGiaoVien)) {
            $lopHocPhan->themGiaoVien($maGiaoVien, $tenGiaoVien, $matKhau, $maChucVu, $maBoMon);
        } else {
            echo "Giáo viên đã có trong DB";
        }
    }
}

?>

<form action="" method="post" style="width:50%;margin-left:20%">
    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Mã giáo viên: </label>
        <div class="col-8">
            <input class="form-control" type="text" name="inputMaGiaoVien" placeholder="nhập mã giáo viên">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Tên giáo viên: </label>
        <div class="col-8">
            <input class="form-control" type="text" name="inputTenGiaoVien" placeholder="nhập tên giáo viên">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Mật khẩu: </label>
        <div class="col-8">
            <input class="form-control" type="text" name="inputMatKhau" placeholder="nhập mật khẩu">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Chức vụ: </label>
        <div class="col-8">
            <select required class="form-select" name="selectChucVu">
                <option value="" disabled selected>Chọn chức vụ</option>
                <?php foreach ($chucVu as $item) : ?>
                    <option value="<?php echo $item['MaChucVu'] ?>">
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
                    <option value="<?php echo $item['MaBoMon'] ?>"><?php echo $item['TenBoMon'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="submit" name="submitThemGiaoVien" class="btn btn-primary" value="thêm giáo viên">
        </div>
    </div>
</form>