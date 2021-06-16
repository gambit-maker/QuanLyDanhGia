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

    //get Mã năm học
    public function getMaNamHoc($thoiGian)
    {
        $result = $this->db->con->query("SELECT MaNamHoc FROM NamHoc WHERE ThoiGian = '{$thoiGian}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['MaNamHoc'];
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
        if (count($resultArr) > 0) {
            return $resultArr[0]['TenNhomHocPhan'];
        }
        return NULL;
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

    // get thông tin bộ môn của khoa
    public function getThongTinBoMonCuaKhoa($maKhoa)
    {
        $result = $this->db->con->query("SELECT * FROM BoMon WHERE MaKhoa = '{$maKhoa}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // get tên khoa
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
        $result = $this->db->con->query("SELECT hinhthucphanloai.NoiDungChiTiet,hinhthucphanloai.NoiDungHinhThucPhanLoai FROM hinhthucphanloai join tieuchidanhgia on hinhthucphanloai.MaTieuChiDanhGia = tieuchidanhgia.MaTieuChi WHERE tieuchidanhgia.MaTieuChi='{$maTieuChi}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    // get thông tin hình thức phân loại để count số lượng tiêu chí
    public function getCountHinhThucPhanLoai($maLopHocPhan, $noiDungTieuChi)
    {
        $result = $this->db->con->query("SELECT
        hinhthucphanloai.NoiDungHinhThucPhanLoai,
        hinhthucphanloai.MaTieuChiDanhGia,
        hinhthucphanloai.Diem
        FROM phieukhaosat JOIN chitietkhaosatphieu on phieukhaosat.MaPhieuKhaoSat = chitietkhaosatphieu.MaPhieuKhaoSat
        JOIN hinhthucphanloai on chitietkhaosatphieu.MaHinhThucPhanLoai = hinhthucphanloai.MaHinhThucPhanLoai
        WHERE phieukhaosat.MaLopHocPhan = '{$maLopHocPhan}' AND hinhthucphanloai.NoiDungHinhThucPhanLoai = '{$noiDungTieuChi}' ");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }


    // get thông tin hình thức phân loại để count số lượng tiêu chí trong nhiều lớp
    public function getCountHinhThucPhanLoaiTrongNhieuLop($arrMaLopHocPhan, $noiDungTieuChi)
    {
        $arrMaLopHocPhan = join("','", $arrMaLopHocPhan);
        $result = $this->db->con->query("SELECT
        hinhthucphanloai.NoiDungHinhThucPhanLoai,
        hinhthucphanloai.MaTieuChiDanhGia
        FROM phieukhaosat JOIN chitietkhaosatphieu on phieukhaosat.MaPhieuKhaoSat = chitietkhaosatphieu.MaPhieuKhaoSat
        JOIN hinhthucphanloai on chitietkhaosatphieu.MaHinhThucPhanLoai = hinhthucphanloai.MaHinhThucPhanLoai
        WHERE phieukhaosat.MaLopHocPhan IN('{$arrMaLopHocPhan}') AND hinhthucphanloai.NoiDungHinhThucPhanLoai = '{$noiDungTieuChi}' ");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }


    //get thông tin hình thức phân loại
    public function getHinhThucPhanLoai($nhomtieuchi)
    {
        $result = $this->db->con->query("SELECT DISTINCT hinhthucphanloai.NoiDungHinhThucPhanLoai 
        FROM
        nhomtieuchi JOIN tieuchidanhgia ON nhomtieuchi.MaNhomTieuChi = tieuchidanhgia.MaNhomTieuChi
        JOIN hinhthucphanloai ON hinhthucphanloai.MaTieuChiDanhGia = tieuchidanhgia.MaTieuChi
        WHERE nhomtieuchi.MaNhomTieuChi = '{$nhomtieuchi}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //get mã khoa của giáo viên
    public function getMaKhoaGiaoVien($maGiaoVien)
    {
        $result = $this->db->con->query("SELECT * 
        FROM khoa JOIN bomon ON khoa.MaKhoa = bomon.MaKhoa
        JOIN giaovien ON giaovien.MaBoMon = bomon.MaBoMon
        WHERE MaGiaoVien = '{$maGiaoVien}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['MaKhoa'];
    }

    //get maKhoa tu tenKhoa
    public function getMaKhoaTuTenKhoa($tenKhoa)
    {
        $result = $this->db->con->query("SELECT MaKhoa FROM Khoa WHERE TenKhoa = '{$tenKhoa}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr[0]['MaKhoa'];
    }

    //get tất cả môn học trong khoa
    public function getMonHocTrongKhoa($maKhoa)
    {
        $result = $this->db->con->query("SELECT * FROM 
        bomon JOIN hocphan ON bomon.MaBoMon = hocphan.MaBoMon
        JOIN lophocphan on hocphan.MaHocPhan = lophocphan.MaHocPhan
        WHERE bomon.MaKhoa = '{$maKhoa}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }


    //get mã bộ môn from tên bô môn
    public function getMaBoMon($tenBoMon, $maKhoa)
    {
        $result = $this->db->con->query("SELECT * FROM bomon JOIN hocphan on bomon.MaBoMon = hocphan.MaBoMon WHERE bomon.TenBoMon = '{$tenBoMon}' AND bomon.MaKhoa = '{$maKhoa}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }

    //get lớp học phần với mã học phần(arr), mã năm học , mã học kỳ cho trang thongKeDiemKhoa.php
    public function getArrLopHocPhan($arrHocPhan, $maNamHoc, $maHocKy)
    {
        $arrHocPhan = join("','", $arrHocPhan);
        $result = $this->db->con->query("SELECT * FROM lophocphan
         WHERE MaHocPhan IN ('{$arrHocPhan}') AND MaNamHoc = '{$maNamHoc}' AND MaHocKy = '{$maHocKy}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }


    //get tên chức vụ
    public function getTenChucVu($maChucVu)
    {
        $result = $this->db->con->query("SELECT * FROM chucvu WHERE MaChucVu = '{$maChucVu}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }


    //get tên chức vụ
    public function getBangchucVuTheoNhom($role)
    {
        $result = $this->db->con->query("SELECT * FROM chucvu WHERE PhanRole = '{$role}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }
}
