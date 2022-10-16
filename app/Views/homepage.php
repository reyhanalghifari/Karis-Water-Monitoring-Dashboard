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

			<div class="col-lg-12">
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

			<div class="col-lg-12">
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
		</div>

		<div class="col-lg-12">
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


<!-- jQuery -->
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>


<!-- Morris Charts JavaScript -->
<script src="<?php echo base_url('assets/js/raphael.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/morris.min.js'); ?>"></script>
<script type="text/javascript">
	var init_cabang_id = $('#cabang-id').val();
	var init_tahun_penjualan = $('#tahun-penjualan').val();

	
	function loadGrafikPenjualan(cabang_id, tahun_penjualan) {
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

		$.get("<?php echo base_url('master/penjualan-mingguan'); ?>/"+cabang_id+"/"+tahun_penjualan, function(data, status){
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

	loadGrafikPenjualan(init_cabang_id, init_tahun_penjualan);
	
	$('#tampilkan-grafik-btn').click(function(){
		console.log("Tombol #tampilkan-grafik-btn diklik...");
		var cabang_id = $('#cabang-id').val();
		var tahun_penjualan = $('#tahun-penjualan').val();

		$('#penjualan-air-galon-per-minggu').empty("");
		$('#penjualan-air-galon-per-bulan').empty("");
		$('#penjualan-air-galon-per-tahun').empty("");

		$.getScript('<?php echo base_url('assets/js/morris.min.js'); ?>');
		$.getScript('<?php echo base_url('assets/js/raphael.min.js'); ?>');

		loadGrafikPenjualan(cabang_id, tahun_penjualan);
	})
</script>

<?= $this->endSection() ?>
