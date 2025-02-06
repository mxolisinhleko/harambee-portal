<?php

use App\Mail\Common;
use App\Mail\TestMail;
use App\Models\Custom;
use App\Models\Invoice;
use App\Models\LoggedHistory;
use App\Models\MaintenanceRequest;
use App\Models\Notification;
use App\Models\Subscription;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Property;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

if (!function_exists('settingsKeys')) {
    function settingsKeys()
    {
        return $settingsKeys = [
            "app_name" => "",
            "theme_color" => "color1",
            "color_type" => "default",
            "own_color" => "",
            "own_color_code" => "",
            "sidebar_mode" => "light",
            "layout_direction" => "ltrmode",
            "layout_mode" => "lightmode",
            "company_logo" => "logo.png",
            "company_favicon" => "favicon.png",
            "landing_logo" => "landing_logo.png",
            "meta_seo_title" => "",
            "meta_seo_keyword" => "",
            "meta_seo_description" => "",
            "meta_seo_image" => "",
            "company_date_format" => "M j, Y",
            "company_time_format" => "g:i A",
            "company_name" => "",
            "company_phone" => "",
            "company_address" => "",
            "company_email" => "",
            "company_email_from_name" => "",
            "google_recaptcha" => "off",
            "recaptcha_key" => "",
            "recaptcha_secret" => "",
            "landing_page" => "on",
            "register_page" => "on",
            'SERVER_DRIVER' => "",
            'SERVER_HOST' => "",
            'SERVER_PORT' => "",
            'SERVER_USERNAME' => "",
            'SERVER_PASSWORD' => "",
            'SERVER_ENCRYPTION' => "",
            'FROM_EMAIL' => "",
            'FROM_NAME' => "",
            "invoice_number_prefix" => "#INV-000",
            "expense_number_prefix" => "#EXP-000",
            'CURRENCY' => "USD",
            'CURRENCY_SYMBOL' => "$",
            'STRIPE_PAYMENT' => "off",
            'STRIPE_KEY' => "",
            'STRIPE_SECRET' => "",
            "paypal_payment" => "off",
            "paypal_mode" => "",
            "paypal_client_id" => "",
            "paypal_secret_key" => "",
            "bank_transfer_payment" => "off",
            "bank_name" => "",
            "bank_holder_name" => "",
            "bank_account_number" => "",
            "bank_ifsc_code" => "",
            "bank_other_details" => "",
            "flutterwave_payment" => "off",
            "flutterwave_public_key" => "",
            "flutterwave_secret_key" => "",
            "timezone" => "",
        ];
    }
}

if (!function_exists('settings')) {
    function settings()
    {
        $settingData = DB::table('settings');
        if (\Auth::check()) {
            $userId = parentId();
            $settingData = $settingData->where('parent_id', $userId);
        } else {
            $settingData = $settingData->where('parent_id', 1);
        }
        $settingData = $settingData->get();
        $details = settingsKeys();

        foreach ($settingData as $row) {
            $details[$row->name] = $row->value;
        }

        config(
            [
                'captcha.secret' => $details['recaptcha_secret'],
                'captcha.sitekey' => $details['recaptcha_key'],
                'options' => [
                    'timeout' => 30,
                ],
            ]
        );

        return $details;
    }
}

if (!function_exists('subscriptionPaymentSettings')) {
    function subscriptionPaymentSettings()
    {
        $settingData = DB::table('settings')->where('type', 'payment')->where('parent_id', '=', 1)->get();
        $result = [
            'CURRENCY' => "USD",
            'CURRENCY_SYMBOL' => "$",
            'STRIPE_PAYMENT' => "off",
            'STRIPE_KEY' => "",
            'STRIPE_SECRET' => "",
            "paypal_payment" => "off",
            "paypal_mode" => "",
            "paypal_client_id" => "",
            "paypal_secret_key" => "",
            "bank_transfer_payment" => "off",
            "bank_name" => "",
            "bank_holder_name" => "",
            "bank_account_number" => "",
            "bank_ifsc_code" => "",
            "bank_other_details" => "",
        ];

        foreach ($settingData as $setting) {
            $result[$setting->name] = $setting->value;
        }

        return $result;
    }
}

