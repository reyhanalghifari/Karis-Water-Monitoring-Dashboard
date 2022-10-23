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
                <h1 class="page-header">Administrasi - Tambah Penempatan Pengguna di Cabang</h1>
            </div>
        </div>
 
        <!-- ... Your content goes here ... -->   

		<div class="row">
			<div class="col-lg-12">
			    <div class="panel panel-default">
			        <div class="panel-heading">
			            Form Tambah Penempatan Pengguna di Cabang
			        </div>
			        <div class="panel-body">
			        	<?php $form_tambah_user_error_message = $session->getFlashData('form_tambah_user_error_message');
                            if ($form_tambah_user_error_message != NULL) { ?>
                            <div class="alert alert-danger">
                                <?php 
                                if (is_array($form_tambah_user_error_message)){
                                    echo "<ul>";
                                    foreach ($form_tambah_user_error_message as $message){
                                        echo "<li>$message</li>";
                                    }
                                    echo "</ul>";
                                } else {
                                    echo $form_tambah_user_error_message;
                                }
                                ?>
                                </div>
                         <?php } ?>
			            <div class="row">
			                <div class="col-lg-12">
			                    <form role="form" method="POST" action="<?php echo base_url('user-cabang/add'); ?>">
			                        <div class="form-group">
			                            <label>Pengguna</label>
			                            <select name="user_id" class="form-control">
			                                <?php foreach ($users as $user) { ?>
			                                <option value="<?= $user->user_id ?>"><?= $user->username ?></option>
			                            	<?php } ?>
			                            </select>
			                        </div>
			                        <div class="form-group">
			                            <label>Cabang</label>
			                            <select name="cabang_id" class="form-control">
			                            	<?php foreach ($list_cabang as $cabang) { ?>
			                                <option value="<?= $cabang->cabang_id ?>"><?= $cabang->nama_cabang ?></option>
			                            	<?php } ?>
			                            </select>
			                        </div>
			                        <input type="submit" class="btn btn-primary" value="Simpan" />
			                        <input type="reset" class="btn btn-warning" value="Reset" />
			                        <a href="<?php echo base_url('user-cabang'); ?>" class="btn btn-danger">Batal </a>
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
