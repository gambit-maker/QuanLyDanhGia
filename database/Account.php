<?php
class Account // chỉ sử dụng trường 'mật khẩu' trong bảng giáo viên và nhân viên để đăng nhập
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) {
            return null;
        }
        $this->db = $db;
    }

    // Get Account    
    public function getAccountGiaoVien($maNguoiDung, $matKhau)
    {
        $result = $this->db->con->query("SELECT * FROM giaovien WHERE MaGiaoVien = '{$maNguoiDung}' AND MatKhau = '{$matKhau}'");
        $resultArray = array();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }
        return $resultArray;
    }

    public function getAccountNhanVien($maNguoiDung, $matKhau)
    {
        $result = $this->db->con->query("SELECT * FROM NhanVien WHERE MaNhanVien = '{$maNguoiDung}' AND MatKhau = '{$matKhau}' ");
        $resultArray = array();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }
        return $resultArray;
    }



    // Get user role
    public function getUserRoleGiaoVien($userID, $table = 'giaovien', $key = 'MaGiaoVien')
    {
        $result = $this->db->con->query("SELECT TenChucVu FROM $table as tb JOIN chucvu on tb.MaChucVu = chucvu.MaChucVu WHERE $key = '{$userID}'");
        $resultArray = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }
        }
        return $resultArray[0]['TenChucVu'];
    }


    // Get nhân viên role
    public function getTenNhanVien($userID, $table = 'giaovien', $key = 'MaGiaoVien')
    {
        $result = $this->db->con->query("SELECT TenNhanVien FROM $table as tb JOIN chucvu on tb.MaChucVu = chucvu.MaChucVu WHERE $key = '{$userID}'");
        $resultArray = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }
        }
        return $resultArray[0]['TenNhanVien'];
    }
}
