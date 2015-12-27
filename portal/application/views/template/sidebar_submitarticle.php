
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

<!-- Begin: image preview -->
<div id="cropit-featured" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myLargeModalLabel">Gambar Fitur</h4>
            </div>
            <div class="modal-body">
                <cropit-cropper name="featured"></cropit-cropper>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" v-on:click="save('featured')">Save</button>
            </div>
        </div>
    </div>
</div>
<div id="cropit-customavatar" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myLargeModalLabel">Avatar</h4>
            </div>
            <div class="modal-body">
                <cropit-cropper name="customavatar" :width="256" :height="256"></cropit-cropper>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" v-on:click="save('customavatar')">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- End: image preview -->
