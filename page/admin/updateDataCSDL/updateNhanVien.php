<?php
if ($_GET["TenChucVu"] === 'admin') {


    if (isset($_GET["MaNhanVien"])) {
        $maNhanVien = $_GET["MaNhanVien"];
        $maNhanVienCheckInput = $maNhanVien;
        $thongTinNhanVien = $infoSmallTable->getThongTinNhanVien($maNhanVien);
        $maNhanVien = substr($maNhanVien, 2); // cắt ký tự  'NV'


        $tenNhanVien = $thongTinNhanVien[0]['TenNhanVien'];
        $matKhau = $thongTinNhanVien[0]['MatKhau'];
        $maChucVu = $thongTinNhanVien[0]['MaChucVu'];

        // sau khi xử ly sẽ bỏ vào lại 

        if (isset($_POST["submitUpdateNhanVien"])) {
            $inputMaNhanVien = $_POST["inputMaNhanVien"];
            $maNhanVien = $inputMaNhanVien;
            $inputMaNhanVien = "NV" . $inputMaNhanVien;
            $inputTenNhanVien = $_POST["inputTenNhanVien"];
            $inputMatKhau = $_POST["inputMatKhau"];
            $selectChucVu = $_POST["selectChucVu"];



            if ($maNhanVienCheckInput === $inputMaNhanVien) {
                $lopHocPhan->updateNhanVien($inputMaNhanVien, $maNhanVienCheckInput, $inputTenNhanVien, $inputMatKhau, $selectChucVu);
            } elseif ($lopHocPhan->checkNhanVien($inputMaNhanVien)) {
                $lopHocPhan->updateNhanVien($inputMaNhanVien, $maNhanVienCheckInput, $inputTenNhanVien, $inputMatKhau, $selectChucVu);
            } else {
                echo "Mã nhân viên trùng nhau";
            }

            $maNhanVien = $inputMaNhanVien;
            $tenNhanVien = $inputTenNhanVien;
            $maChucVu = $selectChucVu;
        }
    }



    $chucVuNhanVien = $infoSmallTable->getBangchucVuTheoNhom("nv");
}

?>

<form action="" method="post" style="width:50%;margin-left:20%">
    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Mã nhân viên: </label>
        <div class="col-8">
            <input value="<?php echo $maNhanVien; ?>" required class="form-control" type="text" name="inputMaNhanVien" placeholder="nhập mã nhân viên">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Tên nhân viên: </label>
        <div class="col-8">
            <input value="<?php echo $tenNhanVien; ?>" required class="form-control" type="text" name="inputTenNhanVien" placeholder="nhập tên nhân viên">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Mật khẩu: </label>
        <div class="col-8">
            <input required value="<?php echo $matKhau; ?>" class="form-control" type="text" name="inputMatKhau" placeholder="nhập mật khẩu">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Chức vụ: </label>
        <div class="col-8">
            <select required class="form-select" name="selectChucVu">
                <option value="" disabled selected>Chọn chức vụ</option>
                <?php foreach ($chucVuNhanVien as $item) : ?>
                    <option <?php
                            if ($item['MaChucVu'] === $maChucVu) {
                                echo "selected";
                            }
                            ?> value="<?php echo $item['MaChucVu'] ?>">
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
            <input type="submit" name="submitUpdateNhanVien" class="btn btn-warning" value="Update nhân viên">
        </div>
    </div>
</form>