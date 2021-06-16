<?php
if ($_GET["TenChucVu"] === 'admin') {

    $boMon = $infoSmallTable->getThongTinBang("BoMon");
    $khoa = $infoSmallTable->getThongTinBang("Khoa");

    if (isset($_POST["submitThemMonHoc"])) {
        $maKhoa = $_POST["selectKhoa"];
        $maBoMon = $_POST["selectBoMon"];
        $tenMonHoc = $_POST["tenMonHoc"];
        $maMonHoc = $_POST["maMonHoc"];

        if ($lopHocPhan->checkHocPhan($maBoMon, $maKhoa, $maMonHoc)) {
            $lopHocPhan->themHocPhan($maBoMon, $maKhoa, $tenMonHoc, $maMonHoc);
        } else {
            echo "Dữ liệu trùng lập mã môn học đã có trong khoa và bộ môn ";
        }

        // echo "Ma khoa: " . $maKhoa . " maBoMon: " . $maBoMon . " ten mon hoc: " . $tenMonHoc . " ma mon hoc " . $maMonHoc;
    }
}

?>

<form action="" method="post" style="width:50%;margin-left:20%">
    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Mã môn học: </label>
        <div class="col-8">
            <input class="form-control" type="text" name="maMonHoc" placeholder="nhập mã môn học">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Tên môn học: </label>
        <div class="col-8">
            <input class="form-control" type="text" name="tenMonHoc" placeholder="nhập tên môn học">
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

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Khoa: </label>
        <div class="col-8">
            <select required class="form-select" name="selectKhoa">
                <option value="" disabled selected>Chọn Khoa</option>
                <?php foreach ($khoa as $item) : ?>
                    <option value="<?php echo $item['MaKhoa'] ?>"><?php echo $item['TenKhoa'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="submit" name="submitThemMonHoc" class="btn btn-primary" value="thêm môn học">
        </div>
    </div>
</form>