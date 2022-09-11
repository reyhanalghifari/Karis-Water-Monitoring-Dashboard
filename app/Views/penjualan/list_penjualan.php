<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
 
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Master - List Penjualan</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   

		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Penjualan
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-karis-water">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Pelanggan</th>
                                        <th>Barang</th>
                                        <th>Tanggal Penjualan</th>
                                        <th>Harga Saat Pembelian</th>
                                        <th>Jumlah</th>
                                        <th>Total Pembelian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach ($datapenjualan as $penjualan) { ?>
                                    <tr class="odd gradeX">
                                        <td><?= $i ?></td>
                                        <td><?= $penjualan->nama_pelanggan ?></td>
                                        <td><?= $penjualan->nama_barang ?></td>
                                        <td><?= $penjualan->tanggal_penjualan ?></td>
                                        <td><?= $penjualan->harga_saat_dibeli ?></td> 
                                        <td><?= $penjualan->jumlah ?></td>
                                        <td><?= $penjualan->jumlah * $penjualan->harga_saat_dibeli ?></td>
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


