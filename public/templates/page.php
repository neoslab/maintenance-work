<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo esc_attr($maintenance['title']).' | '.get_bloginfo('name'); ?></title>
    <link href="<?php echo plugin_dir_url(__FILE__).'assets/fonts/font-awesome/css/all.min.css'; ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,900" rel="stylesheet">
    <style>*{-webkit-box-sizing:border-box;box-sizing:border-box}body{padding:0;margin:0}#error{position:relative;height:100vh}#error .error{position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.error{max-width:920px;width:100%;line-height:1.4;text-align:center;padding-left:15px;padding-right:15px}.error .error-code{position:absolute;height:100px;top:0;left:50%;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%);z-index:-1}.error .error-code h1{font-family:'Maven Pro',sans-serif;color:#ececec;font-weight:900;font-size:276px;margin:0;position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.error h2{font-family:'Maven Pro',sans-serif;font-size:46px;color:#000;font-weight:900;text-transform:uppercase;margin:0}.error p{font-family:'Maven Pro',sans-serif;font-size:16px;color:#000;font-weight:400;text-transform:uppercase;margin-top:15px}.error a{font-family:'Maven Pro',sans-serif;font-size:14px;text-decoration:none;text-transform:uppercase;background:#189cf0;display:inline-block;padding:16px 38px;border:2px solid transparent;border-radius:4px;color:#fff;font-weight:400;-webkit-transition:.2s all;transition:.2s all}.error a:hover{background-color:#fff;border-color:#189cf0;color:#189cf0}@media only screen and (max-width:480px){.error .error-code h1{font-size:162px}.error h2{font-size:26px}}</style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="error">
        <div class="error">
            <div class="error-code">
                <h1><i class="fa-solid fa-gears"></i></h1>
            </div>
            <h2><?php echo esc_attr($maintenance['title']); ?></h2>
            <p><?php echo wp_kses_post($maintenance['description']); ?></p>
            <a href="<?php echo get_site_url(); ?>"><?php echo _e('Refresh Page', 'maintenance-work'); ?></a>
        </div>
    </div>
</body>
</html>