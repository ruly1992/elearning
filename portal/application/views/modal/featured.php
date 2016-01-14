<div id="cropit-featured" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
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
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" v-on:click="cancel('featured')">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" v-on:click="save('featured')">Save</button>
            </div>
        </div>
    </div>
</div>