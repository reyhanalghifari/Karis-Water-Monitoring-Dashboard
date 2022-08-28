<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
 
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Master - List Cabang Distribusi</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   

		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Cabang Distribusi
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <a href="<?php echo base_url('cabang/add'); ?>" class="btn btn-info">Tambah Cabang Baru</a>
                            <br />
                            <br />
                            <table class="table table-striped table-bordered table-hover" id="dataTables-karis-water">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Cabang</th>
                                        <th>Kepala Cabang</th>
                                        <th>Alamat Cabang</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach ($datacabang as $cabang) { ?>
                                    <tr class="odd gradeX">
                                        <td><?= $i ?></td>
                                        <td><?= $cabang->nama_cabang ?></td>
                                        <td><?= $cabang->kepala_cabang ?></td>
                                        <td><?= $cabang->alamat_cabang ?></td>
                                        <td><?= $cabang->email ?></td>
                                        <td><?= $cabang->no_telp ?></td>
                                        <td class="center">
                                            <a href="<?php echo base_url('cabang/edit/'.$cabang->cabang_id); ?>" class="btn btn-success">Edit</a>
                                            <a href="<?php echo base_url('cabang/delete/'.$cabang->cabang_id); ?>" class="btn btn-danger">Delete</a>
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


