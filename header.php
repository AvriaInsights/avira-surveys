<?php
require_once("survey/classes/cls-survey.php");
$obj_survey = new Survey();?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="title" content="<?php echo isset($page_title) ? $page_title : ""; ?>">
        <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : ""; ?>">
        <meta name="keywords" content="<?php echo isset($meta_keywords) ? $meta_keywords : ""; ?>">
        
        <title><?php echo $page_title; ?></title>
        
        <!-- Bootstrap CSS -->
        <link rel="icon" href="<?php echo SITEPATHFRONT; ?>images/Avira-Survey-Logo_Favicon.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo SITEPATHFRONT; ?>css/style.css">
        <link rel="stylesheet" href="<?php echo SITEPATHFRONT; ?>css/responsive.css">
        
        <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-0NPNQHMZ4X"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
             gtag('config', 'G-0NPNQHMZ4X');
            </script>
            <!-- Google Tag Manager -->
            
        <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-RB2NMBZKTZ"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
            
              gtag('config', 'G-RB2NMBZKTZ');
            </script>    
        <!-- Google tag (gtag.js) -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-5NTKLK3');</script>
            <!-- End Google Tag Manager -->
        <!-- Hotjar Tracking Code for Software Intent -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:3335653,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>    
  </head>
  <body>