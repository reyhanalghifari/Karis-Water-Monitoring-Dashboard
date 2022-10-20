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
                <h1 class="page-header">Data Master - Tambah Cabang Distribusi</h1>
            </div>
        </div>
  
        <!-- ... Your content goes here ... -->   

		<div class="row">
			<div class="col-lg-12">
			    <div class="panel panel-default">
			        <div class="panel-heading">
			            Form Tambah Cabang Distribusi
			        </div>
			        <div class="panel-body">
			        	<?php $form_tambah_cabang_error_message = $session->getFlashData('form_tambah_cabang_error_message');
                            if ($form_tambah_cabang_error_message != NULL) { ?>
                            <div class="alert alert-danger">
                                <?php 
                                if (is_array($form_tambah_cabang_error_message)){
                                    echo "<ul>";
                                    foreach ($form_tambah_cabang_error_message as $message){
                                        echo "<li>$message</li>";
                                    }
                                    echo "</ul>";
                                } else {
                                    echo $form_tambah_cabang_error_message;
                                }
                                ?>
                            </div>
                         <?php } ?>
			            <div class="row">
			                <div class="col-lg-12">
			                    <form role="form" method="POST" action="<?php echo base_url('cabang/add'); ?>">
			                        <div class="form-group">
			                            <label>Nama Cabang</label>
			                           <input name="nama_cabang" class="form-control" placeholder="Isi dengan nama cabang">
			                        </div>
			                        <div class="form-group">
			                            <label>Kepala Cabang</label>
			                            <input name="kepala_cabang" class="form-control" placeholder="Isi dengan nama kepala cabang">
			                        </div>
			                        <div class="form-group">
			                            <label>Alamat Cabang</label>
			                            <input name="alamat_cabang" class="form-control" placeholder="Isi dengan alamat cabang">
			                        </div>
			                        <div class="form-group">
			                            <label>Email</label>
			                            <input name="email" class="form-control" placeholder="Isi dengan email cabang">
			                        </div>
			                        <div class="form-group">
			                            <label>No Telepon</label>
			                            <input name="no_telp" class="form-control" placeholder="Isi dengan no telepon cabang">
			                        </div>
			                        <div class="form-group">
			                            <label>Tipe Cabang</label>
			                            <select name="tipe_cabang" class="form-control">
			                                <option value="pusat">pusat</option>
			                                <option value="cabang">cabang</option>
			                            </select>
			                        </div>
			                        <input type="submit" class="btn btn-primary" value="Simpan" />
			                        <input type="reset" class="btn btn-warning" value="Reset" />
			                        <a href="<?php echo base_url('cabang'); ?>" class="btn btn-danger">Batal </a>
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
