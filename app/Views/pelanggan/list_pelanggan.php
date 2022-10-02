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
                <h1 class="page-header">Data Master - List Pelanggan</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   

		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Pelanggan
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <?php $form_tambah_pelanggan_success_message = $session->getFlashData('form_tambah_pelanggan_success_message');
                            if ($form_tambah_pelanggan_success_message != NULL) { ?>
                            <div class="alert alert-success">
                                <?php echo $form_tambah_pelanggan_success_message; ?>
                            </div>
                         <?php } ?>

                         <?php $form_edit_pelanggan_success_message = $session->getFlashData('form_edit_pelanggan_success_message');
                            if ($form_edit_pelanggan_success_message != NULL) { ?>
                            <div class="alert alert-success">
                                <?php echo $form_edit_pelanggan_success_message; ?>
                            </div>
                         <?php } ?>

                         <?php $delete_pelanggan_success_message = $session->getFlashData('delete_pelanggan_success_message');
                            if ($delete_pelanggan_success_message != NULL) { ?>
                            <div class="alert alert-success">
                                <?php echo $delete_pelanggan_success_message; ?>
                            </div>
                         <?php } ?>

                        <div class="table-responsive">
                            <a href="<?php echo base_url('pelanggan/add'); ?>" class="btn btn-info">Tambah Pelanggan Baru</a>
                            <br />
                            <br />
                            <!-- Modal -->
                            <div class="modal fade" id="delete-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Hapus Pelanggan</h4>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin akan menghapus pelanggan ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <a id="delete-form-button-yes" href="#" class="btn btn-danger">Ya, hapus pelanggan ini</a>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <table class="table table-striped table-bordered table-hover" id="dataTables-karis-water">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Alamat</th>
                                        <th>No Telepon</th>
                                        <th>Email</th>
                                        <th>Jenis Pelanggan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach ($datapelanggan as $pelanggan) { ?>
                                    <tr class="odd gradeX">
                                        <td><?= $i ?></td>
                                        <td><?= $pelanggan->nama_pelanggan ?></td>
                                        <td><?= $pelanggan->alamat_pelanggan ?></td>
                                        <td><?= $pelanggan->no_telepon ?></td>
                                        <td><?= $pelanggan->email ?></td> 
                                        <td><?= $pelanggan->jenis_pelanggan ?></td> 
                                        <td class="center">
                                            <a href="<?php echo base_url('pelanggan/edit/'.$pelanggan->pelanggan_id); ?>" class="btn btn-success">Edit</a>
                                            <button data-toggle="modal" data-target="#delete-form" data-url="<?php echo base_url('pelanggan/delete/'.$pelanggan->pelanggan_id); ?>" class="btn btn-danger btn-delete">Hapus</button>
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

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
</script>

<?= $this->endSection() ?>

<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>

<script type="text/javascript">
    // popover demo
    $("[data-toggle=popover]").popover();
</script>