if (!function_exists('invoicePaymentSettings')) {
    function invoicePaymentSettings($id)
    {
        $settingData = DB::table('settings')->where('type', 'payment')->where('parent_id', $id)->get();
        $result = [
            'CURRENCY' => "USD",
            'CURRENCY_SYMBOL' => "$",
            'STRIPE_PAYMENT' => "off",
            'STRIPE_KEY' => "",
            'STRIPE_SECRET' => "",
            "paypal_payment" => "off",
            "paypal_mode" => "",
            "paypal_client_id" => "",
            "paypal_secret_key" => "",
            "bank_transfer_payment" => "off",
            "bank_name" => "",
            "bank_holder_name" => "",
            "bank_account_number" => "",
            "bank_ifsc_code" => "",
            "bank_other_details" => "",
            "flutterwave_payment" => "off",
            "flutterwave_public_key" => "",
            "flutterwave_secret_key" => "",
        ];

        foreach ($settingData as $row) {
            $result[$row->name] = $row->value;
        }
        return $result;
    }
}


if (!function_exists('getSettingsValByName')) {
    function getSettingsValByName($key)
    {
        $setting = settings();
        if (!isset($setting[$key]) || empty($setting[$key])) {
            $setting[$key] = '';
        }

        return $setting[$key];
    }
}

if (!function_exists('settingDateFormat')) {
    function settingDateFormat($settings, $date)
    {
        return date($settings['company_date_format'], strtotime($date));
    }
}
if (!function_exists('settingPriceFormat')) {
    function settingPriceFormat($settings, $price)
    {
        return $settings['CURRENCY_SYMBOL'] . $price;
    }
}
if (!function_exists('settingTimeFormat')) {
    function settingTimeFormat($settings, $time)
    {
        return date($settings['company_time_format'], strtotime($time));
    }
}
if (!function_exists('dateFormat')) {
    function dateFormat($date)
    {
        $settings = settings();

        return date($settings['company_date_format'], strtotime($date));
    }
}
if (!function_exists('timeFormat')) {
    function timeFormat($time)
    {
        $settings = settings();

        return date($settings['company_time_format'], strtotime($time));
    }
}
if (!function_exists('priceFormat')) {
    function priceFormat($price)
    {
        $settings = settings();

        return $settings['CURRENCY_SYMBOL'] . $price;
    }
}
if (!function_exists('parentId')) {
    function parentId()
    {
        if (\Auth::user()->type == 'owner' || \Auth::user()->type == 'super admin') {
            return \Auth::user()->id;
        } else {
            return \Auth::user()->parent_id;
        }
    }
}

if (!function_exists('smtpDetail')) {
    function smtpDetail($id)
    {
        $settings = emailSettings($id);

        $smtpDetail = config(
            [
                'mail.mailers.smtp.transport' => $settings['SERVER_DRIVER'],
                'mail.mailers.smtp.host' => $settings['SERVER_HOST'],
                'mail.mailers.smtp.port' => $settings['SERVER_PORT'],
                'mail.mailers.smtp.encryption' => $settings['SERVER_ENCRYPTION'],
                'mail.mailers.smtp.username' => $settings['SERVER_USERNAME'],
                'mail.mailers.smtp.password' => $settings['SERVER_PASSWORD'],
                'mail.from.address' => $settings['FROM_EMAIL'],
                'mail.from.name' => $settings['FROM_NAME'],
            ]
        );

        return $smtpDetail;
    }
}

if (!function_exists('invoicePrefix')) {
    function invoicePrefix()
    {
        $settings = settings();
        return $settings["invoice_number_prefix"];
    }
}
if (!function_exists('expensePrefix')) {
    function expensePrefix()
    {
        $settings = settings();
        return $settings["expense_number_prefix"];
    }
}

if (!function_exists('timeCalculation')) {
    function timeCalculation($startDate, $startTime, $endDate, $endTime)
    {
        $startdate = $startDate . ' ' . $startTime;
        $enddate = $endDate . ' ' . $endTime;

        $startDateTime = new DateTime($startdate);
        $endDateTime = new DateTime($enddate);

        $interval = $startDateTime->diff($endDateTime);
        $totalHours = $interval->h + $interval->i / 60;

        return number_format($totalHours, 2);
    }
}

