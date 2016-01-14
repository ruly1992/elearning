<div class="content-right">
    <div class="widget">
        <div id="time">
            <div class="card text-xs-center">
                <div class="card-block">
                    <h4>Time</h4>
                    <h2 id="quiz-countdown">00:00</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-instructor">
            <div class="widget-instructor-title">
                <h3>INSTRUCTOR</h3>
            </div>
            <div class="widget-instructor-profile">
                <div class="text-xs-center">
                    <img src="<?php echo $course->instructor->avatar ?>" alt="">
                    <p><strong><a href="#"><?php echo $course->instructor->full_name ?></a></strong></p>
                </div>
            </div>
            <div class="list-details">
                <ul>
                    <li><?php echo $course->instructor->email ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php custom_script() ?>
    <script src="<?php echo asset('node_modules/countdown/dist/jquery.countdown.min.js') ?>"></script>
    <script>
    $(document).ready(function() {
        var date = '<?php echo $member->finished_at ?>';
        $('#quiz-countdown').countdown(date, function (event) {
            $(this).html(event.strftime('%M:%S'));
        });
    })
    </script>
<?php endcustom_script() ?>
