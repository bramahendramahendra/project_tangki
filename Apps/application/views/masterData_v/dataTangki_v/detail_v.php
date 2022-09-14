<?php templateHeader($dataView); ?>


<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <?php $this->load->view('templates/breadcrumb_v', $dataView);?>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="<?=($dataDetail->kapasitas_bahan_bakar&&$dataDetail->kapasitas_bahan_bakar!=""&&$dataDetail->sisa_bahan_bakar&&$dataDetail->sisa_bahan_bakar!=""?'col-lg-7':'col-lg-12');?> col-md-12">
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
                        <!-- <?php echo "<pre>";var_dump($dataDetail);echo "</pre>";?> -->
                            <?=form_input(array('type' =>'hidden','name'=>'id','id'=>'id','value'=>(isset($dataDetail->id)&&$dataDetail->id!=""?$dataDetail->id:"") ));?>
                            <?=form_input(array('type' =>'hidden','name'=>'id_facility_management','id'=>'id_facility_management','value'=>(isset($dataDetail->id_facility_management)&&$dataDetail->id_facility_management!=""?$dataDetail->id_facility_management:"") ));?>
                            <?=form_input(array('type' =>'hidden','name'=>'id_gedung','id'=>'id_gedung','value'=>(isset($dataDetail->id_gedung)&&$dataDetail->id_gedung!=""?$dataDetail->id_gedung:"") ));?>
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
                            <p>
                            <?php if($dataDetail->kapasitas_bahan_bakar&&$dataDetail->kapasitas_bahan_bakar!="") : ?>
                                <?=($dataDetail->kapasitas_bahan_bakar&&$dataDetail->kapasitas_bahan_bakar!=""?$dataDetail->kapasitas_bahan_bakar." liter":'');?>
                            <?php endif;?>
                            </p>
                            <p>
                                <a href="javascript:void(0);" id="update-btn" class="btn btn-warning waves-effect waves-float btn-sm waves-green " rel="<?=($dataDetail->kapasitas_bahan_bakar&&$dataDetail->kapasitas_bahan_bakar!="")?'update':'create';?>" ><i class="zmdi zmdi-edit"></i> Update</a>
                            </p>
                            <!-- <hr> -->
                        </div>
                    </div>
                </div>
                <?php if($dataDetail->kapasitas_bahan_bakar&&$dataDetail->kapasitas_bahan_bakar!=""&&$dataDetail->sisa_bahan_bakar&&$dataDetail->sisa_bahan_bakar!=""): ?>
                    <div class="col-lg-5 col-md-12">
                        <div class="card">
                            <div class="header">
                            <h2><strong><?=$dataView['subTitlePage'][2]?></strong> <?=$dataView['subTitlePage'][3]?> </h2>
                            </div>
                            <div class="body">
                                <div id="chart-donut" class="c3_chart"></div>
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
                    ['data1', 22.5],
                    ['data2', 60],
                ],
                type: 'donut', // default type of chart
                colors: {
                    'data1': Aero.colors["red"],
                    'data2': Aero.colors["lime"],
                },
                names: {
                    // name of each serie
                    'data1': 'Open',
                    'data2': 'Close',
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

        $('#update-btn').off().click(function(e){
            var id_gedung = $('#id_gedung').val();
            var rel = $(this).attr('rel');
            // alert(rel);
            $.ajax({
                url  : '<?=$dataView['urlForm'];?>',
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
            e.preventDefault();
        });

    });
</script>


<?php templateFooter($dataView); ?>