if (!function_exists('setup')) {
    function setup()
    {
        $setupPath = storage_path() . "/installed";
        return $setupPath;
    }
}

if (!function_exists('userLoggedHistory')) {
    function userLoggedHistory()
    {
        $serverip = $_SERVER['REMOTE_ADDR'];
        $data = @unserialize(file_get_contents('http://ip-api.com/php/' . $serverip));
        if (isset($data['status']) && $data['status'] == 'success') {
            $browser = new \WhichBrowser\Parser($_SERVER['HTTP_USER_AGENT']);
            if ($browser->device->type == 'bot') {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
            $referrerData = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER']) : null;
            $data['browser'] = $browser->browser->name ?? null;
            $data['os'] = $browser->os->name ?? null;
            $data['language'] = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? mb_substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : null;
            $data['device'] = User::getDevice($_SERVER['HTTP_USER_AGENT']);
            $data['referrer_host'] = !empty($referrerData['host']);
            $data['referrer_path'] = !empty($referrerData['path']);
            $result = json_encode($data);
            $details = new LoggedHistory();
            $details->type = Auth::user()->type;
            $details->user_id = Auth::user()->id;
            $details->date = date('Y-m-d H:i:s');
            $details->Details = $result;
            $details->ip = $serverip;
            $details->parent_id = parentId();
            $details->save();
        }
    }
}

if (!function_exists('defaultTenantCreate')) {
    function defaultTenantCreate($id)
    {
        // Default Tenant role
        $tenantRoleData = [
            'name' => 'tenant',
            'parent_id' => $id,
        ];
        $systemTenantRole = Role::create($tenantRoleData);
        // Default Tenant permissions
        $systemTenantPermissions = [
            ['name' => 'manage invoice'],
            ['name' => 'show invoice'],
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],

            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],
            ['name' => 'create invoice payment'],
            ['name' => 'manage maintenance request'],
            ['name' => 'create maintenance request'],
            ['name' => 'edit maintenance request'],
            ['name' => 'delete maintenance request'],
            ['name' => 'show maintenance request'],
        ];
        $systemTenantRole->givePermissionTo($systemTenantPermissions);
        return $systemTenantRole;
    }
}

if (!function_exists('defaultMaintainerCreate')) {
    function defaultMaintainerCreate($id)
    {
        $maintainerRoleData =  [
            'name' => 'maintainer',
            'parent_id' => $id,
        ];
        $systemMaintainerRole = Role::create($maintainerRoleData);
        // Default admin permissions
        $systemMaintainerPermissions = [
            ['name' => 'manage maintenance request'],
            ['name' => 'show maintenance request'],
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],

            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],
        ];
        $systemMaintainerRole->givePermissionTo($systemMaintainerPermissions);
        return $systemMaintainerRole;
    }
}


if (!function_exists('sendEmail')) {

    function sendEmail($to, $datas)
    {
        $datas['settings'] = settings();

        try {

            emailSettings(1);
            Mail::to($to)->send(new TestMail($datas));
            return [
                'status' => 'success',
                'message' => __('Email successfully sent'),
            ];
        } catch (\Exception $e) {

            Log::info($e->getMessage());
            return [
                'status' => 'error',
                'message' => __('We noticed that the email settings have not been configured for this system. As a result, email-related functionalities may not work as expected. please add valide email smtp details first.')
            ];
        }
    }
}


if (!function_exists('commonEmailSend')) {
    function commonEmailSend($to, $datas)
    {
        $datas['settings'] = settings();
        try {

            emailSettings(1);
            Mail::to($to)->send(new Common($datas));
            return [
                'status' => 'success',
                'message' => __('Email successfully sent'),
            ];
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return [
                'status' => 'error',
                'message' => __('We noticed that the email settings have not been configured for this system. As a result, email-related functionalities may not work as expected. please add valide email smtp details first.')
            ];
        }
    }
}

