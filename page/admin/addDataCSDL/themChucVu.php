<?php
if ($_GET["TenChucVu"] === 'admin') {

    if (isset($_POST["submitChucVu"])) {
        $chucVu = $_POST["inputChucVu"];
        $role = $_POST["inputRole"];
        $chucVu = strtolower($chucVu);
        if ($lopHocPhan->checkChucVu($chucVu, $role)) {
            $lopHocPhan->themChucVu($chucVu, $role);
        } else {
            echo "Chức vụ đã có trong role";
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
        <label class="col-4  col-form-label" style="font-size: 1rem;">Thêm chức vụ: </label>
        <div class="col-8">
            <input class="form-control" type="text" required name="inputChucVu" placeholder="Nhập tên chức vụ" value="<?php if (isset($_POST["submitChucVu"])) {
                                                                                                                            echo $chucVu;
                                                                                                                        } ?>">
        </div>
    </div>

    <div class="row pb-4">
        <label class="col-4  col-form-label" style="font-size: 1rem;">Role: </label>
        <div class="col-8">
            <div class="form-check">
                <input class="form-check-input" type="radio" value="nv" checked name="inputRole">
                <label class="form-check-label">
                    Nhân viên
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" <?php
                                                                if (isset($_POST["submitChucVu"]) && $role === 'gv') {
                                                                    echo "checked";
                                                                } ?> name="inputRole" value="gv">
                <label class="form-check-label">
                    Giáo viên
                </label>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="submit" name="submitChucVu" class="btn btn-primary" value="thêm chức vụ">
        </div>
    </div>
</form>