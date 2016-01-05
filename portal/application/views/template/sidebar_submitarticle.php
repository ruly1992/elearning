
<div class="widget">
    <div class="widget-sidebar-heading">
        <h3>Silahkan pilih Kategori</h3>
    </div>
    <div class="widget-sidebar-content">
        <?php echo $category_lists ?>
    </div>
</div>

<div class="widget">
    <div class="widget-sidebar-heading">
        <h3>Gambar Fitur</h3>
    </div>
    <div class="widget-sidebar-content">
        <cropit-preview name="featured"></cropit-preview>
    </div>
</div>

<?php $this->load->view('modal/featured'); ?>
<?php $this->load->view('modal/customavatar'); ?>
