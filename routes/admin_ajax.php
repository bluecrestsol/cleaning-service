<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'ajax', 'namespace' =>'Ajax'], function() {

    // staff
    Route::group(['prefix' => 'staff'], function() {
        Route::post('list', 'StaffController@list')->name('admin.ajax.staff.list');
    });

    // customers
    Route::group(['prefix' => 'customers'], function() {
        Route::post('list', 'CustomerController@list')->name('admin.ajax.customers.list');
        Route::get('/{id}/billing-details', 'CustomerController@getBillingDetails')->name('admin.ajax.customers.billing_details.get');
        Route::get('/', 'CustomerController@fetch')->name('admin.ajax.customers.fetch');

        // customers notes
        Route::group(['prefix' => '{id}/notes'], function() {
            Route::post('list', 'CustomerNoteController@list')->name('admin.ajax.customers.notes.list');
        });
    });

    // roles
    Route::group(['prefix' => 'roles'], function() {
        Route::post('list', 'RoleController@list')->name('admin.ajax.roles.list');
    });

    // countries
    Route::group(['prefix' => 'countries'], function() {
        Route::post('list', 'CountryController@list')->name('admin.ajax.countries.list');
        Route::get('/', 'CountryController@fetch')->name('admin.ajax.countries.fetch');

        // countries languages
        Route::group(['prefix' => '{id}/languages'], function() {
            Route::post('list', 'CountryLanguageController@list')->name('admin.ajax.countries.languages.list');
            Route::get('/', 'CountryLanguageController@fetch')->name('admin.ajax.countries.languages.fetch');
            Route::get('fetch/reverse', 'CountryLanguageController@fetchReverse')->name('admin.ajax.countries.languages.fetch.reverse');
        });

        // countries currencies
        Route::group(['prefix' => '{id}/currencies'], function() {
            Route::post('list', 'CountryCurrencyController@list')->name('admin.ajax.countries.currencies.list');
            Route::get('/', 'CountryCurrencyController@fetch')->name('admin.ajax.countries.currencies.fetch');
            Route::get('fetch/reverse', 'CountryCurrencyController@fetchReverse')->name('admin.ajax.countries.currencies.fetch.reverse');
        });
    });

    // states
    Route::group(['prefix' => 'states'], function() {
        Route::post('list', 'StateController@list')->name('admin.ajax.states.list');
        Route::get('/', 'StateController@fetch')->name('admin.ajax.states.fetch');
    });

    // cities
    Route::group(['prefix' => 'cities'], function() {
        Route::post('list', 'CityController@list')->name('admin.ajax.cities.list');
        Route::get('/', 'CityController@fetch')->name('admin.ajax.cities.fetch');
    });

    // districts
    Route::group(['prefix' => 'districts'], function() {
        Route::post('list', 'DistrictController@list')->name('admin.ajax.districts.list');
        Route::get('/', 'DistrictController@fetch')->name('admin.ajax.districts.fetch');
    });

    // languages
    Route::group(['prefix' => 'languages'], function() {
        Route::post('list', 'LanguageController@list')->name('admin.ajax.languages.list');
        Route::get('/', 'LanguageController@fetch')->name('admin.ajax.languages.fetch');
    });

    // currencies
    Route::group(['prefix' => 'currencies'], function() {
        Route::post('list', 'CurrencyController@list')->name('admin.ajax.currencies.list');
        Route::get('/', 'CurrencyController@fetch')->name('admin.ajax.currencies.fetch');
    });

    // companies
    Route::group(['prefix' => 'companies'], function() {
        Route::post('list', 'CompanyController@list')->name('admin.ajax.companies.list');

        // companies countries
        Route::group(['prefix' => '{id}/countries'], function() {
            Route::post('list', 'CompanyCountryController@list')->name('admin.ajax.companies.countries.list');
            Route::get('/', 'CompanyCountryController@fetch')->name('admin.ajax.companies.countries.fetch');
            Route::get('fetch/reverse', 'CompanyCountryController@fetchReverse')->name('admin.ajax.companies.countries.fetch.reverse');
        });
    });

    // places
    Route::group(['prefix' => 'places'], function() {
        Route::post('list', 'PlaceController@list')->name('admin.ajax.places.list');
        Route::get('/', 'PlaceController@fetch')->name('admin.ajax.places.fetch');

        // places categories
        Route::group(['prefix' => 'categories'], function() {
            Route::post('list', 'PlacesCategoryController@list')->name('admin.ajax.places.categories.list');
            Route::get('/', 'PlacesCategoryController@fetch')->name('admin.ajax.places.categories.fetch');
        });
    });

    // crew members
    Route::group(['prefix' => 'crew_members'], function() {
        Route::post('list', 'CrewMemberController@list')->name('admin.ajax.crew_members.list');
        Route::get('/', 'CrewMemberController@fetch')->name('admin.ajax.crew_members.fetch');
    });

    // bookings
    Route::group(['prefix' => 'bookings'], function() {
        Route::post('list', 'BookingController@list')->name('admin.ajax.bookings.list');
    });

    // appointments
    Route::group(['prefix' => 'appointments'], function() {
        Route::post('list', 'AppointmentController@list')->name('admin.ajax.appointments.list');
    });

    // faqs questions
    Route::group(['prefix' => 'faqs-questions'], function() {
        Route::post('list', 'FaqController@list')->name('admin.ajax.faqs_questions.list');
    });

    // faqs categories
    Route::group(['prefix' => 'faqs-categories'], function() {
        Route::post('list', 'FaqCategoryController@list')->name('admin.ajax.faqs_categories.list');
        Route::post('order/{country}', 'FaqCategoryController@order')->name('admin.ajax.faqs_categories.order');
        Route::get('/', 'FaqCategoryController@fetch')->name('admin.ajax.faqs_categories.fetch');

        // faqs categories questions
        Route::group(['prefix' => '{id}/questions'], function() {
            Route::post('order', 'FaqCategoryQuestionController@order')->name('admin.ajax.faqs_categories.questions.order');
        });
    });

     // contracts
     Route::group(['prefix' => 'contracts'], function() {
        Route::post('list', 'ContractController@list')->name('admin.ajax.contracts.list');
        Route::get('/', 'ContractController@fetch')->name('admin.ajax.contracts.fetch');
    });

    // agents
    Route::group(['prefix' => 'agents'], function() {
        Route::post('list', 'AgentController@list')->name('admin.ajax.agents.list');
        Route::get('/', 'AgentController@fetch')->name('admin.ajax.agents.fetch');
    });

    // services
    Route::group(['prefix' => 'services'], function() {
        Route::post('list', 'ServiceController@list')->name('admin.ajax.services.list');
        Route::post('order/{country}', 'ServiceController@order')->name('admin.ajax.services.order');
        Route::get('/', 'ServiceController@fetch')->name('admin.ajax.services.fetch');
    });

    // contact requests
    Route::group(['prefix' => 'contact-requests'], function() {
        Route::post('list', 'ContactRequestController@list')->name('admin.ajax.contact_requests.list');
    });
});
