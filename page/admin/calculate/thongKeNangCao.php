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
?>
<form autocomplete="off" action="" method="POST">
    <table class="m-auto">
        <tr>
            <td style="text-align: right;">Khoa: </td>
            <td>
                <div class="autocomplete input-group-sm">
                    <input id="myInputKhoa" class="form-control" type="text" name="inputKhoa" placeholder="Tìm khoa">
                </div>
            </td>
            <td>
                <select class="btn btn-sm" name="hang" required>
                    <option value="" disabled selected>Chọn khoa</option>
                    <?php
                    foreach ($khoa as $item) :
                        $arrKhoa[] = '"' . $item['TenKhoa'] . '"';
                    ?>
                        <option value="<?php echo $item['MaKhoa']; ?>"><?php echo $item['TenKhoa']; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">Bộ môn: </td>
            <td>
                <div class="autocomplete input-group-sm">
                    <input id="myInputBoMon" class="form-control" type="text" name="inputBoMon" placeholder="Tìm bộ môn">
                </div>
            </td>
            <td>
                <select class="btn btn-sm" name="hang" required>
                    <option value="" disabled selected>Chọn bộ môn</option>
                    <?php
                    foreach ($boMon as $item) :
                        $arrBoMon[] = '"' . $item['TenBoMon'] . '"';
                    ?>
                        <option value="<?php echo $item['MaKhoa']; ?>"><?php echo $item['TenBoMon']; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">Môn học: </td>
            <td>
                <select class="btn btn-sm" name="hang" required>
                    <option value="" disabled selected>Chọn môn học</option>
                    <?php
                    foreach ($khoa as $item) :
                    ?>
                        <option value="<?php echo $item['MaKhoa']; ?>"><?php echo $item['TenKhoa']; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">Giáo viên:</td>
            <td>
                <select class="btn btn-sm" name="hang" required>
                    <option value="" disabled selected>Chọn mã giáo viên</option>
                    <?php
                    foreach ($khoa as $item) :
                    ?>
                        <option value="<?php echo $item['MaKhoa']; ?>"><?php echo $item['TenKhoa']; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </td>
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
    });

    $(function() {
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
    });
</script>