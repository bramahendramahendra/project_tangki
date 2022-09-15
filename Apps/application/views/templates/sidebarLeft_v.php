<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="index.html"><span class="m-l-10">Volume Control</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="profile.html"><img src="<?= base_url('resource/assets/images/profile_av.jpg');?>" alt="User"></a>
                    <div class="detail">
                        <h4>Michael</h4>
                        <small>Admin</small>                        
                    </div>
                </div>
            </li>
            <li <?=($dataView['menu']==1?'class="active open"':'')?> ><a href="<?= site_url('Home');?>"><i class="zmdi zmdi-home"></i><span>Home</span></a></li>
            <li <?=($dataView['menu']==2?'class="active open"':'')?> ><a href="<?= site_url('Profile');?>"><i class="zmdi zmdi-account"></i><span>Profil</span></a></li>
            <li <?=($dataView['menu']==3?'class="active open"':'')?> ><a href="<?= site_url('DataTangki');?>"><i class="zmdi zmdi-storage"></i><span>Data Tangki BBM</span></a></li>
            <li <?=($dataView['menu']==4?'class="active open"':'')?> ><a href="<?= site_url('ApproveOrder');?>"><i class="zmdi zmdi-check-all"></i><span>Approve Order Solar</span></a></li>
            <li <?=($dataView['menu']==5?'class="active open"':'')?> ><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-wrench"></i><span>Master Data</span></a>
                <ul class="ml-menu">
                    <li <?=($dataView['submenu']==1?'class="active"':'')?> ><a href="<?= site_url('MasterData/DataTangki');?>">Data Tangki</a></li>
                    <li <?=($dataView['submenu']==2?'class="active"':'')?> ><a href="<?= site_url('MasterData/FacilityManagement');?>">Facility Management</a></li>
                    <li <?=($dataView['submenu']==3?'class="active"':'')?> ><a href="<?= site_url('MasterData/Gedung');?>">Gedung</a></li>
                    <li <?=($dataView['submenu']==4?'class="active"':'')?> ><a href="<?= site_url('MasterData/JenisTangki');?>">Jenis Tangki</a></li>                  
                </ul>
            </li>
            <li <?=($dataView['menu']==6?'class="active open"':'')?> ><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-flower"></i><span>Setting Aplikasi</span></a>
                <ul class="ml-menu">
                    <li <?=($dataView['submenu']==1?'class="active"':'')?> ><a href="<?= site_url('SettingAplikasi/UserAplikasi');?>">User Aplikasi</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>