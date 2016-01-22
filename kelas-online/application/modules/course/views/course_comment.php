<?php echo form_open('course/comment/store', array('id' => 'form-comment')); ?>
<?php echo form_hidden('course_id', $course->id); ?>
<input type="hidden" name="parent" v-model="parent">
    
    <?php echo show_message() ?>

        <?php if (auth()->check()): ?>
            <?php
            $user = auth()->getUser();

            echo form_hidden('name', $user->full_name);
            echo form_hidden('email', $user->email);
            ?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <p class="text-static">Login sebagai <strong><?php echo $user->full_name ?></strong>. <a href="<?php echo logout_url() ?>">Logout</a>?</p>
                    </div>
                </div>
            </div>
        <?php else: ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <?php echo form_input('name', set_value('name'), array('class' => 'form-control', 'placeholder' => 'Your Name')); ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <?php echo form_input(array(
                        'name'          => 'email',
                        'value'         => set_value('email'),
                        'class'         => 'form-control',
                        'placeholder'   => 'Your Email',
                        'type'          => 'email'
                    )); ?>
                </div>
            </div>
        </div>
        <?php endif ?>

    <div class="row">
        <div class="col-sm-12" v-show="name">
            <p class="label label-info">Reply comment to {{ name }} <a href="#comments" v-on:click="cancel">&times;</a></p>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <textarea name="content" id="content" cols="40" rows="5" placeholder="Your Message" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <?php echo button_save('Kirim') ?>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>

<?php custom_script() ?>
<script src="<?php echo asset('node_modules/vue/dist/vue.min.js') ?>"></script>
<script>
    new Vue({
        el: '#comments',
        data: {
            parent: 0,
            name: ''
        },
        methods: {
            reply: function (parent, name) {
                this.parent = parent;
                this.name = name;
            },
            cancel: function () {
                this.parent = 0;
                this.name = '';
            }
        }
    })
</script>
<?php endcustom_script() ?>
