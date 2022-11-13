<?php

namespace App\Models;
   
use CodeIgniter\Model;
 
class Penjualan extends Model
{
	protected $table = 'penjualan';
	protected $primaryKey = 'penjualan_id';
	protected $allowedFields = ['pelanggan_id', 'barang_id', 'tanggal_penjualan', 'jenis_transaksi', 'harga_saat_dibeli', 'jumlah', 'user_id', 'cabang_id'];

	public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getDataPenjualan()
    {
        $query_stmt = 'SELECT penjualan_id, nama_pelanggan, nama_barang, tanggal_penjualan, jenis_transaksi, harga_saat_dibeli, jumlah, pj.user_id, pj.cabang_id FROM penjualan pj LEFT JOIN barang br on pj.barang_id=br.barang_id LEFT JOIN pelanggan pl ON pj.pelanggan_id=pl.pelanggan_id ORDER BY tanggal_penjualan DESC';
        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getDataPenjualanByCabangID($cabang_id)
    {
        $query_stmt = 'SELECT penjualan_id, nama_pelanggan, nama_barang, tanggal_penjualan, jenis_transaksi, harga_saat_dibeli, jumlah, pj.user_id, pj.cabang_id FROM penjualan pj LEFT JOIN barang br on pj.barang_id=br.barang_id LEFT JOIN pelanggan pl ON pj.pelanggan_id=pl.pelanggan_id WHERE pj.cabang_id IN (SELECT cabang_id from user_cabang where cabang_id='.$cabang_id.') ORDER BY tanggal_penjualan DESC';
        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getPenjualan($penjualan_id)
    {
    	$query_stmt = 'SELECT * FROM penjualan WHERE penjualan_id="'.$penjualan_id.'"';
    	$query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    }

    public function getPenjualanPerBulanByCabang($cabang_id, $tahun)
    {
        $query_stmt = 'SELECT 
        MONTH(tanggal_penjualan) as bulan_penjualan, 
        YEAR(tanggal_penjualan) as tahun_penjualan,
        SUM(jumlah) as jumlah,
        SUM((harga_saat_dibeli * jumlah)) as total_pembelian FROM `penjualan`
        WHERE cabang_id='.$cabang_id.' AND YEAR(tanggal_penjualan)='.$tahun.'
        GROUP BY bulan_penjualan, tahun_penjualan
        ORDER BY bulan_penjualan ASC;';

        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getPenjualanPerTahunByCabang($cabang_id)
    {
        $query_stmt = 'SELECT 
        YEAR(tanggal_penjualan) as tahun_penjualan,
        SUM(jumlah) as jumlah,
        SUM((harga_saat_dibeli * jumlah)) as total_pembelian FROM `penjualan`
        WHERE cabang_id='.$cabang_id.' 
        GROUP BY tahun_penjualan
        ORDER BY tahun_penjualan ASC;';

        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    } 

    public function getPenjualanPerMingguByCabang($cabang_id, $tahun, $bulan)
    {
        $query_stmt = 'SELECT 
        WEEK(tanggal_penjualan) as minggu_penjualan, 
        MONTH(tanggal_penjualan) as bulan_penjualan, 
        YEAR(tanggal_penjualan) as tahun_penjualan,
        SUM(jumlah) as jumlah,
        SUM((harga_saat_dibeli * jumlah)) as total_pembelian FROM `penjualan`
        WHERE cabang_id='.$cabang_id.' AND YEAR(tanggal_penjualan)='.$tahun.' AND MONTH(tanggal_penjualan)='.$bulan.'
        GROUP BY minggu_penjualan, bulan_penjualan, tahun_penjualan
        ORDER BY minggu_penjualan ASC;';

        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    } 

    public function getPenjualanPerMingguByCabangTahunan($cabang_id, $tahun)
    {
        $query_stmt = 'SELECT 
        WEEK(tanggal_penjualan) as minggu_penjualan, 
        YEAR(tanggal_penjualan) as tahun_penjualan,
        SUM(jumlah) as jumlah,
        SUM((harga_saat_dibeli * jumlah)) as total_pembelian FROM `penjualan`
        WHERE cabang_id='.$cabang_id.' AND YEAR(tanggal_penjualan)='.$tahun.'
        GROUP BY minggu_penjualan, tahun_penjualan
        ORDER BY minggu_penjualan ASC;';

        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    } 

    public function getTahunPenjualan()
    {
        $query_stmt = 'SELECT 
        YEAR(tanggal_penjualan) as tahun_penjualan
        FROM `penjualan`
        GROUP BY tahun_penjualan
        ORDER BY tahun_penjualan ASC;';

        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    } 

    public function getPenjualanPerHariByCabang($cabang_id, $tahun, $bulan)
    {
        $query_stmt = 'SELECT 
        DAY(tanggal_penjualan) as tanggal_penjualan,
        concat(YEAR(tanggal_penjualan), "-", MONTH(tanggal_penjualan)) as bulan_penjualan, 
        YEAR(tanggal_penjualan) as tahun_penjualan,
        SUM(jumlah) as jumlah,
        SUM((harga_saat_dibeli * jumlah)) as total_pembelian FROM `penjualan`
        WHERE cabang_id='.$cabang_id.' AND YEAR(tanggal_penjualan)='.$tahun.' AND MONTH(tanggal_penjualan)='.$bulan.'
        GROUP BY tanggal_penjualan, bulan_penjualan, tahun_penjualan
        ORDER BY tanggal_penjualan ASC;';

        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getPenjualanPerTahunTertentuByCabang($cabang_id, $tahun)
    {
        $query_stmt = 'SELECT 
        YEAR(tanggal_penjualan) as tahun_penjualan,
        SUM(jumlah) as jumlah,
        SUM((harga_saat_dibeli * jumlah)) as total_pembelian FROM `penjualan`
        WHERE cabang_id='.$cabang_id.' AND YEAR(tanggal_penjualan)='.$tahun.'
        GROUP BY tahun_penjualan
        ORDER BY tahun_penjualan ASC;';

        $query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    }

    public function getPenjualanPerBulanTertentuByCabang($cabang_id, $bulan, $tahun)
    {
        $query_stmt = 'SELECT 
        MONTH(tanggal_penjualan) as bulan_penjualan, 
        YEAR(tanggal_penjualan) as tahun_penjualan,
        SUM(jumlah) as jumlah,
        SUM((harga_saat_dibeli * jumlah)) as total_pembelian FROM `penjualan`
        WHERE cabang_id='.$cabang_id.' AND YEAR(tanggal_penjualan)='.$tahun.' AND MONTH(tanggal_penjualan)='.$bulan.'
        GROUP BY bulan_penjualan, tahun_penjualan
        ORDER BY bulan_penjualan ASC;';

        $query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    }

    public function getPenjualanPerHariTertentuByCabang($cabang_id, $tanggal, $bulan, $tahun)
    {
        $query_stmt = 'SELECT 
        DAY(tanggal_penjualan) as tanggal_penjualan,
        concat(YEAR(tanggal_penjualan), "-", MONTH(tanggal_penjualan)) as bulan_penjualan, 
        YEAR(tanggal_penjualan) as tahun_penjualan,
        SUM(jumlah) as jumlah,
        SUM((harga_saat_dibeli * jumlah)) as total_pembelian FROM `penjualan`
        WHERE cabang_id='.$cabang_id.' AND YEAR(tanggal_penjualan)='.$tahun.' AND MONTH(tanggal_penjualan)='.$bulan.' AND DAY(tanggal_penjualan)='.$tanggal.'
        GROUP BY tanggal_penjualan, bulan_penjualan, tahun_penjualan
        ORDER BY tanggal_penjualan ASC;';

        $query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    }

    public function getPenjualanPerMingguTertentuByCabang($cabang_id, $tahun, $bulan, $minggu)
    {
        $query_stmt = 'SELECT 
        WEEK(tanggal_penjualan) as minggu_penjualan, 
        MONTH(tanggal_penjualan) as bulan_penjualan, 
        YEAR(tanggal_penjualan) as tahun_penjualan,
        SUM(jumlah) as jumlah,
        SUM((harga_saat_dibeli * jumlah)) as total_pembelian FROM `penjualan`
        WHERE cabang_id='.$cabang_id.' AND YEAR(tanggal_penjualan)='.$tahun.' AND MONTH(tanggal_penjualan)='.$bulan.' AND WEEK(tanggal_penjualan)='.$minggu.'
        GROUP BY minggu_penjualan, bulan_penjualan, tahun_penjualan
        ORDER BY minggu_penjualan ASC;';

        $query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    } 
}