if (!function_exists('emailSettings')) {
    function emailSettings($id)
    {

        $settingData = DB::table('settings')
            ->where('type', 'smtp')
            ->where('parent_id', $id)
            ->get();

        $result = [
            'FROM_EMAIL' => "",
            'FROM_NAME' => "",
            'SERVER_DRIVER' => "",
            'SERVER_HOST' => "",
            'SERVER_PORT' => "",
            'SERVER_USERNAME' => "",
            'SERVER_PASSWORD' => "",
            'SERVER_ENCRYPTION' => "",
        ];

        foreach ($settingData as $setting) {
            $result[$setting->name] = $setting->value;
        }



        // Apply settings dynamically
        config([
            'mail.default' => $result['SERVER_DRIVER'] ?? '',
            'mail.mailers.smtp.host' => $result['SERVER_HOST'] ?? '',
            'mail.mailers.smtp.port' => $result['SERVER_PORT'] ?? '',
            'mail.mailers.smtp.encryption' => $result['SERVER_ENCRYPTION'] ?? '',
            'mail.mailers.smtp.username' => $result['SERVER_USERNAME'] ?? '',
            'mail.mailers.smtp.password' => $result['SERVER_PASSWORD'] ?? '',
            'mail.from.name' => $result['FROM_NAME'] ?? '',
            'mail.from.address' => $result['FROM_EMAIL'] ?? '',
        ]);
        return $result;
    }
}

