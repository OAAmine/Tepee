<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo (basename(__FILE__, '.php')); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="../../tinymce/js/tinymce/tinymce.min.js"></script>


    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>

</head>

<body>
    <?php
    require_once "../../db.php";
    session_start();
    include("/var/www/Tepee.com/html/navbar.php")
    ?>




    <h1>TinyMCE Quick Start Guide</h1>
    <textarea id="myTextarea">Hello, World!</textarea>
    <button onclick="myFunction()">Click me</button>


        <cours id="cours">
        
       <p> fzeifhzEOFHZEFUHZIUFEHZIEUFHzIUFHIZUFEHiZUFHZ 
       </p>
       <h1>dzdzdzdzdzzdzd</h1>
        
        
        </cours>


    <script>
        tinymce.init({
            selector: '#myTextarea',
            setup: function(editor) {
                editor.on('init', function(e) {
                    editor.setContent('<p>Hello loooooooooworld!</p>');
                });
            }
        });


        function myFunction() {
            var x = document.getElementById("cours").innerHTML;
            tinymce.get("myTextarea").setContent(x);



            var myContent = tinymce.get("myTextarea").getContent();
            alert(myContent);
        }
    </script>





    <?php include("/var/www/Tepee.com/html/footer.php") ?>
</body>

</html>