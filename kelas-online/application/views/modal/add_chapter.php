<div class="modal fade add_chapter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelExam">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myLargeModalLabel">Add Chapter</h4>
            </div>
            <div class="modal-body">
                <form action="">
                    <fieldset class="form-group">
                        <label for="">Judul Chapter</label>
                        <input type="text" id="judul" class="form-control" v-model="input.chapter.name"> 
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="">Content</label>
                        <textarea class="form-control" id="content" cols="30" rows="10" v-model="input.chapter.content"></textarea>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" v-on:click="cancelChapter">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" v-on:click="saveChapter">Save</button>
            </div>
        </div>
    </div>
</div>