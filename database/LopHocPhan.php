<?php
class LopHocPhan
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) {
            return null;
        }
        $this->db = $db;
    }

    // thêm câu hỏi của hoạt động (mỗi hoạt động sẽ có 1 danh sách các câu hỏi khảo sát)
    public function themCauHoiCuaHoatDong($maCauHoi, $maHoatDong)
    {
        $result = $this->db->con->query("INSERT INTO `cauhoicuahoatdong`(`MaHoatDongKhaoSat`, `MaCauHoi`) VALUES ('{$maHoatDong}','{$maCauHoi}')");
        if ($result === TRUE) {
            // echo '----add new record in CauHoiCuaHoatDong----';
        } else {
            echo '----Not thing add to CauHoiCuaHoatDong----';
        }
    }

    // check hoạt động khảo sát và mã câu hỏi có bị trùng lặp ko
    public function checkCauHoiCuaHoatDong($maCauHoi, $maHoatDong)
    {
        $result = $this->db->con->query("SELECT * FROM `cauhoicuahoatdong` WHERE MaCauHoi = '{$maCauHoi}' AND MaHoatDongKhaoSat = '{$maHoatDong}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        if (count($resultArr) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //thêm lớp học phần
    public function themLopHocPhan($maHocPhan, $maNamHoc, $maHocKy, $maGiaoVien, $maNhomHocPhan, $maHoatDongKhaoSat)
    {
        $result = $this->db->con->query("INSERT INTO LopHocPhan (MaHocPhan,MaNamHoc,MaHocKy,MaGiaoVien,MaNhomHocPhan,MaHoatDongKhaosat) VALUE('{$maHocPhan}','{$maNamHoc}','{$maHocKy}','{$maGiaoVien}','{$maNhomHocPhan}','{$maHoatDongKhaoSat}')");
        if ($result === TRUE) {
            // echo '----add new record in themLopHocPhan ----';
        } else {
            echo "----not thing add to LopHocPhan ----";
        }
    }

    // thêm Phiếu khảo sát
    public function themPhieuKhaoSat($maLoaiPhieu, $maLopHocPhan,  $maHoatDongKhaoSat)
    {
        $result = $this->db->con->query("INSERT INTO PhieuKhaoSat (MaLoaiPhieu,MaLopHocPhan,MaHoatDongKhaoSat) VALUE ('{$maLoaiPhieu}','{$maLopHocPhan}','{$maHoatDongKhaoSat}')");
        if ($result === TRUE) {
            // echo '----add new record in PhieuKhaoSat ----';
        } else {
            echo '----not thing add to PhieuKhaoSat ----';
        }
    }

    // thêm Chi tiết phiếu khảo sát theo phiếu
    public function themChiTietPhieuKhaoSatTheoPhieu($maPhieuKhaoSat, $maTieuChiDanhGia, $maHinhThucPhanLoai, $diemSo)
    {
        $result = $this->db->con->query("INSERT INTO `chitietkhaosatphieu`(`MaPhieuKhaoSat`, `MaTieuChiDanhGia`, `MaHinhThucPhanLoai`, `DiemSo`) VALUES ('{$maPhieuKhaoSat}','{$maTieuChiDanhGia}','{$maHinhThucPhanLoai}','{$diemSo}')");
        if ($result === TRUE) {
            // echo '<br>add new record in ChiTietPhieuKhaoSat<br>';
        } else {
            echo '<br>Not thing add to ChiTietPhieuKhaoSat<br>';
        }
    }



    //kiểm tra trùng lặp trong lớp học phần
    public function checkLopHocPhan($maHocPhan, $maNamHoc, $maHocKy, $maGiaoVien, $maNhomHocPhan, $maHoatDongKhaoSat)
    {
        $result = $this->db->con->query("SELECT * 
        FROM LopHocPhan 
        WHERE MaHocPhan = '{$maHocPhan}' 
        AND MaNamHoc = '{$maNamHoc}' 
        AND MaHocKy = '{$maHocKy}' 
        AND MaGiaoVien = '{$maGiaoVien}'
        AND MaNhomHocPhan = '{$maNhomHocPhan}'
        AND MaHoatDongKhaoSat = '{$maHoatDongKhaoSat}'
        ");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        if (count($resultArr) > 0) {
            return FALSE;
        }
        return TRUE;
    }

    //get Mã hình thức phân loại
    public function getMaHinhThucPhanLoai($maTieuChiDanhGia, $diemSo)
    {
        $result = $this->db->con->query("SELECT MaHinhThucPhanLoai FROM hinhthucphanloai WHERE MaTieuChiDanhGia = '{$maTieuChiDanhGia}' and Diem = '{$diemSo}' ");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['MaHinhThucPhanLoai'];
    }

    // get Mã lớp học phần
    public function getMaLopHocPhan($maHocPhan, $maNamHoc, $maHocKy, $maGiaoVien, $maNhomHocPhan)
    {
        $result = $this->db->con->query("SELECT MaLopHocPhan FROM LopHocPhan WHERE MaHocPhan ='{$maHocPhan}' 
        AND MaNamHoc = '{$maNamHoc}' 
        AND MaHocKy = '{$maHocKy}' 
        AND MaGiaoVien = '{$maGiaoVien}'
        AND MaNhomHocPhan = '{$maNhomHocPhan}'        
        ");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['MaLopHocPhan'];
    }

    // get current mã phiếu khảo sát
    public function getLastestMaPhieuKhaoSat()
    {
        $result = $this->db->con->query("SELECT `AUTO_INCREMENT`
        FROM  INFORMATION_SCHEMA.TABLES
        WHERE TABLE_SCHEMA = 'quanlydanhgia'
        AND   TABLE_NAME   = 'PhieuKhaoSat'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['AUTO_INCREMENT'];
    }

    // get Mã năm học
    public function getMaNamHoc($thoiGian)
    {
        $result = $this->db->con->query("SELECT MaNamHoc FROM NamHoc WHERE ThoiGian = '{$thoiGian}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        if (count($resultArr) > 0) {
            return $resultArr[0]['MaNamHoc'];
        }
        return NULL;
    }

    //get thông tin lớp học phần
    public function getLopHocPhan()
    {
        $result = $this->db->con->query("SELECT * FROM LopHocPhan");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // get thông tin lớp học phần theo mã giáo viên
    public function getLopHocPhanGiaoVien($maGiaoVien)
    {
        $result = $this->db->con->query("SELECT * FROM LopHocPhan WHERE MaGiaoVien = '{$maGiaoVien}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // get thông tin hoatDongKhaoSat
    public function getThongTinHoatDongKhaoSat($noiDungRutGon)
    {
        $result = $this->db->con->query("SELECT MaHoatDong FROM hoatdongkhaosat WHERE NoiDungRutGon = '{$noiDungRutGon}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        if (count($resultArr) > 0) {
            return $resultArr[0]['MaHoatDong'];
        }
        return NULL;
    }

    // get thong tin loại phiếu 
    public function getThongTinLoaiPhieu()
    {
        $result = $this->db->con->query("SELECT * FROM loaiphieu");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // check giáo viên có trong DB
    public function checkGiaoVienCoTrongDB($maGiaoVien)
    {
        $result = $this->db->con->query("SELECT * FROM giaovien WHERE MaGiaoVien = '{$maGiaoVien}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        if (count($resultArr) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    // get thông tin lớp học phần MaDuLieuHocPhan
    public function getMaDuLieuHocPhan()
    {
        $result = $this->db->con->query("SELECT * FROM hocphan");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // get phiếu theo mã lớp học phần
    public function getPhieuKhaoSat($maLopHocPhan)
    {
        $result = $this->db->con->query("SELECT * FROM PhieuKhaoSat WHERE MaLopHocPhan = '{$maLopHocPhan}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // get thông tin chi tiêt đánh giá của từng phiếu
    // có bao nhiêu người đánh RD ở tiêu chí đánh giá 1 của lớp học phần 1
    // có bao nhiêu người đánh TDD ở tiêu chí đánh giá 1 của lớp học phần 1
    // vv...
    public function getThongTinChiTietKetQuaCauHoiCuaLop($maLopHocPhan, $maTieuChiDanhGia, $noiDungHinhThucPhanLoai)
    {
        $result = $this->db->con->query("SELECT
        hinhthucphanloai.NoiDungHinhThucPhanLoai,
        chitietkhaosatphieu.MaTieuChiDanhGia,
        hinhthucphanloai.MaTieuChiDanhGia
        FROM phieukhaosat 
        JOIN chitietkhaosatphieu 
        ON phieukhaosat.MaPhieuKhaoSat = chitietkhaosatphieu.MaPhieuKhaoSat
        JOIN hinhthucphanloai 
        ON chitietkhaosatphieu.MaHinhThucPhanLoai = hinhthucphanloai.MaHinhThucPhanLoai
        WHERE phieukhaosat.MaLopHocPhan = '{$maLopHocPhan}' 
        AND hinhthucphanloai.MaTieuChiDanhGia = '{$maTieuChiDanhGia}' 
        AND hinhthucphanloai.NoiDungHinhThucPhanLoai = '{$noiDungHinhThucPhanLoai}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // get thông tin chi tiêt đánh giá của từng phiếu của mỗi lớp học phần trong 1 nhóm
    // có bao nhiêu người đánh RD ở tiêu chí đánh giá 1 của lớp học phần 1
    // có bao nhiêu người đánh TDD ở tiêu chí đánh giá 1 của lớp học phần 1
    // vv...
    public function getThongTinChiTietKetQuaCauHoiCuaNhieuLop($arrPhieu, $maTieuChiDanhGia, $noiDungHinhThucPhanLoai)
    {
        $arrPhieu = join("','", $arrPhieu);
        $result = $this->db->con->query("SELECT
        hinhthucphanloai.NoiDungHinhThucPhanLoai,
        chitietkhaosatphieu.MaTieuChiDanhGia,
        hinhthucphanloai.MaTieuChiDanhGia
        FROM phieukhaosat 
        JOIN chitietkhaosatphieu 
        ON phieukhaosat.MaPhieuKhaoSat = chitietkhaosatphieu.MaPhieuKhaoSat
        JOIN hinhthucphanloai 
        ON chitietkhaosatphieu.MaHinhThucPhanLoai = hinhthucphanloai.MaHinhThucPhanLoai
        WHERE phieukhaosat.MaLopHocPhan IN('{$arrPhieu}')
        AND hinhthucphanloai.MaTieuChiDanhGia = '{$maTieuChiDanhGia}' 
        AND hinhthucphanloai.NoiDungHinhThucPhanLoai = '{$noiDungHinhThucPhanLoai}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //get lớp học trong bộ môn
    public function getLopHocTrongBoMon($maBoMon)
    {
        $result = $this->db->con->query("SELECT *
        FROM hocphan JOIN lophocphan ON hocphan.MaHocPhan = lophocphan.MaHocPhan
        WHERE hocphan.MaBoMon = '{$maBoMon}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // get count dữ liệu
    public function getCountDuLieu($table = 'khoa', $column = 'TenKhoa', $duLieu)
    {
        $result = $this->db->con->query("SELECT *
        FROM $table WHERE $column = '{$duLieu}' ");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        if (count($resultArr) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    //check Bộ môn trong khoa
    public function kiemTraBoMonCoTrongKhoa($tenKhoa, $tenBoMon)
    {
        $result = $this->db->con->query("SELECT * FROM bomon 
        JOIN khoa ON bomon.MaKhoa = khoa.MaKhoa
        WHERE khoa.TenKhoa = '{$tenKhoa}' AND bomon.TenBoMon ='{$tenBoMon}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        if (count($resultArr) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    //check môn học trong bộ môn
    public function kiemTraMonHocCoTrongBoMon($tenHocPhan, $tenBoMon)
    {
        $result = $this->db->con->query("SELECT *
        FROM hocphan JOIN bomon on hocphan.MaBoMon = bomon.MaBoMon
        WHERE hocphan.TenHocPhan = '{$tenHocPhan}' AND bomon.TenBoMon = '{$tenBoMon}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        if (count($resultArr) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    // get các lớp học phần trong 1 khoảng thời gian nhất định(page: thongKeNangCao)
    public function getThongKeKhoa($khoa)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }


    public function getThongKeBoMon($khoa, $boMon)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' AND bomon.TenBoMon = '{$boMon}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // thống kê theo môn học
    public function getThongKeMonHoc($khoa, $boMon, $monHoc)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' AND bomon.TenBoMon = '{$boMon}' AND hocphan.TenHocPhan = '{$monHoc}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }


    // thống kê khoa theo năm học
    public function getThongKeKhoaTheoNam($khoa, $namHoc)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' AND namhoc.ThoiGian = '{$namHoc}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }


    //thống kê khoa theo năm học học kỳ
    public function getThongKeKhoaHocKy($khoa, $namHoc, $hocKy)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' AND namhoc.ThoiGian = '{$namHoc}' AND hocky.TenHocKy = '{$hocKy}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //thống kê khoa theo khoảng năm học
    public function getThongKeKhoaTheoKhoanNamHoc($khoa, $namHoc, $denNam)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' AND namhoc.ThoiGian BETWEEN '{$namHoc}' AND '{$denNam}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }


    //thống kê khoa theo khoảng năm học hoc kỳ
    public function getThongKeKhoaTheoKhoanNamHocVaHocKy($khoa, $namHoc, $denNam, $hocKy)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' 
        AND namhoc.ThoiGian BETWEEN '{$namHoc}' AND '{$denNam}'
        AND hocky.TenHocKy = '{$hocKy}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }


    //thống kê bộ môn theo năm học
    public function thongKeBoMonTheoNam($khoa, $boMon, $namHoc)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' 
        AND namhoc.ThoiGian = '{$namHoc}' 
        AND bomon.TenBoMon ='{$boMon}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }
    //thống kê bộ môn theo năm học học kỳ
    public function thongKeBoMonTheoNamVaHocKy($khoa, $boMon, $namHoc, $hocKy)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' 
        AND namhoc.ThoiGian = '{$namHoc}' 
        AND bomon.TenBoMon ='{$boMon}'
        AND hocky.TenHocKy = '{$hocKy}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //thống kê bộ môn theo khoảng năm học
    public function thongKeBoMonTheoKhoanNam($khoa, $boMon, $namHoc, $denNam)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' 
        AND namhoc.ThoiGian BETWEEN '{$namHoc}' AND '{$denNam}' 
        AND bomon.TenBoMon ='{$boMon}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //thống kê bộ môn theo khoảng năm học hoc kỳ
    public function thongKeBoMonTheoKhoanNamCuaHocKy($khoa, $boMon, $namHoc, $denNam, $hocKy)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' 
        AND namhoc.ThoiGian BETWEEN '{$namHoc}' AND '{$denNam}' 
        AND bomon.TenBoMon ='{$boMon}'
        AND hocky.TenHocKy = '{$hocKy}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //thống kê học phần theo năm học
    public function thongKeHocPhanTheoNam($khoa, $boMon, $hocPhan, $namHoc)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' 
        AND hocphan.TenHocPhan = '{$hocPhan}'
        AND namhoc.ThoiGian = '{$namHoc}'
        AND bomon.TenBoMon ='{$boMon}'        ");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }
    //thống kê học phần theo năm học học kỳ
    public function thongKeHocPhanTheoNamVaHocKy($khoa, $boMon, $hocPhan, $namHoc, $hocKy)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' 
        AND hocphan.TenHocPhan = '{$hocPhan}'
        AND namhoc.ThoiGian = '{$namHoc}'
        AND bomon.TenBoMon ='{$boMon}'
        AND hocky.TenHocKy = '{$hocKy}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //thống kê học phần theo khoảng năm học
    public function thongKeHocPhanTheoKhoanNam($khoa, $boMon, $hocPhan, $namHoc, $denNam)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' 
        AND hocphan.TenHocPhan = '{$hocPhan}'
        AND namhoc.ThoiGian BETWEEN '{$namHoc}' AND '{$denNam}'
        AND bomon.TenBoMon ='{$boMon}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }
    //thống kê học phần theo khoảng năm học, hoc kỳ
    public function thongKeHocPhanTheoKhoanNamVaHocKy($khoa, $boMon, $hocPhan, $namHoc, $denNam, $hocKy)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE khoa.TenKhoa = '{$khoa}' 
        AND hocphan.TenHocPhan = '{$hocPhan}'
        AND namhoc.ThoiGian BETWEEN '{$namHoc}' AND '{$denNam}'
        AND bomon.TenBoMon ='{$boMon}'
        AND hocky.TenhocKy = '{$hocKy}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }



    //thống kê theo giáo viên
    public function getThongKeGiaoVien($maGiaoVien, $tenGiaoVien)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
        WHERE giaovien.MaGiaoVien = '{$maGiaoVien}' AND giaovien.TenGiaoVien = '$tenGiaoVien'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // thống kê theo năm của giáo viên
    public function getThongKeGiaoVienTheoNam($maGiaoVien, $tenGiaoVien, $namHoc)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
            WHERE giaovien.MaGiaoVien = '{$maGiaoVien}' 
                AND giaovien.TenGiaoVien = '$tenGiaoVien' 
                AND namhoc.ThoiGian = '{$namHoc}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // thống kê theo khoảng thời gian năm học giáo viên
    public function getThongKeGiaoVienTheoKhoangThoiGian($maGiaoVien, $tenGiaoVien, $namHoc, $denNam)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
            WHERE giaovien.MaGiaoVien = '{$maGiaoVien}' 
                AND giaovien.TenGiaoVien = '$tenGiaoVien' 
                AND namhoc.ThoiGian BETWEEN '{$namHoc}' AND '{$denNam}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // thống kê khoảng thời gian theo học kỳ của giáo viên    
    public function getThongKeGiaoVienTheoKhoangThoiGianHocKy($maGiaoVien, $tenGiaoVien, $namHoc, $denNam, $hocKy)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
            WHERE giaovien.MaGiaoVien = '{$maGiaoVien}' 
                AND giaovien.TenGiaoVien = '$tenGiaoVien' 
                AND namhoc.ThoiGian BETWEEN '{$namHoc}' AND '{$denNam}'
                AND hocky.TenHocKy = '{$hocKy}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }



    // thống kê theo năm học và học kỳ của giáo viên
    public function getThongKeGiaoVienNamHocKy($maGiaoVien, $tenGiaoVien, $namHoc, $hocKy)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
            WHERE giaovien.MaGiaoVien = '{$maGiaoVien}' 
                AND giaovien.TenGiaoVien = '$tenGiaoVien' 
                AND namhoc.ThoiGian = '{$namHoc}'
                AND hocky.TenHocKy = '{$hocKy}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //thống kê theo năm học của toàn trường
    public function getThongKeNam($namHoc)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
            WHERE namhoc.ThoiGian = '{$namHoc}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }



    // thống kê toàn trường từ năm xxx đến năm xxx
    public function getThongTuNamDenNam($namHoc, $denNam)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
            WHERE namhoc.ThoiGian BETWEEN '{$namHoc}' AND '{$denNam}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // thống kê toàn trường từ năm xxx đến năm xxx theo học kỳ
    public function getThongTuNamDenNamTheoHocKy($namHoc, $denNam, $hocKy)
    {

        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
            WHERE namhoc.ThoiGian BETWEEN '{$namHoc}' AND '{$denNam}'
            AND hocky.TenHocKy = '{$hocKy}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }


    // thống kê toàn trường theo học kỳ của năm học
    public function getToanTruongTheoHocKy($namHoc, $hocKy)
    {
        $result = $this->db->con->query("SELECT *
        FROM
        lophocphan 
        JOIN hocphan
        ON lophocphan.MaHocPhan = hocphan.MaHocPhan 
        JOIN giaovien
        ON giaovien.MaGiaoVien = lophocphan.MaGiaoVien
        JOIN nhomhocphan
        ON nhomhocphan.MaNhomHocPhan = lophocphan.MaNhomHocPhan
        JOIN namhoc
        ON namhoc.MaNamHoc = lophocphan.MaNamHoc
        JOIN hocky
        ON hocky.MaHocKy = lophocphan.MaHocKy
        JOIN bomon
        ON bomon.MaBoMon = giaovien.MaBoMon
        JOIN khoa
        ON khoa.MaKhoa = bomon.MaKhoa
            WHERE namhoc.ThoiGian = '{$namHoc}'
            AND hocky.TenHocKy = '{$hocKy}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }


    //check hoạt động khảo sát có trùng nhau của các lớp học phần
    // dùng để mở rộng nếu có nhiều hoạt động khảo sát khác nhau
    public function checkHoatDongKhaoSatCoTrungNhau($arrPhieu)
    {
        $arrPhieu = join("','", $arrPhieu);
        $result = $this->db->con->query("SELECT DISTINCT MaHoatDongKhaoSat FROM LopHocPhan 
        WHERE  MaLopHocPhan IN('{$arrPhieu}')");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }

        if (count($resultArr) > 1) {
            echo 'Hoạt động khảo sát có sự không giống nhau';
            return null;
        }
        return $resultArr;
    }

    // kiểm tra các phiếu có cùng 1 hoạt động
    public function checkHoatDongCuaCacPhieu($arrPhieu, $maHoatDongKhaoSat)
    {
        $arrPhieu = join("','", $arrPhieu);
        $result = $this->db->con->query("SELECT * FROM LopHocPhan 
        WHERE MaHoatDongKhaoSat = '{$maHoatDongKhaoSat}' AND MaLopHocPhan IN('{$arrPhieu}')");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // get phiếu của nhiều lớp học
    public function getPhieuNhieuLop($arrPhieu)
    {
        $arrPhieu = join("','", $arrPhieu);
        $result = $this->db->con->query("SELECT * FROM PhieuKhaoSat 
        WHERE MaLopHocPhan IN('{$arrPhieu}')");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }




    //thêm học phần
    public function themHocPhan($maBoMon, $maKhoa, $tenHocPhan, $maDuLieuHocPhan)
    {
        $result = $this->db->con->query("INSERT INTO `hocphan`(`MaBoMon`, `MaKhoa`, `TenHocPhan`, `MaDuLieuHocPhan`) VALUES ('{$maBoMon}','{$maKhoa}','{$tenHocPhan}','{$maDuLieuHocPhan}')");
        if ($result === TRUE) {
            echo '----add new record in themLopHocPhan ----';
        } else {
            echo "----not thing add to hocPhan ----";
        }
    }

    //kiểm tra insert trùng nhau
    public function checkHocPhan($maBoMon, $maKhoa, $maDuLieuHocPhan)
    {
        $result = $this->db->con->query("SELECT * FROM hocphan 
        WHERE MaBoMon = '{$maBoMon}' AND
        MaKhoa = '{$maKhoa}' AND        
        MaDuLieuHocPhan = '{$maDuLieuHocPhan}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        if (count($resultArr) > 0) { // trùng dữ liệu
            return false;
        }
        return true;
    }

    // thêm năm học
    public function themNamHoc($thoiGian)
    {
        $result = $this->db->con->query("INSERT INTO `namhoc`(`ThoiGian`) VALUES ('{$thoiGian}')");
        if ($result === TRUE) {
            echo '----add new record in namHoc ----';
        } else {
            echo "----not thing add to NamHoc ----";
        }
    }

    public function checkNamHoc($thoiGian)
    {
        $result = $this->db->con->query("SELECT * FROM namhoc 
        WHERE ThoiGian = '{$thoiGian}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        if (count($resultArr) > 0) { // trùng dữ liệu
            return false;
        }
        return true;
    }
    
}
