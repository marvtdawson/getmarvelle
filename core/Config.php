<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/16/16
 * Time: 11:32 PM
 */

namespace Core;


class Config
{

#################### SITE PROPERTIES ##########################

const SITE_NAME = 'Get Marvelle';
const SITE_DOMAIN = 'www.getmarvelle.com';
const SITE_LOGO = '/assets/images/Logo3.jpg';
const APP_ROOT = __DIR__;
const BASE_URL = 'http://localhost/projects/getmarvelle.dev'; // dev environment
const CORE_PAGES_KEYWORDS = 'corePages';
const CPANEL_PAGES_KEYWORDS = 'cPanPages';

#################### LAYOUT ###################################
const CPANEL_NAV_BUTTON = '/assets/images/site/mobile_menu_button_no_bkground.png';

#################### COOKIES ###################################
const COOKIE_HASH_NAME = 'hash';
const COOKIE_EXPIRY = 300000; // cookies expiry in 5 minutes

#################### DB DRIVERS  ##############################

// set db driver option i.e. PDO


################### MEMBER PROFILE IMAGES ####################
const MEMBER_PROFILE_BILLBOARD_IMAGE = '/assets/images/memberprofile/billboard/default.jpg';
const MEMBER_PROFILE_THUMB_PROFILE_IMAGE = '/assets/images/memberprofile/thumb/default.jpg';

#################### PUBLIC FORMS #############################

// ADMIN LOGIN FORM
const ADMIN_FORM_PAGE_TITLE = 'Register';
const ADMIN_LOGIN_FORM_NAME = 'admin_Form';
const ADMIN_FORM_ID = 21; // value reference in db table
const ADMIN_LOGIN_FORM_PROCESS = '/adminlogin/process';
const ADMIN_LOGIN_FORM_PRETTY_URI = '/adminlogin/index';
const ADMIN_FORM_SUBMIT_BUTTON = 'adminloginForm_Submit';

// CONTACT FORM
const CONTACT_FORM_PAGE_TITLE = 'Contact';
const CONTACT_FORM_NAME = 'conTact_Form';
const CONTACT_FORM_TABLE_NAME = 'conTactForm';
const CONTACT_FORM_ID = 22; // value reference in db table
const CONTACT_FORM_PROCESS = '/contact/process';
const CONTACT_FORM_PRETTY_URI = '/contact/index';
const CONTACT_FORM_SUBMIT_BUTTON = 'contactForm_Submit';

// LOGIN FORM
const LOGIN_FORM_PAGE_TITLE = 'Login';
const LOGIN_FORM_NAME = 'login_Form';
const LOGIN_FORM_ID = 23; // value reference in db table
const LOGIN_FORM_PROCESS = '/login/process';
const LOGIN_FORM_PRETTY_URI = '/login/index';
const LOGIN_FORM_SUBMIT_BUTTON = 'loginForm_Submit';

//REGISTER FORM
const REGISTER_FORM_PAGE_TITLE = 'Register';
const REGISTER_FORM_NAME = 'register_Form';
const REGISTER_FORM_ID =  24; // value reference in db table
const REGISTER_FORM_PROCESS = '/register/process';
const REGISTER_FORM_PRETTY_URI = '/register/index';
const REGISTER_FORM_SUBMIT_BUTTON = 'registerForm_Submit';

// SUBSCRIPTION
const SUBSCRIBE_FORM_PAGE_TITLE = 'Subscribe';
const SUBSCRIBE_FORM_NAME = 'subscribe_Form';
const SUBSCRIBE_FORM_ID = 25; // value reference in db table
const SUBSCRIBE_FORM_PROCESS = '/subscribe/process';
const SUBSCRIBE_FORM_PRETTY_URI = '/subscribe/index';
const SUBSCRIBE_FORM_SUBMIT_BUTTON = 'subscribeForm_Submit';

// FORGOT PASSWORD
const FORGOT_PASSWORD_FORM_PAGE_TITLE = 'Forgot Password';
const FORGOT_PASSWORD_FORM_NAME = 'forgot_password_Form';
const FORGOT_PASSWORD_FORM_ID = 26; // value reference in db table
const FORGOT_PASSWORD_FORM_PROCESS = '/forgotpassword/process';
const FORGOT_PASSWORD_FORM_PRETTY_URI = '/forgotpassword/index';
const FORGOT_PASSWORD_FORM_SUBMIT_BUTTON = 'forgotpassword_Submit';

#################### START APP CORE PAGES ##########################
const ABOUT_CORE_PAGE_PRETTY_URI = '/about/index';

####################################################################
####################################################################
######################### START CMS CPANEL #########################
####################################################################
####################################################################

#################### APP CMS CPANEL ################################
const APP_CMS_CPANEL_INDEX_PRETTY_URI = '/appcms/cpanel/index';

#################### APP CMS MUSIC ################################
// MUSIC LINK PAGES
const APP_CMS_MUSIC_INDEX = '/appcms/music/index';
const APP_CMS_ADD_CD_PROCESS = '/appcms/music/addcd/process';
const APP_CMS_ADD_CD_PRETTY_URI = '/appcms/music/addcd';
const APP_CMS_ADD_MUSIC_PROCESS = '/appcms/music/add/process';
const APP_CMS_ADD_MUSIC_PRETTY_URI = '/appcms/music/add';
const APP_CMS_EDIT_MUSIC_PROCESS = '/appcms/music/edit/process';
const APP_CMS_EDIT_MUSIC_PRETTY_URI = '/appcms/music/edit';
const APP_CMS_DELETE_MUSIC_PROCESS = '/appcms/music/delete/process';
const APP_CMS_DELETE_MUSIC_PRETTY_URI = '/appcms/music/delete';

#################### APP CMS VIDEO ################################
// VIDEO LINK PAGES
const APP_CMS_VIDEO_INDEX_PRETTY_URI = '/appcms/video/index';
const APP_CMS_ADD_VIDEO_PROCESS = '/appcms/video/add/process';
const APP_CMS_ADD_VIDEO_PRETTY_URI = '/appcms/video/add';
const APP_CMS_EDIT_VIDEO_PROCESS = '/appcms/video/edit/process';
const APP_CMS_EDIT_VIDEO_PRETTY_URI = '/appcms/video/edit';
const APP_CMS_DELETE_VIDEO_PROCESS = '/appcms/video/delete/process';
const APP_CMS_DELETE_VIDEO_PRETTY_URI = '/appcms/video/delete';

#################### APP CMS CONTACT PAGE ################################
// CONTACT ENTRIES PAGE
const APP_CMS_CONTACT_ENTRIES_PAGE_TITLE = 'Contact Request';
const APP_CMS_CONTACT_ENTRIES_FORM_NAME = 'conTactForm';
const APP_CMS_CONTACT_ENTRIES_ID = 22; // value reference in db table
const APP_CMS_CONTACT_ENTRIES_PROCESS = '/appcms/contactentries/process';
const APP_CMS_CONTACT_ENTRIES_PRETTY_URI = '/appcms/contactentries/index';
const APP_CMS_CONTACT_ENTRIES_SUBMIT_BUTTON = 'contactForm_Submit';

#################### APP CMS CORE PAGES ################################
const APP_CMS_CORE_PAGES_PRETTY_URI = '/appcms/corepages/index';
//EDIT CORE PAGES
const APP_CMS_EDIT_CORE_PAGES_PRETTY_URI = '/appcms/corepages/editPageContent';
const APP_CMS_SAVE_CORE_PAGES_PRETTY_URI = '/appcms/corepages/savePageContent';

#################### APP CMS THEME INDEX ################################
const APP_CMS_THEME_INDEX_PRETTY_URI = '/appcms/theme/index';
const APP_CMS_THEME_INDEX_PAGE_TITLE = 'Edit Theme';

#################### APP CMS THEME EDIT FONT ################################
// THEME EDIT FONT FORM PAGE
const APP_CMS_THEME_EDIT_FONT_PAGE_TITLE = 'Edit Font';
const APP_CMS_THEME_EDIT_FONT_FORM_NAME = 'editFont';
const APP_CMS_THEME_EDIT_FONT_ID = 22; // value reference in db table
const APP_CMS_THEME_EDIT_FONT_PROCESS = '/appcms/theme/processfont';
const APP_CMS_THEME_EDIT_FONT_PRETTY_URI = '/appcms/theme/editfont';
const APP_CMS_THEME_EDIT_FONT_SUBMIT_BUTTON = 'editfontProcessTheme_Submit';

#################### APP CMS THEME EDIT LAYOUT COLOR ################################
// THEME EDIT LAYOUT COLOR FORM PAGE
const APP_CMS_THEME_EDIT_LAYOUT_COLOR_PAGE_TITLE = 'Edit Layout Color';
const APP_CMS_THEME_EDIT_LAYOUT_COLOR_FORM_NAME = 'editLayoutColor';
const APP_CMS_THEME_EDIT_LAYOUT_COLOR_ID = 22; // value reference in db table
const APP_CMS_THEME_EDIT_LAYOUT_COLOR_PROCESS = '/appcms/theme/processlayoutcolor';
const APP_CMS_THEME_EDIT_LAYOUT_COLOR_PRETTY_URI = '/appcms/theme/layoutcolor';
const APP_CMS_THEME_EDIT_LAYOUT_COLOR_SUBMIT_BUTTON = 'editlayoutProcessTheme_Submit';

#################### APP CMS THEME EDIT PAGE BACKGROUND COLOR ################################
// THEME EDIT PAGE BACKGROUND COLOR FORM PAGE
const APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_PAGE_TITLE = 'Edit Page Background Color';
const APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_FORM_NAME = 'editPageBackgroundColor';
const APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_ID = 22; // value reference in db table
const APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_PROCESS = '/appcms/theme/processpagebackground';
const APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_PRETTY_URI = '/appcms/theme/pagebackground';
const APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_SUBMIT_BUTTON = 'editpagebackgroundProcessTheme_Submit';

#################### APP CMS VIRTUAL MANAGER INDEX ################################
const APP_CMS_VIRTUAL_MANAGER_INDEX_PRETTY_URI = '/appcms/virtualmanager/index';
const APP_CMS_VIRTUAL_MANAGER_INDEX_PAGE_TITLE = 'Virtual Manager';

#################### APP CMS VIRTUAL MANAGER ################################
// FAN STATS PAGE
const APP_CMS_VIRTUAL_MANAGER_FAN_STATS_PAGE_TITLE = 'View Fan Stats';
const APP_CMS_VIRTUAL_MANAGER_FAN_STATS_FORM_NAME = 'viewFanStats';
const APP_CMS_VIRTUAL_MANAGER_FAN_STATS_ID = 220; // value reference in db table
const APP_CMS_VIRTUAL_MANAGER_FAN_STATS_PROCESS = '/appcms/virtualmanager/fanstats/process';
const APP_CMS_VIRTUAL_MANAGER_FAN_STATS_PRETTY_URI = '/appcms/virtualmanager/fanstats';
const APP_CMS_VIRTUAL_MANAGER_FAN_STATS_BUTTON = 'fanStatsProcess_Submit';

// TRACK STATS PAGE
const APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_PAGE_TITLE = 'View Track Stats';
const APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_FORM_NAME = 'viewTrackStats';
const APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_ID = 220; // value reference in db table
const APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_PROCESS = '/appcms/virtualmanager/trackstats/process';
const APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_PRETTY_URI = '/appcms/virtualmanager/trackstats';
const APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_BUTTON = 'trackStatsProcess_Submit';

#################### APP CMS USER PROFILE ################################
const APP_CMS_USER_INDEX_PAGE_URI = '/appcms/users/index';
const APP_CMS_USER_EDIT_ADDRESS_PRETTY_URI = '/appcms/users/editAddress';
const APP_CMS_USER_EDIT_EMAIL_PRETTY_URI = '/appcms/users/editEmail';

const APP_CMS_USER_EDIT_ALTERNATIVE_EMAIL_PRETTY_URI = '/appcms/users/alternativeemail';


const APP_CMS_USER_EDIT_PHONE_PRETTY_URI = '/appcms/users/editPhone';

const APP_CMS_USER_DEMOGRAPHS_PRETTY_URI = '/appcms/users/demographs';


const APP_CMS_USER_DEMOGRAPHS_ARTIST_NAME_FORM_NAME = 'artistNameForm';
const APP_CMS_USER_DEMOGRAPHS_ARTIST_NAME_FORM_PROCESS = '/appcms/users/processDemoGraphArtistNameForm';

const APP_CMS_USER_DEMOGRAPHS_ARTIST_STYLE_FORM_NAME = 'flowStyleForm';
const APP_CMS_USER_DEMOGRAPHS_ARTIST_STYLE_FLOW_FORM = '/appcms/users/artiststyle';

#################### APP CMS SETTINGS ################################
const APP_CMS_SETTINGS_NOTIFICATIONS_PRETTY_URI = '/appcms/settings/index';

#################### RADIO STATION #############################
const APP_CMS_CONTROL_BOARD_PAGE_INDEX_PRETTY_URI = '/appcms/radiostation/index';
const APP_CMS_CONTROL_BOARD_INDEX_PAGE_TITLE = 'Radio Station';

// CONTROL BOARD PAGE
const APP_CMS_CONTROL_BOARD_PAGE_TITLE = 'Control Board';
const APP_CMS_CONTROL_BOARD_FORM_NAME = 'conTrolBoarD';
const APP_CMS_CONTROL_BOARD_ID = 22; // value reference in db table
const APP_CMS_CONTROL_BOARD_PROCESS = '/appcms/radiostation/controlboard/process';
const APP_CMS_CONTROL_BOARD_PRETTY_URI = '/appcms/radiostation/controlboard';
# const APP_CMS_CONTROL_BOARD_SUBMIT_BUTTON = 'controlboardForm_Submit';

// SOUND EFFECTS PAGE
const APP_CMS_SOUND_EFFECTS_PAGE_TITLE = 'Sound Board';
const APP_CMS_SOUND_EFFECTS_FORM_NAME = 'sounDeFF3ctS';
const APP_CMS_SOUND_EFFECTS_ID = 22; // value reference in db table
const APP_CMS_SOUND_EFFECTS_PROCESS = '/appcms/radiostation/soundeffects/process';
const APP_CMS_SOUND_EFFECTS_PRETTY_URI = '/appcms/radiostation/soundeffects';
# const APP_CMS_SOUND_EFFECTS_SUBMIT_BUTTON = 'soundEffectForm_Submit';

################### SLIDE SHOW #############################
const APP_CMS_SLIDESHOW_INDEX_PAGE_PRETTY_URI = '/appcms/slideshow/index';

// SLIDE SHOW PAGE
const APP_CMS_SLIDESHOW_PAGE_TITLE = 'Slideshow Image';
const APP_CMS_SLIDESHOW_FORM_NAME = 'sLid3shOW';
const APP_CMS_SLIDESHOW_ID = 32; // value reference in db table
const APP_CMS_SLIDESHOW_PROCESS = '/appcms/slideshow/process';
const APP_CMS_SLIDESHOW_PRETTY_URI = '/appcms/slideshow/index';
const APP_CMS_SLIDESHOW_SUBMIT_BUTTON = 'slideshowForm_Submit';

// ADD SLIDE PAGE
const APP_CMS_ADD_SLIDE_PRETTY_URI = '/appcms/slideshow/add';
const APP_CMS_ADD_SLIDE_PROCESS = '/appcms/slideshow/addSlide';

// EDIT SLIDE PAGE
const APP_CMS_EDIT_SLIDE_PRETTY_URI = '/appcms/slideshow/edit';

// DELETE SLIDE PAGE
const APP_CMS_DELETE_SLIDE_PRETTY_URI = '/appcms/slideshow/delete';

################### GALLERY #############################
const APP_CMS_GALLERY_INDEX_PAGE_PRETTY_URI = '/appcms/gallery/index';
const APP_CMS_GALLERY_ADD_PAGE_PRETTY_URI = '/appcms/gallery/addgallery';
const APP_CMS_GALLERY_EDIT_PAGE_PRETTY_URI = '/appcms/gallery/editgallery';
const APP_CMS_GALLERY_DELETE_PAGE_PRETTY_URI = '/appcms/gallery/deletegallery';

################### SOCIAL MEDIA #############################
const APP_CMS_SOCIAL_MEDIA_INDEX_PAGE_PRETTY_URI = '/appcms/socialmedia/index';
const APP_CMS_SOCIAL_MEDIA_ADD_PAGE_PRETTY_URI = '/appcms/socialmedia/addsocialmedia';
const APP_CMS_SOCIAL_MEDIA_EDIT_PAGE_PRETTY_URI = '/appcms/socialmedia/editsocialmedia';
const APP_CMS_SOCIAL_MEDIA_DELETE_PAGE_PRETTY_URI = '/appcms/socialmedia/deletesocialmedia';

#################### CONFIRMATION MESSAGES  ####################################
const APP_CONFIRM_MESSAGES_PAGE_PRETTY_URI = '/confirmMessages/index';
const APP_CONFIRM_CONTACT_MESSAGES_PAGE_PRETTY_URI = '/confirmMessages/contact';
const APP_CONFIRM_MEMBER_NOT_FOUND_PAGE_PRETTY_URI = '/confirmMessages/memberNotFound';

const APP_CONFIRM_ACTIVATION_ACCOUNT_PAGE_TITLE = 'Activation Confirmed';
const APP_CONFIRM_ACTIVATION_ACCOUNT_PAGE_PRETTY_URI = '/confirmMessages/activationIncomplete';

#################### CSRF TOKEN ####################################
/**
 * @return string to each form's controller construct method
 */
public static function getTokenName()
{
    $tokenName = 'golden_token';
    return $tokenName;
}

#################### LOGGED IN USER SESSION NAME ####################################
const LOGGED_IN_USER_SESSION_NAME = 'kropad_access';

public static function getLoggedInUserSessionName(){
   $useSessionName =  self::LOGGED_IN_USER_SESSION_NAME;
   return $useSessionName;
}

#####################  DATABASE CONFIGURATION AND SETUP ##############################
// SYSTEM DATABASE
##const SITE_DB_NAME = 'g3tmarV3Lle1550';
// TABLE ABBREVIATION PREFIX
##const TAP = 'getmarv_';
// TABLE ABBREVIATION SUFFIX
##const TASUF = '_table';

// SYSTEM TABLES
/*const SITE_REGISTERED_MEMBERS_TABLE = TAP.'register_members'.TASUF;
const SITE_CONTACT_FORM_TABLE = TAP.'contact_form'.TASUF;
const SITE_CONFIGURE_PROCESSESS_TABLE = TAP.'config_processes'.TASUF;
const SITE_FORGOT_PASSWORD_TABLE = TAP.'forgot_password'.TASUF;
const SITE_MEMBERS_LOGGED_IN_TABLE = TAP.'members_loggedin'.TASUF;
const SITE_MEMBERS_ONLINE_TABLE = TAP.'members_online'.TASUF;
const SITE_SOCIAL_MEDIA_CONNECTIONS_TABLE = TAP.'social_media_connections'.TASUF;
const SITE_BLOG_LOG_TABLE = TAP.'blog_log'.TASUF;
const SITE_VIDEO_LOG_TABLE = TAP.'video_log'.TASUF;
const SITE_WEEKLY_BROADCAST_LOG_TABLE = TAP.'weekly_broadcast_log'.TASUF;
const SITE_CORE_PAGES_NAME_TABLE = TAP.'core_pages_name'.TASUF;*/



}