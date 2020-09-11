<?php

use Illuminate\Support\Facades\Route;

/*
 * Use snakecase for naming
 * add .ajax as prefix for ajax routes
 */
Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax', 'middleware' => 'locale.cookie'], function() {

    // cities
    Route::group(['prefix' => 'cities'], function() {
        Route::get('/', 'CityController@fetch')->name('customer.ajax.cities.fetch');
    });

    // places
    Route::group(['prefix' => 'places'], function() {
        Route::get('/', 'PlaceController@fetch')->name('customer.ajax.places.fetch');
        Route::get('search', 'PlaceController@getByCode')->name('customer.ajax.places.search');

        // categories
        Route::group(['prefix' => 'categories'], function() {
             Route::get('fetch', 'PlacesCategoryController@fetch')->name('customer.ajax.places.categories.fetch');
        });
    });

    Route::group(['prefix' => 'faqs'], function() {
        Route::get('fetch', 'FaqCategoryController@fetch')->name('customer.ajax.faqs.fetch');
        Route::get('questions', 'FaqCategoryQuestionController@index')->name('customer.ajax.faqs.questions.fetch');
    });

    Route::get('services/categories/fetch', 'ServiceController@fetch')->name('customer.ajax.services.categories.fetch');
    Route::post('bookings/store', 'BookingController@store')->name('customer.ajax.bookings.store');
    Route::post('contact/store', 'ContactRequestController@store')->name('customer.ajax.contact.store');
    Route::post('appointments/services/history/list', 'AppointmentController@listServiceHistory')->name('customer.ajax.appointments.services.history.list');
});
