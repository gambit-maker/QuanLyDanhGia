<?php
if ($_GET["TenChucVu"] === 'admin') {

    if (isset($_GET["MaKhoa"])) {
        $maKhoa = $_GET["MaKhoa"];

        $tenKhoa = $infoSmallTable->getTenKhoa($maKhoa);
        $tenKhoaCheckInput = strtolower($tenKhoa);

        if (isset($_POST["submitUpdateKhoa"])) {
            $khoa = $_POST["inputKhoa"];
            $khoa = strtolower($khoa);

            if ($tenKhoaCheckInput === $khoa) {
                echo "Không có gì thay đổi";
            } elseif ($lopHocPhan->checkKhoa($khoa)) {
                $tenKhoa = $khoa;
                $lopHocPhan->updateKhoa($maKhoa, $tenKhoa);
            } else {
                echo "Khoa đã có";
            }
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
        <label class="col-4  col-form-label" style="font-size: 1rem;">Update khoa: </label>
        <div class="col-8">
            <input value="<?php echo $tenKhoa; ?>" class="form-control" required type="text" name="inputKhoa" placeholder="Nhập tên khoa">
        </div>
    </div>


    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="submit" name="submitUpdateKhoa" class="btn btn-warning" value="Update khoa">
        </div>
    </div>
</form>