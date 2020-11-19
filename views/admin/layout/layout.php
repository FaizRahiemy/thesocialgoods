<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo $this->baseUrl ?>public/images/favicon.ico" type="image/ico">
    <title> <?php echo $this->titlePage ?> - The Social Goods</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo $this->metakey ?>" />
    <meta name="description" content="<?php echo $this->metadesc ?>" /> 
    <link href="<?php echo $this->baseUrl ?>public/css/style.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php if ($this->alias == "admin"){?>
    <?php } ?>
    <script src="<?php echo $this->baseUrl ?>public/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea',
        menubar: "edit insert view format table tools",
        plugins: "advlist anchor autoresize autosave charmap code colorpicker directionality emoticons fullscreen hr image link lists media paste preview save searchreplace table textcolor wordcount",
        toolbar1: "save | cut copy paste | undo redo | removeformat anchor | fullscreen preview searchreplace",
        toolbar2: "formatselect fontselect fontsizeselect | bullist numlist outdent indent ltr rtl",
        toolbar3: "bold italic underline | alignleft aligncenter alignright alignjustify | strikethrough subscript superscript blockquote | forecolor backcolor",
        save_enablewhendirty: true,
        save_onsavecallback: function() {console.log("Save");}
    });
    </script>
    <script>
        function show_confirm(){
            return confirm("Yakin?");
        }
    </script>
</head>

<body>
   
    <div id="container">
        <?php require($content) ?>
    </div>
    <?php
    if (isset($_SESSION['flash'])){
        echo '<div id="flashMessage">'.$_SESSION['flash'].'</div>';
        unset($_SESSION['flash']);
    }
    ?>
    <div class="push"></div>
    <?php require('header.php'); require('footer.php'); ?>   
    
</body>
</html>