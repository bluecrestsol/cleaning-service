<?php

use Illuminate\Support\Facades\Route;

// Ajax
Route::group(['prefix' => 'admin'], function() {
    include('admin_config.php');
    include('admin_ajax.php');
});

// Auth
Route::post('staff-panel/login', 'Admin\AuthController@login')->name('admin.auth.login');
Route::get('staff-panel', 'Admin\MainController@index')->name('admin.login');

// Panel
Route::group(['prefix' => 'staff-panel', 'namespace' => 'Admin', 'middleware' => ['auth:staff']], function() {
    Route::get('logout', 'AuthController@logout')->name('admin.logout');
    Route::get('dashboard', 'MainController@dashboard')->name('admin.dashboard');
    Route::get('main/language/change/{language}', 'MainController@changeLanguage')->name('admin.main.language.change');
    Route::post('admin/active/update', 'AdminController@updateActive')->name('admin.admin_user.active.update'); //admin user

    $modules = [
        [
            'route' => 'staff',
            'controller' => 'Staff',
            'name' => 'staff',
        ],
        [
            'route' => 'customers',
            'controller' => 'Customer',
            'name' => 'customers',
        ],
        [
            'route' => 'customers.notes',
            'controller' => 'CustomerNote',
            'name' => 'customers.notes',
        ],
        [
            'route' => 'roles',
            'controller' => 'Role',
            'name' => 'roles',
        ],
        [
            'route' => 'countries.languages',
            'controller' => 'CountryLanguage',
            'name' => 'countries.languages',
        ],
        [
            'route' => 'countries.currencies',
            'controller' => 'CountryCurrency',
            'name' => 'countries.currencies',
        ],
        [
            'route' => 'countries',
            'controller' => 'Country',
            'name' => 'countries',
        ],
        [
            'route' => 'states',
            'controller' => 'State',
            'name' => 'states',
        ],
        [
            'route' => 'cities',
            'controller' => 'City',
            'name' => 'cities',
        ],
        [
            'route' => 'districts',
            'controller' => 'District',
            'name' => 'districts',
        ],
        [
            'route' => 'languages',
            'controller' => 'Language',
            'name' => 'languages',
        ],
        [
            'route' => 'currencies',
            'controller' => 'Currency',
            'name' => 'currencies',
        ],
        [
            'route' => 'companies.countries',
            'controller' => 'CompanyCountry',
            'name' => 'companies.countries',
        ],
        [
            'route' => 'companies',
            'controller' => 'Company',
            'name' => 'companies',
        ],
        [
            'route' => 'places/categories',
            'controller' => 'PlacesCategory',
            'name' => 'places.categories',
        ],
        [
            'route' => 'places',
            'controller' => 'Place',
            'name' => 'places',
        ],
        [
            'route' => 'crew-members',
            'controller' => 'CrewMember',
            'name' => 'crew_members',
        ],
        [
            'route' => 'bookings',
            'controller' => 'Booking',
            'name' => 'bookings',
        ],
        [
            'route' => 'appointments',
            'controller' => 'Appointment',
            'name' => 'appointments',
        ],
        [
            'route' => 'faqs-categories.questions',
            'controller' => 'FaqCategoryQuestion',
            'name' => 'faqs_categories.questions',
        ],
        [
            'route' => 'faqs-categories',
            'controller' => 'FaqCategory',
            'name' => 'faqs_categories'
        ],
        [
            'route' => 'faqs-questions',
            'controller' => 'Faq',
            'name' => 'faqs_questions'
        ],
        [
            'route' => 'contracts',
            'controller' => 'Contract',
            'name' => 'contracts',
        ],
        [
            'route' => 'agents',
            'controller' => 'Agent',
            'name' => 'agents',
        ],
        [
            'route' => 'services',
            'controller' => 'Service',
            'name' => 'services',
        ],
        [
            'route' => 'contact-requests',
            'controller' => 'ContactRequest',
            'name' => 'contact_requests',
        ]
    ];

    foreach($modules as $module) {
        Route::resource($module['route'], "{$module['controller']}Controller", [
            'names' => [
                'index' => "admin.{$module['name']}.index",
                'create' => "admin.{$module['name']}.create",
                'store' => "admin.{$module['name']}.store",
                'show' => "admin.{$module['name']}.show",
                'edit' => "admin.{$module['name']}.edit",
                'update' => "admin.{$module['name']}.update",
                'destroy' => "admin.{$module['name']}.destroy",
            ]
        ]);

        if (isset($module['after'])) {
            $module['after']();
        }
    }
});