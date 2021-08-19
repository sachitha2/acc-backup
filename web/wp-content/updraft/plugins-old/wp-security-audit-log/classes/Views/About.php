<?php
/**
 * @package Wsal
 *
 * About Page.
 */
class WSAL_Views_About extends WSAL_AbstractView
{
    public function GetTitle()
    {
        return __('About WP Security Audit Log', 'wp-security-audit-log');
    }
    
    public function GetIcon()
    {
        return 'dashicons-editor-help';
    }
    
    public function GetName()
    {
        return __('About', 'wp-security-audit-log');
    }
    
    public function GetWeight()
    {
        return 6;
    }
    
    public function Render()
    {
        ?><div class="metabox-holder" style="position: relative;">
        
            <div class="postbox" style="margin-right: 270px;">
                <!--h3 class="hndl"><span>About WP Security Audit Log</span></h3-->
                <div class="inside">
                    <div class="activity-block">
                        <?php _e('WP Security Audit Log enables WordPress administrators and owners to identify WordPress security issues before they become a security problem by keeping a security audit log. WP Security Audit Log is developed by WordPress security professionals WP White Security.', 'wp-security-audit-log'); ?>
                        
                        <h2><?php _e('Keep A WordPress Security Audit Log & Identify WordPress Security Issues', 'wp-security-audit-log'); ?></h2>
                        <p>
                            <?php _e('WP Security Audit Log logs everything happening on your WordPress blog or website and WordPress multisite network. By using WP Security Audit Log security plugin it is very easy to track suspicious user activity before it becomes a problem or a security issue. A WordPress security alert is generated by the plugin when:', 'wp-security-audit-log'); ?>
                        </p>
                        <ul style="list-style-type: disc; margin-left: 2.5em; list-style-position: outside;">
                            <li><?php _e('User creates a new user or a new user is registered', 'wp-security-audit-log'); ?></li>
                            <li><?php _e('Existing user changes the role, password or other properties of another user', 'wp-security-audit-log'); ?></li>
                            <li><?php _e('Existing user on a WordPress multisite network is added to a site', 'wp-security-audit-log'); ?></li>
                            <li><?php _e('User uploads or deletes a file, changes a password or email address', 'wp-security-audit-log'); ?></li>
                            <li><?php _e('User installs, activates, deactivates, upgrades or uninstalls a plugin', 'wp-security-audit-log'); ?></li>
                            <li><?php _e('User creates, modifies or deletes a new post, page, category or a custom post type', 'wp-security-audit-log'); ?></li>
                            <li><?php _e('User installs or activates a WordPress theme', 'wp-security-audit-log'); ?></li>
                            <li><?php _e('User adds, modifies or deletes a widget', 'wp-security-audit-log'); ?></li>
                            <li><?php _e('User uses the dashboard file editor', 'wp-security-audit-log'); ?></li>
                            <li><?php _e('WordPress settings are changed', 'wp-security-audit-log'); ?></li>
                            <li><?php _e('Failed login attempts', 'wp-security-audit-log'); ?></li>
                            <li><?php _e('and much more&hellip;', 'wp-security-audit-log'); ?></li>
                        </ul>
                        <br/>
                        Refer to the complete list of <a href="http://www.wpsecurityauditlog.com/documentation/list-monitoring-wordpress-security-alerts-audit-log/?utm_source=wsalabt&utm_medium=txtlink&utm_campaign=wsal" target="_blank">WordPress Security Alerts</a> for more information.
                    </div>
                </div>
            </div>
            
            <div style="position: absolute; right: 70px; width: 180px; top: 10px;">
                <div class="postbox">
                    <h3 class="hndl"><span><?php _e('Extend the Functionality & Get More Value from WP Security Audit Log', 'wp-security-audit-log'); ?></span></h3>
                    <div class="inside">
                        <p>
                            <?php _e('Get more value out of WP Security Audit Log by extending the functionality of WP Security Audit Log with the premium Add-Ons.'); ?>
                        </p>
                        <a class="button button-primary" href="http://www.wpsecurityauditlog.com/plugin-extensions/" target="_blank"><?php _e('See Add-Ons', 'wp-security-audit-log'); ?></a>
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndl"><span><?php _e('WP Security Audit Log in your Language!', 'wp-security-audit-log'); ?></span></h3>
                    <div class="inside">
                        <?php _e('If you are interested in translating our plugin please drop us an email on', 'wp-security-audit-log'); ?>
                        <a href="mailto:plugins@wpwhitesecurity.com">plugins@wpwhitesecurity.com</a>.
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndl"><span><?php _e('WordPress Security Services', 'wp-security-audit-log'); ?></span></h3>
                    <div class="inside">
                        <?php _e('Professional WordPress security services provided by WP White Security', 'wp-security-audit-log'); ?>
                        <ul>
                            <li><a href="http://www.wpwhitesecurity.com/wordpress-security-services/wordpress-security-hardening/?utm_source=wpsalabt&utm_medium=txtlink&utm_campaign=wpsal" target="_blank">Security Hardening</a></li>
                            <li><a href="http://www.wpwhitesecurity.com/wordpress-security-services/wordpress-security-audit/?utm_source=wpsalabt&utm_medium=txtlink&utm_campaign=wpsal" target="_blank">Security Audit</a></li>
                            <li><a href="http://www.wpwhitesecurity.com/wordpress-security-services/wordpress-plugins-security-code-audit-review/?utm_source=wpsalabt&utm_medium=txtlink&utm_campaign=wpsal" target="_blank">Plugin Security Code Audit</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><?php
    }
}
