<style>
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
    }

    .autocomplete-items {
        position: absolute;

        /*position the autocomplete items to be the same width as the container:*/
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
        background-color: DodgerBlue !important;
        color: #ffffff;
    }

    /* make table not overflow */
    td,
    th {
        white-space: nowrap;
        overflow: hidden;
    }


    /* hide arrow input type number */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>


<?php
$khoa = $infoSmallTable->getThongTinBang('Khoa');
$arrKhoa = array();

$boMon = $infoSmallTable->getThongTinBang('BoMon');
$arrBoMon = array();

$monHoc = $infoSmallTable->getThongTinBang('HocPhan');
$arrMonHoc = array();

$giaoVien = $infoSmallTable->getThongTinBang('GiaoVien');
$arrGiaoVien = array();

$namHoc = $infoSmallTable->getThongTinBangNamHocASC();
$arrNamHoc = array();

$hocKy = $infoSmallTable->getThongTinBang('HocKy');
$arrHocKy = array();

?>



<?php
$inputKhoa = null;
$inputBoMon = null;
$inputMonHoc = null;
$inputGiaoVien = null;
$inputMaGiaoVien = null;
$inputTenGiaoVien = null;
$inputNamHoc = null;
$inputDenNamHoc = null;
$inputHocKy = null;



// thông báo khi nhập sai dữ liệu
$thongTinLop  = array();
$khongCoKhoaMessage = FALSE;
$khongBoMonMessage = FALSE;
$KhoaKhongCoBoMonMessage = FALSE;
$khongMonHocMessage = FALSE;
$khongCoMonHocTrongBoMonMessage = FALSE;
$khongCoGiaoVienMessage = FALSE;
$khongTimThayNamHocMessage = FALSE;
$khongTimThayDenNamHocMessage = FALSE;
$denNamHocLonHonNamHocMessage = FALSE;


// thông báo khi nhập chưa đủ dữ liệu
$hayXacDinhKhoaMessage = FALSE;
$hayXacDinhBoMon = FALSE;



