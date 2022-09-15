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
                                <div class="col-lg-2" align="right">
                                    <button type="button" class="btn btn-primary" id="create-btn"><i class="zmdi zmdi-plus-square"></i> Tambah</button>
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
                                                <th width="80%">Jenis Tangki</th>
                                                <th width="15%">Panjang</th>
                                                <th width="15%">Lebar</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="50%">Jenis Tangki</th>
                                                <th width="15%">Panjang</th>
                                                <th width="15%">Lebar</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $no=1;?>
                                            <?php foreach ($dataList as $key => $value) : ?>
                                                <tr>
                                                    <td data-title="No"><?=$no++;?></td>
                                                    <td data-title="Jenis Tangki"><?=($value->jenis_tangki&&$value->jenis_tangki!=""?$value->jenis_tangki:"-");?></td>
                                                    <td data-title="Panjang"><?=($value->panjang&&$value->panjang!=""?$value->panjang:"-");?></td>
                                                    <td data-title="Lebar"><?=($value->lebar&&$value->lebar!=""?$value->lebar:"-");?></td>
                                                    <td data-title="Aksi">
                                                        <a href="javascript:void(0);" class="btn btn-warning waves-effect waves-float btn-sm waves-green update-btn" rel="<?=$value->id;?>"><i class="zmdi zmdi-edit"></i></a>
                                                        <a href="javascript:void(0);" class="btn btn-danger waves-effect waves-float btn-sm waves-red delete-btn" rel="<?=$value->id;?>"><i class="zmdi zmdi-delete"></i></a>
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
       
        $('#create-btn').off().click(function(e){
            $.ajax({
                url : '<?=$dataView['urlForm'];?>',
                data : 'pages=create',
                beforeSend	:function(){
                    $('.page-loader-wrapper').show();
                },
                success: function(data){
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

        $('.update-btn').off().click(function(e){
            var id = $(this).attr('rel');
            $.ajax({
                url  : '<?=$dataView['urlForm'];?>',
                data : 'pages=update&id='+id,
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

        $('.delete-btn').off().click(function(e){
            var id = $(this).attr('rel');
            if(confirm('Apakah anda yakin akan menghapus data ini ?')){
                $.ajax({
                    url : '<?=$dataView['urlDelete'];?>',
                    data : 'pages=delete&id='+id,
                    beforeSend	:function(){
                        $('.page-loader-wrapper').show();
                    },
                    success: function(data){
                        location.reload();
                        $('.page-loader-wrapper').hide();
                    }
                });
            }
            e.preventDefault();
        });
    });
</script>

<?php templateFooter($dataView); ?>