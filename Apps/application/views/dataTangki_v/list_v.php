<?php templateHeader($dataView); ?>

<!-- Main Content -->
<section class="content" id="main-content">
    <div class="body_scroll">
        <?php $this->load->view('templates/breadcrumb_v', $dataView);?>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h2><strong><?=$dataView['subTitlePage'][0]?></strong> <?=$dataView['subTitlePage'][1]?> </h2>
                                </div>
                            </div>
                        </div>
                        <?php $this->load->view('templates/alerts_v');?>
                        <div class="body">
                            <div class="table-responsive">
                                <?=form_open($dataView['urlList'], 'id="formList"');?>
                                    <?php echo "<pre>"; var_dump($dataList); echo "</pre>";?>
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="30%">Facility Management</th>
                                                <th width="40%">Gedung</th>
                                                <th width="15%">Kapasitas Bahan Bakar</th>
                                                <th width="15%">Sisa Bahan Bakar</th>
                                                <th width="15%">Status</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="30%">Facility Management</th>
                                                <th width="40%">Gedung</th>
                                                <th width="15%">Kapasitas Bahan Bakar</th>
                                                <th width="15%">Sisa Bahan Bakar</th>
                                                <th width="15%">Status</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $no=1;?>
                                            <?php foreach ($dataList as $key => $value) : ?>
                                                <?php
                                                    $temp_kapsitasBahanBakar = ($value->kapasitas_bahan_bakar&&$value->kapasitas_bahan_bakar!=""?$value->kapasitas_bahan_bakar:"0"); 
                                                    $temp_panjang = ($value->panjang&&$value->panjang!=""?$value->panjang:"0"); 
                                                    $temp_lebar = ($value->lebar&&$value->lebar!=""?$value->lebar:"0"); 
                                                    $temp_tinggi = ($value->tinggi&&$value->tinggi!=""?$value->tinggi:"0"); 
                                                    $temp_volume = $temp_panjang*$temp_lebar*$temp_tinggi;
                                                    // echo $temp_panjang."<br>";
                                                    // echo var_dump(array($temp_volume, $temp_panjang, $temp_lebar, $temp_tinggi));
                                                    $temp_liter = $temp_volume / 1000;
                                                    $temp_sisa = $temp_kapsitasBahanBakar - $temp_liter;
                                                ?>
                                                <tr>
                                                    <td data-title="No"><?=$no++;?></td>
                                                    <td data-title="Facility Management"><?=($value->facility_management&&$value->facility_management!=""?$value->facility_management:"-");?></td>
                                                    <td data-title="Gedung"><?=($value->gedung&&$value->gedung!=""?$value->gedung:"-");?></td>
                                                    <td data-title="Kapasitas Bahan Bakar"><?=($value->kapasitas_bahan_bakar&&$value->kapasitas_bahan_bakar!=""?$value->kapasitas_bahan_bakar:"-");?></td>
                                                    <td data-title="Sisa Bahan Bakar"><?=($temp_sisa&&$temp_sisa!=""?$temp_sisa:"-");?></td>
                                                    <td data-title="Status"><?=($value->nama_status&&$value->nama_status!=""?$value->nama_status:"-");?></td>
                                                    <td data-title="Aksi">
                                                        <a href="<?=$dataView['urlDetail'].'/'.$value->id_gedung;?>" class="btn btn-info waves-effect waves-float btn-sm waves-green update-btn"><i class="zmdi zmdi-file-text"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                <?=form_close()?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php templateFooter($dataView); ?>