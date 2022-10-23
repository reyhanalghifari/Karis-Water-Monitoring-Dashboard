<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<?php

$session = \Config\Services::session();
 
?>
 
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Catat Penjualan ke Cabang</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   

		<div class="row">
			<div class="col-lg-12">
			    <div class="panel panel-default">
			        <div class="panel-heading">
			            Form Penjualan untuk Cabang
			        </div>
			        <div class="panel-body">
			        	<?php $form_penjualan_error_message = $session->getFlashData('form_penjualan_error_message');
                            if ($form_penjualan_error_message != NULL) { ?>
                            <div class="alert alert-danger">
                                <?php 
                                if (is_array($form_penjualan_error_message)){
                                    echo "<ul>";
                                    foreach ($form_penjualan_error_message as $message){
                                        echo "<li>$message</li>";
                                    }
                                    echo "</ul>";
                                } else {
                                    echo $form_penjualan_error_message;
                                }
                                ?>
                                </div>
                         <?php } ?>
			            <div class="row">
			                <div class="col-lg-12">
			                    <form role="form" method="POST" action="<?php echo base_url('penjualan/add'); ?>">
			                        <div class="form-group">
			                            <label>Pelanggan</label>
			                            <select name="pelanggan_id" class="form-control">
			                            	<?php foreach ($data_pelanggan as $pelanggan) { ?>
			                            	<option value="<?= $pelanggan->pelanggan_id?>"><?= $pelanggan->nama_pelanggan ?></option>
			                            	<?php } ?>
			                            </select>
			                        </div>
			                        <div class="form-group">
			                            <label>Barang</label>
			                            <select id="barang-id" name="barang_id" class="form-control">
			                            	<?php foreach ($data_barang as $barang) { ?>
			                            	<option <?php if (strpos($barang->nama_barang, "alon") !== false ) { echo "selected"; } ?> value="<?= $barang->barang_id?>"><?= $barang->nama_barang ?></option>
			                            	<?php } ?>
			                            </select>
			                        </div>
			                        <!-- <div class="form-group">
			                            <label>Jenis Transaksi</label>
			                            <select name="jenis_transaksi" class="form-control">
			                            	<option value="kas">kas</option>
			                            	<option value="piutang">piutang</option>
			                            </select>
			                        </div> -->
			                        <div class="form-group">
			                            <label>Harga Saat Dibeli</label>
			                            <input id="harga-saat-dibeli" name="harga_saat_dibeli" class="form-control" value="" />
			                        </div> 
			                        <div class="form-group">
			                            <label>Jumlah</label>
			                            <input name="jumlah" class="form-control" placeholder="Isi dengan jumlah pembelian" />
			                        </div>
			                        <input type="hidden" name="jenis_transaksi" value="kas" />
			                        <input type="submit" class="btn btn-primary" value="Simpan" />
			                        <input type="reset" class="btn btn-warning" value="Reset" />
			                        <a href="<?php echo base_url('penjualan'); ?>" class="btn btn-danger">Batal </a>
			                    </form>
			                </div>
			                <!-- /.col-lg-6 (nested) -->
			                
			            </div>
			            <!-- /.row (nested) -->
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
<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>

<script type="text/javascript">
	function changeHargaBarang(barang_id){
		$.get("<?php echo base_url('master/barang'); ?>/"+barang_id, function(data, status){
			console.log(data);
			jsonObj = JSON.parse(data);
			$("#harga-saat-dibeli").val(jsonObj.harga);
		});
	}

	$(function() {
		let barang_id = $("#barang-id").val();
		changeHargaBarang(barang_id);
	});

	$( "#barang-id" ).change(function(){
		changeHargaBarang(this.value);	
	});
</script>

<?= $this->endSection() ?>
