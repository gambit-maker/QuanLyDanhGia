<?php
if (isset($_POST["submit"])) {
    $file = $_FILES["fileName"]['name'];

    $target_dir = 'page\admin\insert\dataImport\\'; // full path
    // $target_dir = 'page/admin/insert/dataImport/'; // full path

    $target_file = $target_dir . basename($file);

    move_uploaded_file($_FILES['fileName']['tmp_name'], $target_file);


    // ****************** (LƯU Ý) tất cả dữ liệu cần có thứ tự giống y hệt file mẫu ******************//

    $myFile = fopen($target_file, 'r');
    $f = (file($target_file));

    // Test dữ liệu
    // echo trim($f[9]) . "<br>";
    // echo trim($f[6]) . "<br>";
    // echo trim($f[10]) . "<br><br>";


    // -------------------- thêm lớp học phần -----------------------------//
    $namHoc = trim(substr($f[6], -6)); // trim, delete space in the string value
    $month = (substr($f[6], -9, 2));
    $month = intval($month);

    if ($month === 9 || $month === 10 || $month === 11 || $month === 12 || $month === 1) {
        $hocKy = 1;
    } else if ($month === 2 || $month === 3 || $month === 4 || $month === 5 || $month === 6) {
        $hocKy = 2;
    } else {
        $hocKy = 3;
    }

    // dữ liệu thuộc dạng String dùng 'intval()' để chuyển sang integer
    $maHocPhan = substr($f[9], 36); // 03/02 - Lập trình hướng đối tượng        
    $maLopHocPhan = substr($maHocPhan, 3, 2); // String 03
    $maNhom = substr($maHocPhan, 0, 2);

    $maGiaoVien = substr($f[10], 13, 2);
    $maNamHoc = $lopHocPhan->getMaNamHoc($namHoc);

    // Test dữ liệu
    // echo "Mã học phần(String): " . $maLopHocPhan . " Value(int): " . intval($maLopHocPhan) . "<br>";
    // echo "Mã giáo viên: " . $maGiaoVien . "<br>";
    // echo "Mã nhóm: " . $maNhom .  "<br>";
    // echo "Mã học kỳ: " . $hocKy . '<br>';
    // echo "năm học: " . $namHoc . " Mã năm học: " . $maNamHoc . "<br><br>";



    $trungNhau = $lopHocPhan->checkLopHocPhan(
        intval($maLopHocPhan),
        intval($maNamHoc),
        intval($hocKy),
        intval($maGiaoVien),
        intval($maNhom)
    );

    if ($trungNhau === TRUE) {
        /* ***************** 1. CODE THÊM DỮ LIỆU LỚP HỌC PHẦN  **************** */
        $lopHocPhan->themLopHocPhan(
            intval($maLopHocPhan),
            intval($maNamHoc),
            intval($hocKy),
            intval($maGiaoVien),
            intval($maNhom)
        );
    } else {
        echo "Dữ liệu trùng nhau: bảng lớp học phần <br><br>";
    }




    // -------------------- thêm phiếu khảo sát -----------------------------//
    $maLoaiPhieu = substr($f[5], 17, 2);
    $maHoatDongKhaoSat = substr($f[7], 31, 2);


    // echo "Mã loại phiếu: " . $maLoaiPhieu . "<br>";
    // echo "Mã hoạt động khảo sát: " . $maHoatDongKhaoSat . "<br><br>";


    if ($trungNhau === TRUE) { // không cho phép dữ liệu trùng nhau        
        $maLopHocPhanV2 = $lopHocPhan->getMaLopHocPhan( // mã lớp học phần bên phiếu khảo sát 
            // lấy dữ liệu chính xác với tất cả khóa phụ để có mã lớp chính xác         
            intval($maLopHocPhan),
            intval($maNamHoc),
            intval($hocKy),
            intval($maGiaoVien),
            intval($maNhom)
        );

        // echo "Mã lớp học phần V2: " . $maLopHocPhanV2 . "<br>";

        // check với từng phiếu trong file (row dữ liệu điểm đánh giá)

        //đọc full dữ liệu
        /*
        for ($i = 13; $i < count($f); $i++) {
            // echo $f[$i] . "<br>";

            $arr = explode("	", $f[$i]);
            if (trim($arr[0]) === "END") {
                break;
            } else { // đọc chưa hết thì đọc tiếp `(*>﹏<*)′
                $lopHocPhan->themPhieuKhaoSat($maLoaiPhieu, $maLopHocPhanV2, $maHoatDongKhaoSat);
            }

            // for ($y = 1; $y < count($arr); $y++) { // thêm dữ liệu vào bảng chi tiết ở đây               
            // }
            echo '<br>';
            print_r($arr);
        }
        */


        // đọc 1,2 dòng để test
        for ($i = 13; $i < 15; $i++) {
            $arr = explode("	", $f[$i]);
            echo '<br>';
            print_r($arr);
            echo '<br>';
            // lấy mã phiếu mới nhất trong auto_increase của MYSQL DB
            $maPhieuTesting = $lopHocPhan->getLastestMaPhieuKhaoSat();
            $maPhieuHienTai = intval($maPhieuTesting);
            // echo '<br> Lastest Mã phiếu khảo sát:  ' . $maPhieuHienTai . "<br>";
            $lopHocPhan->themPhieuKhaoSat($maLoaiPhieu, $maLopHocPhanV2, $maHoatDongKhaoSat);

            for ($y = 1; $y < count($arr); $y++) {
                // $lopHocPhan->themChiTietPhieuKhaoSatTheoPhieu($maPhieuHienTai);
            }
        }
    } else {
        echo "insert failed : phiếu khảo sát <br><br>";
    }



    // ------------------------- Khu vực test file -------------------------//
    // while ($line = fgets($myFile)) {
    //     echo $line . "<br>";
    // }
    fclose($myFile);
}
?>

<form action="" enctype="multipart/form-data" method="POST">
    <div class="d-flex align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <input required class="btn btn-sm btn-outline-secondary" type="file" name="fileName" accept=".txt">
                <input type="submit" name="submit" value="Import">
            </div>
        </div>
    </div>
</form>

<!-- <form action="" method="POST">
    <div class="d-flex flex-row-reverse align-items-center pt-3 pb-2 mb-3 border-bottom">
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