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
                <h1 class="page-header">Data Master - List Barang</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   

		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Barang
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <?php $form_tambah_barang_success_message = $session->getFlashData('form_tambah_barang_success_message');
                            if ($form_tambah_barang_success_message != NULL) { ?>
                            <div class="alert alert-success">
                                <?php echo $form_tambah_barang_success_message; ?>
                            </div>
                         <?php } ?>

                         <?php $form_edit_barang_success_message = $session->getFlashData('form_edit_barang_success_message');
                            if ($form_edit_barang_success_message != NULL) { ?>
                            <div class="alert alert-success">
                                <?php echo $form_edit_barang_success_message; ?>
                            </div>
                         <?php } ?>

                        <div class="table-responsive">
                            <a href="<?php echo base_url('barang/add'); ?>" class="btn btn-info">Tambah Barang Baru</a>
                            <br />
                            <br />
                            <table class="table table-striped table-bordered table-hover" id="dataTables-karis-water">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis</th>
                                        <th>Ukuran</th>
                                        <th>Harga</th>
                                        <th>Harga Jual</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach ($databarang as $barang) { ?>
                                    <tr class="odd gradeX">
                                        <td><?= $i ?></td>
                                        <td><?= $barang->nama_barang ?></td>
                                        <td><?= $barang->jenis ?></td>
                                        <td><?= $barang->ukuran ?></td>
                                        <td><?= $barang->harga ?></td>
                                        <td><?= $barang->harga_jual ?></td>
                                        <td class="center">
                                            <a href="<?php echo base_url('barang/edit/'.$barang->barang_id); ?>" class="btn btn-success">Edit</a>
                                            <a href="<?php echo base_url('barang/delete/'.$barang->barang_id); ?>" class="btn btn-danger">Delete</a>
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


