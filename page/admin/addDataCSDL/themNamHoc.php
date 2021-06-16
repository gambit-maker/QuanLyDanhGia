<?php
if ($_GET["TenChucVu"] === 'admin') {
    $namHoc = $infoSmallTable->getThongTinBang("NamHoc");

    if (isset($_POST["submitThemNamhoc"])) {
        $thoiGian = $_POST["inputNamHoc"];

        if ($lopHocPhan->checkNamHoc($thoiGian)) {
            $lopHocPhan->themNamHoc($thoiGian);
        } else {
            echo "Dữ liệu năm học đã có trong DB";
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
        <label class="col-4  col-form-label" style="font-size: 1rem;">Thêm năm học: </label>
        <div class="col-8">
            <input class="form-control" min="1000" max="9999" type="number" name="inputNamHoc" placeholder="Nhập năm học VD:2020">
        </div>
    </div>


    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="submit" name="submitThemNamhoc" class="btn btn-primary" value="thêm năm học">
        </div>
    </div>
</form>