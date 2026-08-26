<?php

/*
	swCV en.php file
	Hppsrc 2026
	Based on version 0.2.0-alpha
	? Base lang file and english lang file
*/

return [

	// just empty
	"" => "",

	// general lang data
	"LANG_CODE" => "en",
	"LANG_NAME" => "English",

	// unused
	"ADMIN_ERROR_TITLE" => "swCV Admin Error",
	"ADMIN_ERROR_TEXT" => "swCV Admin Error",

	// general view
	"LANGUAGE" => "Language",
	"MY_IP" => "My IP address",
	"SQUEMA_VERSION" => "Server version",
	"403_NOT_ALLOWED_TEXT" => "You're not allowed to open this page. Click <a href='?v=main'>here</a> to go back.",
	"404_NOT_FOUND_TEXT" => "This page was not found. Click <a href='?v=main'>here</a> to go back.",
	"NO_PROD_NOTICE" => "THIS PROJECT IS IN AN EARLY DEVELOPMENT PHASE. UNDER NO CIRCUMSTANCES SHOULD IT BE USED IN A PRODUCTION ENVIRONMENT.",

	"GENERAL_ADMIN_CREDENTIALS" => "Type your admin username",
	"GENERAL_ADMIN_CREDENTIALS_PLACEHOLDER" => "admin",
	"GENERAL_PASSWORD_CREDENTIALS" => "Type your admin password",
	"GENERAL_PASSWORD_CREDENTIALS_PLACEHOLDER" => "********",
	"GENERAL_ADMIN_ERROR" => "Admin username or password is incorrect.",
	"GENERAL_ADMIN_HASH_ERROR" => "Session was closed due to a credential error/expired. Please log in again.",
	"GENERAL_GO_BACK" => "Go back to home",
	"GENERAL_LOG_OUT" => "Log out",
	"GENERAL_NOT_ALLOWED" => "Request is not allowed.",
	"GENERAL_CSRF_ERROR" => "This request is missing authorization.",

	// pages titles
	"TITLE_SETUP" => "Setup",
	"TITLE_WELCOME" => "Welcome",
	"TITLE_DASHBOARD" => "Dashboard", // ! unused
	"TITLE_PRIVATE" => "Private",

	// private
	"PRIVATE_TITLE" => "This app is private",
	"PRIVATE_TEXT" => "This swCV deployment was to private, the web owner disabled any public view access. Wait until this option is disabled.",

	// setup view
	"SETUP_TITLE" => "swCV User Setup",
	"SETUP_TEXT" => "Welcome to the swCV data settings. In this view, you can configure your personal information and control its visibility in your swCV deployment.",
	"SETUP_NAME" => "Type your legal name here",
	"SETUP_NAME_PLACEHOLDER" => "John Doe",
	"SETUP_DESCRIPTION" => "Your amazing bio!",
	"SETUP_DESCRIPTION_PLACEHOLDER" => "I'm some years old and not an LLM!",
	"SETUP_AGE" => "Select your age",
	"SETUP_SHOW_AGE" => "Display my age",
	"SETUP_PROFILE_PICTURE" => "Add a profile picture!",
	"SETUP_PROFILE_PICTURE_INFO" => "File must be under 3MB and maximum 500x500 pixels.",
	"SETUP_PROFILE_PICTURE_ERROR_UPLOAD" => "Something went wrong with your image, try again.",
	"SETUP_PROFILE_PICTURE_ERROR_SIZE" => "Your image is over 3MB.",
	"SETUP_PROFILE_PICTURE_ERROR_DIMENSIONS" => "Your image is too big!",
	"SETUP_PROFILE_PICTURE_ERROR_RATIO" => "Your image is not square enough!",

	"SETUP_SOCIALS" => "Social media",
	"SETUP_FACEBOOK" => "Show my Facebook profile",
	"SETUP_FACEBOOK_PLACEHOLDER" => "Your Facebook username here",
	"SETUP_TWITTER" => "Show my Twitter/X profile",
	"SETUP_TWITTER_PLACEHOLDER" => "Your Twitter/X username here",
	"SETUP_LINKEDIN" => "Show my LinkedIn profile",
	"SETUP_LINKEDIN_PLACEHOLDER" => "Your LinkedIn profile URL",
	"SETUP_GITHUB" => "Show my GitHub profile",
	"SETUP_GITHUB_PLACEHOLDER" => "Your GitHub username here",
	"SETUP_WEB" => "Show my personal website",
	"SETUP_WEB_PLACEHOLDER" => "https://yourwebsite.com",
	"SETUP_EMAIL" => "Show my public email",
	"SETUP_EMAIL_PLACEHOLDER" => "hello@example.com",
	"SETUP_PHONE" => "Show my phone number",
	"SETUP_PHONE_WHATSAPP" => "This number has WhatsApp",
	"SETUP_PHONE_PLACEHOLDER" => "+1 234 567 890",

	"SETUP_SUBMIT" => "Setup now!",

	"SETUP_CHECK_EMPTY_ERROR" => "Some inputs are empty while their checks are enabled.",

	"SETUP_SUCCESS" => "User data was fully set up!",

	// welcome view
	"WELCOME_TITLE" => "Welcome to my swCV!",
	"WELCOME_TEXT" => "Well done! This swCV installation is now fully setup and you can now open your <a href='?v=dashboard'>dashboard</a> to disable this welcome screen! :)<br>If you're not the web owner, wait until this user disable the welcome view!",

	// dashboard
	"DASHBOARD_TITLE" => "swCV Dashboard",
	"DASHBOARD_TEXT_LOGIN" => "Log in to see your personal dashboard.",
	"DASHBOARD_BUTTON_LOGIN" => "Log in!",
	"DASHBOARD_TAB_GENERAL" => "General",
	"DASHBOARD_TAB_BLOG" => "Blog",
	"DASHBOARD_TAB_ANALYTICS" => "Analytics",
	"DASHBOARD_TAB_SETTINGS" => "Settings",
	"DASHBOARD_TAB_ABOUT" => "About",

	"DASHBOARD_DISABLED" => "Value can't be updated.",
	"DASHBOARD_SUCCESS" => "Value was updated succesfully!",
	"DASHBOARD_ERROR" => "Request wasn't successful.",
	"DASHBOARD_AJAX_ERROR" => "Unexpected AJAX request.",

	"DASHBOARD_TAB_GENERAL_TEXT" => "Here you can configure basic settings such as visibility, language, and more.",
	"DASHBOARD_TAB_GENERAL_SHOW_WELCOME" => "Show welcome screen: The default value is true at the time of installation. Once disabled, it cannot be re-enabled.",
	"DASHBOARD_TAB_GENERAL_SHOW_LAST_UPDATE" => "Show last update: Last time since database was modified. This is always updated when request are made to the database. This allows you to show or hide the last update date.",
	"DASHBOARD_TAB_GENERAL_PUBLIC_VIEW" => "Public view: If enabled, everyone can access your swCV. If disabled, a notice is shown saying this swCV can't be viewed.",
	"DASHBOARD_TAB_GENERAL_BLOG_ENABLED" => "Enable blog: If enabled, a blog section is shown in your swCV.",
	"DASHBOARD_TAB_GENERAL_BLOG_COMMENTS_ENABLED" => "Enable blog comments: If enabled, visitors can comment on blog posts.",
	"DASHBOARD_TAB_GENERAL_BLOG_LIKES_ENABLED" => "Enable blog likes: If enabled, visitors can like blog posts.",
	"DASHBOARD_TAB_GENERAL_BLOG_INFO" => "Blog comments and like do not require an accounts, comments are liked by an unique IP + ID hash. So \"banning\" users is not possible.",
	"DASHBOARD_TAB_GENERAL_LANGUAGE" => "Select swCV language",
	"DASHBOARD_TAB_GENERAL_LANGUAGE_INFO" => "Options will show % of total translations available based on english language.",

];

?>