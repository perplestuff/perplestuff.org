<html>

    <head>

        <title>Files</title>

        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="jquery.js"></script>
        <script>
            $(document).ready(function(e){
                $.ajaxSetup({cache:false});
                setInterval(function(){
                    $('#files').load('file.txt');
                },1000);
            });
        </script>

    </head>

    <body>

        <div id="body">

            <h1 class="title">[Files]</h1>

            <img src="images/subwoofer.jpg" class="pics">

            <p>This is experimental, use with caution. <br><b>Please remember to report all problems to @perplestuff on twitter,</b> thank you.</p>

        </div>

        <small>Max file size is <b>1 MB</b>.</small>

        <form action="file.php" method="post" enctype="multipart/form-data">
        <h1>Please select an image.</h1>
        <input type="file" name="file" id="file">
        <input type="submit" value="Select Image." name="submit">
        </form>

        <div id="files">loading...</div>

    </body>

</html>