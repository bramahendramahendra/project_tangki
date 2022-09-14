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
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="30%">Facility Management</th>
                                                <th width="40%">Gedung</th>
                                                <th width="15%">Kapasitas Bahan Bakar</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="30%">Facility Management</th>
                                                <th width="40%">Gedung</th>
                                                <th width="15%">Kapasitas Bahan Bakar</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $no=1;?>
                                            <?php foreach ($dataList as $key => $value) : ?>
                                                <tr>
                                                    <td data-title="No"><?=$no++;?></td>
                                                    <td data-title="Facility Management"><?=($value->facility_management&&$value->facility_management!=""?$value->facility_management:"-");?></td>
                                                    <td data-title="Gedung"><?=($value->gedung&&$value->gedung!=""?$value->gedung:"-");?></td>
                                                    <td data-title="Kapasitas Bahan Bakar"><?=($value->kapasitas_bahan_bakar&&$value->kapasitas_bahan_bakar!=""?$value->kapasitas_bahan_bakar:"-");?></td>
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