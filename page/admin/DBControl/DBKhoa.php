<?php
if ($_GET["TenChucVu"] === 'admin') {
    $khoa = $infoSmallTable->getThongTinBang("khoa");
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
        <div><a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=themKhoa" class="btn btn-primary">thêm khoa</a></div>
    </div>

    <div class="row justify-content-bet">

    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="width: 50%; text-align: center;">STT</th>
                <th style="width: 50%; text-align: center;">Khoa</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($khoa as $item) : ?>
                <tr>
                    <th style="text-align: center;">
                        <?php
                        echo $stt;
                        $stt++;
                        ?>
                    </th>
                    <th style="text-align: center;">
                        <?php
                        echo $item['TenKhoa'];
                        ?>
                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>