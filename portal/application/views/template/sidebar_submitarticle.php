
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
        <h3>Featured Image</h3>
    </div>
    <div class="widget-sidebar-content">
        <cropit-preview name="featured" :show-description="true"></cropit-preview>
    </div>
</div>

<?php $this->load->view('modal/featured'); ?>
<?php $this->load->view('modal/customavatar'); ?>

