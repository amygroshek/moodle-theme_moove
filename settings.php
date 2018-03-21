<?php
// This file is part of Ranking block for Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme user1st block settings file
 *
 * @package    theme_user1st
 * @copyright  2017 Willian Mano http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesettinguser1st', get_string('configtitle', 'theme_user1st'));

    /*
    * ----------------------
    * General settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_user1st_general', get_string('generalsettings', 'theme_user1st'));

    // Logo file setting.
    $name = 'theme_user1st/logo';
    $title = get_string('logo', 'theme_user1st');
    $description = get_string('logodesc', 'theme_user1st');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset.
    $name = 'theme_user1st/preset';
    $title = get_string('preset', 'theme_user1st');
    $description = get_string('preset_desc', 'theme_user1st');
    $default = 'default.scss';

    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_user1st', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_user1st/presetfiles';
    $title = get_string('presetfiles', 'theme_user1st');
    $description = get_string('presetfiles_desc', 'theme_user1st');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Variable $brand-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_user1st/brandcolor';
    $title = get_string('brandcolor', 'theme_user1st');
    $description = get_string('brandcolor_desc', 'theme_user1st');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Must add the page after definiting all the settings!
    $settings->add($page);

    /*
    * ----------------------
    * Advanced settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_user1st_advanced', get_string('advancedsettings', 'theme_user1st'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode('theme_user1st/scsspre',
        get_string('rawscsspre', 'theme_user1st'), get_string('rawscsspre_desc', 'theme_user1st'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode('theme_user1st/scss', get_string('rawscss', 'theme_user1st'),
        get_string('rawscss_desc', 'theme_user1st'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    /*
    * -----------------------
    * Frontpage settings tab
    * -----------------------
    */
    $page = new admin_settingpage('theme_user1st_frontpage', get_string('frontpagesettings', 'theme_user1st'));

    // Headerimg file setting.
    $name = 'theme_user1st/headerimg';
    $title = get_string('headerimg', 'theme_user1st');
    $description = get_string('headerimgdesc', 'theme_user1st');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'headerimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Bannerheading.
    $name = 'theme_user1st/bannerheading';
    $title = get_string('bannerheading', 'theme_user1st');
    $description = get_string('bannerheadingdesc', 'theme_user1st');
    $default = 'Perfect Learning System';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Bannercontent.
    $name = 'theme_user1st/bannercontent';
    $title = get_string('bannercontent', 'theme_user1st');
    $description = get_string('bannercontentdesc', 'theme_user1st');
    $default = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_user1st/displaymarketingbox';
    $title = get_string('displaymarketingbox', 'theme_user1st');
    $description = get_string('displaymarketingboxdesc', 'theme_user1st');
    $default = 1;
    $choices = array(0 => 'No', 1 => 'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    // Marketing1icon.
    $name = 'theme_user1st/marketing1icon';
    $title = get_string('marketing1icon', 'theme_user1st');
    $description = get_string('marketing1icondesc', 'theme_user1st');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing1icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1heading.
    $name = 'theme_user1st/marketing1heading';
    $title = get_string('marketing1heading', 'theme_user1st');
    $description = get_string('marketing1headingdesc', 'theme_user1st');
    $default = 'We host';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1subheading.
    $name = 'theme_user1st/marketing1subheading';
    $title = get_string('marketing1subheading', 'theme_user1st');
    $description = get_string('marketing1subheadingdesc', 'theme_user1st');
    $default = 'your MOODLE';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1content.
    $name = 'theme_user1st/marketing1content';
    $title = get_string('marketing1content', 'theme_user1st');
    $description = get_string('marketing1contentdesc', 'theme_user1st');
    $default = 'Moodle hosting in a powerful cloud infrastructure';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1url.
    $name = 'theme_user1st/marketing1url';
    $title = get_string('marketing1url', 'theme_user1st');
    $description = get_string('marketing1urldesc', 'theme_user1st');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2icon.
    $name = 'theme_user1st/marketing2icon';
    $title = get_string('marketing2icon', 'theme_user1st');
    $description = get_string('marketing2icondesc', 'theme_user1st');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing2icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2heading.
    $name = 'theme_user1st/marketing2heading';
    $title = get_string('marketing2heading', 'theme_user1st');
    $description = get_string('marketing2headingdesc', 'theme_user1st');
    $default = 'Consulting';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2subheading.
    $name = 'theme_user1st/marketing2subheading';
    $title = get_string('marketing2subheading', 'theme_user1st');
    $description = get_string('marketing2subheadingdesc', 'theme_user1st');
    $default = 'for your company';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2content.
    $name = 'theme_user1st/marketing2content';
    $title = get_string('marketing2content', 'theme_user1st');
    $description = get_string('marketing2contentdesc', 'theme_user1st');
    $default = 'Moodle consulting and training for you';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2url.
    $name = 'theme_user1st/marketing2url';
    $title = get_string('marketing2url', 'theme_user1st');
    $description = get_string('marketing2urldesc', 'theme_user1st');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3icon.
    $name = 'theme_user1st/marketing3icon';
    $title = get_string('marketing3icon', 'theme_user1st');
    $description = get_string('marketing3icondesc', 'theme_user1st');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing3icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3heading.
    $name = 'theme_user1st/marketing3heading';
    $title = get_string('marketing3heading', 'theme_user1st');
    $description = get_string('marketing3headingdesc', 'theme_user1st');
    $default = 'Development';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3subheading.
    $name = 'theme_user1st/marketing3subheading';
    $title = get_string('marketing3subheading', 'theme_user1st');
    $description = get_string('marketing3subheadingdesc', 'theme_user1st');
    $default = 'themes and plugins';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3content.
    $name = 'theme_user1st/marketing3content';
    $title = get_string('marketing3content', 'theme_user1st');
    $description = get_string('marketing3contentdesc', 'theme_user1st');
    $default = 'We develop themes and plugins as your desires';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3url.
    $name = 'theme_user1st/marketing3url';
    $title = get_string('marketing3url', 'theme_user1st');
    $description = get_string('marketing3urldesc', 'theme_user1st');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4icon.
    $name = 'theme_user1st/marketing4icon';
    $title = get_string('marketing4icon', 'theme_user1st');
    $description = get_string('marketing4icondesc', 'theme_user1st');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing4icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4heading.
    $name = 'theme_user1st/marketing4heading';
    $title = get_string('marketing4heading', 'theme_user1st');
    $description = get_string('marketing4headingdesc', 'theme_user1st');
    $default = 'Support';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4subheading.
    $name = 'theme_user1st/marketing4subheading';
    $title = get_string('marketing4subheading', 'theme_user1st');
    $description = get_string('marketing4subheadingdesc', 'theme_user1st');
    $default = 'we give you answers';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4content.
    $name = 'theme_user1st/marketing4content';
    $title = get_string('marketing4content', 'theme_user1st');
    $description = get_string('marketing4contentdesc', 'theme_user1st');
    $default = 'MOODLE specialized support';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4url.
    $name = 'theme_user1st/marketing4url';
    $title = get_string('marketing4url', 'theme_user1st');
    $description = get_string('marketing4urldesc', 'theme_user1st');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    /*
    * --------------------
    * Footer settings tab
    * --------------------
    */
    $page = new admin_settingpage('theme_user1st_footer', get_string('footersettings', 'theme_user1st'));

    $name = 'theme_user1st/getintouchcontent';
    $title = get_string('getintouchcontent', 'theme_user1st');
    $description = get_string('getintouchcontentdesc', 'theme_user1st');
    $default = 'Conecti.me';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Website.
    $name = 'theme_user1st/website';
    $title = get_string('website', 'theme_user1st');
    $description = get_string('websitedesc', 'theme_user1st');
    $default = 'http://conecti.me';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Mobile.
    $name = 'theme_user1st/mobile';
    $title = get_string('mobile', 'theme_user1st');
    $description = get_string('mobiledesc', 'theme_user1st');
    $default = 'Mobile : +55 (98) 00123-45678';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Mail.
    $name = 'theme_user1st/mail';
    $title = get_string('mail', 'theme_user1st');
    $description = get_string('maildesc', 'theme_user1st');
    $default = 'willianmano@conectime.com';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Facebook url setting.
    $name = 'theme_user1st/facebook';
    $title = get_string('facebook', 'theme_user1st');
    $description = get_string('facebookdesc', 'theme_user1st');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Twitter url setting.
    $name = 'theme_user1st/twitter';
    $title = get_string('twitter', 'theme_user1st');
    $description = get_string('twitterdesc', 'theme_user1st');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Googleplus url setting.
    $name = 'theme_user1st/googleplus';
    $title = get_string('googleplus', 'theme_user1st');
    $description = get_string('googleplusdesc', 'theme_user1st');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Linkdin url setting.
    $name = 'theme_user1st/linkedin';
    $title = get_string('linkedin', 'theme_user1st');
    $description = get_string('linkedindesc', 'theme_user1st');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Youtube url setting.
    $name = 'theme_user1st/youtube';
    $title = get_string('youtube', 'theme_user1st');
    $description = get_string('youtubedesc', 'theme_user1st');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}
