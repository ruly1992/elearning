$(document).ready(function () {
    $("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
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