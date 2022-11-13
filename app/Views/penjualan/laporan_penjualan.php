<?php

$session = \Config\Services::session();
 
?>

<?= $this->extend('layout/base') ?>
 
<?= $this->section('content') ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
  
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Laporan Penjualan Karis Water</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   

		<div class="row">
			<div class="col-lg-12">
			    <div class="panel panel-default">
                    <div class="panel-heading">
                        Filter Laporan Penjualan
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                    	<form role="form">
	                        <div class="form-group">
	                            <label>Tahun Penjualan</label>
	                            <select id="tahun-penjualan" name="tahun-penjualan" class="form-control">
	                            	<?php foreach ($list_tahun_penjualan as $row) { ?>
	                            	<option value="<?= $row->tahun_penjualan ?>"><?= $row->tahun_penjualan ?></option>
	                            	<?php } ?>
	                            </select>
	                        </div>
	                        
	                        <?php if ($session->get('account_type') == "superadmin" || $session->get('account_type') == "owner") { ?>
	                        <div class="form-group">
	                            <label>Cabang</label>
	                            <select id="cabang-id" name="cabang-id" class="form-control">
	                            	<?php foreach ($list_cabang as $row) { ?>
	                            	<option 
	                            	<?php 
	                            		if ($row->nama_cabang == "Pusat") {
                            				echo "selected";
                            			}
	                            	?>
	                            	value="<?= $row->cabang_id ?>"><?= $row->nama_cabang ?></option>
	                            	<?php } ?>
	                            </select>
	                        </div>
	                    	<?php } else { ?>

	                        <input id="cabang-id" type="hidden" value="<?php echo $session->get('cabang_id'); ?>"/>

	                    	<?php } ?>
	                        <a id="tampilkan-laporan-btn" href="#" class="btn btn-info">Tampilkan </a>
	                	</form>
                    </div>
                    <!-- /.panel-body -->
                </div>
			    <!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->

			
			<div class="col-lg-12">
			    <div class="panel panel-default">
	                <div class="panel-heading">
	                    Laporan Penjualan Air Galon Tahunan
	                </div>
	                <!-- /.panel-heading -->
	                <div class="panel-body">
	                    <div class="table-responsive">
	                    	<a target="_blank" id="cetak-laporan-tahunan-btn" href="#" class="btn btn-primary">Cetak Laporan Tahunan</a>
                        	<br />
                        	<br />
                        	<br />
                            <table class="table table-striped table-bordered table-hover" id="dataTables-karis-water-tahunan">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tahun</th>
                                        <th>Total Galon Terjual</th>
                                        <th>Total Penjualan Per Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   	<tr class="odd gradeX">
                                        <td>0</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="total-penjualan-tahunan" class="well">
                        	<p><b>Total Galon Terjual: 0</b></p>
                            <p><b>Total Penjualan: Rp. 0</b></p>
                        </div>
	                </div>
	                <!-- /.panel-body -->
	            </div>
			    <!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->

			<div class="col-lg-12">
			    <div class="panel panel-default">
                    <div class="panel-heading">
                        Laporan Penjualan Air Galon Bulanan
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                        	<a target="_blank" id="cetak-laporan-bulanan-btn" href="#" class="btn btn-primary">Cetak Laporan Bulanan</a>
                        	<br />
                        	<br />
                        	<br />
                            <table class="table table-striped table-bordered table-hover" id="dataTables-karis-water-bulanan">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Total Galon Terjual</th>
                                        <th>Total Penjualan Per Bulan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   	<tr class="odd gradeX">
                                        <td>0</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="total-penjualan-bulanan"  class="well">
                        	<p><b>Total Galon Terjual: 0</b></p>
                            <p><b>Total Penjualan: Rp. 0</b></p>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
			    <!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->

			<div class="col-lg-12">
			    <div class="panel panel-default">
                    <div class="panel-heading">
                        Laporan Penjualan Air Galon Mingguan
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                        	<a target="_blank" id="cetak-laporan-mingguan-btn" href="#" class="btn btn-primary">Cetak Laporan Mingguan</a>
                        	<br />
                        	<br />
                        	<br />
                            <table class="table table-striped table-bordered table-hover" id="dataTables-karis-water-mingguan">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Minggu</th>
                                        <th>Tahun</th>
                                        <th>Total Galon Terjual</th>
                                        <th>Total Penjualan Per Minggu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   	<tr class="odd gradeX">
                                        <td>0</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="total-penjualan-mingguan"  class="well">
                        	<p><b>Total Galon Terjual: 0</b></p>
                            <p><b>Total Penjualan: Rp. 0</b></p>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
			    <!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->

		</div>

		<input type="hidden" id="base-url" value="<?php echo base_url('/'); ?>" />
    </div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>

