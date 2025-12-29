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