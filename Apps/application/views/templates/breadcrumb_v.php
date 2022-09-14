<div class="block-header">
    <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
            <h2><?=$dataView['titlePage']?></h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=$dataView['urlBreadcrumb'][0]?>"><i class="zmdi zmdi-home"></i> <?=$dataView['breadcrumb'][0]?></a></li>
                <?php if(count($dataView['breadcrumb']) > 3) : ?>
                    <li class="breadcrumb-item"><a href="<?=$dataView['urlBreadcrumb'][1]?>"><?=$dataView['breadcrumb'][1]?></a></li>
                    <li class="breadcrumb-item"><a href="<?=$dataView['urlBreadcrumb'][2]?>"><?=$dataView['breadcrumb'][2]?></a></li>
                    <li class="breadcrumb-item active"><?=$dataView['breadcrumb'][3]?></li>
                <?php elseif(count($dataView['breadcrumb']) > 2) : ?>
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><?=$dataView['breadcrumb'][1]?></a></li>
                    <li class="breadcrumb-item active"><?=$dataView['breadcrumb'][2]?></li>
                <?php else : ?>
                    <li class="breadcrumb-item active"><?=$dataView['breadcrumb'][1]?></li>
                <?php endif;?>
            </ul>
            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">                
            <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
        </div>
    </div>
</div>