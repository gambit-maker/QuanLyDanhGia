<?php
// ini_set('max_execution_time', '300');
$rootPath = $_SERVER['DOCUMENT_ROOT'] . "\\QuanLyDanhGia";
include_once $rootPath . './vendor/autoload.php';


use DonatelloZa\RakePlus\RakePlus;
use TeamTNT\TNTSearch\Classifier\TNTClassifier;

$filePython = $rootPath . "/vn_words_translate.py ";


$options = array(
    'ignore_errors' => true,
    // other options go here
);

// binary to string chuyển đổi dữ liệu của python
function binaryToString($binary)
{
    $binaries = explode(' ', $binary);

    $string = null;
    foreach ($binaries as $binary) {
        $string .= pack('H*', dechex(bindec($binary)));
    }

    return $string;
}



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

// đọc nhiều file
function reArrayFiles(&$file_post)
{

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

if (isset($_POST["submit"])) {
    // if ($_FILES['filePhieu']['size'][0] === 0) { // check file Empty
    //     echo "File Empty";
    // }    

    // check file Empty
    if ($_FILES['filePhieu']['size'][0] !== 0) {
        $file_ary = reArrayFiles($_FILES['filePhieu']);
        foreach ($file_ary as $file) {
            echo "<br>FILE: " . $file['name'] . "<br>";
            //lưu ở thư mục gốc để đọc sau đó xóa
            move_uploaded_file($file['tmp_name'], $rootPath . "/" . $file['name']);

            $html = SimpleXLSX::parse($file['name'])->toHTML();
            // echo $html;

            $text = \Soundasleep\Html2Text::convert($html, $options);
            $data = str_replace("&nbsp", "", $text);


            $path_parts = pathinfo($file['name']);
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
                $idCauHoi = createArrayIDCauHoi($f[8]); //đọc line 9 trong file để lấy ra mã câu hỏi (mã tiêu chí)
                // print_r($idCauHoi);

                foreach ($idCauHoi as $item) {
                    if ($lopHocPhan->checkCauHoiCuaHoatDong($item, $maHoatDongKhaoSat) === FALSE) {
                        $lopHocPhan->themCauHoiCuaHoatDong($item, $maHoatDongKhaoSat);
                    } else {
                        // echo 'Dữ liệu đã có, nên sẽ không cần insert nữa<br>';
                        // check câu hỏi ứng với hoạt động khảo sát nào(mở rộng cho nhiều hoạt động khảo sát)
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
                        $maTieuChiDanhGia = $idCauHoi[$y - 1]; // arr bắt đầu từ  0 nên -1
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
            unlink($file['name']);
            unlink($path_parts['filename'] . ".txt");
            fclose($myFile);
        }
    } else {
        echo "Không có FILE Phiếu. <br>";
    }

    if ($_FILES['fileGopY']['size'][0] !== 0) {
        echo "Có FILE Góp ý.<br>";
        $file_ary = reArrayFiles($_FILES['fileGopY']);
        foreach ($file_ary as $file) {
            echo "<br>FILE: " . $file['name'] . "<br>";
            //lưu ở thư mục gốc để đọc sau đó xóa
            move_uploaded_file($file['tmp_name'], $rootPath . "/" . $file['name']);

            $html = SimpleXLSX::parse($file['name'])->toHTML();
            $text = \Soundasleep\Html2Text::convert($html, $options);
            $data = str_replace("&nbsp", "", $text);
            $path_parts = pathinfo($file['name']);
            $myfile = fopen($path_parts['filename'] . ".txt", "w"); //lấy tên file onlly
            fwrite($myfile, ltrim($data));
            fclose($myfile);

            // ****************** (LƯU Ý) tất cả dữ liệu cần có thứ tự giống y hệt file mẫu ******************//
            $target_file = $path_parts['filename'] . ".txt";
            $myFile = fopen($target_file, 'r');
            $f = file($target_file); // sau khi lưu dữ liệu vào biến $f thì xóa file
            unlink($file['name']);
            unlink($path_parts['filename'] . ".txt");
            fclose($myFile);

            //get Mã học kỳ
            $hocKy = 0;
            if (str_contains($f[4], "HK1")) {
                $hocKy = 1;
            } elseif (str_contains($f[4], "HK2")) {
                $hocKy = 2;
            } elseif (str_contains($f[4], "HK3")) {
                $hocKy = 3;
            } else {
                echo "Không tìm thấy học kỳ, hãy chắc rằng, học kỳ được viết dưới dạng HK1, HK2, HK3";
                continue;
            }


            //get Mã năm học
            $namHocPos = strpos($f[4], 'Năm học'); // vị trí năm học
            $namHoc = substr($f[4], $namHocPos + 11, 4); // VD data str '2022'
            $maNamHoc = $phieuKhaoSat->getMaNamHoc($namHoc); // mã năm học

            if ($maNamHoc === false) {
                echo "Năm học <b>" . $namHoc . "</b> Không có trong DB";
            }

            $maDuLieuHocPhanKhongCoTrongDB = array(); // dữ liệu học phần không có trong DB để kiểm tra
            for ($i = 9; $i < count($f); $i++) {
                $toArr = explode("	", $f[$i]);
                // dữ liệu mỗi dòng của file được lưu dưới dạng arr để chia từng ô ứng với dữ liệu
                // VD Array ( [0] => 1 [1] => SOT304 - T.Hành Tin học cơ sở [2] => 27 [3] => 2008022 - Đoàn Vũ Thịnh [4] => Những ưu điểm nổi bật của GV trong quá trình giảng dạy học phần: [5] => Nhiệt tình, quan tâm trong việc giảng dạy và truyền đạt kiến thức [6] => thái độ GV [7] => pos )                

                $maDuLieuHocPhan = substr($toArr[1], 0, 6);
                $maHocPhan = $phieuKhaoSat->getMaHocPhan($maDuLieuHocPhan);
                if ($maHocPhan === false) {
                    if (!in_array($maDuLieuHocPhan, $maDuLieuHocPhanKhongCoTrongDB)) {
                        array_push($maDuLieuHocPhanKhongCoTrongDB, $maDuLieuHocPhan);
                    }
                }

                // luôn luôn là 6 chữ đầu tiên cột môn học VD data: SOT304

                $tenMonHoc = substr($toArr[1], 9);
                // bắt đầu tại vị trí số 9 VD data: Tin học cơ sở, Ngôn ngữ lập trình C/C++
                // lưu ý rằng dữ liệu tên môn học cần giống với cơ sở dữ liệu để thuần tiện cho việc tìm kiếm

                $nhomHocPhan = $toArr[2];
                // echo "nhom hoc phan" . $nhomHocPhan;

                $viTriDauGachNgang = strpos($toArr[3], "-");
                $maGiaoVien = substr($toArr[3], 0, $viTriDauGachNgang);
                //Mã giáo viên VD data: 2008022 - Đoàn Vũ Thịnh
                //lấy từ 0 đến vị trị dấu -

                $cauHoi = $toArr[4];
                $noiDungGopY = $toArr[5];

                // xử lý nội dung góp ý                            
                $noiDungGopY = mb_strtolower($noiDungGopY);

                // bỏ ký tự đặc biệt
                $noiDungGopY = preg_replace('~[^\\pL\d]+~u', ' ', strip_tags($noiDungGopY));

                // bỏ số
                $noiDungGopY = preg_replace('/[0-9]+/', '', $noiDungGopY);

                // chuẩn hóa âm tiết VD hayyyy -> hay
                $noiDungGopY = preg_replace('{(.)\1+}', '$1', $noiDungGopY);

                $maLopHocPhan = $phieuKhaoSat->getMaLopHocPhanChoCauHoiMo($maHocPhan, $maNamHoc, $hocKy, $maGiaoVien, $nhomHocPhan);



                $maTieuChiDanhGiaCauHoiMo = $phieuKhaoSat->getMaTieuChiDanhGiaCauHoiMo($cauHoi);

                // echo $cauHoi . "<br>";
                // echo "ma tieu chi danh gia: " . $maTieuChiDanhGiaCauHoiMo . "<br>";

                // echo "hoc phan " . $maHocPhan . " nam hoc " . $maNamHoc . " hoc ky " . $hocKy . "  giao vien " . $maGiaoVien . "nhom hoc phan " . intval($nhomHocPhan) . "<br>";

                // echo "lop hoc phan code :" . $maLopHocPhan . "<br>";


                // áp dụng machine learning ở đây
                // thêm phiếu câu hỏi mở







                if ($maLopHocPhan === false) {
                    // echo "Không tìm thấy Mã học phần " . $maDuLieuHocPhan . "<br>";
                    if ($maTieuChiDanhGiaCauHoiMo === false) {
                        echo "Không tìm thấy Mã tiêu chí ";
                    }
                } else {
                    // áp dụng RAKE để xử lý và tính điểm nội dung                                        
                    $rake = RakePlus::create($noiDungGopY, 'vn_VN');
                    $phrase_scores = $rake->sortByScore('desc')->scores();
                    $getTValue = floor(count($phrase_scores) / 3); // size của số lượng từ lấy ra trong RAKE
                    // print_r($phrase_scores);

                    $cauSauKhiXuLyRake = '';
                    if (count($phrase_scores) === 0) { // không có nội dung vì đã bị stop word lấy mất
                        $cauSauKhiXuLyRake = $noiDungGopY . " ,";
                    } else {
                        if ($getTValue >= 3) {
                            $arr = array_slice($phrase_scores, 0, $getTValue);
                        } else {
                            $arr = array_slice($phrase_scores, 0, count($phrase_scores));
                        }
                        // print_r($arr);                    
                        $arrKey = array_keys($arr);
                        foreach ($arrKey as $item) {
                            $cauSauKhiXuLyRake .= $item . " ,";
                        }
                    }

                    $cauSauKhiXuLyRake = substr($cauSauKhiXuLyRake, 0, -2);
                    echo "sau khi xu ly rake " . $cauSauKhiXuLyRake;
                    echo "<br>";

                    // $phieuKhaoSat->themPhieuCauHoiMo($maLopHocPhan,$maTieuChiDanhGiaCauHoiMo,$noiDungGopY);
                }
            }


            echo "<br><br>Dữ liệu học phần không có trong DB<BR>";
            print_r($maDuLieuHocPhanKhongCoTrongDB);
        }
    } else {
        echo "Không có FILE Góp Ý. <br>";
    }
}


?>

<form action="" enctype="multipart/form-data" method="POST">

    <table class="m-auto">
        <tr>
            <td style="text-align: left;">InputFile Phiếu: </td>
            <td class="px-5">
                <div class="input-group-sm">
                    <input id="myInputKhoa" class="form-control" type="file" name="filePhieu[]" multiple="multiple">
                </div>
            </td>
        </tr>

        <tr>
            <td style="text-align: left;">InputFile Góp ý: </td>
            <td class="px-5">
                <div class="input-group-sm">
                    <input id="myInputKhoa" class="form-control" type="file" name="fileGopY[]" multiple="multiple">
                </div>
            </td>
        </tr>



        <tr>
            <th>
                <input class="btn btn-sm btn-primary" type="submit" name="submit" value="Nhập file">
            </th>
        </tr>
    </table>

    <!-- <div class="d-flex align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <input required class="btn btn-sm btn-outline-secondary" type="file" name="filePhieu[]" multiple="multiple">
                <input type="submit" name="submit" value="Import">
            </div>
        </div>
    </div> -->


    <!-- <div class="d-flex align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <input required class="btn btn-sm btn-outline-secondary" type="file" name="filePhieu[]" multiple="multiple">
                <input type="submit" name="submit" value="Import">
            </div>
        </div>
    </div> -->


</form>