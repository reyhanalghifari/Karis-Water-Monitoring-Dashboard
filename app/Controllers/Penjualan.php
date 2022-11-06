<?php
 
namespace App\Controllers;

class Penjualan extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
    
        $this->penjualan_model = new \App\Models\Penjualan();
        $this->pelanggan_model = new \App\Models\Pelanggan();
        $this->barang_model = new \App\Models\Barang();
        $this->cabang_model = new \App\Models\Cabang();
    }

    public function index()
    {
        if ($this->session->get('cabang_id') != ""){
            $datapenjualan = $this->penjualan_model->getDataPenjualanByCabangID($this->session->get('cabang_id'));
        } else {
            $datapenjualan = $this->penjualan_model->getDataPenjualan();   
        }

        return view('penjualan/list_penjualan', ['datapenjualan' => $datapenjualan]);
    }

    public function add()
    {
        $data_pelanggan = $this->pelanggan_model->getDataPelangganEceran();
        $data_barang = $this->barang_model->getDataBarang();
        return view('penjualan/tambah_penjualan', ['data_pelanggan' => $data_pelanggan, 'data_barang' => $data_barang]);
    }

    public function add_cabang()
    {
        $data_pelanggan = $this->pelanggan_model->getDataPelangganCabang();
        $data_barang = $this->barang_model->getDataBarang();
        return view('penjualan/tambah_penjualan_cabang', ['data_pelanggan' => $data_pelanggan, 'data_barang' => $data_barang]);
    }

    public function process_add()
    {

        $this->validation->setRules(
            [
                'jumlah' => 'required|integer',
                
            ],
            
            [   // Errors
                
                'jumlah' => [
                    'required' => 'Jumlah pembelian tidak boleh kosong',
                    'integer' => 'Jumlah pembelian harus di isi dengan angka'
                ],

            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('form_penjualan_error_message', $this->validation->getErrors());
            return redirect()->to('/penjualan/add');
        }
        else {

            $penjualan_data = [
                'user_id' => $this->request->getVar('user_id'),
                'cabang_id' => $this->request->getVar('cabang_id'),
                'pelanggan_id' => $this->request->getVar('pelanggan_id'),
                'barang_id' => $this->request->getVar('barang_id'),
                'tanggal_penjualan' => $this->request->getVar('tanggal_penjualan'),
                'jenis_transaksi' => $this->request->getVar('jenis_transaksi'),
                'harga_saat_dibeli' => $this->request->getVar('harga_saat_dibeli'),
                'jumlah' => $this->request->getVar('jumlah'),
            
            ];

            $result = $this->penjualan_model->insert($penjualan_data);
            $this->session->setFlashdata('form_penjualan_success_message', 'Transaksi berhasil');
            return redirect()->to('/penjualan');    
        }
    }

    public function edit()
    {
        return view('penjualan/edit_penjualan');
    }

    public function delete()
    {
        // redirect halaman ke Barang/Index
    }

    public function laporan()
    {
        $list_tahun_penjualan = $this->penjualan_model->getTahunPenjualan();
        $list_cabang = $this->cabang_model->getDataCabang();
        return view('penjualan/laporan_penjualan', ["list_tahun_penjualan" => $list_tahun_penjualan, "list_cabang" => $list_cabang]);
    }

    public function print_laporan_bulanan($cabang_id, $tahun)
    {
        include APPPATH . 'ThirdParty/fpdf/fpdf.php';

        $penjualan_bulanan = $this->penjualan_model->getPenjualanPerBulanByCabang($cabang_id, $tahun);
        $cabang = $this->cabang_model->getCabang($cabang_id);

        $this->response->setContentType('application/pdf');

        $header = array('No', 'Tahun', 'Bulan', 'Total Penjualan Per Bulan');

        $pdf = new \FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',14);
        
        $pdf->SetX((210-30)/2);

        $pdf->Cell(40, 20, 'C.V. Karis Water');
        $pdf->Ln(5);

        $pdf->SetX((210-90)/2);
        $pdf->Cell(40, 20, 'Laporan Penjualan Bulanan - Tahun '. $tahun);

        $pdf->SetFont('Arial','B',12);


        $pdf->Ln(10);
        $pdf->Cell(40, 20, 'Cabang: '. $cabang->nama_cabang);
        $pdf->Ln();

        // Colors, line width and bold font
        $pdf->SetFillColor(128,128,96);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128,128,96);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','B',10);

        // Header
        $w = array(40, 35, 40, 45);
        for($i=0;$i<count($header);$i++)
            $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial','B',8);

        // Data
        $fill = false;
        $i=1;
        $total_penjualan = 0;
        foreach($penjualan_bulanan as $row)
        {
            $pdf->Cell($w[0],6,$i,'LR',0,'L',$fill);
            $pdf->Cell($w[1],6,$row->tahun_penjualan,'LR',0,'L',$fill);
            $pdf->Cell($w[2],6,$row->bulan_penjualan,'LR',0,'R',$fill);
            $pdf->Cell($w[3],6,"Rp. ".number_format($row->total_pembelian),'LR',0,'R',$fill);
            $pdf->Ln();
            $fill = !$fill;
            $i++;
            $total_penjualan += $row->total_pembelian;
        }

        // Closing line
        $pdf->Cell(array_sum($w),0,'','T');

        $pdf->Ln();

        $pdf->Cell(40,20,'Total penjualan: Rp. '.$total_penjualan);

        $pdf->Output();
    }

    public function print_laporan_mingguan($cabang_id, $tahun)
    {
        include APPPATH . 'ThirdParty/fpdf/fpdf.php';

        $penjualan_mingguan = $this->penjualan_model->getPenjualanPerMingguByCabangTahunan($cabang_id, $tahun);
        $cabang = $this->cabang_model->getCabang($cabang_id);

        $this->response->setContentType('application/pdf');

        $header = array('No', 'Tahun', 'Minggu', 'Total Penjualan Per Minggu');

        $pdf = new \FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',14);

        $pdf->SetX((210-30)/2);

        $pdf->SetFont('Arial','B',14);

        $pdf->Cell(40, 20, 'C.V. Karis Water');
        $pdf->Ln(5);

        $pdf->SetX((210-90)/2);
        $pdf->Cell(40, 20, 'Laporan Penjualan Mingguan - Tahun '. $tahun);

        $pdf->SetFont('Arial','B',12);

        $pdf->Ln(10);
        $pdf->Cell(40, 20, 'Cabang: '. $cabang->nama_cabang);
        $pdf->Ln();
        

        // Colors, line width and bold font
        $pdf->SetFillColor(128,128,96);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128,128,96);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','B',9);

        // Header
        $w = array(40, 35, 40, 45);
        for($i=0;$i<count($header);$i++)
            $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial','B',8);

        // Data
        $fill = false;
        $i=1;
        $total_penjualan = 0;
        foreach($penjualan_mingguan as $row)
        {
            $pdf->Cell($w[0],6,$i,'LR',0,'L',$fill);
            $pdf->Cell($w[1],6,$row->tahun_penjualan,'LR',0,'L',$fill);
            $pdf->Cell($w[2],6,$row->minggu_penjualan+1,'LR',0,'R',$fill);
            $pdf->Cell($w[3],6,"Rp. ".number_format($row->total_pembelian),'LR',0,'R',$fill);
            $pdf->Ln();
            $fill = !$fill;
            $i++;
            $total_penjualan += $row->total_pembelian;
        }

        $pdf->SetFont('Arial','B',10);


        // Closing line
        $pdf->Cell(array_sum($w),0,'','T');

        $pdf->Ln();

        $pdf->Cell(40,20,'Total penjualan: Rp. '.$total_penjualan);

        $pdf->Output();
    }

    public function print_laporan_tahunan($cabang_id)
    {
        include APPPATH . 'ThirdParty/fpdf/fpdf.php';

        $penjualan_tahunan = $this->penjualan_model->getPenjualanPerTahunByCabang($cabang_id);
        $cabang = $this->cabang_model->getCabang($cabang_id);

        $this->response->setContentType('application/pdf');

        $header = array('No', 'Tahun', 'Total Penjualan Per Tahun');
        $title = 'C.V Karis Water';

        $pdf = new \FPDF();
        $pdf->AddPage();

        $pdf->SetX((210-30)/2);

        $pdf->SetFont('Arial','B',14);

        $pdf->Cell(40, 20, 'C.V. Karis Water');
        $pdf->Ln(5);

        $pdf->SetX((210-60)/2);
        $pdf->Cell(40, 20, 'Laporan Penjualan Tahunan');

        $pdf->SetFont('Arial','B',12);
        
        $pdf->Ln(10);
        $pdf->Cell(40, 20, 'Cabang: '. $cabang->nama_cabang);
        $pdf->Ln();

        // Colors, line width and bold font
        $pdf->SetFillColor(128,128,96);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128,128,96);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','B',9);

        // Header
        $w = array(40, 35, 50);
        for($i=0;$i<count($header);$i++)
            $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial','B',8);

        // Data
        $fill = false;
        $i=1;
        $total_penjualan = 0;
        foreach($penjualan_tahunan as $row)
        {
            $pdf->Cell($w[0],6,$i,'LR',0,'L',$fill);
            $pdf->Cell($w[1],6,$row->tahun_penjualan,'LR',0,'L',$fill);
            $pdf->Cell($w[2],6,"Rp. ".number_format($row->total_pembelian),'LR',0,'R',$fill);
            $pdf->Ln();
            $fill = !$fill;
            $i++;
            $total_penjualan += $row->total_pembelian;
        }

        // Closing line
        $pdf->Cell(array_sum($w),0,'','T');

        $pdf->Ln();

        $pdf->Cell(40, 20,'Total penjualan: Rp. '.number_format($total_penjualan));

        $pdf->Output();
    }
}
