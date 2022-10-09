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
                        Grafik Penjualan Air Galon per Bulan
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="morris-bar-chart"></div>
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

<!-- Bootstrap -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo base_url('assets/js/raphael.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/morris.min.js'); ?>"></script>
<script type="text/javascript">

	$.get("<?php echo base_url('master/penjualan-bulanan'); ?>/6/2020", function(data, status){
		jsonData = JSON.parse(data);
		elements = []
		for (elem in jsonData) {
			console.log(jsonData[elem])
			elements.push({y:jsonData[elem].bulan_penjualan, a:jsonData[elem].total_pembelian})
		}
		Morris.Bar({
	        element: 'morris-bar-chart',
	        data: elements,
	        xkey: 'y',
	        ykeys: ['a',],
	        labels: ['Penjualan Pusat',],
	        hideHover: 'auto',
	        resize: true
	    });
	});
</script>

<?= $this->endSection() ?>