if (!function_exists('MessageReplace')) {
    function MessageReplace($notification, $id = 0)
    {
        $return['subject'] = !empty($notification->subject) ? $notification->subject : $notification['subject'];
        $return['message'] = !empty($notification->message) ? $notification->message : $notification['message'];
        if (!empty($notification->password)) {
            $notification['password'] = $notification->password;
        }
        $settings = settings();
        if (!empty($notification)) {
            $search = [];
            $replace = [];
            if ($notification->module == 'user_create') {
                $user = User::find($id);
                $search = ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{new_user_name}', '{username}', '{password}', '{app_link}'];
                $replace = [$settings['company_name'], $settings['company_email'], $settings['company_phone'], $settings['company_address'], $settings['CURRENCY_SYMBOL'], $user->name, $user->email, $notification['password'], env('APP_URL')];
            }
            if ($notification->module == 'tenant_create') {
                $user = User::find($id);
                $search = ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{user_name}', '{username}', '{password}', '{app_link}'];
                $replace = [$settings['company_name'], $settings['company_email'], $settings['company_phone'], $settings['company_address'], $settings['CURRENCY_SYMBOL'], $user->name, $user->email, $notification['password'], env('APP_URL')];
            }
            if ($notification->module == 'maintainer_create') {
                $user = User::find($id);
                $search = ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{user_name}', '{username}', '{password}', '{app_link}'];
                $replace = [$settings['company_name'], $settings['company_email'], $settings['company_phone'], $settings['company_address'], $settings['CURRENCY_SYMBOL'], $user->name, $user->email, $notification['password'], env('APP_URL')];
            }
            if ($notification->module == 'maintenance_request_create') {
                $user_name = User::where('id', $notification->user_id)->first();
                $MaintenanceRequest = MaintenanceRequest::find($id);
                $issue_type = $MaintenanceRequest->types->title;
                $tenamt_name = !empty($MaintenanceRequest->tenetData()->user->name) ? $MaintenanceRequest->tenetData()->user->name : '';
                $tenamt_number = !empty($MaintenanceRequest->tenetData()->user->phone_number) ? $MaintenanceRequest->tenetData()->user->phone_number : '';
                $tenamt_mail = !empty($MaintenanceRequest->tenetData()->user->email) ? $MaintenanceRequest->tenetData()->user->email : '';
                $search = ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{tenant_name}', '{created_at}', '{issue_type}', '{issue_description}', '{tenant_number}', '{tenant_mail}'];
                $replace = [$settings['company_name'], $settings['company_email'], $settings['company_phone'], $settings['company_address'], $settings['CURRENCY_SYMBOL'], $user_name->first_name, $MaintenanceRequest->created_at, $issue_type, $MaintenanceRequest->notes, $tenamt_number, $user_name->email];
            }
            if ($notification->module == 'maintenance_request_complete') {
                $MaintenanceRequest = MaintenanceRequest::find($id);
                $issue_type = $MaintenanceRequest->types->title;
                $tenamt_name = !empty($MaintenanceRequest->tenetData()->user->name) ? $MaintenanceRequest->tenetData()->user->name : '';
                $tenamt_number = !empty($MaintenanceRequest->tenetData()->user->phone_number) ? $MaintenanceRequest->tenetData()->user->phone_number : '';
                $tenamt_mail = !empty($MaintenanceRequest->tenetData()->user->email) ? $MaintenanceRequest->tenetData()->user->email : '';
                $maintainer_email = !empty($MaintenanceRequest->maintainers->email) ? $MaintenanceRequest->maintainers->email : '';
                $maintainer_number = !empty($MaintenanceRequest->maintainers->phone_number) ? $MaintenanceRequest->maintainers->phone_number : '';
                $maintainers_name = !empty($MaintenanceRequest->maintainers->name) ? $MaintenanceRequest->maintainers->name : '';
                $search = ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{tenant_name}', '{submitted_at}', '{issue_type}', '{issue_description}', '{completed_at}', '{maintainer_email}', '{maintainer_number}', '{maintainer_name}'];
                $replace = [$settings['company_name'], $settings['company_email'], $settings['company_phone'], $settings['company_address'], $settings['CURRENCY_SYMBOL'], $tenamt_name, $MaintenanceRequest->created_at, $issue_type, $MaintenanceRequest->notes, $MaintenanceRequest->updated_at, $maintainer_email, $maintainer_number, $maintainers_name];
            }
            if ($notification->module == 'invoice_create') {
                $invoice = Invoice::find($id);
                $user_name = $invoice->tenants()->user->name;
                $invoice_number = invoicePrefix() . $invoice->invoice_id;
                $search = ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{user_name}', '{invoice_number}', '{invoice_date}', '{invoice_due_date}', '{invoice_description}', '{amount}'];
                $replace = [$settings['company_name'], $settings['company_email'], $settings['company_phone'], $settings['company_address'], $settings['CURRENCY_SYMBOL'], $user_name, $invoice_number, $invoice->created_at, $invoice->end_date, $invoice->notes, priceFormat($invoice->getInvoiceDueAmount())];
            }
            if ($notification->module == 'invoice_create') {
                $invoice = Invoice::find($id);
                $user_name = $invoice->tenants()->user->name;
                $invoice_number = invoicePrefix() . $invoice->invoice_id;
                $search = ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{user_name}', '{invoice_number}', '{invoice_date}', '{invoice_due_date}', '{invoice_description}', '{amount}'];
                $replace = [$settings['company_name'], $settings['company_email'], $settings['company_phone'], $settings['company_address'], $settings['CURRENCY_SYMBOL'], $user_name, $invoice_number, $invoice->created_at, $invoice->end_date, $invoice->notes, priceFormat($invoice->getInvoiceDueAmount())];
            }
            if ($notification->module == 'payment_reminder') {
                $invoice = Invoice::find($id);
                $user_name = $invoice->tenants()->user->name;
                $invoice_number = invoicePrefix() . $invoice->invoice_id;
                $search = ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{user_name}', '{invoice_number}', '{invoice_date}', '{invoice_due_date}', '{amount}', '{invoice_description}'];
                $replace = [$settings['company_name'], $settings['company_email'], $settings['company_phone'], $settings['company_address'], $settings['CURRENCY_SYMBOL'], $user_name, $invoice_number, $invoice->created_at, $invoice->end_date, priceFormat($invoice->getInvoiceDueAmount()), $invoice->notes];
            }
            $return['subject'] = str_replace($search, $replace, $notification->subject);
            $return['message'] = str_replace($search, $replace, $notification->message);
        }

        return $return;
    }
}


