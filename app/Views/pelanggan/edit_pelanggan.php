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
                <h1 class="page-header">Data Master - Edit Pelanggan</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   

		<div class="row">
			<div class="col-lg-12">
			    <div class="panel panel-default">
			        <div class="panel-heading">
			            Form Edit Pelanggan
			        </div>
			        <div class="panel-body">
			        	<?php $form_edit_pelanggan_error_message = $session->getFlashData('form_edit_pelanggan_error_message');
                            if ($form_edit_pelanggan_error_message != NULL) { ?>
                            <div class="alert alert-danger">
                                <?php 
                                if (is_array($form_edit_pelanggan_error_message)){
                                    echo "<ul>";
                                    foreach ($form_edit_pelanggan_error_message as $message){
                                        echo "<li>$message</li>";
                                    }
                                    echo "</ul>";
                                } else {
                                    echo $form_edit_pelanggan_error_message;
                                }
                                ?>
                            </div>
                         <?php } ?>
			            <div class="row">
			                <div class="col-lg-12">
			                    <form role="form" method="POST" action="<?php echo base_url('pelanggan/edit'); ?>">
			                        <div class="form-group">
			                            <label>Nama Pelanggan</label>
			                            <input name="nama_pelanggan" class="form-control" placeholder="Isi dengan nama pelanggan" value="<?= $pelanggan->nama_pelanggan ?>"/>
			                            <input type="hidden" name="pelanggan_id" class="form-control" placeholder="Isi dengan nama pelanggan" value="<?= $pelanggan->pelanggan_id ?>"/>
			                        </div>
			                        <div class="form-group">
			                            <label>Alamat Pelanggan</label>
			                            <input name="alamat_pelanggan" class="form-control" placeholder="Isi dengan alamat pelanggan" value="<?= $pelanggan->alamat_pelanggan ?>"/>
			                        </div>
			                        <div class="form-group">
			                            <label>No Telepon</label>
			                            <input name="no_telepon" class="form-control" placeholder="Isi dengan no telepon pelanggan" value="<?= $pelanggan->no_telepon ?>"/> 
			                        </div>
			                        <div class="form-group">
			                            <label>Email</label>
			                            <input name="email" class="form-control" placeholder="Isi dengan email pelanggan" value="<?= $pelanggan->email ?>"/>
			                        </div>
			                        <div class="form-group">
			                            <label>Jenis Pelanggan</label>
			                            <select name="jenis_pelanggan" class="form-control">
			                                <?php if ($session->get('tipe_cabang') == "pusat") { ?>
			                                <option <?php if ($pelanggan->jenis_pelanggan == "cabang") { echo "selected"; } ?> value="cabang">cabang</option>
			                                <option <?php if ($pelanggan->jenis_pelanggan == "eceran") { echo "selected"; } ?> value="eceran">eceran</option>
			                                <?php } else { ?>
			                                <option <?php if ($pelanggan->jenis_pelanggan == "eceran") { echo "selected"; } ?> value="eceran">eceran</option>
			                                <?php } ?>
			                            </select>
			                        </div>      
			                       <input type="submit" class="btn btn-primary" value="Simpan" />
			                       <a href="<?php echo base_url('pelanggan'); ?>" class="btn btn-danger">Batal </a>
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
