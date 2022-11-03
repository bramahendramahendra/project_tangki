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
                                    <?php // echo "<pre>"; var_dump($dataList); echo "</pre>";?>
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="30%">Facility Management</th>
                                                <th width="25%">Gedung</th>
                                                <th width="10%">Kapasitas Bahan Bakar</th>
                                                <th width="10%">Sisa Bahan Bakar</th>
                                                <th width="10%">Request Bahan Bakar</th>
                                                <!-- <th width="15%">Status</th> -->
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="30%">Facility Management</th>
                                                <th width="25%">Gedung</th>
                                                <th width="10%">Kapasitas Bahan Bakar</th>
                                                <th width="10%">Sisa Bahan Bakar</th>
                                                <th width="10%">Request Bahan Bakar</th>
                                                <!-- <th width="15%">Status</th> -->
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php // echo "<pre>"; var_dump($dataList); echo "</pre>"; ?>
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
                                                    <td data-title="Status"><?=($value->jumlah_request&&$value->jumlah_request!=""?$value->jumlah_request:"-");?></td>
                                                    <td data-title="Aksi">
                                                        <a href="javascript:void(0);" id="approve-btn" class="btn btn-success waves-effect waves-float btn-sm waves-green update-btn" rel_id_gedung="<?= $value->id_gedung?>" rel_status="1"><i class="zmdi zmdi-check"></i></a>
                                                        <a href="javascript:void(0);" id="approve-btn" class="btn btn-danger waves-effect waves-float btn-sm waves-green update-btn" rel_id_gedung="<?= $value->id_gedung?>" rel_status="2"><i class="zmdi zmdi-close"></i></a>
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

<script>
    $(document).ready(function(){
        $('#approve-btn').off().click(function(e){
            // var id_gedung = $('#id_gedung').val();
            var id_gedung = $(this).attr('rel_id_gedung');
            var status = $(this).attr('rel_status');
            // var status = $('#status').val();
            // alert(id_gedung);
            // alert(status);
            // if(status != 1) {
            $.ajax({
                url  : '<?=$dataView['urlApprove'];?>',
                data : 'status='+status+'&id_gedung='+id_gedung,
                beforeSend	:function(){
                    $('.page-loader-wrapper').show();
                },
                success: function(data){
                    // $('#main-content').html(data);
                    $('#generalModal .modal-dialog').addClass('modal-lg');
                    $('#generalModal .modal-dialog .modal-content').html(data);
                    $('#generalModal').modal({'backdrop':'static'});
                    $('#generalModal').on('hide.bs.modal', function (e) {
                        location.reload();
                    })
                    $('.page-loader-wrapper').hide();
                }
            });
            // } else {
                // alert('Anda sedang dalam proses pengajuan request bahan bakar.');
            // }
           
            e.preventDefault();
        });

    });
</script>

<?php templateFooter($dataView); ?>