<?php
if ($_GET["TenChucVu"] === 'admin') {


    if (isset($_POST["submitXoaNhanVien"])) {
        $maNhanVien = $_POST["maNhanVienHidden"];
        $lopHocPhan->xoaNhanVien($maNhanVien);
    }

    $nhanvien = $infoSmallTable->getThongTinBang("nhanvien");
    $stt = 1;
}
?>

<div>
    <div class="pb-5 d-flex justify-content-around">
        <div>
            <h4>Danh sách giáo viên</h4>
        </div>
        <div><a href="login.php?TenChucVu=<?php echo $tenChucVu; ?>&page=themNhanVien" class="btn btn-primary">thêm nhân viên</a></div>
    </div>
    <table class="tfilter table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã nhân viên</th>
                <th>Tên nhân viên</th>
                <th>Chức vụ</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nhanvien as $item) : ?>
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
                        <td>
                            <input value="<?php echo $item['MaNhanVien']; ?>" type="hidden" name="maNhanVienHidden">

                            <input class="btn btn-sm btn-danger" type="submit" name="submitXoaNhanVien" value="Xóa">

                            <a href="login.php?TenChucVu=<?php echo $tenChucVu; ?>&page=updateNhanVien&MaNhanVien=<?php echo $item['MaNhanVien']; ?>" class="btn btn-sm btn-warning">Update</a>
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
            col_0: 'none',
            col_4: 'none'
        });
        tf.init();
    </script>
</div>