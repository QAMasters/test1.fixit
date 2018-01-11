<?php
if(!isset($_COOKIE['lang'])) {
  setcookie("lang", "en", time() + (86400 * 30), "/");
  $pref_lang = "sw";
} else {
  $pref_lang = $_COOKIE["lang"];
}
?>
<!DOCTYPE html>
<html>
    <head>
        
        <!-- Title -->
        <title><?php echo site_data()->title;?></title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:500,400,300' rel='stylesheet' type='text/css'>
		

		<link href="./assets1/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="./assets1/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="./assets1/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="./assets1/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="./assets1/plugins/animate/animate.css" rel="stylesheet" type="text/css">
        <link href="./assets1/plugins/tabstylesinspiration/css/tabs.css" rel="stylesheet" type="text/css">
        <link href="./assets1/plugins/tabstylesinspiration/css/tabstyles.css" rel="stylesheet" type="text/css"> 
        
        <?php echo $xheader; ?>
        <link href="./assets1/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
        <!--<link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">-->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#383b75"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "showLink": false,
  "theme": "classic",
  "position": "bottom-right"
})});
</script>      

</head>  