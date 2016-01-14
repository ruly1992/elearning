<div class="kelas-main" id="app-requirement">
    <div class="panel panel-default">
        <div class="panel-heading">
             <p class="panel-title">Course Requirement</p>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="input-group">
                        <?php echo form_dropdown('course', $course_lists->toArray(), null, 'id="input-requirement" class="form-control search-course" v-model="input.requirement"'); ?>
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" v-on:click="addRequirement">Add</button>
                        </span>
                    </div>
                </div>
            </div>
           <!-- start: content -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Course</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="requirement in course.requirements">
                            <th scope="row">{{ $index+1 }}</th>
                            <td>{{{ requirement.name }}}</td>
                            <td>
                                <a class="btn btn-sm btn-danger" title="Delete" v-on:click="removeRequirement($index)"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        <tr v-show="course.requirements.length == 0">
                            <td colspan="3">No requirement</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- end:content -->
        </div>
        <div class="panel-footer">
            <button type="submit" id="btn-submit" class="btn btn-primary btn-sm">Save</button>
        </div>
    </div>

    <?php echo form_open('kelasonline/course/edit/'.$course->id.'/requirement', ['id' => 'form-course-result']); ?>
    <div id="course-result">
        <div v-for="requirement in course.requirements">
            <input type="hidden" name="course[requirements][{{ $index }}]" value="{{ requirement.id || 0 }}">
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<?php custom_script() ?>
    <script src="<?php echo asset('node_modules/vue/dist/vue.min.js') ?>"></script>
    <script src="<?php echo asset('node_modules/vue-resource/dist/vue-resource.min.js') ?>"></script>
    <script>
    $(document).ready(function () {
        $('.search-course').select2({
            placeholder: 'Select course'
        });

        $('#btn-submit').on('click', function () {
            $('#form-course-result').submit();
        })

        new Vue({
            el: '#app-requirement',
            data: {
                course: {
                    requirements: []
                },
                input: {
                    requirement: 0
                }
            },
            methods: {
                addRequirement: function () {
                    var requirement = $('#input-requirement')

                    if (requirement.val() == null)
                        requirement.val(requirement.find('option:first').val())

                    this.$http.get(siteurl + '/kelasonline/api/course/' + requirement.val())
                        .then(function (response) {
                            var course = response.data;

                            console.log(course);

                            this.course.requirements.push(course);
                        }
                    )
                },
                removeRequirement: function ($index) {
                    this.course.requirements.splice($index, 1);
                }
            },
            ready: function () {
                this.$http.get(siteurl + '/kelasonline/api/course/' + <?php echo $course->id ?>)
                    .then(function (response) {
                        var requirements = response.data.requirements;

                        this.course.requirements = requirements;
                    }
                )
            }
        })
    })
    </script>
<?php endcustom_script() ?>
