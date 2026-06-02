<?php
if((isset($_GET['output'])) && ($_GET['output'] === 'updated'))
{
    $notice = array('success', __('Your settings have been successfully updated.', 'maintenance-work'));
}
elseif((isset($_GET['output'])) && ($_GET['output'] === 'error'))
{
    if((isset($_GET['type'])) && ($_GET['type'] === 'status'))
    {
        $notice = array('wrong', __('The maintenance page status is not valid !!', 'maintenance-work'));
    }
    elseif((isset($_GET['type'])) && ($_GET['type'] === 'title'))
    {
        $notice = array('wrong', __('The maintenance page title is not valid !!', 'maintenance-work'));
    }
    elseif((isset($_GET['type'])) && ($_GET['type'] === 'description'))
    {
        $notice = array('wrong', __('The maintenance page description is not valid !!', 'maintenance-work'));
    }
    elseif((isset($_GET['type'])) && ($_GET['type'] === 'unknown'))
    {
        $notice = array('wrong', __('An unknown error occured !!', 'maintenance-work'));
    }
}
?>
<div class="wrap">
    <section class="wpdx-wrapper">
        <div class="wpdx-container">
            <div class="wpdx-tabs">
                <?php echo $this->return_plugin_header(); ?>
                <main class="tabs-main">
                    <?php echo $this->return_tabs_menu('tab1'); ?>
                    <section class="tab-section">
                        <?php if(isset($notice)) { ?>
                        <div class="wpdx-notice <?php echo esc_attr($notice[0]); ?>">
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span><?php echo esc_attr($notice[1]); ?></span>
                        </div>
                        <?php } elseif((isset($opts['status']) && ($opts['status']) === 'off')) { ?>
                        <div class="wpdx-notice warning">
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span><?php echo _e('Your maintenance page is currently switched-off ! In order to switch it on, please use the below form.', 'maintenance-work'); ?></span>
                        </div>
                        <?php } else { ?>
                        <div class="wpdx-notice info">
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span><?php echo _e('Your maintenance page is currently switched-on ! In order to switch it off, please use the below form.', 'maintenance-work'); ?></span>
                        </div>
                        <?php } ?>
                        <form method="POST">
                            <input type="hidden" name="mtw-update-option" value="true" />
                            <?php wp_nonce_field('mtw-referer-form', 'mtw-referer-option'); ?>
                            <div class="wpdx-form">
                                <div class="field">
                                    <?php $fieldID = uniqid(); ?>
                                    <span class="label"><?php echo _e('Maintenance Mode', 'maintenance-work'); ?></span>
                                    <div class="onoffswitch">
                                        <input id="<?php echo esc_attr($fieldID); ?>" type="checkbox" name="_maintenance_work[status]" class="onoffswitch-checkbox input-status" <?php if((isset($opts['status'])) && ($opts['status'] === 'on')) { echo 'checked="checked"';} ?>/>
                                        <label class="onoffswitch-label" for="<?php echo esc_attr($fieldID); ?>">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                    <small><?php echo _e('Do you want to switch your website under maintenance mode ?', 'maintenance-work'); ?></small>
                                </div>
                                <div id="handler-maintenance" class="subfield <?php if((isset($opts['status'])) && ($opts['status'] === 'on')) { echo 'show'; } ?>">
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Page Title', 'maintenance-work'); ?><span class="redmark">(<span>*</span>)</span></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[title]" placeholder="<?php echo _e('Enter the page title', 'maintenance-work'); ?>" value="<?php if(isset($opts['title'])) { echo stripslashes($opts['title']); } ?>" autocomplete="OFF" required="required"/>
                                        <small><?php echo _e('Enter the page title as you want it to appear on the maintenance page displayed to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Page Description', 'maintenance-work'); ?><span class="redmark">(<span>*</span>)</span></span>
                                        <textarea id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[description]" placeholder="<?php echo _e('Enter the page description', 'maintenance-work'); ?>" required="required"><?php if(isset($opts['description'])) { echo stripslashes($opts['description']); } ?></textarea>
                                        <small><?php echo _e('Enter the description as you want it to appear on the maintenance page displayed to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Logo URL', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[logo-url]" placeholder="<?php echo _e('Enter the logo URL', 'maintenance-work'); ?>" value="<?php if(isset($opts['logo-url'])) { echo stripslashes($opts['logo-url']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo _e('Enter the URL of the logo you want displayed on the maintenance page shown to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Copyright Name', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[copyright-name]" placeholder="<?php echo _e('Enter the copyright name', 'maintenance-work'); ?>" value="<?php if(isset($opts['copyright-name'])) { echo stripslashes($opts['copyright-name']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo _e('Enter the copyright name as you want it to appear on the maintenance page displayed to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Copyright Title', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[copyright-title]" placeholder="<?php echo _e('Enter the copyright title', 'maintenance-work'); ?>" value="<?php if(isset($opts['copyright-title'])) { echo stripslashes($opts['copyright-title']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo _e('Enter the copyright title as you want it to appear on the maintenance page displayed to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Copyright Link', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[copyright-link]" placeholder="<?php echo _e('Enter the copyright link', 'maintenance-work'); ?>" value="<?php if(isset($opts['copyright-link'])) { echo stripslashes($opts['copyright-link']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo _e('Enter the copyright link as you want it to appear on the maintenance page displayed to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Powered Name', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[powered-name]" placeholder="<?php echo _e('Enter the powered name', 'maintenance-work'); ?>" value="<?php if(isset($opts['powered-name'])) { echo stripslashes($opts['powered-name']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo _e('Enter the powered name as you want it to appear on the maintenance page displayed to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Powered Title', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[powered-title]" placeholder="<?php echo _e('Enter the powered title', 'maintenance-work'); ?>" value="<?php if(isset($opts['powered-title'])) { echo stripslashes($opts['powered-title']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo _e('Enter the powered title as you want it to appear on the maintenance page displayed to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Powered Link', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[powered-link]" placeholder="<?php echo _e('Enter the powered link', 'maintenance-work'); ?>" value="<?php if(isset($opts['powered-link'])) { echo stripslashes($opts['powered-link']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo _e('Enter the powered link as you want it to appear on the maintenance page displayed to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Discord URL', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[discord-url]" placeholder="<?php echo esc_attr__('Enter the Discord URL', 'maintenance-work'); ?>" value="<?php if(isset($opts['discord-url'])) { echo esc_url($opts['discord-url']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo esc_html__('Enter the Discord URL you want to display on the maintenance page shown to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Facebook URL', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[facebook-url]" placeholder="<?php echo esc_attr__('Enter the Facebook URL', 'maintenance-work'); ?>" value="<?php if(isset($opts['facebook-url'])) { echo esc_url($opts['facebook-url']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo esc_html__('Enter the Facebook URL you want to display on the maintenance page shown to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Github URL', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[github-url]" placeholder="<?php echo esc_attr__('Enter the Github URL', 'maintenance-work'); ?>" value="<?php if(isset($opts['github-url'])) { echo esc_url($opts['github-url']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo esc_html__('Enter the Github URL you want to display on the maintenance page shown to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Instagram URL', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[instagram-url]" placeholder="<?php echo esc_attr__('Enter the Instagram URL', 'maintenance-work'); ?>" value="<?php if(isset($opts['instagram-url'])) { echo esc_url($opts['instagram-url']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo esc_html__('Enter the Instagram URL you want to display on the maintenance page shown to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Linkedin URL', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[linkedin-url]" placeholder="<?php echo esc_attr__('Enter the Linkedin URL', 'maintenance-work'); ?>" value="<?php if(isset($opts['linkedin-url'])) { echo esc_url($opts['linkedin-url']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo esc_html__('Enter the Linkedin URL you want to display on the maintenance page shown to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Mastodon URL', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[mastodon-url]" placeholder="<?php echo esc_attr__('Enter the Mastodon URL', 'maintenance-work'); ?>" value="<?php if(isset($opts['mastodon-url'])) { echo esc_url($opts['mastodon-url']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo esc_html__('Enter the Mastodon URL you want to display on the maintenance page shown to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Telegram URL', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[telegram-url]" placeholder="<?php echo esc_attr__('Enter the Telegram URL', 'maintenance-work'); ?>" value="<?php if(isset($opts['telegram-url'])) { echo esc_url($opts['telegram-url']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo esc_html__('Enter the Telegram URL you want to display on the maintenance page shown to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('TikTok URL', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[tiktok-url]" placeholder="<?php echo esc_attr__('Enter the TikTok URL', 'maintenance-work'); ?>" value="<?php if(isset($opts['tiktok-url'])) { echo esc_url($opts['tiktok-url']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo esc_html__('Enter the TikTok URL you want to display on the maintenance page shown to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Twitter URL', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[twitter-url]" placeholder="<?php echo esc_attr__('Enter the Twitter URL', 'maintenance-work'); ?>" value="<?php if(isset($opts['twitter-url'])) { echo esc_url($opts['twitter-url']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo esc_html__('Enter the Twitter URL you want to display on the maintenance page shown to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Youtube URL', 'maintenance-work'); ?></span>
                                        <input type="text" id="<?php echo esc_attr($fieldID); ?>" name="_maintenance_work[youtube-url]" placeholder="<?php echo esc_attr__('Enter the Youtube URL', 'maintenance-work'); ?>" value="<?php if(isset($opts['youtube-url'])) { echo esc_url($opts['youtube-url']); } ?>" autocomplete="OFF"/>
                                        <small><?php echo esc_html__('Enter the Youtube URL you want to display on the maintenance page shown to your visitors.', 'maintenance-work'); ?></small>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <input type="submit" class="button button-primary button-theme" style="height:45px;" value="<?php _e('Update Settings', 'maintenance-work'); ?>">
                                </div>
                            </div>
                        </form>
                    </section>
                </main>
            </div>
        </div>
    </section>
</div>