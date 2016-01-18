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
                if (window.app_kelas_online.course.category_id === 0) {
                    alert('Anda harus memilih kategori');
                    return false;
                }

                return form.valid();
            } else if (currentIndex === 2) {
                var length = window.app_kelas_online.course.chapters.length;

                if (length === 0) {
                    alert('Anda belum memasukkan chapter.')

                    return false;
                } else {
                    if (window.app_kelas_online.checkAllChapterHasQuiz()) {
                        return true;
                    }

                    alert('Setiap chapter harus mempunyai quiz');

                    return false;
                }
            }

            return true;
        },
        onFinishing: function (event, currentIndex) {
            if (currentIndex === 3) {
                var length = window.app_kelas_online.course.exam.questions.length;

                if (length === 0) {
                    alert('Anda belum memasukkan exam.')

                    return false;
                } else {
                    return true;
                }
            }

            alert(currentIndex)

            return false;
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