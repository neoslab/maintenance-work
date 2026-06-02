<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo esc_attr($maintenance['title']).' | '.get_bloginfo('name'); ?></title>
    <link href="<?php echo plugin_dir_url(__FILE__).'assets/fonts/fontawesome/css/all.min.css'; ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,900" rel="stylesheet">
    <style>*{-webkit-box-sizing:border-box;box-sizing:border-box}body{padding:0;margin:0}#wrapper{position:relative;height:100vh}#wrapper .wrapper{position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.wrapper{max-width:920px;width:100%;line-height:1.4;text-align:center;padding-left:15px;padding-right:15px}.wrapper .container{position:absolute;height:100px;top:0;left:50%;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%);z-index:-1}.wrapper .container h1{font-family:"Maven Pro",sans-serif;color:#ececec;font-weight:900;font-size:276px;margin:0;position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.pagelogo{margin-bottom:30px;display:inline-block}.pagelogo img{max-width:200px;height:auto;display:block}.wrapper h2{font-family:"Maven Pro",sans-serif;font-size:46px;color:#000;font-weight:900;text-transform:uppercase;margin:0}.wrapper p{font-family:"Maven Pro",sans-serif;font-size:16px;color:#000;font-weight:400;text-transform:uppercase;margin-top:15px}.social-icons{margin:30px 0 40px;display:flex;justify-content:center;gap:15px;flex-wrap:wrap}.social-icons a{font-family:"Maven Pro",sans-serif;font-size:24px;text-decoration:none;text-transform:none;background:transparent!important;display:inline-flex;align-items:center;justify-content:center;width:50px;height:50px;padding:0!important;border:2px solid #bbb!important;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;color:#888!important;font-weight:400;-webkit-transition:.2s all;transition:.2s all}.social-icons a i{line-height:1;font-size:24px}.social-icons a:hover{border-color:#189cf0!important;color:#189cf0!important;transform:translateY(-3px);background:transparent!important}.social-icons a:hover i{color:#189cf0}.wrapper .refresh-button{font-family:"Maven Pro",sans-serif;font-size:14px;text-decoration:none;text-transform:uppercase;background:#189cf0;display:inline-block;padding:16px 30px;border:2px solid transparent;border-radius:4px;color:#fff;font-weight:400;-webkit-transition:.2s all;transition:.2s all}.wrapper .refresh-button:hover{background-color:#fff;border-color:#189cf0;color:#189cf0}.footer{position:fixed;bottom:10px;left:0;right:0;text-align:center;font-family:"Maven Pro",sans-serif;font-size:12px;color:#666;z-index:100}.footer a{font-family:"Maven Pro",sans-serif;font-size:12px;text-decoration:none;text-transform:none;background:transparent;display:inline;padding:0;border:none;border-radius:0;color:#189cf0;font-weight:400;-webkit-transition:.2s all;transition:.2s all}.footer a:hover{background-color:transparent;border-color:none;color:#0d6efd;text-decoration:underline}.footer .separator{margin:0 4px;color:#999}@media only screen and (max-width: 480px){.wrapper .container h1{font-size:162px}.wrapper h2{font-size:26px}.pagelogo img{max-width:150px}.social-icons a{font-size:20px;width:40px;height:40px}.social-icons a i{font-size:20px}.footer{font-size:10px}.footer a{font-size:10px}}</style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
        <div class="wrapper">
            <div class="container">
                <h1><i class="fa-solid fa-gears"></i></h1>
            </div>
            <?php if(isset($maintenance['logo-url']) && !empty($maintenance['logo-url'])) { ?>
            <div class="pagelogo">
                <img src="<?php echo esc_url($maintenance['logo-url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?> Logo">
            </div>
            <?php } ?>
            <h2><?php echo esc_attr($maintenance['title']); ?></h2>
            <p><?php echo wp_kses_post($maintenance['description']); ?></p>
            <?php
            $socials = array();
            $networks = array
            (
                'discord' => array('icon' => 'fa-brands fa-discord', 'name' => 'Discord'),
                'facebook' => array('icon' => 'fa-brands fa-facebook-f', 'name' => 'Facebook'),
                'github' => array('icon' => 'fa-brands fa-github', 'name' => 'GitHub'),
                'instagram' => array('icon' => 'fa-brands fa-instagram', 'name' => 'Instagram'),
                'linkedin' => array('icon' => 'fa-brands fa-linkedin-in', 'name' => 'LinkedIn'),
                'mastodon' => array('icon' => 'fa-brands fa-mastodon', 'name' => 'Mastodon'),
                'telegram' => array('icon' => 'fa-brands fa-telegram', 'name' => 'Telegram'),
                'tiktok' => array('icon' => 'fa-brands fa-tiktok', 'name' => 'TikTok'),
                'twitter' => array('icon' => 'fa-brands fa-twitter', 'name' => 'Twitter'),
                'youtube' => array('icon' => 'fa-brands fa-youtube', 'name' => 'YouTube')
            );
            
            foreach($networks as $network => $data)
            {
                $optionkey = $network . '-url';
                if(isset($maintenance[$optionkey]) && !empty($maintenance[$optionkey]))
                {
                    $socials[] = array
                    (
                        'url' => esc_url($maintenance[$optionkey]),
                        'icon' => $data['icon'],
                        'name' => $data['name']
                    );
                }
            }
            
            ?>
            <?php if(!empty($socials)) { ?>
            <div class="social-icons">
                <?php
                foreach($socials as $social)
                {
                    ?>
                    <a href="<?php echo $social['url']; ?>" title="<?php echo esc_attr($social['name']); ?>" target="_blank" rel="noopener noreferrer">
                        <i class="<?php echo $social['icon']; ?>"></i>
                    </a>
                    <?php 
                }
                ?>
            </div>
            <?php } ?>
            
            <a href="<?php echo get_site_url(); ?>" class="refresh-button"><?php echo __('Refresh Page', 'wpdx'); ?></a>
        </div>
    </div>    
    <?php $year = date('Y'); ?>
    <div class="footer">
        <?php 
        $footerparts = array();
        $copyright = false;
        $powered = false;
        
        if(isset($maintenance['copyright-name']) && !empty($maintenance['copyright-name']))
        {
            $copyright = true;
            $html = __('Copyright', 'wpdx').' &copy; '.$year.' ';            
            $hreftitle = (isset($maintenance['copyright-title']) && !empty($maintenance['copyright-title'])) ? esc_attr($maintenance['copyright-title']) : esc_attr($maintenance['copyright-name']);
            if(isset($maintenance['copyright-link']) && !empty($maintenance['copyright-link']))
            {
                $html.= '<a href="'.esc_url($maintenance['copyright-link']).'" title="'.$hreftitle.'" rel="noopener noreferrer">';
                $html.= esc_html($maintenance['copyright-name']);
                $html.= '</a>';
            }
            else
            {
                $html.= '<span title="'.$hreftitle.'">'.esc_html($maintenance['copyright-name']).'</span>';
            }
        
            $footerparts[] = $html;
        }

        if(isset($maintenance['powered-name']) && !empty($maintenance['powered-name']))
        {
            $powered = true;
            $html = __('Powered by', 'wpdx').' ';            
            $hreftitle = (isset($maintenance['powered-title']) && !empty($maintenance['powered-title'])) ? esc_attr($maintenance['powered-title']) : esc_attr($maintenance['powered-name']);            
            if(isset($maintenance['powered-link']) && !empty($maintenance['powered-link']))
            {
                $html.= '<a href="'.esc_url($maintenance['powered-link']).'" title="'.$hreftitle.'" target="_blank" rel="noopener noreferrer">';
                $html.= esc_html($maintenance['powered-name']);
                $html.= '</a>';
            }
            else
            {
                $html .= '<span title="'.$hreftitle.'">'.esc_html($maintenance['powered-name']).'</span>';
            }
        
            $footerparts[] = $html;
        }

        if($copyright && $powered)
        {
            echo $footerparts[0].' <span class="separator">|</span> '.$footerparts[1];
        }
        elseif($copyright || $powered)
        {
            echo implode('', $footerparts);
        }
        ?>
    </div>
</body>
</html>