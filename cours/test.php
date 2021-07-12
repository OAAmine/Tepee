<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editeur de Cours</title>

    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#mytextarea',
            setup: function(editor) {
                editor.on('init', function(e) {
                    editor.setContent('iiiiiiiiiiiiiiiiiiiiiiiii');
                });
            }
        });
    </script>

</head>

<body>
    <textarea name="" id="mytextarea" cols="30" rows="10"></textarea>
</body>