<?php
if ($_GET["TenChucVu"] === 'admin') {



    if (isset($_GET["MaNamHoc"])) {
        $maNamhoc = $_GET["MaNamHoc"];
        $thoiGian = $infoSmallTable->getThongTinNam($maNamhoc);
        $thoiGianCheckInput = $thoiGian;

        if (isset($_POST["submitUpdate"])) {
            $thoiGian = $_POST["inputNamHoc"];

            if ($thoiGianCheckInput === $thoiGian) {
                echo "Không có gì thay đổi";
            } elseif ($lopHocPhan->checkNamHoc($thoiGian)) {
                $lopHocPhan->updateNamHoc($maNamhoc, $thoiGian);
            } else {
                echo "Dữ liệu năm học đã có trong DB";
            }
        }
    }

    // $namHoc = $infoSmallTable->getThongTinBang("NamHoc");
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
        <label class="col-4  col-form-label" style="font-size: 1rem;">Update năm học: </label>
        <div class="col-8">
            <input required class="form-control" min="1000" max="9999" type="number" name="inputNamHoc" placeholder="Nhập năm học VD:2020" value="<?php echo $thoiGian; ?>">
        </div>
    </div>


    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="submit" name="submitUpdate" class="btn btn-warning" value="Update năm học">
        </div>
    </div>
</form>