if (isset($_POST["submit"])) {
    if (isset($_POST["inputKhoa"]) && !empty($_POST["inputKhoa"])) {
        $inputKhoa = $_POST["inputKhoa"];
        // echo $inputKhoa . "<br>";
    }
    if (isset($_POST["inputBoMon"]) && !empty($_POST["inputBoMon"])) {
        $inputBoMon = $_POST["inputBoMon"];
        // echo $inputBoMon . "<br>";
    }
    if (isset($_POST["inputMonHoc"]) && !empty($_POST["inputMonHoc"])) {
        $inputMonHoc = $_POST["inputMonHoc"];
        // echo $inputMonHoc . "<br>";
    }
    if (isset($_POST["inputGiaoVien"]) && !empty($_POST["inputGiaoVien"])) {
        $inputGiaoVien = $_POST["inputGiaoVien"];
        // input giáo viên có dạng MaxGV-TeneGV VD '2002123-Nguyễn văn A'
        $arrInputGiaoVien = explode('-', $inputGiaoVien); // cắt input thành 1 mảng gồm 2 giá trị
        if (count($arrInputGiaoVien) !== 1) { // nếu đúng với dạng chỉ định ở trên
            $inputMaGiaoVien = $arrInputGiaoVien[0]; // phân mã giáo viên
            $inputTenGiaoVien = $arrInputGiaoVien[1]; // phân tên giáo viên
        } else { //không đúng dạng chỉ định
            $inputMaGiaoVien = ''; // '' cho giá trị mặt định luôn sai trong mọi trường hợp vì DB ko giá trị rỗng
            $inputTenGiaoVien = ''; //tương tự với tên
        }
    }
    if (isset($_POST["inputNamHoc"]) && !empty($_POST["inputNamHoc"])) {
        $inputNamHoc = $_POST["inputNamHoc"];
        // echo $inputNamHoc . "<br>";
    }
    if (isset($_POST["inputDenNamHoc"]) && !empty($_POST["inputDenNamHoc"])) {
        $inputDenNamHoc = $_POST["inputDenNamHoc"];
        // echo $inputDenNamHoc . "<br>";
    }
    if (isset($_POST["inputHocKy"]) && !empty($_POST["inputHocKy"])) {
        $inputHocKy = $_POST["inputHocKy"];
        // echo $inputHocKy . "<br>";
    }



    //check lỗi khi input thiếu điều kiện
    if (
        empty($inputKhoa)
        && $inputBoMon !== null // input Bộ môn ko rõ khoa nào
        // && empty($inputMonHoc)
        // && empty($inputMaGiaoVien)
        // && empty($inputTenGiaoVien)
        // && empty($inputNamHoc)
        // && empty($inputDenNamHoc)
        // && empty($inputHocKy)
    ) {
        $hayXacDinhKhoaMessage = TRUE;
    }

    if (
        // empty($inputKhoa)
        empty($inputBoMon)
        && $inputMonHoc !== null // input môn học không rõ bộ môn nòa
        // && empty($inputMaGiaoVien)
        // && empty($inputTenGiaoVien)
        // && empty($inputNamHoc)
        // && empty($inputDenNamHoc)
        // && empty($inputHocKy)
    ) {
        $hayXacDinhBoMon = TRUE;
    }



    // thống kê theo khoa
    if (
        $inputKhoa !== null
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && empty($inputNamHoc)
        && empty($inputDenNamHoc)
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->getThongKeKhoa($inputKhoa);

        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
    }


    // thống kê khoa theo bộ môn
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && empty($inputNamHoc)
        && empty($inputDenNamHoc)
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->getThongKeBoMon($inputKhoa, $inputBoMon);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        } else {
            if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
                $khongBoMonMessage = TRUE;
            } elseif (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
                $KhoaKhongCoBoMonMessage = TRUE;
            }
        }
    }


    // thống kê theo môn học
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && $inputMonHoc !== null
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && empty($inputNamHoc)
        && empty($inputDenNamHoc)
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->getThongKeMonHoc($inputKhoa, $inputBoMon, $inputMonHoc);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            // kiểm tra có khoa này trong DB không
            $khongCoKhoaMessage = TRUE;
        } else {
            if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
                $khongBoMonMessage = TRUE;
            } elseif (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
                // kiểm tra trong khoa có bộ môn này không
                $KhoaKhongCoBoMonMessage = TRUE;
            } else {
                if (!$lopHocPhan->getCountDuLieu('hocphan', 'TenHocPhan', $inputMonHoc)) {
                    $khongMonHocMessage = TRUE;
                } elseif (!$lopHocPhan->kiemTraMonHocCoTrongBoMon($inputMonHoc, $inputBoMon)) {
                    $khongCoMonHocTrongBoMonMessage = TRUE;
                }
            }
        }
    }

    //thống kê khoa theo năm học
    if (
        $inputKhoa !== null
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && empty($inputDenNamHoc)
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->getThongKeKhoaTheoNam($inputKhoa, $inputNamHoc);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            $khongTimThayNamHocMessage = TRUE;
        }
    }

    //thống kê khoa theo năm học học kỳ
    if (
        $inputKhoa !== null
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && empty($inputDenNamHoc)
        && $inputHocKy !== null
    ) {
        $thongTinLop = $lopHocPhan->getThongKeKhoaHocKy($inputKhoa, $inputNamHoc, $inputHocKy);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            $khongTimThayNamHocMessage = TRUE;
        }
    }


    //thống kê khoa theo khoảng năm học
    if (
        $inputKhoa !== null
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && $inputDenNamHoc !== null
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->getThongKeKhoaTheoKhoanNamHoc($inputKhoa, $inputNamHoc, $inputDenNamHoc);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            $khongTimThayNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputDenNamHoc)) {
            $khongTimThayDenNamHocMessage = TRUE;
        }
        if ($inputDenNamHoc <= $inputNamHoc) {
            $denNamHocLonHonNamHocMessage = TRUE;
        }
    }

    //thống kê khoa theo khoảng năm học hoc kỳ
    if (
        $inputKhoa !== null
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && $inputDenNamHoc !== null
        && $inputHocKy !== null
    ) {
        $thongTinLop = $lopHocPhan->getThongKeKhoaTheoKhoanNamHocVaHocKy($inputKhoa, $inputNamHoc, $inputDenNamHoc, $inputHocKy);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            $khongTimThayNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputDenNamHoc)) {
            $khongTimThayDenNamHocMessage = TRUE;
        }
        if ($inputDenNamHoc <= $inputNamHoc) {
            $denNamHocLonHonNamHocMessage = TRUE;
        }
    }

    //thống kê bộ môn theo năm học
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && empty($inputDenNamHoc)
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->thongKeBoMonTheoNam($inputKhoa, $inputBoMon, $inputNamHoc);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            $khongTimThayNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
            $KhoaKhongCoBoMonMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
            $khongBoMonMessage = TRUE;
        }
    }

    //thống kê bộ môn theo năm học, học kỳ
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && empty($inputDenNamHoc)
        && $inputHocKy !== null
    ) {
        $thongTinLop = $lopHocPhan->thongKeBoMonTheoNamVaHocKy($inputKhoa, $inputBoMon, $inputNamHoc, $inputHocKy);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            $khongTimThayNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
            $KhoaKhongCoBoMonMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
            $khongBoMonMessage = TRUE;
        }
    }

    //thống kê bộ môn theo khoảng năm học
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && $inputDenNamHoc !== null
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->thongKeBoMonTheoKhoanNam($inputKhoa, $inputBoMon, $inputNamHoc, $inputDenNamHoc);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            $khongTimThayNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
            $khongBoMonMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputDenNamHoc)) {
            $khongTimThayDenNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
            $KhoaKhongCoBoMonMessage = TRUE;
        }
        if ($inputDenNamHoc <= $inputNamHoc) {
            $denNamHocLonHonNamHocMessage = TRUE;
        }
    }

    //thống kê bộ môn theo khoảng năm học hoc kỳ
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && $inputDenNamHoc !== null
        && $inputHocKy !== null
    ) {
        $thongTinLop = $lopHocPhan->thongKeBoMonTheoKhoanNamCuaHocKy($inputKhoa, $inputBoMon, $inputNamHoc, $inputDenNamHoc, $inputHocKy);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            $khongTimThayNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
            $khongBoMonMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputDenNamHoc)) {
            $khongTimThayDenNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
            $KhoaKhongCoBoMonMessage = TRUE;
        }
        if ($inputDenNamHoc <= $inputNamHoc) {
            $denNamHocLonHonNamHocMessage = TRUE;
        }
    }


    //thống kê học phần theo năm học
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && $inputMonHoc !== null
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && empty($inputDenNamHoc)
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->thongKeHocPhanTheoNam($inputKhoa, $inputBoMon, $inputMonHoc, $inputNamHoc);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            $khongTimThayNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
            $KhoaKhongCoBoMonMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
            $khongBoMonMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('hocphan', 'TenHocPhan', $inputMonHoc)) {
            $khongMonHocMessage = TRUE;
        }
        if (!$lopHocPhan->kiemTraMonHocCoTrongBoMon($inputMonHoc, $inputBoMon)) {
            $khongCoMonHocTrongBoMonMessage = TRUE;
        }
    }

    //thống kê học phần theo năm học học kỳ
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && $inputMonHoc !== null
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && empty($inputDenNamHoc)
        && $inputHocKy !== null
    ) {
        $thongTinLop = $lopHocPhan->thongKeHocPhanTheoNamVaHocKy($inputKhoa, $inputBoMon, $inputMonHoc, $inputNamHoc, $inputHocKy);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            $khongTimThayNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
            $KhoaKhongCoBoMonMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
            $khongBoMonMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('hocphan', 'TenHocPhan', $inputMonHoc)) {
            $khongMonHocMessage = TRUE;
        }
        if (!$lopHocPhan->kiemTraMonHocCoTrongBoMon($inputMonHoc, $inputBoMon)) {
            $khongCoMonHocTrongBoMonMessage = TRUE;
        }
    }
    //thống kê học phần theo khoảng năm học
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && $inputMonHoc !== null
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && $inputDenNamHoc !== null
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->thongKeHocPhanTheoKhoanNam($inputKhoa, $inputBoMon, $inputMonHoc, $inputNamHoc, $inputDenNamHoc);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
            $khongBoMonMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('hocphan', 'TenHocPhan', $inputMonHoc)) {
            $khongMonHocMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            $khongTimThayNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputDenNamHoc)) {
            $khongTimThayDenNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
            $KhoaKhongCoBoMonMessage = TRUE;
        }
        if (!$lopHocPhan->kiemTraMonHocCoTrongBoMon($inputMonHoc, $inputBoMon)) {
            $khongCoMonHocTrongBoMonMessage = TRUE;
        }
        if ($inputDenNamHoc <= $inputNamHoc) {
            $denNamHocLonHonNamHocMessage = TRUE;
        }
    }
    //thống kê học phần theo khoảng năm học hoc kỳ
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && $inputMonHoc !== null
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && $inputDenNamHoc !== null
        && $inputHocKy !== null
    ) {
        $thongTinLop = $lopHocPhan->thongKeHocPhanTheoKhoanNamVaHocKy($inputKhoa, $inputBoMon, $inputMonHoc, $inputNamHoc, $inputDenNamHoc, $inputHocKy);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            $khongCoKhoaMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
            $khongBoMonMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('hocphan', 'TenHocPhan', $inputMonHoc)) {
            $khongMonHocMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            $khongTimThayNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputDenNamHoc)) {
            $khongTimThayDenNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
            $KhoaKhongCoBoMonMessage = TRUE;
        }
        if (!$lopHocPhan->kiemTraMonHocCoTrongBoMon($inputMonHoc, $inputBoMon)) {
            $khongCoMonHocTrongBoMonMessage = TRUE;
        }
        if ($inputDenNamHoc <= $inputNamHoc) {
            $denNamHocLonHonNamHocMessage = TRUE;
        }
    }




    // thống kê theo giáo viên
    if (
        empty($inputKhoa)
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && $inputMaGiaoVien !== null
        && $inputTenGiaoVien !== null
        && empty($inputNamHoc)
        && empty($inputDenNamHoc)
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->getThongKeGiaoVien($inputMaGiaoVien, $inputTenGiaoVien);
        if (
            !$lopHocPhan->getCountDuLieu('giaovien', 'MaGiaoVien', $inputMaGiaoVien)
            || !$lopHocPhan->getCountDuLieu('giaovien', 'TenGiaoVien', $inputTenGiaoVien)
        ) {
            $khongCoGiaoVienMessage = TRUE;
        }
    }

    // thống kê theo năm học của giáo viên
    if (
        empty($inputKhoa)
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && $inputMaGiaoVien !== null
        && $inputTenGiaoVien !== null
        && $inputNamHoc !== null
        && empty($inputDenNamHoc)
        && empty($inputHocKy)
    ) {
        if (
            !$lopHocPhan->getCountDuLieu('giaovien', 'MaGiaoVien', $inputMaGiaoVien)
            || !$lopHocPhan->getCountDuLieu('giaovien', 'TenGiaoVien', $inputTenGiaoVien)
        ) {
            $khongCoGiaoVienMessage = TRUE;
        } else {
            $thongTinLop = $lopHocPhan->getThongKeGiaoVienTheoNam(
                $inputMaGiaoVien,
                $inputTenGiaoVien,
                $inputNamHoc
            );
            if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
                $khongTimThayNamHocMessage = TRUE;
            }
        }
    }

    // thống kê theo khoảng thời gian năm học của giáo viên
    if (
        empty($inputKhoa)
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && $inputMaGiaoVien !== null
        && $inputTenGiaoVien !== null
        && $inputNamHoc !== null
        && $inputDenNamHoc !== null
        && empty($inputHocKy)
    ) {
        if (
            // check giáo viên có trong DB không
            !$lopHocPhan->getCountDuLieu('giaovien', 'MaGiaoVien', $inputMaGiaoVien)
            || !$lopHocPhan->getCountDuLieu('giaovien', 'TenGiaoVien', $inputTenGiaoVien)
        ) {
            $khongCoGiaoVienMessage = TRUE; // thông báo không có
        } else {
            if ($inputDenNamHoc > $inputNamHoc) {
                $thongTinLop = $lopHocPhan->getThongKeGiaoVienTheoKhoangThoiGian(
                    $inputMaGiaoVien,
                    $inputTenGiaoVien,
                    $inputNamHoc,
                    $inputDenNamHoc
                );
                if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
                    $khongTimThayNamHocMessage = TRUE;
                }
                if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputDenNamHoc)) {
                    $khongTimThayDenNamHocMessage = TRUE;
                }
            } else {
                $denNamHocLonHonNamHocMessage = TRUE;
            }
        }
    }



    // thống kê theo khoảng năm học theo hoc kỳ của giáo viên
    if (
        empty($inputKhoa)
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && $inputMaGiaoVien !== null
        && $inputTenGiaoVien !== null
        && $inputNamHoc !== null
        && $inputDenNamHoc !== null
        && $inputHocKy !== null
    ) {
        if (
            // check giáo viên có trong DB không
            !$lopHocPhan->getCountDuLieu('giaovien', 'MaGiaoVien', $inputMaGiaoVien)
            || !$lopHocPhan->getCountDuLieu('giaovien', 'TenGiaoVien', $inputTenGiaoVien)
        ) {
            $khongCoGiaoVienMessage = TRUE; // thông báo không có
        } else {
            if ($inputDenNamHoc > $inputNamHoc) {
                // hoc kỳ
                $thongTinLop = $lopHocPhan->getThongKeGiaoVienTheoKhoangThoiGianHocKy(
                    $inputMaGiaoVien,
                    $inputTenGiaoVien,
                    $inputNamHoc,
                    $inputDenNamHoc,
                    $inputHocKy
                );
                if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
                    $khongTimThayNamHocMessage = TRUE;
                }
                if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputDenNamHoc)) {
                    $khongTimThayDenNamHocMessage = TRUE;
                }
            } else {
                $denNamHocLonHonNamHocMessage = TRUE;
            }
        }
    }

    // thống kê theo năm học và học kỳ của giáo viên
    if (
        empty($inputKhoa)
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && $inputMaGiaoVien !== null
        && $inputTenGiaoVien !== null
        && $inputNamHoc !== null
        && empty($inputDenNamHoc)
        && $inputHocKy !== null
    ) {
        if (
            !$lopHocPhan->getCountDuLieu('giaovien', 'MaGiaoVien', $inputMaGiaoVien)
            || !$lopHocPhan->getCountDuLieu('giaovien', 'TenGiaoVien', $inputTenGiaoVien)
        ) {
            $khongCoGiaoVienMessage = TRUE;
        } else {
            $thongTinLop = $lopHocPhan->getThongKeGiaoVienNamHocKy(
                $inputMaGiaoVien,
                $inputTenGiaoVien,
                $inputNamHoc,
                $inputHocKy
            );
            if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
                $khongTimThayNamHocMessage = TRUE;
            }
        }
    }



    // thống kê toàn trường theo năm học
    if (
        empty($inputKhoa)
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && empty($inputDenNamHoc)
        && empty($inputHocKy)
    ) {
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            //nếu không tìm thấy năm học
            $khongTimThayNamHocMessage = TRUE;
        } else {
            $thongTinLop = $lopHocPhan->getThongKeNam($inputNamHoc);
        }
    }

    // thống kê toàn trường từ năm xxx đến năm xxx
    if (
        empty($inputKhoa)
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && $inputDenNamHoc !== null
        && empty($inputHocKy)
    ) {
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            //nếu không tìm thấy năm học
            $khongTimThayNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputDenNamHoc)) {
            $khongTimThayDenNamHocMessage = TRUE;
        }

        if ($inputDenNamHoc > $inputNamHoc) {
            $thongTinLop = $lopHocPhan->getThongTuNamDenNam($inputNamHoc, $inputDenNamHoc);
        } else {
            $denNamHocLonHonNamHocMessage = TRUE;
        }
    }


    // thống kê toàn trường từ năm xxx đến năm xxx theo học kỳ    
    if (
        empty($inputKhoa)
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && $inputDenNamHoc !== null
        && $inputHocKy !== null
    ) {
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            //nếu không tìm thấy năm học
            $khongTimThayNamHocMessage = TRUE;
        }
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputDenNamHoc)) {
            $khongTimThayDenNamHocMessage = TRUE;
        }

        if ($inputDenNamHoc > $inputNamHoc) {
            $thongTinLop = $lopHocPhan->getThongTuNamDenNamTheoHocKy($inputNamHoc, $inputDenNamHoc, $inputHocKy);
        } else {
            $denNamHocLonHonNamHocMessage = TRUE;
        }
    }


    // thống kê toàn trường theo học kỳ của năm học
    if (
        empty($inputKhoa)
        && empty($inputBoMon)
        && empty($inputMonHoc)
        && empty($inputMaGiaoVien)
        && empty($inputTenGiaoVien)
        && $inputNamHoc !== null
        && empty($inputDenNamHoc)
        && $inputHocKy !== null
    ) {
        if (!$lopHocPhan->getCountDuLieu('namhoc', 'ThoiGian', $inputNamHoc)) {
            //nếu không tìm thấy năm học
            $khongTimThayNamHocMessage = TRUE;
        } else {
            $thongTinLop = $lopHocPhan->getToanTruongTheoHocKy($inputNamHoc, $inputHocKy);
        }
    }

    // thống kê giáo viên theo khoa, bộ môn, học phần
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && $inputMonHoc !== null
        && $inputMaGiaoVien !== null
        && $inputTenGiaoVien !== null
        && empty($inputNamHoc)
        && empty($inputDenNamHoc)
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->getThongKeGiaoVienMonHoc($inputKhoa, $inputBoMon, $inputMonHoc, $inputMaGiaoVien);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            // kiểm tra có khoa này trong DB không
            $khongCoKhoaMessage = TRUE;
        } else {
            if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
                $khongBoMonMessage = TRUE;
            } elseif (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
                // kiểm tra trong khoa có bộ môn này không
                $KhoaKhongCoBoMonMessage = TRUE;
            } else {
                if (!$lopHocPhan->getCountDuLieu('hocphan', 'TenHocPhan', $inputMonHoc)) {
                    $khongMonHocMessage = TRUE;
                } elseif (!$lopHocPhan->kiemTraMonHocCoTrongBoMon($inputMonHoc, $inputBoMon)) {
                    $khongCoMonHocTrongBoMonMessage = TRUE;
                }
            }
        }
    }

    // thống kê giáo viên theo khoa, bộ môn, học phần theo năm học
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && $inputMonHoc !== null
        && $inputMaGiaoVien !== null
        && $inputTenGiaoVien !== null
        && $inputNamHoc !== null
        && empty($inputDenNamHoc)
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->getThongKeGiaoVienMonHocVaNamHoc($inputKhoa, $inputBoMon, $inputMonHoc, $inputMaGiaoVien, $inputNamHoc);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            // kiểm tra có khoa này trong DB không
            $khongCoKhoaMessage = TRUE;
        } else {
            if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
                $khongBoMonMessage = TRUE;
            } elseif (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
                // kiểm tra trong khoa có bộ môn này không
                $KhoaKhongCoBoMonMessage = TRUE;
            } else {
                if (!$lopHocPhan->getCountDuLieu('hocphan', 'TenHocPhan', $inputMonHoc)) {
                    $khongMonHocMessage = TRUE;
                } elseif (!$lopHocPhan->kiemTraMonHocCoTrongBoMon($inputMonHoc, $inputBoMon)) {
                    $khongCoMonHocTrongBoMonMessage = TRUE;
                }
            }
        }
    }

    // thống kê giáo viên theo khoa, bộ môn, học phần theo năm học, và học kỳ
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && $inputMonHoc !== null
        && $inputMaGiaoVien !== null
        && $inputTenGiaoVien !== null
        && $inputNamHoc !== null
        && empty($inputDenNamHoc)
        && $inputHocKy !== null
    ) {
        $thongTinLop = $lopHocPhan->getThongKeGiaoVienMonHocVaNamHocVaHocKy($inputKhoa, $inputBoMon, $inputMonHoc, $inputMaGiaoVien, $inputNamHoc, $inputHocKy);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            // kiểm tra có khoa này trong DB không
            $khongCoKhoaMessage = TRUE;
        } else {
            if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
                $khongBoMonMessage = TRUE;
            } elseif (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
                // kiểm tra trong khoa có bộ môn này không
                $KhoaKhongCoBoMonMessage = TRUE;
            } else {
                if (!$lopHocPhan->getCountDuLieu('hocphan', 'TenHocPhan', $inputMonHoc)) {
                    $khongMonHocMessage = TRUE;
                } elseif (!$lopHocPhan->kiemTraMonHocCoTrongBoMon($inputMonHoc, $inputBoMon)) {
                    $khongCoMonHocTrongBoMonMessage = TRUE;
                }
            }
        }
    }

    // thống kê giáo viên theo khoa, bộ môn, học phần theo năm học, đến năm học
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && $inputMonHoc !== null
        && $inputMaGiaoVien !== null
        && $inputTenGiaoVien !== null
        && $inputNamHoc !== null
        && $inputDenNamHoc !== null
        && empty($inputHocKy)
    ) {
        $thongTinLop = $lopHocPhan->getThongKeGiaoVienMonHocTrongKhoangThoiGian($inputKhoa, $inputBoMon, $inputMonHoc, $inputMaGiaoVien, $inputNamHoc, $inputDenNamHoc);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            // kiểm tra có khoa này trong DB không
            $khongCoKhoaMessage = TRUE;
        } else {
            if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
                $khongBoMonMessage = TRUE;
            } elseif (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
                // kiểm tra trong khoa có bộ môn này không
                $KhoaKhongCoBoMonMessage = TRUE;
            } else {
                if (!$lopHocPhan->getCountDuLieu('hocphan', 'TenHocPhan', $inputMonHoc)) {
                    $khongMonHocMessage = TRUE;
                } elseif (!$lopHocPhan->kiemTraMonHocCoTrongBoMon($inputMonHoc, $inputBoMon)) {
                    $khongCoMonHocTrongBoMonMessage = TRUE;
                }
            }
        }
    }

    // thống kê giáo viên theo khoa, bộ môn, học phần theo năm học, đến năm học, học kỳ
    if (
        $inputKhoa !== null
        && $inputBoMon !== null
        && $inputMonHoc !== null
        && $inputMaGiaoVien !== null
        && $inputTenGiaoVien !== null
        && $inputNamHoc !== null
        && $inputDenNamHoc !== null
        && $inputHocKy !== null
    ) {
        $thongTinLop = $lopHocPhan->getThongKeGiaoVienMonHocTrongKhoangThoiGianVaHocKy($inputKhoa, $inputBoMon, $inputMonHoc, $inputMaGiaoVien, $inputNamHoc, $inputDenNamHoc, $inputHocKy);
        if (!$lopHocPhan->getCountDuLieu('khoa', 'TenKhoa', $inputKhoa)) {
            // kiểm tra có khoa này trong DB không
            $khongCoKhoaMessage = TRUE;
        } else {
            if (!$lopHocPhan->getCountDuLieu('bomon', 'TenBoMon', $inputBoMon)) {
                $khongBoMonMessage = TRUE;
            } elseif (!$lopHocPhan->kiemTraBoMonCoTrongKhoa($inputKhoa, $inputBoMon)) {
                // kiểm tra trong khoa có bộ môn này không
                $KhoaKhongCoBoMonMessage = TRUE;
            } else {
                if (!$lopHocPhan->getCountDuLieu('hocphan', 'TenHocPhan', $inputMonHoc)) {
                    $khongMonHocMessage = TRUE;
                } elseif (!$lopHocPhan->kiemTraMonHocCoTrongBoMon($inputMonHoc, $inputBoMon)) {
                    $khongCoMonHocTrongBoMonMessage = TRUE;
                }
            }
        }
    }

    $arrMaCacLopHocPhan = array(); // arr các lớp học phần
    foreach ($thongTinLop as $item) {
        $arrMaCacLopHocPhan[] = $item['MaLopHocPhan'];
    }

    $_SESSION['arrMaLopHocPhan'] = $arrMaCacLopHocPhan;

    $_SESSION['inputKhoa'] = $inputKhoa;
    $_SESSION['inputBoMon'] = $inputBoMon;
    $_SESSION['inputMonHoc'] = $inputMonHoc;
    $_SESSION['inputNamHoc'] = $inputNamHoc;
    $_SESSION['inputDenNamHoc'] = $inputDenNamHoc;
    $_SESSION['inputHocKy'] = $inputHocKy;
    $_SESSION['inputTenGiaoVien'] = $inputTenGiaoVien;
}

