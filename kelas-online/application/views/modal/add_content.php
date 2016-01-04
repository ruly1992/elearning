<div class="modal fade add-content" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myLargeModalLabel">Add Content</h4>
            </div>
            <div class="modal-body">
                <fieldset class="form-group">
                    <input type="file" name="attachments[]" id="file_attachment" multiple="multiple">
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" v-on:click="saveChapterContent">Save</button>
            </div>
        </div>
      </div>
</div>