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
                    alert('Beberapa form mungkin belum diisi dengan benar.');
                }
            });
        }
    });
})