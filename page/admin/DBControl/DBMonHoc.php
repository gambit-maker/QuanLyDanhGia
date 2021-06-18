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
    <table class="tfilter table table-hover">
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