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


    public function getMaHocPhan($maDuLieuHocPhan)
    {
        $result = $this->db->con->query("SELECT MaHocPhan FROM hocphan WHERE MaDuLieuHocPhan = '{$maDuLieuHocPhan}'");
        $row = $result->fetch_row();
        $value = $row[0] ?? false;
        return $value;
    }


    public function getMaNamHoc($thoiGian)
    {
        $result = $this->db->con->query("SELECT MaNamHoc FROM namhoc WHERE ThoiGian = '{$thoiGian}'");
        $row = $result->fetch_row();
        $value = $row[0] ?? false;
        return $value;
    }

    public function getMaLopHocPhanChoCauHoiMo($maHocPhan, $maNamHoc, $maHocKy, $maGiaoVien, $maNhom, $maHoatDongKhaoSat = '1')
    {
        $result = $this->db->con->query("SELECT *
        FROM lophocphan
        WHERE MaHocPhan = '{$maHocPhan}' AND MaNamHoc = '{$maNamHoc}' AND MaHocKy = '{$maHocKy}' AND MaGiaoVien = '{$maGiaoVien}' AND MaNhomHocPhan = '{$maNhom}'
        AND MaHoatDongKhaoSat = '{$maHoatDongKhaoSat}'");
        $row = $result->fetch_row();
        $value = $row[0] ?? false;
        return $value;
    }

    //get Mã tiêu chí đánh giá
    public function getMaTieuChiDanhGiaCauHoiMo($noiDungTieuChi)
    {
        $result = $this->db->con->query("SELECT MaTieuChi FROM tieuchidanhgia WHERE NoiDung = '{$noiDungTieuChi}'");
        $row = $result->fetch_row();
        $value = $row[0] ?? false;
        return $value;
    }


    // thêm câu hỏi mở
    public function themPhieuCauHoiMo($maLopHocPhan, $maTieuChiDanhGia, $thuTuCauHoi, $noiDungGopY, $phanLop, $danhGia, $maHoatDongKhaoSat = '1')
    {
        $result = $this->db->con->query("INSERT INTO `chitietkhaosatcauhoimo`(`MaLopHocPhan`, `MaTieuChiDanhGia`, `MaHoatDongKhaoSat`, `ThuTuCauHoi`,`NoiDungGopY`, `PhanLop`, `DanhGia`)
         VALUES ('{$maLopHocPhan}','{$maTieuChiDanhGia}','{$maHoatDongKhaoSat}','{$thuTuCauHoi}','{$noiDungGopY}','{$phanLop}','{$danhGia}')");
        if ($result === TRUE) {
            echo 'add new record phieu cau hoi mo';
        } else {
            echo "not thing add to cau hoi mo";
        }
    }

    public function checkViTriCauHoiTrongFile($maLopHocPhan, $viTriCauHoi)
    {
        $result = $this->db->con->query("SELECT * FROM chitietkhaosatcauhoimo WHERE MaLopHocPhan = '{$maLopHocPhan}' AND ThuTuCauHoi = '{$viTriCauHoi}'");
        $row = $result->fetch_row();
        if ($row === null) { // không có trong DB
            return true;
        } else {
            return false;
        }
    }

    //-----------------------



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
