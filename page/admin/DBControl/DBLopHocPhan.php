<?php
if ($_GET["TenChucVu"] === 'admin') {
    $stt = 1;

    $DSLopHocPhan = $lopHocPhan->getLopHocPhan();


    if (isset($_POST["submitXoa"])) {
        $maLopHocPhan = $_POST["maLopHocPhan"];
        $lopHocPhan->xoaLopHocPhan($maLopHocPhan);
        $DSLopHocPhan = $lopHocPhan->getLopHocPhan(); // làm mới lại danh sách sau khi xóa
    }
}
?>

<style>
    td,
    th {
        white-space: nowrap;
        overflow: hidden;
    }
</style>

<div>
    <div class="pb-5 d-flex justify-content-center">
        <h4>Danh sách các lớp học</h4>
    </div>


    <table class="tfilter table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã GV</th>
                <th>Tên GV</th>
                <th>Mã môn học</th>
                <th>Môn học</th>
                <th>Nhóm</th>
                <th>Năm học</th>
                <th>Học kỳ</th>
                <th>Bộ môn</th>
                <th>Khoa</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($DSLopHocPhan as $item) : ?>
                <form action="" method="POST">
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
                            $tenGiaoVien = $infoSmallTable->getThongTinGiaoVien($item['MaGiaoVien'], 'TenGiaoVien');
                            echo $tenGiaoVien;
                            ?>
                        </td>
                        <td>
                            <?php
                            $maDuLieuHocPhan = $infoSmallTable->getThongTinHocPhan($item['MaHocPhan'], 'MaDuLieuHocPhan');
                            echo $maDuLieuHocPhan;

                            ?>
                        </td>
                        <td>
                            <?php
                            $tenMonHoc = $infoSmallTable->getThongTinHocPhan($item['MaHocPhan'], 'TenHocPhan');
                            echo $tenMonHoc;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $item['MaNhomHocPhan'];
                            ?>
                        </td>
                        <td>
                            <?php
                            $namHoc = $infoSmallTable->getThongTinNam($item['MaNamHoc']);
                            echo $namHoc;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $item['MaHocKy'];
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
                        <td>
                            <input type="hidden" name="maLopHocPhan" value="<?php echo $item['MaLopHocPhan']; ?>">
                            <input type="submit" name="submitXoa" class="btn btn-sm btn-danger" value="Xóa">
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
                name: 'colsVisibility',
                // at_start: [10],
                text: 'Columns: ',
                enable_tick_all: true
            }, {
                name: 'sort'
            }],
            col_0: 'none',
            col_10: 'none'
        });
        tf.init();
    </script>
</div>