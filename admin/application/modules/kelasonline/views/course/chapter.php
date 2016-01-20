<div class="kelas-main" id="app-kelas-online">
    <div class="panel panel-default">
        <div class="panel-body">
           <!-- start: content -->
            <div id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default" v-for="chapter in course.chapters">
                    <div class="panel-heading" role="tab">
                        <h5 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $index }}" aria-expanded="true" aria-controls="collapseOne">
                                Chapter {{ $index + 1 }} : {{ chapter.name }}
                            </a>
                        </h5>
                    </div>
                    <div id="collapse{{ $index }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Chapter{{ $index }}">
                        <div class="container-fluid">
                            <!-- Start: Deskripsi-->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                             <p>Deskripsi :</p>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group row">
                                                <p>{{ chapter.content }}</p>
                                            </div>
                                        </div>
                                    </div>
                            <!-- End: Deskripsi -->
                            <!-- Start: Attachment -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                         <p>Attachment :</p>
                                    </div>
                                    <div class="panel-body">
                                        <!-- Start: Table Attachment -->
                                        <div class="table-responsive">                                            
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Type</th>
                                                        <th>Size</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="content in attachments[$index].contents">
                                                        <th scope="row">{{ $index+1 }}</th>
                                                        <td>{{ content.filename }}</td>
                                                        <td>{{ content.filetype }}</td>
                                                        <td>{{ content.filesize }}</td>
                                                        <td>
                                                            <a class="btn btn-sm btn-danger" title="Delete" v-on:click="removeChapterContent($index, $parent.$index)"><i class="fa fa-trash-o"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr v-show="attachments[$index].contents.length == 0">
                                                        <td colspan="5">Tidak ada attachment</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- End: Table Attachment -->
                                    </div>
                                </div>
                            <!-- End: Attachment -->
                            <!-- Start: Quiz -->
                                <div class="panel">
                                    <div class="panel-heading">
                                         <p>Quiz :</p>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group row">
                                            <label for="waktu" class="col-sm-2 form-control-label">Waktu</label>
                                            <div class="input-group col-sm-4">
                                                <p class="form-static">{{ chapter.quiz.time }} menit</p>
                                            </div>
                                        </div>
                                        <!-- Start: Table Queations -->                                                   
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Questions</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="quiz in chapter.quiz.questions">
                                                        <th scope="row">{{ $index+1 }}</th>
                                                        <td>{{{ quiz.question }}}</td>
                                                        <td>
                                                            <a class="btn btn-sm btn-secondary" data-toggle="modal" data-target=".add-question" v-on:click="editChapterQuiz($index, $parent.$index)"><i class="fa fa-pencil-square-o"></i></a>
                                                            <a class="btn btn-sm btn-danger" v-on:click="removeChapterQuiz($index, $parent.$index)"><i class="fa fa-trash-o"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr v-show="chapter.quiz.questions.length == 0">
                                                        <td colspan="3">Tidak ada quiz</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        <!-- End: Table Questions -->
                                    </div>
                                </div>
                            <!-- End: Quiz -->
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".add_chapter" v-on:click="addChapter">Add Chapter</button>
                        </h5>
                    </div>
                </div>
            </div>
            <!-- end:content -->
        </div>
    </div>
</div>

<?php custom_stylesheet() ?>
    <link rel="stylesheet" href="<?php echo asset('stylesheets/custom.jquery.steps.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('plugins/jquery.steps-1.1.0/css/jquery.steps.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('plugins/jQuery.filer-1.0.5/css/jquery.filer.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('plugins/jQuery.filer-1.0.5/css/themes/jquery.filer-dragdropbox-theme.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('stylesheets/cropit.css') ?>">
<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
    <?php echo $this->load->view('template/vue_course_form'); ?>
    <?php echo $this->load->view('template/vue_cropit'); ?>
    
    <script src="<?php echo asset('plugins/tinymce/tinymce.min.js') ?>"></script>
    <script src="<?php echo asset('node_modules/vue/dist/vue.min.js') ?>"></script>
    <script src="<?php echo asset('javascript/kelas.vue.js') ?>"></script>
    <script src="<?php echo asset('plugins/jQuery.filer-1.0.5/js/jquery.filer.min.js') ?>"></script>
    <script src="<?php echo asset('plugins/jQuery.filer-1.0.5/js/custom.js') ?>"></script>
    <script src="<?php echo asset('plugins/jquery.steps-1.1.0/js/jquery.steps.js') ?>"></script>
    <script>
    $(document).ready(function () {
        window.app_kelas_online.withCache = false;

        $.ajax({
            url: siteurl+'/kelasonline/api/course/<?php echo $course->id ?>',
            type: 'GET',
            success: function (response) {
                window.app_kelas_online.initCourse(response)
            }
        })

        $.ajax({
            url: siteurl+'/kelasonline/api/attachment/<?php echo $course->id ?>',
            type: 'GET',
            success: function (response) {
                window.app_kelas_online.initAttachment(response)
            }
        })

        $('#btn-submit').on('click', function () {
            $('#form-course-result').submit();
        })
    })
    </script>
<?php endcustom_script() ?>