<script type="text/javascript">
    var init_cabang_id = $('#cabang-id').val();
    var init_tahun_penjualan = $('#tahun-penjualan').val();
    var base_url = $('#base-url').val();
        
    function loadLaporanPenjualan(cabang_id, tahun_penjualan) {
        var cetak_laporan_bulanan_url = base_url+"/penjualan/laporan/print/bulanan/"+cabang_id+"/"+tahun_penjualan;
        var cetak_laporan_mingguan_url = base_url+"/penjualan/laporan/print/mingguan/"+cabang_id+"/"+tahun_penjualan;
        var cetak_laporan_tahunan_url = base_url+"/penjualan/laporan/print/tahunan/"+cabang_id;

        function formatKursRupiah(money) {
           return new Intl.NumberFormat('id-ID',
             { style: 'currency', currency: 'IDR' }
           ).format(money);
        }

        $('#cetak-laporan-bulanan-btn').attr('href', cetak_laporan_bulanan_url);
        $('#cetak-laporan-mingguan-btn').attr('href', cetak_laporan_mingguan_url);
        $('#cetak-laporan-tahunan-btn').attr('href', cetak_laporan_tahunan_url);
        
        $.get("<?php echo base_url('master/penjualan-bulanan'); ?>/"+cabang_id+"/"+tahun_penjualan, function(data, status){
            $('#dataTables-karis-water-bulanan > tbody').empty();
            jsonData = JSON.parse(data);
            elements = [];
            total_penjualan = 0;
            total_galon_terjual = 0;

            if (jsonData.length > 0) {
                var row_template_bulanan = '';
                var i = 1;
                for (elem in jsonData) {
                    row_template_bulanan += '<tr class="odd gradeX">' +
                                    '<td>'+i+'</td>' +
                                    '<td>'+jsonData[elem].bulan_penjualan+'</td>' +
                                    '<td>'+jsonData[elem].tahun_penjualan+'</td>' +
                                    '<td>'+jsonData[elem].jumlah+'</td>' +
                                    '<td>Rp. '+formatKursRupiah(parseInt(jsonData[elem].total_pembelian))+'</td>' +
                                '</tr>';

                    total_penjualan += parseInt(jsonData[elem].total_pembelian);
                    total_galon_terjual += parseInt(jsonData[elem].jumlah);
                    i++;
                }
                console.log(row_template_bulanan);
                $('#dataTables-karis-water-bulanan > tbody').append(row_template_bulanan);
                $('#total-penjualan-bulanan').empty();

                var total_info = '<p><b>Total Galon Terjual:</b> '+total_galon_terjual+'</p>'
                                + '<p><b>Total Penjualan:</b> Rp. '+formatKursRupiah(parseInt(total_penjualan))+'</p>';
                $('#total-penjualan-bulanan').append(total_info);
            }
        });

        $.get("<?php echo base_url('master/penjualan-tahunan'); ?>/"+cabang_id, function(data, status){
            $('#dataTables-karis-water-tahunan > tbody').empty();
            jsonData = JSON.parse(data);
            elements = [];
            total_penjualan = 0;
            total_galon_terjual = 0;

            if (jsonData.length > 0) {
                var row_template_tahunan = '';
                var i = 1;
                for (elem in jsonData) {
                    row_template_tahunan += '<tr class="odd gradeX">' +
                                    '<td>'+i+'</td>' +
                                    '<td>'+jsonData[elem].tahun_penjualan+'</td>' +
                                    '<td>'+jsonData[elem].jumlah+'</td>' +
                                    '<td>Rp. '+formatKursRupiah(parseInt(jsonData[elem].total_pembelian))+'</td>' +
                                '</tr>';

                    total_penjualan += parseInt(jsonData[elem].total_pembelian);
                    total_galon_terjual += parseInt(jsonData[elem].jumlah);
                    i++;
                }
                console.log(row_template_tahunan);
                $('#dataTables-karis-water-tahunan > tbody').append(row_template_tahunan);
                $('#total-penjualan-tahunan').empty();

                var total_info = '<p><b>Total Galon Terjual:</b> '+total_galon_terjual+'</p>'
                                + '<p><b>Total Penjualan:</b> Rp. '+formatKursRupiah(parseInt(total_penjualan))+'</p>';
                $('#total-penjualan-tahunan').append(total_info);
            }
        });

        $.get("<?php echo base_url('master/penjualan-mingguan-tahunan'); ?>/"+cabang_id+"/"+tahun_penjualan, function(data, status){
            $('#dataTables-karis-water-mingguan > tbody').empty();
            jsonData = JSON.parse(data);
            elements = [];
            total_penjualan = 0;
            total_galon_terjual = 0;

            if (jsonData.length > 0) {
                var row_template_mingguan = '';
                var i = 1;
                for (elem in jsonData) {
                    var minggu_penjualan = parseInt(jsonData[elem].minggu_penjualan) + 1;
                    row_template_mingguan += '<tr class="odd gradeX">' +
                                    '<td>'+i+'</td>' +
                                    '<td>'+minggu_penjualan+'</td>' +
                                    '<td>'+jsonData[elem].tahun_penjualan+'</td>' +
                                    '<td>'+jsonData[elem].jumlah+'</td>' +
                                    '<td>Rp. '+formatKursRupiah(parseInt(jsonData[elem].total_pembelian))+'</td>' +
                                '</tr>';

                    total_penjualan += parseInt(jsonData[elem].total_pembelian);
                    total_galon_terjual += parseInt(jsonData[elem].jumlah);
                    i++;
                }
                console.log(row_template_mingguan);
                $('#dataTables-karis-water-mingguan > tbody').append(row_template_mingguan);
                $('#total-penjualan-mingguan').empty();

                var total_info = '<p><b>Total Galon Terjual:</b> '+total_galon_terjual+'</p>'
                                + '<p><b>Total Penjualan:</b> Rp. '+formatKursRupiah(parseInt(total_penjualan))+'</p>';
                $('#total-penjualan-mingguan').append(total_info);
            }
        });
    }

    loadLaporanPenjualan(init_cabang_id, init_tahun_penjualan);
    
    $('#tampilkan-laporan-btn').click(function(){
        console.log("Tombol #tampilkan-laporan-btn diklik...");
        var cabang_id = $('#cabang-id').val();
        var tahun_penjualan = $('#tahun-penjualan').val();
        
        loadLaporanPenjualan(cabang_id, tahun_penjualan);
    })

    // http://localhost:8888/karis-water-monitoring/public/penjualan/laporan/print/bulanan/6/2021
</script>


<?= $this->endSection() ?>

