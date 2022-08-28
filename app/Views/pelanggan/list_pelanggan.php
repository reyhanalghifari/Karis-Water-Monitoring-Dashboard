<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
  
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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-karis-water">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Alamat Pelanggan</th>
                                        <th>No Telepon</th>
                                        <th>Email</th>
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
                                        <td class="center">
                                            <a href="<?php echo base_url('pelanggan/edit/'.$pelanggan->pelanggan_id); ?>" class="btn btn-success">Edit</a>
                                            <a href="<?php echo base_url('pelanggan/delete/'.$pelanggan->pelanggan_id); ?>" class="btn btn-danger">Delete</a>
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


