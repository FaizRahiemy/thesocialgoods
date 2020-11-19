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