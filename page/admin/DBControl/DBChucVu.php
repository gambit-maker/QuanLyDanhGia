<?php
if ($_GET["TenChucVu"] === 'admin') {
    $chucVu = $infoSmallTable->getThongTinBang("ChucVu");
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
            <h4>Danh sách chức vụ</h4>
        </div>
        <div><a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=themChucVu" class="btn btn-primary">thêm chức vụ</a></div>
    </div>

    <div class="row justify-content-bet">

    </div>
    <table class="tfilter table table-hover">
        <thead>
            <tr>
                <th style="width: 50%; text-align: center;">STT</th>
                <th style="width: 50%; text-align: center;">chức vụ</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($chucVu as $item) : ?>
                <tr>
                    <td style="text-align: center;">
                        <?php
                        echo $stt;
                        $stt++;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($item['TenChucVu'] === 'giaovien') {
                            echo "Giáo viên";
                        } elseif ($item['TenChucVu'] === 'truongbomon') {
                            echo "Trưởng bộ môn";
                        } elseif ($item['TenChucVu'] === 'truongkhoa') {
                            echo "Trưởng khoa";
                        } elseif ($item['TenChucVu'] === 'nhanvien') {
                            echo "Nhân viên";
                        } else {
                            echo $item['TenChucVu'];
                        }
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