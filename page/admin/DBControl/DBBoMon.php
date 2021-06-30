<?php
if ($_GET["TenChucVu"] === 'admin') {


    if (isset($_POST["submitXoaBoMon"])) {
        $maBoMonHidden = $_POST["maBoMonHidden"];
        $lopHocPhan->xoaBoMon($maBoMonHidden);
    }


    $boMon = $infoSmallTable->getThongTinBang("BoMon");
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
        <div><a href="login.php?TenChucVu=<?php echo $tenChucVu; ?>&page=themBoMon" class="btn btn-primary">thêm bộ môn</a></div>
    </div>

    <div class="row justify-content-bet">

    </div>
    <table class="tfilter table table-hover">
        <thead>
            <tr>
                <th style="width: 10%; text-align: center;">STT</th>
                <th style="width: 30%; text-align: center;">Bộ môn</th>
                <th style="width: 30%; text-align: center;">Khoa</th>
                <th colspan="2"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($boMon as $item) : ?>
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
                            echo $item['TenBoMon'];
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <?php
                            $maKhoa = $infoSmallTable->getThongTinBoMon($item['MaBoMon'], 'MaKhoa');
                            $tenKhoa = $infoSmallTable->getTenKhoa($maKhoa);
                            echo strtolower($tenKhoa);
                            ?>
                        </td>
                        <td>
                            <input name="maBoMonHidden" value="<?php echo $item['MaBoMon']; ?>" type="hidden">
                            <input type="submit" value="Xóa" name="submitXoaBoMon" class="btn btn-sm btn-danger">

                            <a href="login.php?TenChucVu=<?php echo $tenChucVu; ?>&page=updateBoMon&MaBoMon=<?php echo $item['MaBoMon']; ?>" class="btn btn-sm btn-warning">Update</a>
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
            col_3: 'none'
        });
        tf.init();
    </script>
</div>