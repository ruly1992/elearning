<div class="modal fade add-requirement" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myLargeModalLabel">Add Requirement</h4>
            </div>
            <div class="modal-body">
                <div class="row">             
                    <div class="col-sm-12">
                        <label for="">Jawaban Benar :</label>
                        <div class="row">
                            <div class="col-xs-2 col-sm-2">
                                <fieldset class="form-group">
                                    <select class="form-control" v-model="input.chapterQuiz.correct">
                                        <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" v-on:click="saveChapterQuiz" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>