<?php
if ($_GET["TenChucVu"] === 'admin') {


    if (isset($_POST["submitXoaGV"])) {
        $maGiaoVienCanXoa = $_POST["maGiaoVien"];
        // echo $maGiaoVienCanXoa;
        $lopHocPhan->xoaGiaoVien($maGiaoVienCanXoa);
    }


    $giaoVien = $infoSmallTable->getThongTinBang("GiaoVien");
    $stt = 1;
}
?>

<div>
    <div class="pb-5 d-flex justify-content-around">
        <div>
            <h4>Danh sách giáo viên</h4>
        </div>
        <div><a href="login.php?TenChucVu=<?php echo $tenChucVu; ?>&page=themGiaoVien" class="btn btn-primary">thêm giáo viên</a></div>
    </div>
    <table class="tfilter table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã giáo viên</th>
                <th>Tên giáo viên</th>
                <th>Chức vụ</th>
                <th>Bộ môn</th>
                <th>Khoa</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($giaoVien as $item) : ?>
                <form action="" method="post">
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

                        <td>
                            <input type="hidden" name="maGiaoVien" value="<?php echo $item['MaGiaoVien']; ?>">
                            <input type="submit" name="submitXoaGV" value="Xóa" class="btn btn-sm btn-danger">
                            <a href="login.php?TenChucVu=<?php echo $tenChucVu; ?>&page=updateGV&MaGiaoVien=<?php echo $item['MaGiaoVien']; ?>" class="btn btn-sm btn-warning">Update</a>
                        </td>
                    </tr>
                </form>

            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        var tf = new TableFilter(document.querySelector('.tfilter'), {
            base_path: 'js/tablefilter/',

            highlight_keywords: true,

            paging: {
                results_per_page: ['Records: ', [10, 25, 50, 100]]
            },
            // aligns filter at cell bottom when Bootstrap is enabled
            // filters_cell_tag: 'th',
            btn_reset: {
                text: 'Clear'
            },

            // allows Bootstrap table styling
            themes: [{
                name: 'transparent'
            }],
            extensions: [{
                name: 'sort'
            }],
            col_0: 'none'
        });
        tf.init();
    </script>
</div>