<div class="sidebar-kelas-online">
    <div class="widget">
        <div class="widget-categories">
            <div class="widget-categories-heading">
                <h4>STEPS</h4>
            </div>
            <div class="widget-categories-content">
                <div class="list-group">
                    <a href="<?php echo site_url('dashboard/course/edit/'.$course->id) ?>" class="list-group-item <?php echo $sidebar_active == 'basic' ? 'active' : '' ?>">Informasi Dasar</a>
                    <a href="<?php echo site_url('dashboard/course/edit/'.$course->id.'/image') ?>" class="list-group-item <?php echo $sidebar_active == 'image' ? 'active' : '' ?>">Gambar</a>
                    <a href="<?php echo site_url('dashboard/course/edit/'.$course->id.'/chapter') ?>" class="list-group-item <?php echo $sidebar_active == 'chapter' ? 'active' : '' ?>">Pertemuan</a>
                    <a href="<?php echo site_url('dashboard/course/edit/'.$course->id.'/exam') ?>" class="list-group-item <?php echo $sidebar_active == 'exam' ? 'active' : '' ?>">Ujian</a>
                </div>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-categories">
            <div class="widget-categories-heading">
                <h4>PESERTA</h4>
            </div>
            <div class="widget-categories-content">
                <div class="list-group">
                    <a href="#" class="list-group-item active">Aktif</a>
                    <a href="#" class="list-group-item">Tidak Aktif</a>
                </div>
            </div>
        </div>
    </div>
</div>