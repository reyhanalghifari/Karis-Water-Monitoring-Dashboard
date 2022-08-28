<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
 
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Master - List User</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   

		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List User
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-karis-water"> 
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Username</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Tipe Akun</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach ($users as $user) { ?>
                                    <tr class="odd gradeX">
                                        <td><?= $i ?></td>
                                        <td><?= $user->username ?></td>
                                        <td><?= $user->nama_lengkap ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><?= $user->no_telp ?></td>
                                        <td><?= $user->account_type ?></td>
                                        <td class="center"><?= $user->user_status ?></td>
                                        <td class="center">
                                            <a href="<?php echo base_url('user/edit/'.$user->user_id); ?>" class="btn btn-success">Edit</a>
                                            <a href="<?php echo base_url('user/delete/'.$user->user_id); ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
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


