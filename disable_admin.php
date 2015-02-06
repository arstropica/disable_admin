<?php
    /*
    Plugin Name: Disable Admin Access
    Plugin URI: http://arstropica.com/
    Description: Disable WordPress Admin Access
    Version: 1.0
    Author: ArsTropica <info@digitalsherpa.com>
    */
    
    // Add Exceptions
    $daa_exceptions = array('username');

    add_action('admin_init', 'no_mo_dashboard');
    function no_mo_dashboard() {
        global $current_user, $daa_exceptions;
        get_currentuserinfo();
        $user_name = $current_user->user_login;
        $user_email = $current_user->user_email;
        if ((! in_array($user_name, $daa_exceptions)) && $_SERVER['DOING_AJAX'] != '/wp-admin/admin-ajax.php') {
            disabled_splash();
            exit;
        }
    }

    function disabled_splash() {
        $blog_name = get_bloginfo('name');
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title><?php echo $blog_name; ?></title>
            <link rel='stylesheet' id='wp-admin-css'  href='/wp-admin/css/wp-admin.min.css' type='text/css' media='all' />
            <link rel='stylesheet' id='buttons-css'  href='/wp-includes/css/buttons.min.css' type='text/css' media='all' />
            <link rel='stylesheet' id='colors-fresh-css'  href='/wp-admin/css/colors-fresh.min.css' type='text/css' media='all' />
            <meta name='robots' content='noindex,nofollow' />
        </head>
        <body class="login login-action-login wp-core-ui">
            <div id="login">
                <h1><a href="/" title="<?php echo $blog_name; ?>">Blog Admin has been Disabled</a></h1>
                <h2 style="text-align: center;"><?php echo $blog_name; ?> Blog Admin area is temporarily unavailable</h2>

                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p style="font-weight: bold; text-align: center;">Due to ongoing maintenance, access to the administrative area for this blog will be temporarily unavailable.</p>
                <p>&nbsp;</p>
                <p style="text-align: center;">Thank you for your patience.</p>
                <p>&nbsp;</p>

                <p id="backtoblog"><a href="/" title="Are you lost?">&larr; Back to Blog</a></p>

            </div>
            <div class="clear"></div>
        </body>
    </html>        
    <?php
    }
?>
