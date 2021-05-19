<?php
class InfoSmallTable
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) {
            return null;
        }
        $this->db = $db;
    }

    //get thông tin khoa
    public function getThongTinBang($table = 'Khoa')
    {
        $result = $this->db->con->query("SELECT * FROM {$table}");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //get thông tin lớp học phần theo mã lớp
    public function getThongTinLopHocPhanTheoMaLop($maLopHocPhan)
    {
        $result = $this->db->con->query("SELECT * FROM LopHocPhan WHERE MaLopHocPhan = '{$maLopHocPhan}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]; // return duy nhất giá trị đầu tiên của bảng
    }

    // ---------------------------- Lấy thông tin tên của các bảng nhỏ ---------------------------------//

    //get thông tin giáo viên
    public function getThongTinGiaoVien($maGiaoVien, $thongTin = 'TenGiaoVien')
    {
        $result = $this->db->con->query("SELECT * FROM GiaoVien WHERE MaGiaoVien = '{$maGiaoVien}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0][$thongTin];
    }

    // get thông tin khoa
    public function getThongTinKhoa($maKhoa)
    {
        $result = $this->db->con->query("SELECT TenKhoa FROM Khoa WHERE MaKhoa = '{$maKhoa}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['TenKhoa'];
    }

    // get thông tin năm học
    public function getThongTinNam($maNamHoc)
    {
        $result = $this->db->con->query("SELECT ThoiGian FROM NamHoc WHERE MaNamHoc = '{$maNamHoc}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['ThoiGian'];
    }

    // get thông tin học kỳ
    public function getThongTinHocKy($maHocKy)
    {
        $result = $this->db->con->query("SELECT TenHocKy FROM HocKy WHERE MaHocKy = '{$maHocKy}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['TenHocKy'];
    }

    // get thông tin nhóm
    public function getThongTinNhom($maNhomHocPhan)
    {
        $result = $this->db->con->query("SELECT TenNhomHocPhan FROM NhomHocPhan WHERE MaNhomHocPhan = '{$maNhomHocPhan}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['TenNhomHocPhan'];
    }

    //get thông tin học phần
    public function getThongTinHocPhan($maHocPhan)
    {
        $result = $this->db->con->query("SELECT TenHocPhan FROM HocPhan WHERE MaHocPhan = '{$maHocPhan}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['TenHocPhan'];
    }

    //get thông tin hoạt động khảo sát
    public function getThongTinHoatDongKhaoSat($maHoatDong)
    {
        $result = $this->db->con->query("SELECT TenHoatDong FROM HoatDongKhaoSat WHERE MaHoatDong = '{$maHoatDong}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['TenHoatDong'];
    }

    // get tên bộ môn
    public function getThongTinBoMon($maBoMon, $thongTin = 'TenBoMon')
    {
        $result = $this->db->con->query("SELECT * FROM BoMon WHERE MaBoMon = '{$maBoMon}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0][$thongTin];
    }

    // get mã khoa
    public function getTenKhoa($maKhoa)
    {
        $result = $this->db->con->query("SELECT TenKhoa FROM Khoa WHERE MaKhoa = '{$maKhoa}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['TenKhoa'];
    }
}
