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
    public function getThongTinHocPhan($maHocPhan, $noiDung = 'TenHocPhan')
    {
        $result = $this->db->con->query("SELECT $noiDung FROM HocPhan WHERE MaHocPhan = '{$maHocPhan}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0][$noiDung];
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

    //get thông tin điểm và nội dung phân loại
    public function getDiemVaNoiDungPhanLoai($maHoatDong)
    {
        $result = $this->db->con->query("SELECT DISTINCT hinhthucphanloai.Diem, hinhthucphanloai.NoiDungHinhThucPhanLoai, hinhthucphanloai.NoiDungChiTiet
        FROM hinhthucphanloai JOIN cauhoicuahoatdong
        WHERE cauhoicuahoatdong.MaHoatDongKhaoSat = '{$maHoatDong}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // các câu hỏi trong hoạt động khảo sát, đều thuộc trong 1 nhóm tiêu chí nào đó
    // dùng hàm này để xác định có bao nhiêu nhóm
    public function getNhomTieuChi($maHoatDongKhaoSat)
    {
        $result = $this->db->con->query("SELECT DISTINCT MaNhomTieuChi FROM cauhoicuahoatdong join tieuchidanhgia on tieuchidanhgia.MaTieuChi = cauhoicuahoatdong.MaCauHoi WHERE cauhoicuahoatdong.MaHoatDongKhaoSat = '{$maHoatDongKhaoSat}' ORDER BY MaNhomTieuChi ASC");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //get tên nhóm tiếu chí theo mã nhóm tiếu chí
    public function getTenNhom($maNhom)
    {
        $result = $this->db->con->query("SELECT TenNhom FROM NhomTieuChi WHERE MaNhomTieuChi = '{$maNhom}'");
        $row = $result->fetch_assoc();
        return $row['TenNhom'];
    }

    // get các câu hỏi trong nhóm tiêu chí
    public function getCauHoiTrongNhomTieuChi($maHoatDongKhaoSat, $maNhomTieuChi)
    {
        $result = $this->db->con->query("SELECT * 
        FROM cauhoicuahoatdong join tieuchidanhgia join nhomtieuchi 
        ON cauhoicuahoatdong.MaCauHoi = tieuchidanhgia.MaTieuChi AND
        tieuchidanhgia.MaNhomTieuChi = nhomtieuchi.MaNhomTieuChi 
        WHERE  cauhoicuahoatdong.MaHoatDongKhaoSat = '{$maHoatDongKhaoSat}' and tieuchidanhgia.MaNhomTieuChi = '{$maNhomTieuChi}'");

        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //get các câu hỏi trong nhóm tiêu chí v2
    public function getCauHoiTrongNhomTieuChiV2($maNhomTieuChi)
    {
        $result = $this->db->con->query("SELECT * FROM nhomtieuchi JOIN tieuchidanhgia ON nhomtieuchi.MaNhomTieuChi = tieuchidanhgia.MaNhomTieuChi 
        WHERE nhomtieuchi.MaNhomTieuChi = '{$maNhomTieuChi}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //get nội dung hình thức phân loại theo mã câu hỏi(mã tiêu chí)
    public function getNoiDungHinhThucPhanLoai($maTieuChi)
    {
        $result = $this->db->con->query("SELECT hinhthucphanloai.NoiDungHinhThucPhanLoai FROM hinhthucphanloai join tieuchidanhgia on hinhthucphanloai.MaTieuChiDanhGia = tieuchidanhgia.MaTieuChi WHERE tieuchidanhgia.MaTieuChi='{$maTieuChi}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }
}
