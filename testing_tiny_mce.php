<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="tinymce/js/tinymce/tinymce.min.js"></script>


</head>

<body>
    <h1>TinyMCE Quick Start Guide</h1>
        <textarea id="myTextarea"></textarea>
        <button onclick="myFunction()">Click me</button> 
</body>



<script>
    tinymce.init({
        selector: '#myTextarea',
        setup: function(editor) {
            editor.on('init', function(e) {
                editor.setContent('<p>Hello loooooooooworld!</p>');
            });
        }
    });


    function myFunction(){
        var myContent = tinymce.get("myTextarea").getContent();
    alert(myContent);
    }

</script>


</html>