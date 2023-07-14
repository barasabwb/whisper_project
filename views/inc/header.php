<!DOCTYPE html>
<html class="html_body" lang="en" data-theme="light">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?=$meta->page_title?></title>
        <link rel="icon" type="image/x-icon" href="<?= ROOT?>resources/images/logos/logo2.png" />
        <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap"
        rel="stylesheet" />
        
        <!-- <link href="<?= ROOT?>resources/external/libraries/tailwind/daisyui/daisyui.css" rel="stylesheet" type="text/css" /> -->
        <!-- <script src="<?= ROOT?>resources/external/libraries/tailwind/tailwind.js"></script> -->
        <link href="<?= ROOT?>resources/dist/output.css" rel="stylesheet" type="text/css" />
        <script src="<?= ROOT?>resources/external/jquery.js"></script>
        <script src="<?= ROOT?>resources/external/libraries/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/bfd35cbf82.js" crossorigin="anonymous"></script>
        <script src="<?= ROOT?>node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script>let url_root = '<?=ROOT?>',isLoggedIn='<?=checkLogin()?>';</script>
   
        <!-- CUSTOM CSS  -->
        <link rel="stylesheet" href="<?= ROOT?>resources/custom/css/main.css" />
    </head>
    <body class="font-sans hidden">

    <script>
        $(document).ready(function (){
            if(isLoggedIn==true){
                $('body').css('background-image', 'url(<?= ROOT?>resources/images/stocks/journal_2.jpg)');
            }
        });
    </script>