if (!function_exists('defultTemplate')) {
    function defultTemplate($id)
    {
        $templateData = [
            'user_create' =>
            [
                'module' => 'user_create',
                'name' => 'New User',
                'short_code' => ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{new_user_name}', '{username}', '{password}', '{app_link}'],
                'subject' => 'Welcome to {company_name}!',
                'templete' => '
                            <p><strong>Dear {new_user_name}</strong>,</p><p>&nbsp;</p><blockquote><p>Welcome We are excited to have you on board and look forward to providing you with an exceptional experience.</p><p>We hope you enjoy your experience with us. If you have any feedback, feel free to share it with us.</p><p>&nbsp;</p><p>Your account details are as follows:</p><p><strong>App Link:</strong> <a href="{app_link}">{app_link}</a></p><p><strong>Username:</strong> {username}</p><p><strong>Password:</strong> {password}</p><p>&nbsp;</p><p>Thank you for choosing {company_name}!</p></blockquote>',
            ],
            'tenant_create' =>
            [
                'module' => 'tenant_create',
                'name' => 'New Tenant',
                'short_code' => ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{user_name}', '{username}', '{password}', '{app_link}'],
                'subject' => 'Welcome to {company_name}!',
                'templete' => '
                  <p><strong>Dear {user_name}</strong>,</p><p>&nbsp;</p><blockquote><p>Welcome We are excited to have you on board and look forward to providing you with an exceptional experience.</p><p>We hope you enjoy your experience with us. If you have any feedback, feel free to share it with us.</p><p>&nbsp;</p><p>Your account details are as follows:</p><p><strong>App Link:</strong> <a href="{app_link}">{app_link}</a></p><p><strong>Username:</strong> {username}</p><p><strong>Password:</strong> {password}</p><p>&nbsp;</p><p>Thank you for choosing {company_name}!</p></blockquote>',
            ],
            'maintainer_create' =>
            [
                'module' => 'maintainer_create',
                'name' => 'New Maintainer',
                'short_code' => ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{user_name}', '{username}', '{password}', '{app_link}'],
                'subject' => 'Welcome to {company_name}!',
                'templete' => '
                  <p><strong>Dear {user_name}</strong>,</p><p>&nbsp;</p><blockquote><p>Welcome We are excited to have you on board and look forward to providing you with an exceptional experience.</p><p>We hope you enjoy your experience with us. If you have any feedback, feel free to share it with us.</p><p>&nbsp;</p><p>Your account details are as follows:</p><p><strong>App Link:</strong> <a href="{app_link}">{app_link}</a></p><p><strong>Username:</strong> {username}</p><p><strong>Password:</strong> {password}</p><p>&nbsp;</p><p>Thank you for choosing {company_name}!</p></blockquote>',
            ],
            'maintenance_request_create' =>
            [
                'module' => 'maintenance_request_create',
                'name' => 'New Maintenance Request',
                'short_code' => ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{tenant_name}', '{created_at}', '{issue_type}', '{issue_description}', '{tenant_number}', '{tenant_mail}'],
                'subject' => 'New Maintenance Request Created',
                'templete' => '
                    <p><strong class="ql-size-huge">Dear Owner,</strong></p><p>We would like to inform you that a new maintenance request has been created for your property. Below are the details of the request:</p><p><strong>Request Details:</strong></p><ul><li>	Submitted By: {tenant_name}</li><li>	Submitted On: {created_at}</li><li>	Category: {issue_type}</li><li>	Description: {issue_description}</li></ul><p><br></p><p><strong>Tenant Contact Information:</strong></p><ul><li>	Name: {tenant_name}</li><li>	Phone: {tenant_number}</li><li>	Email: {tenant_mail}</li></ul><p>Thank you for your attention to this matter.</p><p><strong>Best regards,</strong></p><p><strong>{tenant_name}</strong></p><p><strong>{tenant_mail}</strong></p>
                ',
            ],
            'maintenance_request_complete' =>
            [
                'module' => 'maintenance_request_complete',
                'name' => 'Maintenance Request Complete',
                'short_code' => ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{tenant_name}', '{submitted_at}', '{issue_type}', '{issue_description}', '{completed_at}', '{maintainer_email}', '{maintainer_number}', '{maintainer_name}'],
                'subject' => 'Maintenance Request Completed!',
                'templete' => '
                    <p><strong>Dear {tenant_name},</strong></p><p><br></p><p>We are pleased to inform you that your maintenance request has been successfully completed.</p><p><br></p><p> <strong>Request Details:</strong></p><ul><li>Submitted By: {tenant_name}</li><li>Submitted On: {submitted_at}</li><li>Category: {issue_type}</li><li>Description: {issue_description}</li></ul><p><br></p><p><strong>Completion Details:</strong></p><ul><li> Completed On: {completed_at}</li> </ul><p><br></p><p><strong>Feedback:</strong></p><p>We value your feedback to improve our services. Please let us know if you are satisfied with the maintenance performed or if there are any further issues that need attention.</p><p><br></p><p><strong>Contact Information:</strong></p><p> If you have any questions or need further assistance, please contact us at {maintainer_email} or {maintainer_number}.</p><p>Thank you for your cooperation and patience.</p><p><br></p><p><strong>Best regards,</strong></p><p>{maintainer_name}</p><p>{maintainer_email}</p>
                ',
            ],
            'invoice_create' =>
            [
                'module' => 'invoice_create',
                'name' => 'New Invoice',
                'short_code' => ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{user_name}', '{invoice_number}', '{invoice_date}', '{invoice_due_date}', '{invoice_description}', '{amount}'],
                'subject' => 'Invoice Created',
                'templete' => '
                        <p><strong>Dear {user_name},</strong></p><p><br></p><p> We are pleased to inform you that an invoice has been created  with {company_name}.</p><p><br></p><p><strong> Invoice Details:</strong></p><ul><li>Invoice Number: {invoice_number}</li><li>Date Issued: {invoice_date}</li><li>Due Date: {invoice_due_date}</li><li>Amount Due: {amount}</li><li>Description: {invoice_description}</li></ul><p><br></p><p><strong>Contact Information:</strong></p><p>If you have any questions or need further assistance, please contact our billing department at {company_email} or {company_number}.</p><p><br></p><p>Thank you for your prompt attention to this matter.</p><p><br></p><p><strong>Best regards,</strong></p><p><strong>{company_name}</strong></p><p><strong>{company_email}</strong></p>
                ',
            ],
            'payment_reminder' =>
            [
                'module' => 'payment_reminder',
                'name' => 'Payment Reminder',
                'short_code' => ['{company_name}', '{company_email}', '{company_phone_number}', '{company_address}', '{company_currency}', '{user_name}', '{invoice_number}', '{invoice_date}', '{invoice_due_date}', '{amount}', '{invoice_description}'],
                'subject' => 'Friendly Reminder: Payment Due Soon',
                'templete' => '
                    <p><strong>Dear {user_name},</strong></p><p><br></p><p> This is a friendly reminder that your payment for the following invoice is due soon:</p><p><br></p><p><strong>Invoice Details:</strong></p><ul><li>Invoice Number: {invoice_number}</li><li>Date Issued: {invoice_date}</li><li>Due Date: {invoice_due_date}</li><li>Amount Due: {amount}</li><li>Description: {invoice_description}</li></ul><p><br></p><p><br></p><p>If you have already made your payment, please disregard this notice. Otherwise, we appreciate your prompt attention to this matter.</p><p><br></p><p><strong>Contact Information:</strong></p><p>If you have any questions or need assistance, feel free to contact our billing department at {company_email} or {company_number}.</p><p><br></p><p>Thank you for your cooperation!</p><p><br></p><p><strong>Best regards,</strong></p><p><strong>{company_name}</strong></p><p><strong>{company_email}</strong></p>
                ',
            ],
        ];

        // Store all created templates if needed
        $createdTemplates = [];

        foreach ($templateData as $key => $value) {
            $template = new Notification();
            $template->module = $value['module'];
            $template->name = $value['name'];
            $template->subject = $value['subject'];
            $template->message = $value['templete'];
            $template->short_code = json_encode($value['short_code']);
            $template->enabled_email = 0;
            $template->parent_id = $id; // Associate with the provided ID
            $template->save();

            $createdTemplates[] = $template; // Collect all created templates
        }

        // Return all created templates if needed
        return $createdTemplates;
    }
}
