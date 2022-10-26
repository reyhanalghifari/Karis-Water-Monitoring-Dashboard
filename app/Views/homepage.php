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
                <h1 class="page-header">Dashboard Penjualan Karis Water</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   

		<div class="row">
			<div class="col-lg-12">
			    <div class="panel panel-default">
                    <div class="panel-heading">
                        Filter Grafik Penjualan
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                    	<form role="form">
                    		<div class="form-group">
	                            <label>Periode Penjualan</label>
	                            <select id="periode-penjualan" name="periode-penjualan" class="form-control">
	                            	<option value="harian">Harian</option>
	                            	<option value="mingguan">Mingguan</option>
	                            	<option value="bulanan">Bulanan</option>
	                            	<option value="tahunan">Tahunan</option>
	                            </select>
	                        </div>
                    		<div id="container-bulan-penjualan" class="form-group">
	                            <label>Bulan Penjualan</label>
	                            <select id="bulan-penjualan" name="bulan-penjualan" class="form-control">
	                            	<option value="1">Januari</option>
	                            	<option value="2">Februari</option>
	                            	<option value="3">Maret</option>
	                            	<option value="4">April</option>
	                            	<option value="5">Mei</option>
	                            	<option value="6">Juni</option>
	                            	<option value="7">Juli</option>
	                            	<option value="8">Agustus</option>
	                            	<option value="9">September</option>
	                            	<option value="10">Oktober</option>
	                            	<option value="11">November</option>
	                            	<option value="12">Desember</option>
	                            </select>
	                        </div>
	                        <div id="container-tahun-penjualan" class="form-group">
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
	                        <a id="tampilkan-grafik-btn" href="#" class="btn btn-info">Tampilkan </a>
	                	</form>
                    </div>
                    <!-- /.panel-body -->
                </div>
			    <!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->

			<div id="container-penjualan-air-galon-per-hari" class="col-lg-12">
			    <div class="panel panel-default">
                    <div class="panel-heading">
                        Grafik Penjualan Air Galon per Hari
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="penjualan-air-galon-per-hari"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>
			    <!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->

			<div id="container-penjualan-air-galon-per-bulan" class="col-lg-12">
			    <div class="panel panel-default">
                    <div class="panel-heading">
                        Grafik Penjualan Air Galon per Bulan
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="penjualan-air-galon-per-bulan"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>
			    <!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->

			<div id="container-penjualan-air-galon-per-minggu" class="col-lg-12">
			    <div class="panel panel-default">
                    <div class="panel-heading">
                        Grafik Penjualan Air Galon per Minggu
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="penjualan-air-galon-per-minggu"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>
			    <!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->
			
			<div id="container-penjualan-air-galon-per-tahun" class="col-lg-12">
			    <div class="panel panel-default">
	                <div class="panel-heading">
	                    Grafik Penjualan Air Galon per Tahun
	                </div>
	                <!-- /.panel-heading -->
	                <div class="panel-body">
	                    <div id="penjualan-air-galon-per-tahun"></div>
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
	var init_bulan_penjualan = $("#bulan-penjualan").val();
	var init_periode_penjualan = $('#periode-penjualan').val();

	function loadGrafikPenjualanHarian(cabang_id, tahun_penjualan, bulan_penjualan) {
		$('#penjualan-air-galon-per-hari').empty("");
		$('#container-penjualan-air-galon-per-hari').show();
		$('#container-penjualan-air-galon-per-minggu').hide();
		$('#container-penjualan-air-galon-per-bulan').hide();
		$('#container-penjualan-air-galon-per-tahun').hide();

		$.get("<?php echo base_url('master/penjualan-harian'); ?>/"+cabang_id+"/"+tahun_penjualan+"/"+bulan_penjualan, function(data, status){
			jsonData = JSON.parse(data);
			elements = []
			if (jsonData.length > 0) {
				for (elem in jsonData) {
					elements.push({y:jsonData[elem].tanggal_penjualan, a:jsonData[elem].total_pembelian})
				}
				console.log(elements);
				
				Morris.Bar({
			        element: 'penjualan-air-galon-per-hari',
			        data: elements,
			        xkey: 'y',
			        ykeys: ['a',],
			        labels: ['Penjualan',],
			        hideHover: 'auto',
			        resize: true,
			        barColors: ["#cb4b4b",]
			    });
			} else {
				$("#penjualan-air-galon-per-hari").append("<p>Data tidak ditemukan...</p>");
			}
		});
	}

	function loadGrafikPenjualanBulanan(cabang_id, tahun_penjualan) {
		$('#penjualan-air-galon-per-bulan').empty("");
		$('#container-penjualan-air-galon-per-bulan').show();
		$('#container-penjualan-air-galon-per-minggu').hide();
		$('#container-penjualan-air-galon-per-hari').hide();
		$('#container-penjualan-air-galon-per-tahun').hide();

		$.get("<?php echo base_url('master/penjualan-bulanan'); ?>/"+cabang_id+"/"+tahun_penjualan, function(data, status){
			jsonData = JSON.parse(data);
			elements = []
			if (jsonData.length > 0) {
				for (elem in jsonData) {
					elements.push({y:jsonData[elem].bulan_penjualan, a:jsonData[elem].total_pembelian})
				}
				console.log(elements);
				
				Morris.Bar({
			        element: 'penjualan-air-galon-per-bulan',
			        data: elements,
			        xkey: 'y',
			        ykeys: ['a',],
			        labels: ['Penjualan',],
			        hideHover: 'auto',
			        resize: true,
			        barColors: ["#cb4b4b",]
			    });
			} else {
				$("#penjualan-air-galon-per-bulan").append("<p>Data tidak ditemukan...</p>");
			}
		});
	}
	
	function loadGrafikPenjualanMingguan(cabang_id, tahun_penjualan, bulan_penjualan) {
		$('#penjualan-air-galon-per-minggu').empty("");
		$('#container-penjualan-air-galon-per-minggu').show();
		$('#container-penjualan-air-galon-per-hari').hide();
		$('#container-penjualan-air-galon-per-bulan').hide();
		$('#container-penjualan-air-galon-per-tahun').hide();

		$.get("<?php echo base_url('master/penjualan-mingguan'); ?>/"+cabang_id+"/"+tahun_penjualan+"/"+bulan_penjualan, function(data, status){
			jsonData = JSON.parse(data);
			elements = []

			if (jsonData.length > 0) {
				for (elem in jsonData) {
					elements.push({y:jsonData[elem].minggu_penjualan, a:jsonData[elem].total_pembelian})
				}

				console.log(elements);

				Morris.Bar({
			        element: 'penjualan-air-galon-per-minggu',
			        data: elements,
			        xkey: 'y',
			        ykeys: ['a',],
			        labels: ['Penjualan',],
			        hideHover: 'auto',
			        resize: true,
			        barColors: ["#4da74d",]
			    });
			} else {
				$("#penjualan-air-galon-per-minggu").append("<p>Data tidak ditemukan...</p>");
			}
		});
	}
	
	function loadGrafikPenjualanTahunan(cabang_id) {
		$('#penjualan-air-galon-per-tahun').empty("");
		$('#container-penjualan-air-galon-per-tahun').show();
		$('#container-penjualan-air-galon-per-minggu').hide();
		$('#container-penjualan-air-galon-per-bulan').hide();
		$('#container-penjualan-air-galon-per-hari').hide();

		$.get("<?php echo base_url('master/penjualan-tahunan'); ?>/"+cabang_id, function(data, status){
			jsonData = JSON.parse(data);
			elements = []
			if (jsonData.length > 0) {
				for (elem in jsonData) {
					elements.push({y:jsonData[elem].tahun_penjualan, a:jsonData[elem].total_pembelian})
				}
				console.log(elements);
				
				Morris.Bar({
			        element: 'penjualan-air-galon-per-tahun',
			        data: elements,
			        xkey: 'y',
			        ykeys: ['a',],
			        labels: ['Penjualan',],
			        hideHover: 'auto',
			        resize: true
			    });
			} else {
				$("#penjualan-air-galon-per-tahun").append("<p>Data tidak ditemukan...</p>");
			}
		});
	}

	loadGrafikPenjualanHarian(init_cabang_id, init_tahun_penjualan, init_bulan_penjualan);
	
	$('#container-penjualan-air-galon-per-minggu').hide();
	$('#container-penjualan-air-galon-per-bulan').hide();
	$('#container-penjualan-air-galon-per-tahun').hide();

	$('#tampilkan-grafik-btn').click(function(){
		console.log("Tombol #tampilkan-grafik-btn diklik...");
		var cabang_id = $('#cabang-id').val();
		var tahun_penjualan = $('#tahun-penjualan').val();
		var bulan_penjualan = $("#bulan-penjualan").val();
		var periode_penjualan = $("#periode-penjualan").val();

		$.getScript('<?php echo base_url('assets/js/morris.min.js'); ?>');
		$.getScript('<?php echo base_url('assets/js/raphael.min.js'); ?>');

		if (periode_penjualan == "harian"){
			loadGrafikPenjualanHarian(cabang_id, tahun_penjualan, bulan_penjualan);
		} else if (periode_penjualan == "mingguan") {
			loadGrafikPenjualanMingguan(cabang_id, tahun_penjualan, bulan_penjualan);
		} else if (periode_penjualan == "bulanan") {
			loadGrafikPenjualanBulanan(cabang_id, tahun_penjualan);
		} else if (periode_penjualan == "tahunan") {
			loadGrafikPenjualanTahunan(cabang_id);
		}

		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});

	$('#periode-penjualan').change(function(){
		console.log("Periode penjualan diganti...");
		var periode_penjualan = $("#periode-penjualan").val();

		if (periode_penjualan == "harian"){
			$('#container-bulan-penjualan').show();
			$('#container-tahun-penjualan').show();
		} else if (periode_penjualan == "mingguan") {
			$('#container-bulan-penjualan').show();
			$('#container-tahun-penjualan').show();
		} else if (periode_penjualan == "bulanan") {
			$('#container-bulan-penjualan').hide();
			$('#container-tahun-penjualan').show();
		} else if (periode_penjualan == "tahunan") {
			$('#container-bulan-penjualan').hide();
			$('#container-tahun-penjualan').hide();
		}
	})
</script>

<?= $this->endSection() ?>
