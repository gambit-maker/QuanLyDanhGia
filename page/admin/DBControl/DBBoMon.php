<?php
if ($_GET["TenChucVu"] === 'admin') {
    $boMon = $infoSmallTable->getThongTinBang("BoMon");
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
            <h4>Danh sách khoa</h4>
        </div>
        <div><a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=themBoMon" class="btn btn-primary">thêm bộ môn</a></div>
    </div>

    <div class="row justify-content-bet">

    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="width: 20%; text-align: center;">STT</th>
                <th style="width: 40%; text-align: center;">Bộ môn</th>
                <th style="width: 40%; text-align: center;">Khoa</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($boMon as $item) : ?>
                <tr>
                    <th style="text-align: center;">
                        <?php
                        echo $stt;
                        $stt++;
                        ?>
                    </th>
                    <th style="text-align: center;">
                        <?php
                        echo $item['TenBoMon'];
                        ?>
                    </th>
                    <th style="text-align: center;">
                        <?php
                        $maKhoa = $infoSmallTable->getThongTinBoMon($item['MaBoMon'], 'MaKhoa');
                        $tenKhoa = $infoSmallTable->getTenKhoa($maKhoa);
                        echo strtolower($tenKhoa);
                        ?>
                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>