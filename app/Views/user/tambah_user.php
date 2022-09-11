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
                <h1 class="page-header">Data Master - Tambah User</h1>
            </div>
        </div>
 
        <!-- ... Your content goes here ... -->   

		<div class="row">
			<div class="col-lg-12">
			    <div class="panel panel-default">
			        <div class="panel-heading">
			            Form Tambah User
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
			                    <form role="form" method="POST" action="<?php echo base_url('user/add'); ?>">
			                        <div class="form-group">
			                            <label>Nama Lengkap</label>
			                            <input name="nama_lengkap" class="form-control" placeholder="Isi dengan nama lengkap Anda">
			                        </div>
			                        <div class="form-group">
			                            <label>Username</label>
			                            <input name="username" class="form-control" placeholder="Isi dengan username Anda">
			                        </div>
			                        <div class="form-group">
			                            <label>Password</label>
			                            <input type="password" name="password" class="form-control" placeholder="Isi dengan password Anda">
			                        </div>
			                        <div class="form-group">
			                            <label>E-Mail</label>
			                            <input name="email" class="form-control" placeholder="Isi dengan e-mail Anda">
			                        </div>
			                        <div class="form-group">
			                            <label>No Telepon</label>
			                            <input name="no_telp" class="form-control" placeholder="Isi dengan no telepon Anda">
			                        </div>
			                        <div class="form-group">
			                            <label>Jenis Akun</label>
			                            <select name="account_type" class="form-control">
			                                <option value="superadmin">superadmin</option>
			                                <option value="owner">owner</option>
			                                <option value="kepala_cabang">kepala cabang</option>
			                                <option value="operator">operator</option>
			                            </select>
			                        </div>
			                        <div class="form-group">
			                            <label>Status Akun</label>
			                            <select name="user_status" class="form-control">
			                                <option value="active">active</option>
			                                <option value="inactive">inactive</option>
			                            </select>
			                        </div>
			                        <input type="submit" class="btn btn-primary" value="Simpan" />
			                        <input type="reset" class="btn btn-warning" value="Reset" />
			                        <a href="<?php echo base_url('user'); ?>" class="btn btn-danger">Batal </a>
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
