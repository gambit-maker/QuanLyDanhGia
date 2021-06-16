<?php
if ($_GET["TenChucVu"] === 'admin') {
    $giaoVien = $infoSmallTable->getThongTinBang("GiaoVien");
    $stt = 1;
}
?>

<div>
    <div class="pb-5 d-flex justify-content-around">
        <div>
            <h4>Danh sách giáo viên</h4>
        </div>
        <div><a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=themGiaoVien" class="btn btn-primary">thêm giáo viên</a></div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã giáo viên</th>
                <th>Tên giáo viên</th>
                <th>Chức vụ</th>
                <th>Bộ môn</th>
                <th>Khoa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($giaoVien as $item) : ?>
                <tr>
                    <td>
                        <?php
                        echo $stt;
                        $stt++;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $item['MaGiaoVien'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $item['TenGiaoVien'];
                        ?>
                    </td>
                    <td>
                        <?php
                        $tenChucVugiaoVien = $infoSmallTable->getTenChucVu($item['MaChucVu']);
                        $tenChucVugiaoVien = $tenChucVugiaoVien[0]['TenChucVu'];
                        if ($tenChucVugiaoVien === 'giaovien') {
                            echo "giáo viên";
                        } elseif ($tenChucVugiaoVien === 'truongbomon') {
                            echo "trưởng bộ môn";
                        } elseif ($tenChucVugiaoVien === 'truongkhoa') {
                            echo "trưởng khoa";
                        }

                        ?>
                    </td>
                    <td>
                        <?php
                        $tenBoMon = $infoSmallTable->getThongTinBoMon($item['MaBoMon'], 'TenBoMon');
                        echo $tenBoMon;
                        ?>
                    </td>
                    <td>
                        <?php
                        $maKhoa = $infoSmallTable->getThongTinBoMon($item['MaBoMon'], 'MaKhoa');
                        $tenKhoa = $infoSmallTable->getTenKhoa($maKhoa);
                        echo $tenKhoa;
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>