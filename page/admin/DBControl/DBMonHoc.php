<?php
if ($_GET["TenChucVu"] === 'admin') {
    $boMon = $infoSmallTable->getThongTinBang("HocPhan");
    $stt = 1;
}
?>

<div>
    <div class="pb-5 d-flex justify-content-around">
        <div>
            <h4>Danh sách môn học</h4>
        </div>
        <div><a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=themMonHoc" class="btn btn-primary">thêm môn học</a></div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã học phần</th>
                <th>Tên học phần</th>
                <th>Bộ môn</th>
                <th>Khoa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($boMon as $item) : ?>
                <tr>
                    <td>
                        <?php
                        echo $stt;
                        $stt++;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $item['MaDuLieuHocPhan'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $item['TenHocPhan'];
                        ?>
                    </td>
                    <td>
                        <?php
                        $maBoMon = $infoSmallTable->getThongTinHocPhan($item['MaHocPhan'], 'MaBoMon');
                        $tenBoMon = $infoSmallTable->getThongTinBoMon($maBoMon, 'TenBoMon');
                        echo $tenBoMon;
                        ?>
                    </td>
                    <td>
                        <?php
                        $maKhoa = $infoSmallTable->getThongTinBoMon($maBoMon, 'MaKhoa');
                        $tenKhoa = $infoSmallTable->getTenKhoa($maKhoa);
                        echo $tenKhoa;
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>