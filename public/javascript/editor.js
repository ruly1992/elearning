$(document).ready(function () {    
    tinymce.init({
        selector: '.editor-simple',
        height: 350,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste imagetools"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic underline | alignleft alignright | bullist numlist outdent indent | link image",
    });
})