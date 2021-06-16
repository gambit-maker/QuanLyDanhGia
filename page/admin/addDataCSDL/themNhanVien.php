<?php
if ($_GET["TenChucVu"] === 'admin') {

    $chucVuNhanVien = $infoSmallTable->getBangchucVuTheoNhom("nv");

    if (isset($_POST["submitThemNhanVien"])) {
        $maNhanVien = $_POST["inputMaNhanVien"];
        $maNhanVien = "NV" . $maNhanVien;
        $tenNhanVien = $_POST["inputTenNhanVien"];
        $matKhau = $_POST["inputMatKhau"];
        $chucVu = $_POST["selectChucVu"];

        if ($lopHocPhan->checkNhanVien($maNhanVien)) {
            $lopHocPhan->themNhanVien($maNhanVien, $tenNhanVien, $matKhau, $chucVu);
        } else {
            echo "Mã nhân viên trùng nhau";
        }
    }
}

?>

<form action="" method="post" style="width:50%;margin-left:20%">
    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Mã nhân viên: </label>
        <div class="col-8">
            <input class="form-control" type="text" name="inputMaNhanVien" placeholder="nhập mã nhân viên">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Tên nhân viên: </label>
        <div class="col-8">
            <input class="form-control" type="text" name="inputTenNhanVien" placeholder="nhập tên nhân viên">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Mật khẩu: </label>
        <div class="col-8">
            <input class="form-control" type="password" name="inputMatKhau" placeholder="nhập mật khẩu">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Chức vụ: </label>
        <div class="col-8">
            <select required class="form-select" name="selectChucVu">
                <option value="" disabled selected>Chọn chức vụ</option>
                <?php foreach ($chucVuNhanVien as $item) : ?>
                    <option value="<?php echo $item['MaChucVu'] ?>">
                        <?php
                        if ($item['TenChucVu'] === 'nhanvien') {
                            echo "Nhân viên";
                        } else {
                            echo $item['TenChucVu'];
                        }
                        ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>


    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="submit" name="submitThemNhanVien" class="btn btn-primary" value="thêm nhân viên">
        </div>
    </div>
</form>