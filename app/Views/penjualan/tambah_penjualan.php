<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
 
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Catat Penjualan</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   

		<div class="row">
			<div class="col-lg-12">
			    <div class="panel panel-default">
			        <div class="panel-heading">
			            Form Penjualan
			        </div>
			        <div class="panel-body">
			            <div class="row">
			                <div class="col-lg-12">
			                    <form role="form" method="POST" action="<?php echo base_url('penjualan/add'); ?>">
			                        <div class="form-group">
			                            <label>Pelanggan</label>
			                            <select name="pelanggan_id" class="form-control">
			                            	<option value="3">test12345</option>
			                            </select>
			                        </div>
			                        <div class="form-group">
			                            <label>Barang</label>
			                            <select name="barang_id" class="form-control">
			                            	<option value="1">Air Mineral Galon</option>
			                            </select>
			                        </div>
			                        <!-- <div class="form-group">
			                            <label>Tanggal Penjualan</label>
			                            <input name="tanggal_penjualan" class="form-control" placeholder="Isi dengan tanggal penjualan">
			                        </div>
			                        <div class="form-group">
			                            <label>Harga Saat Dibeli</label>
			                            <input name="harga_saat_dibeli" class="form-control" placeholder="Isi dengan harga">
			                        </div> -->
			                        <div class="form-group">
			                            <label>Jumlah</label>
			                            <input name="jumlah" class="form-control" placeholder="Isi dengan jumlah pembelian">
			                        </div>
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

<?= $this->endSection() ?>
