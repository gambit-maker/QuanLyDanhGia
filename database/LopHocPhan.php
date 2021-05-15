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

    //thêm lớp học phần
    public function themLopHocPhan($maHocPhan, $maNamHoc, $maHocKy, $maGiaoVien, $maNhomHocPhan)
    {
        $result = $this->db->con->query("INSERT INTO LopHocPhan (MaHocPhan,MaNamHoc,MaHocKy,MaGiaoVien,MaNhomHocPhan) VALUE('{$maHocPhan}','{$maNamHoc}','{$maHocKy}','{$maGiaoVien}','{$maNhomHocPhan}')");
        if ($result === TRUE) {
            echo 'add new record in themLopHocPhan <br>';
        } else {
            echo "not thing add to LopHocPhan <br>";
        }
    }

    // thêm Phiếu khảo sát
    public function themPhieuKhaoSat($maLoaiPhieu, $maLopHocPhan,  $maHoatDongKhaoSat)
    {
        $result = $this->db->con->query("INSERT INTO PhieuKhaoSat (MaLoaiPhieu,MaLopHocPhan,MaHoatDongKhaoSat) VALUE ('{$maLoaiPhieu}','{$maLopHocPhan}','{$maHoatDongKhaoSat}')");
        if ($result === TRUE) {
            echo 'add new record in PhieuKhaoSat <br>';
        } else {
            echo 'not thing add to PhieuKhaoSat <br>';
        }
    }

    //kiểm tra trùng lặp trong lớp học phần
    public function checkLopHocPhan($maHocPhan, $maNamHoc, $maHocKy, $maGiaoVien, $maNhomHocPhan)
    {
        $result = $this->db->con->query("SELECT * 
        FROM LopHocPhan 
        WHERE MaHocPhan = '{$maHocPhan}' 
        AND MaNamHoc = '{$maNamHoc}' 
        AND MaHocKy = '{$maHocKy}' 
        AND MaGiaoVien = '{$maGiaoVien}'
        AND MaNhomHocPhan = '{$maNhomHocPhan}'
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
}
