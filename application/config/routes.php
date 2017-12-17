<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['access_denied'] = "Access";


$route['dashboard'] = "Dashboard";

$route['tickets/ini_type'] = "Tickets/ini_type";
$route['tickets/event_download'] = "Tickets/event_download";
$route['tickets/share_ticket'] = "Tickets/share_ticket";
$route['tickets/add_material'] = "Tickets/add_material";
$route['tickets/drafts'] = "Tickets/draft_tickets";
$route['tickets/publish'] = "Tickets/publish";
$route['tickets/me'] = "Tickets/my_tickets";
$route['tickets/open'] = "Tickets/open_tickets";
$route['tickets/closed'] = "Tickets/closed_tickets";
$route['tickets/deleted'] = "Tickets/deleted_tickets";
$route['tickets/new'] = "Tickets/new_tickets";
$route['tickets/create'] = "Tickets/create_ticket";
$route['tickets/edit'] = "Tickets/new_tickets";
$route['tickets/history'] = "Tickets/history";
$route['tickets/addcomment'] = "Tickets/addcomment";
$route['tickets/(:any)'] = "Tickets/ticket_edit/$1";
$route['tickets/pdf'] = "Tickets/gen_pdf";
$route['fetchservice'] = "Tickets/fetch_sub_service";
$route['tickets/status/change'] = "Tickets/status_change";

$route['vendors/active'] = "Vendors/active_vendors";
$route['vendors/inactive'] = "Vendors/inactive_vendors";
$route['vendors/new'] = "Vendors/vendor_new";
$route['vendor/edit/(:any)'] = "Vendors/vendor_edit/$1";

$route['invoice/pdf'] = "Invoices/Invoice_pdf";
$route['invoice/send_email'] = "Invoices/send_email";
$route['invoice/update_rot'] = "Invoices/update_rot";
$route['invoice/requested'] = "Invoices/requested";
$route['invoice/mat_search'] = "Invoices/material_search";
$route['invoice/generate/(:any)'] = "Invoices/generate/$1";
$route['invoice/list'] = "Invoices/raised";
$route['invoice/invoice_status_change'] = "Invoices/invoice_status_change";
$route['invoice/invoice_date_change'] = "Invoices/invoice_date_change";
$route['invoice/change_bill_due'] = "Invoices/change_bill_due";
$route['invoice/update'] = "Invoices/invoice_update";
$route['invoice/edit/(:any)'] = "Invoices/edit/$1";

$route['settings/ticket-config/add_ini_type'] = "Settings/add_ini_type";
$route['settings/ticket-config/add_community'] = "Settings/add_community";
$route['settings/ticket-config/material_import'] = "Settings/material_import";
$route['settings/ticket-config/material_update'] = "Settings/material_update";
$route['settings/ticket-config'] = "Settings/ticketconfig";
$route['settings/email-templates'] = "Settings/email_tpl";
$route['settings/email-templates/edit/(:any)'] = "Settings/email_tpl_edit/$1";
$route['settings/appconfig'] = "Settings/appconfig";
$route['settings/appconfig/update'] = "Settings/appconfig_update";

$route['language/(:any)'] = "Language/change/$1";
$route['login'] = "Login";
$route['logout'] = "Login/logout";
$route['profile'] = "Profile";
$route['profile/pic_upload'] = "Profile/do_upload";

$route['calendar'] = "calendar";
$route['calendar/add_event'] = "calendar/add_event";
$route['calendar/edit_event'] = "calendar/edit_event";
$route['calendar/get_events'] = "calendar/get_events";

$route['backup'] = "backup";
$route['backup/run'] = "backup/run_backup";


$route['landing'] = "landing/index";
$route['create-ticket'] = "landing/create_ticket";
$route['track-ticket'] = "landing/track_ticket";
$route['change-lang'] = "landing/change_lang";