if (isset($_POST["tongHopKetQua"])) {
    $soLopHocPhanDangCo = count($_SESSION['arrMaLopHocPhan']);
    $userRole = $_GET["TenChucVu"];
    if ($soLopHocPhanDangCo > 0) {
        echo ("<script>location.href = 'index.php?TenChucVu=" . $userRole . "&page=tonghopketqua" . "';</script>");
    }
} elseif (isset($_POST["tongHopKetQuaGopY"])) {
    $soLopHocPhanDangCo = count($_SESSION['arrMaLopHocPhan']);
    $userRole = $_GET["TenChucVu"];
    if ($soLopHocPhanDangCo > 0) {
        echo ("<script>location.href = 'index.php?TenChucVu=" . $userRole . "&page=tonghopketquagopy" . "';</script>");
    }
}

?>

<form autocomplete="off" action="" method="POST">
    <table class="m-auto">
        <tr>
            <td style="text-align: right;">Khoa: </td>
            <td>
                <?php
                foreach ($khoa as $item) {
                    $arrKhoa[] = '"' . $item['TenKhoa'] . '"';
                }
                ?>
                <div class="autocomplete input-group-sm">
                    <input id="myInputKhoa" class="form-control" type="text" name="inputKhoa" placeholder="Tìm khoa" value="<?php if (!empty($inputKhoa)) echo $inputKhoa; ?>">
                </div>
            </td>
            <?php if ($khongCoKhoaMessage === TRUE) : ?>
                <td class="text-danger" colspan="2">Khoa không có trong hệ thống dữ liệu</td>
            <?php elseif ($hayXacDinhKhoaMessage === TRUE) : ?>
                <td class="text-danger" colspan="2">Hãy xác định khoa</td>
            <?php endif; ?>
        </tr>
        <tr>
            <td style="text-align: right;">Bộ môn: </td>
            <td>
                <?php
                foreach ($boMon as $item) {
                    $arrBoMon[] = '"' . $item['TenBoMon'] . '"';
                }
                ?>
                <div class="autocomplete input-group-sm">
                    <input id="myInputBoMon" class="form-control" type="text" name="inputBoMon" placeholder="Tìm bộ môn" value="<?php if (!empty($inputBoMon)) echo $inputBoMon; ?>">
                </div>
            </td>
            <?php if ($khongBoMonMessage) : ?>
                <td class="text-danger" colspan="2">Bộ môn không có trong hệ thống dữ liệu</td>
            <?php elseif ($KhoaKhongCoBoMonMessage) : ?>
                <td class="text-danger" colspan="2">Khoa không có bộ môn</td>
            <?php elseif ($hayXacDinhBoMon === TRUE) : ?>
                <td class="text-danger" colspan="2">Hãy Xác định bộ môn</td>
            <?php endif; ?>
        </tr>
        <tr>
            <td style="text-align: right;">Học phần: </td>
            <td>
                <?php
                foreach ($monHoc as $item) {
                    $arrMonHoc[] = '"' . $item['TenHocPhan'] . '"';
                }
                ?>
                <div class="autocomplete input-group-sm">
                    <input id="myInputMonHoc" class="form-control" type="text" name="inputMonHoc" placeholder="Tìm môn học" value="<?php if (!empty($inputMonHoc)) echo $inputMonHoc; ?>">
                </div>
            </td>
            <?php if ($khongMonHocMessage) : ?>
                <td class="text-danger" colspan="2">Môn học không có trong hệ thống dữ liệu</td>
            <?php elseif ($khongCoMonHocTrongBoMonMessage) : ?>
                <td class="text-danger" colspan="2">Môn học không có trong bộ môn này</td>
            <?php endif; ?>
        </tr>
        <tr>
            <td style="text-align: right;">Giáo viên:</td>
            <td>
                <?php
                foreach ($giaoVien as $item) {
                    $arrGiaoVien[] = '"' . $item['MaGiaoVien'] . "-" . $item['TenGiaoVien'] . '"';
                }
                ?>
                <div class="autocomplete input-group-sm">
                    <input id="myInputGiaoVien" class="form-control" type="text" name="inputGiaoVien" placeholder="Tìm giáo viên" value="<?php if (!empty($inputTenGiaoVien)) echo $inputMaGiaoVien . "-" . $inputTenGiaoVien; ?>">
                </div>
            </td>
            <?php if ($khongCoGiaoVienMessage === TRUE) : ?>
                <td class="text-danger" colspan="2">Không tìm thấy giáo viên trong cơ sở dữ liệu</td>
            <?php endif; ?>
        </tr>
        <tr>
            <td style="text-align: right;">Năm học:</td>
            <td>
                <?php
                foreach ($namHoc as $item) {
                    $arrNamHoc[] = '"' . $item['ThoiGian']  . '"';
                }
                ?>
                <div class="autocomplete input-group-sm">
                    <input id="myInputNamHoc" class="form-control" type="number" name="inputNamHoc" placeholder="Năm học" value="<?php if (!empty($inputNamHoc)) echo $inputNamHoc; ?>">
                </div>

            </td>
            <?php if ($khongTimThayNamHocMessage === TRUE) : ?>
                <td class="text-danger">Năm học không tồn tại</td>
            <?php endif; ?>
            <td style="text-align: right;">Đến năm :</td>
            <td>
                <div class="autocomplete input-group-sm">
                    <input style="width: 80%;" id="myInputDenNamHoc" class="form-control" type="number" name="inputDenNamHoc" placeholder="Năm học" value="<?php if (!empty($inputDenNamHoc)) echo $inputDenNamHoc; ?>">
                </div>
            </td>
            <?php if ($denNamHocLonHonNamHocMessage === TRUE) : ?>
                <td class="text-danger">Năm đến phải lớn hơn năm học</td>
            <?php elseif ($khongTimThayDenNamHocMessage === TRUE) : ?>
                <td class="text-danger">Năm học không tồn tại</td>
            <?php endif; ?>
        </tr>

        <tr>
            <td style="text-align: right;">Học kỳ:</td>
            <td>
                <?php
                foreach ($hocKy as $item) {
                    $arrHocKy[] = '"' . $item['TenHocKy']  . '"';
                }
                ?>
                <div class="autocomplete input-group-sm">
                    <input id="myInputHocKy" min="1" max="3" class="form-control" type="number" name="inputHocKy" placeholder="Học kỳ" value="<?php if (!empty($inputHocKy)) echo $inputHocKy; ?>">
                </div>
            </td>
        </tr>
        <tr>
            <th></th>
            <th><input class="btn btn-sm btn-primary" type="submit" name="submit" value="Thống kê"></th>
            <?php if (!empty($thongTinLop)) : ?>
                <th></th>
                <th>
                    <input class="btn btn-sm btn-primary" type="submit" name="tongHopKetQua" value="Tổng kết phiếu">
                    <input class="btn btn-sm btn-primary" type="submit" name="tongHopKetQuaGopY" value="Tổng kết góp ý">
                </th>


            <?php endif; ?>
        </tr>
    </table>
