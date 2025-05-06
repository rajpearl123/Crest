<?php

namespace App\Utils;

class ViewPath
{
    // WEB VIEWS
    public const HOME = 'web-views.home';
    public const REGSISTER = 'web-views.auth.register';
    public const LOGIN = 'web-views.auth.login';
    public const CUSTOMER_FORGOT_PASSWORD = 'web-views.auth.forgot-password';
    public const CUSTOMER_RESET_PASSWORD_VIEW = 'web-views.auth.reset-password';
    public const ABOUT_US = 'web-views.business_pages.about-us';
    public const GALLERY = 'web-views.gallery';
    public const BLOG = 'web-views.blog';
    public const SERVICES_WEDDING = 'web-views.services.wedding';
    public const VIDEO = 'web-views.video';
    public const BLOGDETAIL = 'web-views.blogdetail';


    public const TERMS_CONDITIONS = 'web-views.business_pages.terms-conditions';
    public const PRIVACY_POLICY = 'web-views.business_pages.privacy-policy';
    public const REFUND_POLICY = 'web-views.business_pages.refund-policy';
    public const CONTACT_US = 'web-views.business_pages.contact-us';
    public const CONTACT_MESSAGES = 'web-views.dashboard.contact-messages';
    public const CONTACT_REPLIES = 'web-views.dashboard.replies';
    
    public const CUSTOMER_BOOKINGS = 'web-views.bookings.list';
    public const CUSTOMER_BOOKING_DETAILS = 'web-views.bookings.view';
    public const INVOICE = 'web-views.invoice.booking-invoice';

    // HOME PAGE SECTIONS VIEWS
    public const HOME_PAGE_THEATER_SECTION = 'web-views.partials.view_theaters';

    //WEB THEARTER VIEWS
    public const THEATER_VIEW = 'web-views.theaters.view';
    public const THEATER_BOOKING = 'web-views.theaters.book';

    // USER PROFILE VIEWS
    public const USER_PROFILE_SIDEBAR = 'web-views.dashboard.partials._profile_sidebar';
    public const USER_DASHBOARD = 'web-views.dashboard.index';

    // ADMIN VIEWS STARTS HERE

    public const ADMIN_LOGIN = 'admin.auth.login';
    public const ADMIN_DASHBOARD = 'admin.dashboard.dashboard';
    public const ADMIN_USERS_LIST = 'admin.users.list';


    //MAIL TEMPLATE VIEWS
    public const SUBSCRIBER_NOTIFICATION = 'email-templates.subscriber-notification'; 
    public const REGSISTER_MAIL = 'email-templates.registration-mail';
    public const BOOKING_CONFIRMATION = 'email-templates.booking_confirmation';
    public const MAIL_STAFF_ADD = 'email-templates.add-staff-mail';
    public const USER_REVIEW_MAIL = 'email-templates.theater-review';

    //ADMIN Business Setting Pages

    public const ADMIN_INLINE_MENU_BUSINESS = 'admin.business_setting.partials._inline_menu_business';
    public const ADMIN_ABOUT_US = 'admin.business_setting.business_pages.about_us';
    public const ADMIN_PRIVACY_POLICY = 'admin.business_setting.business_pages.privacy_policy';
    public const ADMIN_REFUND_POLICY = 'admin.business_setting.business_pages.refund-policy';
    public const ADMIN_TERMS_CONDITIONS = 'admin.business_setting.business_pages.terms_conditions';
    public const ADMIN_WHY_CHOOSE_US = 'admin.business_setting.business_pages.why_choose_us';

    public const ADMIN_SOCIAL_LINKS = 'admin.business_setting.social_links';
    public const ADMIN_SOCIAL_LINKS_EDIT = 'admin.business_setting.edit_social_link';
    public const ADMIN_INLINE_MENU_WEBSITE_SETTING = 'admin.business_setting.partials.inline_menu_website_setting';
    public const ADMIN_WEBSITE_SETTING = 'admin.business_setting.website_setting.index';
    public const ADMIN_WEBSITE_BANNER = 'admin.business_setting.website_setting.banners';
    public const ADMIN_CONTACT_SUBMISSIONS = 'admin.contact.list';
    public const ADMIN_REPLY_VIEW = 'admin.contact.reply';

    //ADMIN THEATER VIEWS
    public const ADMIN_THEATER_ADD = 'admin.theaters.add';
    public const ADMIN_THEATER_LIST = 'admin.theaters.list';
    public const ADMIN_THEATER_EDIT = 'admin.theaters.edit';
    public const ADMIN_EVENT_ADD = 'admin.events.add';
    public const ADMIN_EVENT_EDIT = 'admin.events.edit';
    public const ADMIN_CAKE_ADD = 'admin.cakes.add';
    public const ADMIN_CAKE_EDIT = 'admin.cakes.edit';
    public const ADMIN_ADDON = 'admin.addon.add';
    public const ADMIN_ADDON_EDIT = 'admin.addon.edit';

    public const ADMIN_TIMING_ADD = 'admin.timing.add';
    
    public const ADMIN_SUBSCRIBERS = 'admin.subscribers.subscribers';

    //ADMIN BOOKING VIEWS
    public const ADMIN_BOOKING_PROSPECTS = 'admin.prospects.list';
    public const ADMIN_BOOKINGS = 'admin.bookings.list';
    public const ADMIN_ADD_BOOIKNG = 'admin.bookings.add';
    public const ADMIN_BOOKING_VIEW = 'admin.bookings.view';
    public const ADMIN_TRANSACTIONS = 'admin.bookings.transactions';
    public const ADMIN_CANCEL_REQUESTS = 'admin.bookings.cancel-requests';

    //ADMIN ROLES VIEWS
    public const ADMIN_ROLES = 'admin.roles.roles';
    public const ADMIN_PERMISSION_ASSIGNMENT = 'admin.roles.assign_permission';
    public const ADMIN_STAFF = 'admin.staff.staff';



    // Add more view paths as needed
}
