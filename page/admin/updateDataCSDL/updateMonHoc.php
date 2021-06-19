<?php
if ($_GET["TenChucVu"] === 'admin') {


    if (isset($_GET["MaHocPhan"])) {
        $maHocPhan = $_GET["MaHocPhan"];


        $maDuLieuHocPhan = $infoSmallTable->getThongTinHocPhan($maHocPhan, 'MaDuLieuHocPhan');
        $maDuLieucheckInput = $infoSmallTable->getThongTinHocPhan($maHocPhan, 'MaDuLieuHocPhan'); //nếu input mã vẫn giữ nguyên thì cho phép còn không thì chechk có trùng mã nào khác không
        // echo $maMonHoc . "<Br>";

        $tenMonHoc = $infoSmallTable->getThongTinHocPhan($maHocPhan, 'TenHocPhan');
        // echo $tenMonHoc . "<br>";

        $maKhoa = $infoSmallTable->getThongTinHocPhan($maHocPhan, 'MaKhoa');
        // echo $maKhoa . "<br>";

        $maBoMon = $infoSmallTable->getThongTinHocPhan($maHocPhan, 'MaBoMon');
        // echo $maBoMon . "<br>";

        if (isset($_POST["submitUpdate"])) {
            $maHocPhan = $_GET["MaHocPhan"];
            $selectBoMon = $_POST["selectBoMon"];
            $selectKhoa = $_POST["selectKhoa"];
            $tenMonHoc = $_POST["tenMonHoc"];
            $maDuLieuHocPhan = $_POST["maDuLieuHocPhan"];
            $maDuLieuHocPhan = strtoupper($maDuLieuHocPhan);



            if ($maDuLieucheckInput === $maDuLieuHocPhan) {
                if ($lopHocPhan->kiemTraBoMonCoTrongKhoaBangMa($selectKhoa, $selectBoMon)) {
                    $lopHocPhan->updateMonHoc($maHocPhan, $selectBoMon, $selectKhoa, $tenMonHoc, $maDuLieuHocPhan);
                } else {
                    echo "Bộ môn không có trong khoa";
                }
            } elseif ($lopHocPhan->checkHocPhan($maDuLieuHocPhan)) {
                if ($lopHocPhan->kiemTraBoMonCoTrongKhoaBangMa($selectKhoa, $selectBoMon)) {
                    $lopHocPhan->updateMonHoc($maHocPhan, $selectBoMon, $selectKhoa, $tenMonHoc, $maDuLieuHocPhan);
                } else {
                    echo "Bộ môn không có trong khoa";
                }
            } else {
                echo "Mã môn học trùng nhau với môn học khác";
            }
        }
    }







    $boMon = $infoSmallTable->getThongTinBang("BoMon");
    $khoa = $infoSmallTable->getThongTinBang("Khoa");
}

?>

<form action="" method="post" style="width:50%;margin-left:20%">
    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Mã môn học: </label>
        <div class="col-8">
            <input required class="form-control" type="text" name="maDuLieuHocPhan" placeholder="nhập mã môn học" value="<?php echo $maDuLieuHocPhan; ?>">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Tên môn học: </label>
        <div class="col-8">
            <input required class="form-control" type="text" name="tenMonHoc" placeholder="nhập tên môn học" value="<?php echo $tenMonHoc; ?>">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Khoa: </label>
        <div class="col-8">
            <select required class="form-select" name="selectKhoa">
                <option value="" disabled selected>Chọn Khoa</option>
                <?php foreach ($khoa as $item) : ?>

                    <option <?php if ($maKhoa === $item['MaKhoa']) {
                                echo "selected";
                            }
                            ?> value="<?php echo $item['MaKhoa'] ?>"><?php echo $item['TenKhoa'] ?></option>
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
                    <option <?php if ($maBoMon === $item['MaBoMon']) {
                                echo "selected";
                            } ?> value="<?php echo $item['MaBoMon'] ?>"><?php echo $item['TenBoMon'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>



    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="submit" name="submitUpdate" class="btn btn-warning" value="Update môn học">
        </div>
    </div>
</form>