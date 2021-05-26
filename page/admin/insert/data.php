<?php

$rootPath = $_SERVER['DOCUMENT_ROOT'] . "\\QuanLyDanhGia";
include_once $rootPath . './vendor/autoload.php';

$options = array(
    'ignore_errors' => true,
    // other options go here
);


// function chỉ áp dụng cho line 12 trong file text input
function createArrayIDCauHoi($lineToReadInfile)
{
    $arr2 = explode("	", $lineToReadInfile);
    $questionIDArray = array();
    for ($i = 1; $i < count($arr2); $i++) {
        $myNum = str_replace(array("[", "]"), "", $arr2[$i]);
        $myNum = intval($myNum);
        $questionIDArray[] = $myNum;
    }
    return $questionIDArray;
}

if (isset($_POST["submit"])) {

    $file = $_FILES["fileName"]['name'];
    // echo $rootPath . basename($file);

    //lưu ở thư mục gốc để đọc sau đó xóa
    move_uploaded_file($_FILES['fileName']['tmp_name'], $rootPath . "/" . basename($file));

    $html = SimpleXLSX::parse(basename($file))->toHTML();
    // echo $html;

    $text = \Soundasleep\Html2Text::convert($html, $options);
    $data = str_replace("&nbsp", "", $text);


    $path_parts = pathinfo(basename($file));
    // echo $path_parts['filename'], "\n";
    $myfile = fopen($path_parts['filename'] . ".txt", "w"); //lấy tên file onlly
    fwrite($myfile, ltrim($data));
    fclose($myfile);

    // ****************** (LƯU Ý) tất cả dữ liệu cần có thứ tự giống y hệt file mẫu ******************//
    $target_file = $path_parts['filename'] . ".txt";
    $myFile = fopen($target_file, 'r');
    $f = file($target_file);

    // -------------------- [SECTION] thêm lớp học phần -----------------------------//
    $viTriNgayLap = strpos($f[4], 'Ngày lập');
    $namHoc = intval(substr($f[4], $viTriNgayLap + 19)); // VD Ngày lập: 01-02-'2021' lấy năm 2021    
    $month = intval(substr($f[4], $viTriNgayLap + 16, 2));

    if ($month === 9 || $month === 10 || $month === 11 || $month === 12 || $month === 1) {
        $hocKy = 1;
    } else if ($month === 2 || $month === 3 || $month === 4 || $month === 5 || $month === 6) {
        $hocKy = 2;
    } else {
        $hocKy = 3;
    }

    $maNhom = substr($f[6], 34, 2);
    $checkMaNhom = $infoSmallTable->getThongTinNhom($maNhom);
    $maLopHocPhan = null;
    $arrDuLieuLopHocPhan = $lopHocPhan->getMaDuLieuHocPhan();
    foreach ($arrDuLieuLopHocPhan as $item) {
        if (str_contains($f[6], $item['MaDuLieuHocPhan'])) {
            $maLopHocPhan = $item['MaHocPhan'];
            break;
        }
    }

    $maNamHoc = $lopHocPhan->getMaNamHoc(intval($namHoc));
    $noiDungHoatDong = substr($f[5], 29, 4);
    $maHoatDongKhaoSat = $lopHocPhan->getThongTinHoatDongKhaoSat($noiDungHoatDong);

    // thông tin mã giáo viên line f[6] "Cán bộ:	2001023 - Phạm Thị Kim Ngoan"
    $viTriCanBo = strpos($f[6], 'Cán'); // tìm vị trí từ Cán bộ
    $thongTinMaGiaoVien = substr($f[6], $viTriCanBo);
    // echo substr($f[6], $viTriCanBo);
    $maGiaoVien = intval(preg_replace('/[^0-9]/', '', $thongTinMaGiaoVien));
    $giaoVienCoTrongDB  = $lopHocPhan->checkGiaoVienCoTrongDB($maGiaoVien);
    // if ($giaoVienCoTrongDB === TRUE) {
    //     // echo "have teacher in DB";
    // } else {
    //     // echo "Dont have teacher in DB";
    // }

    $dataIsCLear = TRUE;
    $trungNhau = FALSE;
    // echo $maLopHocPhan;
    if ($maLopHocPhan === NULL) {
        echo "<br>Mã lớp học phần không có trong DB<br>";
        $dataIsCLear = FALSE;
    }
    if ($checkMaNhom === NULL) {
        echo "Mã nhóm không có trong DB<br>";
        $dataIsCLear = FALSE;
    }
    if ($maNamHoc === NULL) {
        echo "Năm học không có trong DB<br>";
        $dataIsCLear = FALSE;
    }
    if ($giaoVienCoTrongDB === FALSE) {
        echo "Mã giáo viên không có trong DB<br>";
        $dataIsCLear = FALSE;
    }
    if ($maHoatDongKhaoSat === NULL) {
        echo "Hoạt động khảo sát không có trong DB<br>";
        $dataIsCLear = FALSE;
    }



    // echo $maHoatDongKhaoSat . "<br>";
    // echo $noiDungHoatDong . "<br>";
    // echo $maNamHoc . "<br>";
    // echo $maGiaoVien . "<br>";
    // echo $maNhom . "<br>";
    // echo $maLopHocPhan . "<br>";
    // echo $month . "<br>";
    // echo $namHoc . "<br>";    
    // ======================================================================
    if ($dataIsCLear === TRUE) {
        $trungNhau = $lopHocPhan->checkLopHocPhan(
            intval($maLopHocPhan),
            intval($maNamHoc),
            intval($hocKy),
            intval($maGiaoVien),
            intval($maNhom),
            intval($maHoatDongKhaoSat)
        );
        if ($trungNhau === TRUE) {
            /* ***************** 1. CODE THÊM DỮ LIỆU LỚP HỌC PHẦN **************** */
            $lopHocPhan->themLopHocPhan(
                intval($maLopHocPhan),
                intval($maNamHoc),
                intval($hocKy),
                intval($maGiaoVien),
                intval($maNhom),
                intval($maHoatDongKhaoSat)
            );
        } else {
            $trungNhau = FALSE;
            echo "Dữ liệu trùng nhau: bảng lớp học phần<br>";
        }
    } else {
        echo "<br>Hãy kiểm tra lại dữ liệu<br>";
    }






    // -------------------- [SECTION] thêm phiếu khảo sát -----------------------------//
    $arrTenLoaiPhieu = $lopHocPhan->getThongTinLoaiPhieu(); // get tên các loại phiếu đang có
    $maLoaiPhieu = 0;
    $count = 0;
    foreach ($arrTenLoaiPhieu as $item) {
        if (str_contains($f[4], $item['TenLoaiPhieu'])) {
            $maLoaiPhieu = $item['MaLoaiPhieu']; // lưu lại mã loại phiếu
            $count++;
            break;
        }
    }
    if ($count === 0) {
        echo "<br>Không tìm thấy phiếu này trong cơ sở dữ liệu";
    }
    // echo "<br>";
    // print_r($arrTenLoaiPhieu);
    // echo "<br>MaloaiPhieu" . $maLoaiPhieu;



    if ($trungNhau === TRUE && $dataIsCLear === TRUE) { // không cho phép dữ liệu trùng nhau và data hợp lệ
        $maLopHocPhanV2 = $lopHocPhan->getMaLopHocPhan( // mã lớp học phần bên phiếu khảo sát
            // lấy dữ liệu chính xác với tất cả khóa phụ để có mã lớp chính xác
            intval($maLopHocPhan),
            intval($maNamHoc),
            intval($hocKy),
            intval($maGiaoVien),
            intval($maNhom)
        );
        $idCauHoi = createArrayIDCauHoi($f[8]); //đọc line 12 trong file để lấy ra mã câu hỏi (mã tiêu chí)
        // print_r($idCauHoi);

        foreach ($idCauHoi as $item) {
            if ($lopHocPhan->checkCauHoiCuaHoatDong($item, $maHoatDongKhaoSat) === FALSE) {
                $lopHocPhan->themCauHoiCuaHoatDong($item, $maHoatDongKhaoSat);
            } else {
                // echo 'Dữ liệu đã có, nên sẽ không cần insert nữa<br>';
            }
        }

        // //đọc full dữ liệu

        for ($i = 9; $i < count($f); $i++) {
            // echo "<br> dòng f i  " . $f[$i] . "<br>";
            $arr = explode("	", $f[$i]);


            // lấy mã phiếu mới nhất trong auto_increase của MYSQL DB
            $maPhieuTesting = $lopHocPhan->getLastestMaPhieuKhaoSat();
            $maPhieuHienTai = intval($maPhieuTesting);
            echo '<br> Lastest Mã phiếu khảo sát:  ' . $maPhieuHienTai . " <br>";
            if (trim($arr[0]) === "") {
                break;
            } else { // đọc chưa hết thì đọc tiếp `(*>﹏<*)′ 
                $lopHocPhan->themPhieuKhaoSat($maLoaiPhieu, $maLopHocPhanV2, $maHoatDongKhaoSat);
            }



            for ($y = 1; $y < count($arr); $y++) { // thêm dữ liệu vào bảng chi tiết ở đây                 
                //get thông tin cần thiết cho bảng chi tiết kết quả phiếu 
                $maTieuChiDanhGia = $idCauHoi[$y - 1];
                $diemSo = intval($arr[$y]);
                $mahinhThucPhanLoaiTieuChi = $lopHocPhan->getMaHinhThucPhanLoai($maTieuChiDanhGia, $diemSo);

                echo "<br>Mã tiêu chí đánh giá: " . $maTieuChiDanhGia . " Điếm số: " . $diemSo . " Mã hình thúc phân loại: " . $mahinhThucPhanLoaiTieuChi . "<br>";
                // ***************** 1. CODE THÊM DỮ LIỆU CHI TIẾT KẾT QUẢ PHIẾU ****************
                $lopHocPhan->themChiTietPhieuKhaoSatTheoPhieu(
                    $maPhieuHienTai,
                    $maTieuChiDanhGia,
                    $mahinhThucPhanLoaiTieuChi,
                    $diemSo
                );
            }
        }
    } else {
        echo "insert failed : phiếu khảo sát <br>Hãy kiểm tra lại dữ liệu<br>";
    }
    //======================================================================

    // ------------------------- Khu vực test file -------------------------//
    // while ($line = fgets($myFile)) {
    //     echo $line . "<br>";
    // }

    // xóa 2 file sau khi tạo
    unlink(basename($file));
    unlink($path_parts['filename'] . ".txt");
    fclose($myFile);
}


?>

<form action="" enctype="multipart/form-data" method="POST">
    <div class="d-flex align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <input required class="btn btn-sm btn-outline-secondary" type="file" name="fileName">
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