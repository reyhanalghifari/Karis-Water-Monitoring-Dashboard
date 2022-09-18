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
                <h1 class="page-header">Data Master - Edit Barang</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   
 
		<div class="row">
			<div class="col-lg-12">
			    <div class="panel panel-default">
			        <div class="panel-heading">
			            Form Edit Barang
			        </div>
			        <div class="panel-body">
			        	<?php $form_edit_barang_error_message = $session->getFlashData('form_edit_barang_error_message');
                            if ($form_edit_barang_error_message != NULL) { ?>
                            <div class="alert alert-danger">
                                <?php 
                                if (is_array($form_edit_barang_error_message)){
                                    echo "<ul>";
                                    foreach ($form_edit_barang_error_message as $message){
                                        echo "<li>$message</li>";
                                    }
                                    echo "</ul>";
                                } else {
                                    echo $form_edit_barang_error_message;
                                }
                                ?>
                            </div>
                         <?php } ?>
			            <div class="row">
			                <div class="col-lg-12">
			                    <form role="form" method="POST" action="<?php echo base_url('barang/edit'); ?>">
			                        <div class="form-group">
			                            <label>Nama Barang</label>
			                            <input name="nama_barang" class="form-control" placeholder="Isi dengan nama barang" value="<?php echo $barang->nama_barang ?>"/>
			                            <input type="hidden" name="barang_id" class="form-control" placeholder="Isi dengan nama barang" value="<?= $barang->barang_id ?>"/>
			                        </div>
			                        <div class="form-group">
			                            <label>Jenis</label>
			                            <input name="jenis" class="form-control" placeholder="Isi dengan jenis barang" value="<?= $barang->jenis ?>"/>
			                        </div>
			                        <div class="form-group">
			                            <label>Ukuran</label>
			                            <select name="ukuran" class="form-control">
			                                <option <?php if ($barang->ukuran == "19 Liter") { echo "selected"; } ?> value="19 Liter">19 Liter</option>
			                                <option <?php if ($barang->ukuran == "600ML") { echo "selected"; } ?> value="600ML">600 ML</option>
			                                <option <?php if ($barang->ukuran == "220ML") { echo "selected"; } ?> value="220ML">220 ML</option>
			                            </select>
			                        </div>
			                        <div class="form-group">
			                            <label>Harga</label>
			                            <input name="harga" class="form-control" placeholder="Isi dengan harga barang" value="<?= $barang->harga ?>"/>
			                        </div> 
			                        <div class="form-group">
			                            <label>Harga Jual</label>
			                            <input name="harga_jual" class="form-control" placeholder="Isi dengan harga jual barang" value="<?= $barang->harga_jual ?>"/> 
			                        </div>     
			                       <input type="submit" class="btn btn-primary" value="Simpan" />
			                       <a href="<?php echo base_url('barang'); ?>" class="btn btn-danger">Batal </a>
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
