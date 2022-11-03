<?php templateHeader($dataView); ?>

<?php
    $temp_kapsitasBahanBakar = ($dataDetail->kapasitas_bahan_bakar&&$dataDetail->kapasitas_bahan_bakar!=""?$dataDetail->kapasitas_bahan_bakar:"0"); 
    $temp_panjang = ($dataDetail->panjang&&$dataDetail->panjang!=""?$dataDetail->panjang:"0"); 
    $temp_lebar = ($dataDetail->lebar&&$dataDetail->lebar!=""?$dataDetail->lebar:"0"); 
    $temp_tinggi = ($dataDetail->tinggi&&$dataDetail->tinggi!=""?$dataDetail->tinggi:"0"); 
    $temp_volume = $temp_panjang*$temp_lebar*$temp_tinggi;
    // echo $temp_panjang."<br>";
    // echo var_dump(array($temp_volume, $temp_panjang, $temp_lebar, $temp_tinggi));
    $temp_liter = $temp_volume / 1000;
    $temp_sisa = $temp_kapsitasBahanBakar - $temp_liter;

    $temp_persen_digunakan = $temp_liter/$temp_kapsitasBahanBakar*100;
    $temp_persen_sisa = $temp_sisa/$temp_kapsitasBahanBakar*100;
?>

<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <?php $this->load->view('templates/breadcrumb_v', $dataView);?>
        <div class="container-fluid">
            <?php $this->load->view('templates/alerts_v');?>
            <div class="row clearfix">
                <div class="<?=($dataDetail->kapasitas_bahan_bakar&&$dataDetail->kapasitas_bahan_bakar!=""&&$temp_persen_sisa&&$temp_persen_sisa!=""&&$temp_persen_digunakan&&$temp_persen_digunakan!=""?'col-lg-7':'col-lg-12');?> col-md-12">    
                    <div class="card">
                        <div class="header">
                            <h2><strong><?=$dataView['subTitlePage'][0]?></strong> <?=$dataView['subTitlePage'][1]?> </h2>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a href="<?=$dataView['urlBack'];?>" role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                        <?php echo "<pre>";var_dump($dataDetail);echo "</pre>";?>
                            <?=form_input(array('type' =>'hidden','name'=>'id','id'=>'id','value'=>(isset($dataDetail->id)&&$dataDetail->id!=""?$dataDetail->id:"") ));?>
                            <?=form_input(array('type' =>'hidden','name'=>'id_facility_management','id'=>'id_facility_management','value'=>(isset($dataDetail->id_facility_management)&&$dataDetail->id_facility_management!=""?$dataDetail->id_facility_management:"") ));?>
                            <?=form_input(array('type' =>'hidden','name'=>'id_gedung','id'=>'id_gedung','value'=>(isset($dataDetail->id_gedung)&&$dataDetail->id_gedung!=""?$dataDetail->id_gedung:"") ));?>
                            <?=form_input(array('type' =>'hidden','name'=>'status','id'=>'status','value'=>(isset($dataDetail->status)&&$dataDetail->status!=""?$dataDetail->status:"") ));?>
                            <small class="text-muted">Facility Management: </small>
                            <p><?=($dataDetail->facility_management&&$dataDetail->facility_management!=""?$dataDetail->facility_management:"-");?></p>
                            <hr>
                            <small class="text-muted">Gedung: </small>
                            <p><?=($dataDetail->gedung&&$dataDetail->gedung!=""?$dataDetail->gedung:"-");?></p>
                            <hr>
                            <small class="text-muted">Lokasi: </small>
                            <p><?=($dataDetail->lokasi&&$dataDetail->lokasi!=""?$dataDetail->lokasi:"-");?></p>
                            <hr>
                            <small class="text-muted">Jenis Tangki: </small>
                            <p><?=($dataDetail->jenis_tangki&&$dataDetail->jenis_tangki!=""?$dataDetail->jenis_tangki:"-");?></p>
                            <hr>
                            <small class="text-muted">Kapasitas Bahan Bakar: </small>
                            <p><?=($dataDetail->kapasitas_bahan_bakar&&$dataDetail->kapasitas_bahan_bakar!=""?$dataDetail->kapasitas_bahan_bakar." Liter":"-");?></p>
                            <hr>
                          
                            <small class="text-muted">Bahan Bakar digunakan: </small>
                            <p><?=($temp_liter&&$temp_liter!=""?$temp_liter:"-");?> Liter</p>
                            <hr>
                            <small class="text-muted">Sisa Bahan Bakar: </small>
                            <p><?=($temp_sisa&&$temp_sisa!=""?$temp_sisa:"-");?> Liter</p>
                            <!-- <hr> -->
                        </div>
                    </div>
                </div>
                <?php if($dataDetail->kapasitas_bahan_bakar&&$dataDetail->kapasitas_bahan_bakar!=""&&$temp_persen_sisa&&$temp_persen_sisa!=""&&$temp_persen_digunakan&&$temp_persen_digunakan!=""): ?>
                    <div class="col-lg-5 col-md-12">
                        <div class="card">
                            <div class="header">
                            <h2><strong><?=$dataView['subTitlePage'][2]?></strong> <?=$dataView['subTitlePage'][3]?> </h2>
                            </div>
                            <div class="body">
                                <div id="chart-donut" class="c3_chart"></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="body">
                                <small class="text-muted">Maksimal Request Bahan Bakar: </small>
                                <p>
                                    <?=($temp_liter&&$temp_liter!=""?$temp_liter:"-");?> Liter 
                                    <a href="javascript:void(0);" id="request-btn" class="btn btn-warning waves-effect waves-float btn-sm waves-green " rel="" ><i class="zmdi zmdi-edit"></i> Request</a>
                                </p>
                                <p>
                                   
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            </div>
            <div class="row clearfix">
                <div class="col-sm-12 offset-sm-12" align="right">
                    <a href="<?=$dataView['urlBack'];?>" role="button" class="btn btn-raised btn-warning btn-round waves-effect">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        var chart = c3.generate({
            bindto: '#chart-donut', // id of chart wrapper
            data: {
                columns: [
                    // each columns data
                    ['data1', <?=$temp_persen_digunakan?>],
                    ['data2', <?=$temp_persen_sisa?>],
                ],
                type: 'donut', // default type of chart
                colors: {
                    'data1': Aero.colors["red"],
                    'data2': Aero.colors["lime"],
                },
                names: {
                    // name of each serie
                    'data1': 'Digunakan',
                    'data2': 'Sisa',
                }
            },
            axis: {
            },
            legend: {
                show: true, //hide legend
            },
            padding: {
                bottom: 0,
                top: 0
            },
            donut: {
                title: "<?=($dataDetail->kapasitas_bahan_bakar&&$dataDetail->kapasitas_bahan_bakar!=""?$dataDetail->kapasitas_bahan_bakar." liter":"");?>"
            }
        });

        $('#request-btn').off().click(function(e){
            var id_gedung = $('#id_gedung').val();
            var rel = $(this).attr('rel');
            var status = $('#status').val();
            // alert(status);
            if(status != 1) {
                $.ajax({
                    url  : '<?=$dataView['urlFormRequest'];?>',
                    data : 'pages='+rel+'&id_gedung='+id_gedung,
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
            } else {
                alert('Anda sedang dalam proses pengajuan request bahan bakar.');
            }
           
            e.preventDefault();
        });

    });
</script>


<?php templateFooter($dataView); ?>