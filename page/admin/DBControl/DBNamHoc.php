<?php
if ($_GET["TenChucVu"] === 'admin') {



    if (isset($_POST["submitXoaNamhoc"])) {
        $maNamHoc = $_POST["maNamHoc"];

        $lopHocPhan->xoaNamHoc($maNamHoc);
    }


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
    <table class="tfilter table table-hover">
        <thead>
            <tr>
                <th style="width: 20%; text-align: center;">STT</th>
                <th style="width: 50%; text-align: center;">Năm học</th>
                <th colspan="2"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($namHoc as $item) : ?>
                <form action="" method="post">
                    <tr>
                        <td style="text-align: center;">
                            <?php
                            echo $stt;
                            $stt++;
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <?php
                            echo $item['ThoiGian'] . "-" . intval($item['ThoiGian']) + 1;
                            ?>
                        </td>
                        <td>
                            <input value="<?php echo $item['MaNamHoc']; ?>" type="hidden" name="maNamHoc">
                            <input type="submit" class="btn btn-sm btn-danger" value="Xóa" name="submitXoaNamhoc">
                            <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=updateNamHoc&MaNamHoc=<?php echo $item['MaNamHoc']; ?>" class="btn btn-sm btn-warning">Update</a>
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
            col_2: 'none'
        });
        tf.init();
    </script>
</div>