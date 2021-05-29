<h2>Xem thông tin thống kê</h2>


<?php
$khoa = $infoSmallTable->getThongTinBang('Khoa');
?>


<form action="" method="POST">
    <!-- <div class="d-flex justify-content-around align-items-center pt-3 pb-2 mb-3">
        <div>
            <label class="text-align: center;">Khoa: </label>
            <select class="btn btn-sm" name="hang" required>
                <option value="" disabled selected>Chọn khoa</option>
                <?php
                foreach ($khoa as $item) :
                ?>
                    <option value="<?php echo $item['MaKhoa']; ?>"><?php echo $item['TenKhoa']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <div>
            <label>Bộ môn: </label>
            <select class="btn btn-sm" name="hang" required>
                <option value="" disabled selected>Chọn bộ môn</option>
                <?php
                foreach ($khoa as $item) :
                ?>
                    <option value="<?php echo $item['MaKhoa']; ?>"><?php echo $item['TenKhoa']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <div>
            <label>Môn học: </label>
            <select class="btn btn-sm" name="hang" required>
                <option value="" disabled selected>Chọn môn học</option>
                <?php
                foreach ($khoa as $item) :
                ?>
                    <option value="<?php echo $item['MaKhoa']; ?>"><?php echo $item['TenKhoa']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-around align-items-center pt-3 pb-2 mb-3">
        <div>
            <label>Kỳ: </label>
            <select class="btn btn-sm" name="hang" required>
                <option value="" disabled selected>Chọn kỳ</option>
                <?php
                foreach ($khoa as $item) :
                ?>
                    <option value="<?php echo $item['MaKhoa']; ?>"><?php echo $item['TenKhoa']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <div>
            <label>Bộ môn: </label>
            <select class="btn btn-sm" name="hang" required>
                <option value="" disabled selected>Chọn bộ môn</option>
                <?php
                foreach ($khoa as $item) :
                ?>
                    <option value="<?php echo $item['MaKhoa']; ?>"><?php echo $item['TenKhoa']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <div>
            <label>Năm học: </label>
            <select class="btn btn-sm" name="hang" required>
                <option value="" disabled selected>Chọn năm</option>
                <?php
                foreach ($khoa as $item) :
                ?>
                    <option value="<?php echo $item['MaKhoa']; ?>"><?php echo $item['TenKhoa']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
    </div> -->


    <!-- <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Quick filter</span>
        </div>
        <input class="form-control" oninput="w3.filterHTML('#watch-table', '.item', this.value)" placeholder="quick sreach...">
    </div> -->

</form>
<style>
    td,
    th {
        white-space: nowrap;
        overflow: hidden;
    }
</style>

<?php
// get thông tin lớp học phần có phiếu đánh giá


if (isset($_GET["TenChucVu"])) {
    $tenChucVu = $_GET["TenChucVu"];
    if ($tenChucVu === 'admin') {
        $thongTinLop = $lopHocPhan->getLopHocPhan(); // get all lớp học phần nếu là admin
    } elseif ($tenChucVu === 'giaovien') {
        $thongTinLop = $lopHocPhan->getLopHocPhanGiaoVien($_SESSION['MaDangNhap']);
    } elseif ($tenChucVu === 'truongbomon') {
        $maBoMon = $infoSmallTable->getThongTinGiaoVien($_SESSION['MaDangNhap'], 'MaBoMon');
        $thongTinLop = $lopHocPhan->getLopHocTrongBoMon($maBoMon);
    } elseif ($tenChucVu === 'truongkhoa') {
        $maKhoaGiaoVien = $infoSmallTable->getMaKhoaGiaoVien($_SESSION['MaDangNhap']);
        $thongTinLop = $infoSmallTable->getMonHocTrongKhoa($maKhoaGiaoVien);
    }
}
?>
<div class="">
    <div class="top">
        <h4>Danh sách phiếu theo lớp</h4>
    </div>
    <table class="tfilter table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Giáo viên</th>
                <th>Khoa</th>
                <th>Bộ môn</th>
                <th>Tên học phần</th>
                <th>Nhóm</th>
                <th>Năm học</th>
                <th>Học kỳ</th>
                <th>Hoạt động khảo sát</th>
                <th colspan="2">Dữ liệu kết quả</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            foreach ($thongTinLop as $item) :
            ?>
                <tr>
                    <td>
                        <?php
                        // STT
                        echo $count;
                        $count++;
                        ?>
                    </td>
                    <td>
                        <?php
                        //tên giáo viên
                        $tenGiaoVien = $infoSmallTable->getThongTinGiaoVien($item['MaGiaoVien'], 'TenGiaoVien');
                        echo $tenGiaoVien;
                        ?>
                    </td>
                    <td>
                        <?php
                        //Tên khoa
                        $maBoMon = $infoSmallTable->getThongTinGiaoVien($item['MaGiaoVien'], 'MaBoMon');
                        $maKhoa = $infoSmallTable->getThongTinBoMon($maBoMon, 'MaKhoa');
                        $tenKhoa = $infoSmallTable->getTenKhoa($maKhoa);
                        echo $tenKhoa;
                        ?>
                    </td>
                    <td>
                        <?php
                        //Tên bộ môn
                        $maBoMon = $infoSmallTable->getThongTinGiaoVien($item['MaGiaoVien'], 'MaBoMon');
                        $tenBoMon = $infoSmallTable->getThongTinBoMon($maBoMon, 'TenBoMon');
                        echo $tenBoMon;


                        ?>
                    </td>
                    <td>
                        <?php
                        // tên học phần
                        $tenHocPhan = $infoSmallTable->getThongTinHocPhan($item['MaHocPhan'], $noidung = 'TenHocPhan');
                        echo $tenHocPhan;
                        ?>
                    </td>
                    <td>
                        <?php
                        // tên học nhóm
                        $tenNhom = $infoSmallTable->getThongTinNhom($item['MaNhomHocPhan']);
                        echo $tenNhom;
                        ?>
                    </td>
                    <td>
                        <?php
                        // tên học năm học
                        $tenNamHoc = $infoSmallTable->getThongTinNam($item['MaNamHoc']);
                        echo $tenNamHoc;
                        ?>
                    </td>
                    <td>
                        <?php
                        // tên học học kỳ
                        $tenHocKy = $infoSmallTable->getThongTinHocKy($item['MaHocKy']);
                        echo $tenHocKy;
                        ?>
                    </td>
                    <td>
                        <?php
                        // tên học hoạt động khảo sát
                        $tenHoatDongKhaoSat = $infoSmallTable->getThongTinHoatDongKhaoSat($item['MaHoatDongKhaoSat']);
                        echo $tenHoatDongKhaoSat;
                        ?>
                    </td>
                    <td>
                        <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=htPhieu&MaLopHocPhan=<?php echo $item['MaLopHocPhan']; ?>" class="btn btn-sm btn-outline-secondary">Phiếu</a>
                        <a href="" class="btn btn-sm btn-outline-secondary">Góp ý</a>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
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
            col_9: 'none'
        });
        tf.init();
    </script>
</div>