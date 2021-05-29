<style>
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
    }

    .autocomplete-items {
        position: absolute;

        /*position the autocomplete items to be the same width as the container:*/
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
        background-color: DodgerBlue !important;
        color: #ffffff;
    }
</style>


<?php
$khoa = $infoSmallTable->getThongTinBang('Khoa');
$arrKhoa = array();

$boMon = $infoSmallTable->getThongTinBang('BoMon');
$arrBoMon = array();

$monHoc = $infoSmallTable->getThongTinBang('HocPhan');
$arrMonHoc = array();

$giaoVien = $infoSmallTable->getThongTinBang('GiaoVien');
$arrGiaoVien = array();

$namHoc = $infoSmallTable->getThongTinBang('NamHoc');
$arrNamHoc = array();

$hocKy = $infoSmallTable->getThongTinBang('HocKy');
$arrHocKy = array();
?>


<?php
if (isset($_POST["submit"])) {
    if (isset($_POST["inputKhoa"])) {
        $inputKhoa = $_POST["inputKhoa"];
        // echo $inputKhoa . "<br>";
    }
    if (isset($_POST["inputBoMon"])) {
        $inputBoMon = $_POST["inputBoMon"];
        // echo $inputBoMon . "<br>";
    }
    if (isset($_POST["inputMonHoc"])) {
        $inputMonHoc = $_POST["inputMonHoc"];
        // echo $inputMonHoc . "<br>";
    }
    if (isset($_POST["inputGiaoVien"])) {
        $inputGiaoVien = $_POST["inputGiaoVien"];
        // echo $inputGiaoVien . "<br>";
        $arrInputGiaoVien = explode('-', $inputGiaoVien);
        $inputMaGiaoVien = $arrInputGiaoVien[0];
        $inputTenGiaoVien = $arrInputGiaoVien[1];
    }
    if (isset($_POST["inputNamHoc"])) {
        $inputNamHoc = $_POST["inputNamHoc"];
        // echo $inputNamHoc . "<br>";
    }
    if (isset($_POST["inputHocKy"])) {
        $inputHocKy = $_POST["inputHocKy"];
        // echo $inputHocKy . "<br>";
    }
}
?>

<form autocomplete="off" action="" method="POST">
    <table class="m-auto">
        <tr>
            <td style="text-align: right;">Khoa: </td>
            <td>
                <?php
                foreach ($khoa as $item) {
                    $arrKhoa[] = '"' . $item['TenKhoa'] . '"';
                }
                ?>
                <div class="autocomplete input-group-sm">
                    <input id="myInputKhoa" class="form-control" type="text" name="inputKhoa" placeholder="Tìm khoa">
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">Bộ môn: </td>
            <td>
                <?php
                foreach ($boMon as $item) {
                    $arrBoMon[] = '"' . $item['TenBoMon'] . '"';
                }
                ?>
                <div class="autocomplete input-group-sm">
                    <input id="myInputBoMon" class="form-control" type="text" name="inputBoMon" placeholder="Tìm bộ môn">
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">Môn học: </td>
            <td>
                <?php
                foreach ($monHoc as $item) {
                    $arrMonHoc[] = '"' . $item['TenHocPhan'] . '"';
                }
                ?>
                <div class="autocomplete input-group-sm">
                    <input id="myInputMonHoc" class="form-control" type="text" name="inputMonHoc" placeholder="Tìm môn học">
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">Giáo viên:</td>
            <td>
                <?php
                foreach ($giaoVien as $item) {
                    $arrGiaoVien[] = '"' . $item['MaGiaoVien'] . "-" . $item['TenGiaoVien'] . '"';
                }
                ?>
                <div class="autocomplete input-group-sm">
                    <input id="myInputGiaoVien" class="form-control" type="text" name="inputGiaoVien" placeholder="Tìm giáo viên">
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">Năm học:</td>
            <td>
                <?php
                foreach ($namHoc as $item) {
                    $arrNamHoc[] = '"' . $item['ThoiGian']  . '"';
                }
                ?>
                <div class="autocomplete input-group-sm">
                    <input id="myInputNamHoc" class="form-control" type="text" name="inputNamHoc" placeholder="Năm học">
                </div>
            </td>
        </tr>

        <tr>
            <td style="text-align: right;">Học kỳ:</td>
            <td>
                <?php
                foreach ($hocKy as $item) {
                    $arrHocKy[] = '"' . $item['TenHocKy']  . '"';
                }
                ?>
                <div class="autocomplete input-group-sm">
                    <input id="myInputHocKy" class="form-control" type="text" name="inputHocKy" placeholder="Học kỳ">
                </div>
            </td>
        </tr>
        <tr>
            <th></th>
            <th><input class="btn btn-sm btn-primary" type="submit" name="submit" value="Thống kê"></th>
        </tr>
    </table>
</form>

<script>
    // filter jquery    
    $(function() {
        var arrKhoa = [
            <?php echo implode(",", $arrKhoa) ?>
        ];
        $("#myInputKhoa").autocomplete({
            source: arrKhoa,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });


        var arrBoMon = [
            <?php echo implode(",", $arrBoMon) ?>
        ];
        $("#myInputBoMon").autocomplete({
            source: arrBoMon,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });


        var arrMonHoc = [
            <?php echo implode(",", $arrMonHoc) ?>
        ];
        $("#myInputMonHoc").autocomplete({
            source: arrMonHoc,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });

        var arrGiaoVien = [
            <?php echo implode(",", $arrGiaoVien) ?>
        ];
        $("#myInputGiaoVien").autocomplete({
            source: arrGiaoVien,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });

        var arrNamHoc = [
            <?php echo implode(",", $arrNamHoc) ?>
        ];
        $("#myInputNamHoc").autocomplete({
            source: arrNamHoc,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });

        var arrHocKy = [
            <?php echo implode(",", $arrHocKy) ?>
        ];
        $("#myInputHocKy").autocomplete({
            source: arrHocKy,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });
    });
</script>