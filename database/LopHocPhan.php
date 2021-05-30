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
}
