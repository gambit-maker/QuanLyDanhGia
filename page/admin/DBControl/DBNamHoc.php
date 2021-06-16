<?php
if ($_GET["TenChucVu"] === 'admin') {
    $namHoc = $infoSmallTable->getThongTinBang("Namhoc");
    $stt = 1;
}
?>
<style>
    table td {
        text-align: center;
    }
</style>

<div>
    <div class="pb-5 d-flex justify-content-around">
        <div>
            <h4>Danh sách năm học</h4>
        </div>
        <div><a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=themNamHoc" class="btn btn-primary">thêm năm học</a></div>
    </div>

    <div class="row justify-content-bet">

    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="width: 50%; text-align: center;">STT</th>
                <th style="width: 50%; text-align: center;">Năm học</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($namHoc as $item) : ?>
                <tr>
                    <th style="text-align: center;">
                        <?php
                        echo $stt;
                        $stt++;
                        ?>
                    </th>
                    <th style="text-align: center;">
                        <?php
                        echo $item['ThoiGian'] . " - " . intval($item['ThoiGian']) + 1;
                        ?>
                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>