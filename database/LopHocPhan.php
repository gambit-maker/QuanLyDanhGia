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
            echo '----add new record in CauHoiCuaHoatDong----';
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
            echo '----add new record in themLopHocPhan ----';
        } else {
            echo "----not thing add to LopHocPhan ----";
        }
    }

    // thêm Phiếu khảo sát
    public function themPhieuKhaoSat($maLoaiPhieu, $maLopHocPhan,  $maHoatDongKhaoSat)
    {
        $result = $this->db->con->query("INSERT INTO PhieuKhaoSat (MaLoaiPhieu,MaLopHocPhan,MaHoatDongKhaoSat) VALUE ('{$maLoaiPhieu}','{$maLopHocPhan}','{$maHoatDongKhaoSat}')");
        if ($result === TRUE) {
            echo '----add new record in PhieuKhaoSat ----';
        } else {
            echo '----not thing add to PhieuKhaoSat ----';
        }
    }

    // thêm Chi tiết phiếu khảo sát theo phiếu
    public function themChiTietPhieuKhaoSatTheoPhieu($maPhieuKhaoSat, $maTieuChiDanhGia, $maHinhThucPhanLoai, $diemSo)
    {
        $result = $this->db->con->query("INSERT INTO `chitietkhaosatphieu`(`MaPhieuKhaoSat`, `MaTieuChiDanhGia`, `MaHinhThucPhanLoai`, `DiemSo`) VALUES ('{$maPhieuKhaoSat}','{$maTieuChiDanhGia}','{$maHinhThucPhanLoai}','{$diemSo}')");
        if ($result === TRUE) {
            echo '<br>add new record in ChiTietPhieuKhaoSat<br>';
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
        return $resultArr[0]['MaNamHoc'];
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
}
