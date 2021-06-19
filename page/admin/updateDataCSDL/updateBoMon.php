<?php
if ($_GET["TenChucVu"] === 'admin') {


    if (isset($_GET["MaBoMon"])) {
        $maBoMon = $_GET["MaBoMon"];
        $tenBoMon = $infoSmallTable->getThongTinBoMon($maBoMon, 'TenBoMon');
        $tenBoMonCheckInput = $tenBoMon;
        $maKhoa = $infoSmallTable->getThongTinBoMon($maBoMon, 'MaKhoa');

        if (isset($_POST["submitUpdateBoMon"])) {
            $inputBoMon = $_POST["inputBoMon"];
            $selectKhoa = $_POST["selectKhoa"];

            if ($tenBoMonCheckInput === $inputBoMon && $maKhoa === $selectKhoa) {
                echo "không có gì thay dổi";
            } elseif ($lopHocPhan->checkBoMon($inputBoMon, $selectKhoa)) {
                $lopHocPhan->updateBoMon($selectKhoa, $maBoMon, $inputBoMon);
            } else {
                echo "Bộ môn đã có trong khoa";
            }
            $tenBoMon = $inputBoMon;
            $maKhoa = $selectKhoa;
        }
    }



    $khoa = $infoSmallTable->getThongTinBang("Khoa");
    if (isset($_POST["submitThemBoMon"])) {
        $boMon = $_POST["inputBoMon"];
        $boMon = strtolower($boMon);
        $maKhoa = $_POST["selectKhoa"];
        if ($lopHocPhan->checkBoMon($boMon, $maKhoa)) {
            $lopHocPhan->themBoMon($boMon, $maKhoa);
        } else {
            echo "bộ môn đã có trong khoa";
        }
    }
}


?>

<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<form action="" method="post" style="width:50%;margin-left:20%">
    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Update bộ môn: </label>
        <div class="col-8">
            <input class="form-control" required type="text" name="inputBoMon" placeholder="Nhập tên bộ môn" value="<?php echo $tenBoMon; ?>">
        </div>
    </div>
    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Khoa: </label>
        <div class="col-8">
            <select required class="form-select" name="selectKhoa">
                <option value="" disabled selected>Chọn Khoa</option>
                <?php foreach ($khoa as $item) : ?>
                    <option <?php
                            if ($item['MaKhoa'] === $maKhoa) {
                                echo "selected";
                            }
                            ?> value="<?php echo $item['MaKhoa'] ?>"><?php echo $item['TenKhoa'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>


    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="submit" name="submitUpdateBoMon" class="btn btn-warning" value="Update bộ môn">
        </div>
    </div>
</form>