tinymce.init({
        selector:'.editor',
        plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        toolbar2: "| link unlink anchor | image media | forecolor backcolor  | print preview code ",
        image_advtab: true ,
           
        // external_filemanager_path:baseurl+"filemanager/",
        // filemanager_title:"Responsive Filemanager" ,
        // external_plugins: { "filemanager" : "./../../../admin/filemanager/plugin.min.js"},
        relative_urls: false,
        remove_script_host : false
    });