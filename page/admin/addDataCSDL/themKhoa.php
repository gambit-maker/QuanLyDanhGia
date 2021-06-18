<?php
if ($_GET["TenChucVu"] === 'admin') {

    if (isset($_POST["submitThemKhoa"])) {
        $khoa = $_POST["inputKhoa"];
        $khoa = strtolower($khoa);
        if ($lopHocPhan->checkKhoa($khoa)) {
            $lopHocPhan->themKhoa($khoa);
        } else {
            echo "Khoa đã có";
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
        <label class="col-4  col-form-label" style="font-size: 1rem;">Thêm thêm khoa: </label>
        <div class="col-8">
            <input value="<?php if (isset($_POST["submitThemKhoa"])) {
                                echo $khoa;
                            } ?>" class="form-control" required type="text" name="inputKhoa" placeholder="Nhập tên khoa">
        </div>
    </div>


    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="submit" name="submitThemKhoa" class="btn btn-primary" value="thêm khoa">
        </div>
    </div>
</form>