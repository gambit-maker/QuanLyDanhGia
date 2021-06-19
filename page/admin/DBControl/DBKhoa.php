<?php
if ($_GET["TenChucVu"] === 'admin') {


    if (isset($_POST["submitXoa"])) {
        $maKhoa = $_POST["maKhoaHidden"];
        $lopHocPhan->xoaKhoa($maKhoa);
    }

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
    <table class="tfilter table table-hover">
        <thead>
            <tr>
                <th style="width: 20%; text-align: center;">STT</th>
                <th style="width: 50%; text-align: center;">Khoa</th>
                <td colspan="2"></td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($khoa as $item) : ?>
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
                            echo $item['TenKhoa'];
                            ?>
                        </td>
                        <td>
                            <input type="hidden" name="maKhoaHidden" value="<?php echo $item['MaKhoa']; ?>">

                            <input type="submit" value="Xóa" class="btn btn-danger btn-sm" name="submitXoa">
                            <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=updateKhoa&MaKhoa=<?php echo $item['MaKhoa']; ?>" class="btn btn-sm btn-warning">Update</a>

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