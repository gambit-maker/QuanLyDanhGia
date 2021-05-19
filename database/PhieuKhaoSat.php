<?php
class PhieuKhaoSat
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) {
            return null;
        }
        $this->db = $db;
    }

    //thêm phiếu khảo sát
    public function themPhieuKhaoSat($maLopHocPhan, $maLoaiPhieu, $maHoatDongKhaoSat)
    {
        $result = $this->db->con->query("INSERT INTO PhieuKhaoSat (MaLoaiPhieu,MaLopHocPhan,MaHoatDongKhaoSat)
        VALUE ('{$maLopHocPhan}','{$maLoaiPhieu}','{$maHoatDongKhaoSat}')");
        if ($result === TRUE) {
            echo 'add new record';
        }
    }


    public function getMaLopHocPhan($maHocPhan, $maNhomHocPhan)
    {
        $result = $this->db->con->query("SELECT MaLopHocPhan FROM LopHocPhan WHERE MaHocPhan = '{$maHocPhan}' AND MaNhomHocPhan = '{$maNhomHocPhan}'");
        $item = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $item;
    }

    public function getPhieuKhaoSatTheoMaLop($maLopHocPhan)
    {
        $result = $this->db->con->query("SELECT * FROM PhieuKhaoSat WHERE MaLopHocPhan = '{$maLopHocPhan}'");
        $resultArr = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArr[] = $row;
        }
        return $resultArr;
    }



    /*
    public function getAccountGiaoVien($maNguoiDung, $matKhau)
    {
        $result = $this->db->con->query("SELECT * FROM giaovien WHERE MaGiaoVien = '{$maNguoiDung}' AND MatKhau = '{$matKhau}'");
        $resultArray = array();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }
        return $resultArray;
    }
    */
}
