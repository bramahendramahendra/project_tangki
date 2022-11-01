<div class="modal-header">
    <h4 class="title" id="defaultModalLabel"><?=$dataView['titlePage']?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<?=form_open($dataView['urlCreate'], 'class="formModal" id="formModal"');?>
    <?=form_input(array('type' =>'hidden','name'=>'id','id'=>'id','value'=>(isset($dataCreate['id'])&&$dataCreate['id']!=""?$dataCreate['id']:"") ));?>
    <?=form_input(array('type' =>'hidden','name'=>'id_gedung','id'=>'id_gedung','value'=>(isset($dataCreate['id_gedung'])&&$dataCreate['id_gedung']!=""?$dataCreate['id_gedung']:"") ));?>
    <?=form_input(array('type' =>'hidden','name'=>'id_facility_management','id'=>'id_facility_management','value'=>(isset($dataCreate['id_facility_management'])&&$dataCreate['id_facility_management']!=""?$dataCreate['id_facility_management']:"") ));?>
    <div class="modal-body">
        <?php $this->load->view('templates/alerts_v');?>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                <label for="kapasitas_bahan_bakar">Kapasitas Bahan Bakar</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="form-group">
                    <input type="text" name="kapasitas_bahan_bakar" id="kapasitas_bahan_bakar" class="form-control kapasitas_bahan_bakar" value="<?=isset($dataCreate['kapasitas_bahan_bakar'])&&$dataCreate['kapasitas_bahan_bakar']!=""?$dataCreate['kapasitas_bahan_bakar']:$this->input->get('kapasitas_bahan_bakar')?> Liter" placeholder="Masukkan Kapasitas Bahan Bakar disini." maxlength="11" required readonly>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                <label for="sisa_bahan_bakar">Sisa Bahan Bakar</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="form-group">
                    <input type="text" name="sisa_bahan_bakar" id="sisa_bahan_bakar" class="form-control sisa_bahan_bakar" value="<?=isset($dataCreate['jumlah_sisa_bahan_bakar'])&&$dataCreate['jumlah_sisa_bahan_bakar']!=""?$dataCreate['jumlah_sisa_bahan_bakar']:$this->input->get('sisa_bahan_bakar')?> Liter" placeholder="Masukkan Sisa Bahan Bakar disini." maxlength="11" required readonly>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                <label for="dibutuhkan_bahan_bakar">Dibutuhkan Bahan Bakar</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="form-group">
                    <input type="text" name="dibutuhkan_bahan_bakar" id="dibutuhkan_bahan_bakar" class="form-control dibutuhkan_bahan_bakar" value="<?=isset($dataCreate['jumlah_use_bahan_bakar'])&&$dataCreate['jumlah_use_bahan_bakar']!=""?$dataCreate['jumlah_use_bahan_bakar']:$this->input->get('dibutuhkan_bahan_bakar')?> Liter" placeholder="Masukkan Dibutuhkan Bahan Bakar disini." maxlength="11" required readonly>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                <label for="request_bahan_bakar">Kapasitas Bahan Bakar</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="form-group">
                    <input type="text" name="request_bahan_bakar" id="request_bahan_bakar" class="form-control request_bahan_bakar" value="<?=isset($dataCreate['request_bahan_bakar'])&&$dataCreate['request_bahan_bakar']!=""?$dataCreate['request_bahan_bakar']:$this->input->get('request_bahan_bakar')?>" placeholder="Masukkan Request Bahan Bakar disini." maxlength="11" required>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="save-btn" class="btn btn-default btn-round waves-effect" >Simpan</button>
        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Tutup</button>
        
    </div>
<?=form_close()?>

<script>
    $(document).ready(function(){
        $('#generalModal').on('hide.bs.modal', function (e) {
            location.reload();
        })

        $('#save-btn').off().click(function(e){
            if(confirm('Apakah anda yakin akan mengupdate data ini ?')){
                $.ajax({
                    url     : $('#formModal').attr('action'),
                    data    : 'save=save&'+$('#formModal').serialize(),
                    beforeSend	:function(){
                        $('.page-loader-wrapper').show();
                    },
                    success: function(data){
                        // $('#main-content').html(data);
                        // console.log(data);

                        //active
                        $('#generalModal .modal-dialog .modal-content').html(data);
                        $('.page-loader-wrapper').hide();
                    }
                });
            }
            e.preventDefault();
        });
    });
</script>