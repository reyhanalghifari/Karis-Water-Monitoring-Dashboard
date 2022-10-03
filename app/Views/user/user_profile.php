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
                <h1 class="page-header">User Profile</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   

		<div class="row">
			<div class="col-lg-12">
			    <div class="panel panel-default">
			        <div class="panel-heading">
			            Form Edit User Profile
			        </div>
			        <div class="panel-body">
			            <div class="row">
			                <div class="col-lg-12">
								<?php $login_form_success_message = $session->getFlashData('login_form_success_message');
	                            if ($login_form_success_message != NULL) { ?>
	                            <div class="alert alert-success">
	                                <?php echo $login_form_success_message; ?>
	                            </div>
								<?php } ?>

								<?php $login_form_error_message = $session->getFlashData('login_form_error_message');
	                            if ($login_form_error_message != NULL) { ?>
	                            <div class="alert alert-danger">
	                                <?php
	                                if (is_array($login_form_error_message)){
	                                    echo "<ul>";
	                                    foreach ($login_form_error_message as $message){
	                                        echo "<li>$message</li>";
	                                    }
	                                    echo "</ul>";
	                                } else {
	                                    echo $login_form_error_message;
	                                }
	                                ?>
	                            </div>
	                            <?php } ?>
			                    <form role="form" method="POST" action="<?php echo base_url('user-profile'); ?>">
			                        <div class="form-group">
			                            <label>Nama Lengkap</label>
			                            <input name="nama_lengkap" class="form-control" placeholder="Isi dengan lengkap Anda" value="<?php echo $user->nama_lengkap; ?>">
		                        	    <input name="user_id" type="hidden" class="form-control" placeholder="Isi dengan lengkap Anda" value="<?php echo $user->user_id; ?>">
			                        </div>
			                        <div class="form-group">
			                            <label>Username</label>
			                            <input name="username" class="form-control" placeholder="Isi dengan username Anda" value="<?php echo $user->username; ?>">
			                        </div>
			                        <div class="form-group">
			                            <label>E-Mail</label>
			                            <p class="form-control-static"><?php echo $user->email; ?></p>
			                        </div>
			                        <div class="form-group">
			                            <label>Account Type</label>
			                            <p class="form-control-static"><?php echo $user->account_type; ?></p>
			                        </div>
			                        <div class="form-group">
			                            <label>User Status</label>
			                            <p class="form-control-static"><?php echo $user->user_status; ?></p>
			                        </div>
			                        <div class="form-group">
			                            <label>Akun ditempatkan di Cabang?</label>
			                            <p class="form-control-static"><?php echo ($session->get('tipe_cabang') != null ? "Ya": "Tidak ditempatkan dimanapun"); ?></p>
			                        </div>
			                        <input type="submit" class="btn btn-success" value="Simpan" />
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
