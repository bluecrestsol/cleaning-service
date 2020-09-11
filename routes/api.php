<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {
    // Locales
    Route::get('/locales', 'LocaleController@index')->name('api.locales');
    // Countries
    Route::group(['prefix' => 'countries'], function () {
        Route::get('/', 'CountryController@index')->name('api.countries.all');
        Route::get('code/{code}', 'CountryController@getByCode')->name('api.countries.code.get');

        Route::group(['prefix' => '{country}'], function () {
            Route::get('company', 'CountryCompanyController@index')->name('api.countries.company');
            Route::get('serviced-locations', 'ServicedLocationController@index')->name('api.countries.serviced_locations.all');
            Route::get('serviced-locations/{district}', 'ServicedLocationController@show')->name('api.countries.serviced_locations.show');
            Route::get('faqs', 'FaqController@index')->name('api.faqs.all');
            Route::get('/', 'CountryController@get')->name('api.countries.get');
        });
    });
    // Languages
    Route::group(['prefix' => 'languages'], function () {
        Route::get('/', 'LanguageController@index')->name('api.languages.all');
        Route::get('code/{code}', 'LanguageController@getByCode')->name('api.languages.code.get');
        Route::get('{language}', 'LanguageController@get')->name('api.languages.get');
    });
    // Companies
    Route::group(['prefix' => 'companies'], function () {
        Route::group(['prefix' => '{company}'], function () {
            Route::get('completed-services', 'CompletedServiceController@index')->name('api.companies.completed_services');
            Route::get('pricing', 'PricingController@index')->name('api.companies.pricing');
            Route::post('contact-requests', 'ContactRequestController@store')->name('api.companies.contact_requests.store');
            Route::post('bookings', 'BookingController@store')->name('api.companies.bookings.store');
        });
    });
    // Places
    Route::group(['prefix' => 'places'], function () {
        Route::get('/code/{code}', 'PlaceController@getByCode')->name('api.places.code.get');
            // Categories
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', 'PlacesCategoryController@index')->name('api.places.categories.all');
        });
        Route::group(['prefix' => '{place}'], function () {
            Route::get('services/history', 'ServiceHistoryController@index')->name('api.places.services.history');
            Route::get('/', 'PlaceController@get')->name('api.places.get');
        });
    });
    // Services
    Route::group(['prefix' => 'services'], function () {
        Route::get('/', 'ServiceController@index')->name('api.services.all');
    });
});