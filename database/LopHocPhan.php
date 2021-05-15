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
            echo 'add new record in themLopHocPhan';
        }
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

    // get Loại phiếu

    // public function getLoaiPhieu($maLoaiPhieu){
    //     $result = $this->db->con->query("SELECT ")
    // }
}
