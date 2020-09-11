<?php

use Illuminate\Support\Facades\Route;

include('web_ajax.php');

/*
 * Use snakecase for naming
 */
Route::group(['prefix' => '{country?}/{locale?}', 'namespace' => 'Customer', 'middleware' => 'locale'], function() {
    Route::get('/', 'HomeController@index')->name('customer.home');
    Route::get('about', 'AboutController@index')->name('customer.about');
    Route::get('services', 'ServiceController@index')->name('customer.services');
    Route::get('pricing', 'PricingController@index')->name('customer.pricing');

    // Serviced locations
    Route::group(['prefix' => 'serviced-locations'], function() {
        Route::get('/', 'ServicedLocationController@index')->name('customer.serviced_locations');
        Route::get('{id}/{city?}/{district?}', 'ServicedLocationController@show')->name('customer.serviced_locations.show');
    });

    Route::group(['prefix' => 'verify'], function() {
        Route::get('/', 'VerifyController@index')->name('customer.verify');
        Route::get('{code}', 'VerifyController@results')->name('customer.verify.results');
    });

    Route::get('completed-services', 'CompletedServiceController@index')->name('customer.completed_services');
    Route::get('testimonials', 'HomeController@testimonials')->name('customer.testimonials');
    Route::get('faq', 'FaqController@index')->name('customer.faq');
    Route::get('privacy-policy', 'HomeController@privacyPolicy')->name('customer.privacy_policy');
    Route::get('terms-and-conditions', 'HomeController@terms')->name('customer.terms');
    Route::get('work-with-us', 'HomeController@workWithUs')->name('customer.work_with_us');
    Route::get('contact', 'ContactController@index')->name('customer.contact');
    Route::get('book-our-services', 'BookingController@index')->name('customer.booking');
});


