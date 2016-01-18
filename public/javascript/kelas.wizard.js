$(document).ready(function () {
    var form = $("#wizard-create-form");

    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        }
    })

    $("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex === 0) {
                return form.valid();
            } else if (currentIndex === 2) {
                var length = window.app_kelas_online.course.chapters.length;

                if (length === 0) {
                    alert('Anda belum memasukkan chapter.')

                    return false;
                } else {
                    return true;
                }
            } else if (currentIndex === 3) {
                var length = window.app_kelas_online.course.exams.length;

                if (length === 0) {
                    alert('Anda belum memasukkan exam.')

                    return false;
                } else {
                    return true;
                }
            }

            return true;
        },
        onFinished: function (event, currentIndex) {
            var form = $('#form-course-result')
            
            form.ajaxSubmit({
                success: function (response) {
                    localStorage.removeItem('vue-kelas-app');
                    window.location.replace(response.redirect)
                },
                error: function (response) {
                    alert('Terjadi kesalahan dalam memproses data.');
                    document.write(response.responseText);
                }
            });
        }
    });
})