<h2>Xem thông tin thống kê</h2>
<!-- <form action="" method="POST">
    <div class="d-flex align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" name="submit" class="btn btn-sm btn-outline-secondary">Import</button>

                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>
</form> -->

<?php
$khoa = $infoSmallTable->getThongTinBang('Khoa');
?>

<!-- <form action="" method="POST">
    <div class="d-flex align-items-center pt-3 pb-2 mb-3">

        <label>Khoa: </label>
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
</form> -->

<?php
// get thông tin lớp học phần có phiếu đánh giá
$thongTinLop = $lopHocPhan->getLopHocPhan();
?>
<div class="container">
    <div class="top">
        <h4>Danh sách phiếu theo lớp</h4>
    </div>
    <table class="content-table">
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
                        $tenHocPhan = $infoSmallTable->getThongTinHocPhan($item['MaHocPhan']);
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
                </tr>
            <?php
            endforeach;
            ?>
            <!-- <tr>
                <td>1</td>
                <td>john</td>
                <td>CNTT</td>
                <td>Lorem, ipsum.</td>
                <td>Lorem, ipsum.</td>
                <td>Lorem, ipsum.</td>
                <td>Lorem, ipsum.</td>
                <td>Lorem, ipsum.</td>
                <td>Lorem, ipsum.</td>
            </tr> -->
        </tbody>
    </table>
</div>