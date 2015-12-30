$(document).ready(function () {
    $("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        enableAllSteps: true,
        onFinished: function (event, currentIndex) {
            var form = $('#form-course-result')
            
            form.submit();
        }
    });
})