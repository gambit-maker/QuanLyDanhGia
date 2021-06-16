<?php
if ($_GET["TenChucVu"] === 'admin') {
    $nhanvien = $infoSmallTable->getThongTinBang("nhanvien");
    $stt = 1;
}
?>

<div>
    <div class="pb-5 d-flex justify-content-around">
        <div>
            <h4>Danh sách giáo viên</h4>
        </div>
        <div><a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=themNhanVien" class="btn btn-primary">thêm nhân viên</a></div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã nhân viênn</th>
                <th>Tên nhân viên</th>
                <th>Chức vụ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nhanvien as $item) : ?>
                <tr>
                    <td>
                        <?php
                        echo $stt;
                        $stt++;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $item['MaNhanVien'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $item['TenNhanVien'];
                        ?>
                    </td>
                    <td>
                        <?php
                        $tenChucVuNhanVien = $infoSmallTable->getTenChucVu($item['MaChucVu']);
                        $tenChucVuNhanVien = $tenChucVuNhanVien[0]['TenChucVu'];
                        if ($tenChucVuNhanVien === 'nhanvien') {
                            echo "Nhân viên";
                        } else {
                            echo $tenChucVuNhanVien;
                        }

                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>