</form>

<div>
    <div class="top">
        <h4>Danh sách phiếu theo lớp</h4>
    </div>
    <form action="" method="POST">
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
                            <a href="index.php?TenChucVu=<?php echo $tenChucVu; ?>&page=htGopY&MaLopHocPhan=<?php echo $item['MaLopHocPhan']; ?>" class="btn btn-sm btn-outline-secondary">Góp ý</a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <?php if (isset($_POST["submit"])) : ?>
            <?php if (count($thongTinLop) === 0) : ?>
                <h6 class="m-auto text-danger">Không tìm thấy kết quả</h6>
            <?php endif; ?>
        <?php endif; ?>
    </form>


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
            col_9: 'none',
            grid: false //hide filter bar


        });
        tf.init();
    </script>
</div>



<script>
    // filter jquery    
    $(function() {
        var arrKhoa = [
            <?php echo implode(",", $arrKhoa) ?>
        ];
        $("#myInputKhoa").autocomplete({
            source: arrKhoa,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });


        var arrBoMon = [
            <?php echo implode(",", $arrBoMon) ?>
        ];
        $("#myInputBoMon").autocomplete({
            source: arrBoMon,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });


        var arrMonHoc = [
            <?php echo implode(",", $arrMonHoc) ?>
        ];
        $("#myInputMonHoc").autocomplete({
            source: arrMonHoc,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });

        var arrGiaoVien = [
            <?php echo implode(",", $arrGiaoVien) ?>
        ];
        $("#myInputGiaoVien").autocomplete({
            source: arrGiaoVien,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });

        var arrNamHoc = [
            <?php echo implode(",", $arrNamHoc) ?>
        ];
        $("#myInputNamHoc").autocomplete({
            source: arrNamHoc,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });

        var arrDenNamHoc = [
            <?php echo implode(",", $arrNamHoc) ?>
        ];
        $("#myInputDenNamHoc").autocomplete({
            source: arrNamHoc,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });

        var arrHocKy = [
            <?php echo implode(",", $arrHocKy) ?>
        ];
        $("#myInputHocKy").autocomplete({
            source: arrHocKy,
            minLength: 0,
            scroll: true
        }).focus(function() {
            $(this).autocomplete("search", "");
        });
    });
</script>