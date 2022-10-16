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
	                    Laporan Penjualan Air Galon per Tahun
	                </div>
	                <!-- /.panel-heading -->
	                <div class="panel-body">
	                    <div class="table-responsive">
	                            <table class="table table-striped table-bordered table-hover" id="dataTables-karis-water-tahunan">
	                                <thead>
	                                    <tr>
	                                        <th>No.</th>
	                                        <th>Tahun</th>
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
	                </div>
	                <!-- /.panel-body -->
	            </div>
			    <!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->

			<div class="col-lg-12">
			    <div class="panel panel-default">
                    <div class="panel-heading">
                        Laporan Penjualan Air Galon per Bulan
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-karis-water-bulanan">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
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
                    </div>
                    <!-- /.panel-body -->
                </div>
			    <!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->

			<div class="col-lg-12">
			    <div class="panel panel-default">
                    <div class="panel-heading">
                        Laporan Penjualan Air Galon per Minggu
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-karis-water-mingguan">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
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
                    </div>
                    <!-- /.panel-body -->
                </div>
			    <!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->

		</div>

		
    </div>
</div>


<!-- jQuery -->
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>


<!-- Morris Charts JavaScript -->
<script src="<?php echo base_url('assets/js/raphael.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/morris.min.js'); ?>"></script>
<script type="text/javascript">
	var init_cabang_id = $('#cabang-id').val();
	var init_tahun_penjualan = $('#tahun-penjualan').val();

	function loadLaporanPenjualan(cabang_id, tahun_penjualan) {
		$.get("<?php echo base_url('master/penjualan-bulanan'); ?>/"+cabang_id+"/"+tahun_penjualan, function(data, status){
			$('#dataTables-karis-water-bulanan > tbody').empty();
			jsonData = JSON.parse(data);
			elements = []
			if (jsonData.length > 0) {
				var row_template_bulanan = '';
				var i = 1;
				for (elem in jsonData) {
					row_template_bulanan += '<tr class="odd gradeX">' +
                                    '<td>'+i+'</td>' +
                                    '<td>'+jsonData[elem].bulan_penjualan+'</td>' +
                                    '<td>'+jsonData[elem].tahun_penjualan+'</td>' +
                                    '<td>Rp. '+jsonData[elem].total_pembelian+'</td>' +
                                '</tr>';

                    i++;
				}
				console.log(row_template_bulanan);
				$('#dataTables-karis-water-bulanan > tbody').append(row_template_bulanan);
			}
		});

		$.get("<?php echo base_url('master/penjualan-tahunan'); ?>/"+cabang_id, function(data, status){
			$('#dataTables-karis-water-tahunan > tbody').empty();
			jsonData = JSON.parse(data);
			elements = []
			if (jsonData.length > 0) {
				var row_template_tahunan = '';
				var i = 1;
				for (elem in jsonData) {
					row_template_tahunan += '<tr class="odd gradeX">' +
                                    '<td>'+i+'</td>' +
                                    '<td>'+jsonData[elem].tahun_penjualan+'</td>' +
                                    '<td>Rp. '+jsonData[elem].total_pembelian+'</td>' +
                                '</tr>';

                    i++;
				}
				console.log(row_template_tahunan);
				$('#dataTables-karis-water-tahunan > tbody').append(row_template_tahunan);
			}
		});

		$.get("<?php echo base_url('master/penjualan-mingguan'); ?>/"+cabang_id+"/"+tahun_penjualan, function(data, status){
			$('#dataTables-karis-water-mingguan > tbody').empty();
			jsonData = JSON.parse(data);
			elements = []
			if (jsonData.length > 0) {
				var row_template_mingguan = '';
				var i = 1;
				for (elem in jsonData) {
					row_template_mingguan += '<tr class="odd gradeX">' +
                                    '<td>'+i+'</td>' +
                                    '<td>'+jsonData[elem].minggu_penjualan+'</td>' +
                                    '<td>'+jsonData[elem].tahun_penjualan+'</td>' +
                                    '<td>Rp. '+jsonData[elem].total_pembelian+'</td>' +
                                '</tr>';

                    i++;
				}
				console.log(row_template_mingguan);
				$('#dataTables-karis-water-mingguan > tbody').append(row_template_mingguan);
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
</script>

<?= $this->endSection() ?>