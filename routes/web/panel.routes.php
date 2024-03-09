<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::controller(App\Http\Controllers\UserController::class)->group(function(){
        Route::get('/users', 'index')->name('user');
        Route::get('/get/users', 'users')->name('get.user');
        Route::get('/user/create', 'create')->name('get.create');
        Route::get('/user/edit/{user}', 'edit')->name('get.edit');
        Route::post('/user/store', 'store');
        Route::put('/user/update/{id}', 'update');
        Route::post('/user/delete', 'destroy');
    });

    Route::controller(App\Http\Controllers\RoleController::class)->group(function(){
        Route::get('/roles', 'index')->name('role');
        Route::get('/role/create', 'create')->name('get.create');
        Route::post('/role/store', 'store');
        Route::patch('/role/update/{id}', 'update');
        Route::get('/get/roles', 'roles')->name('get.roles');
        Route::get('/get/names-roles', 'rolesName');
        Route::get('/user-permissions', 'permissions');
    });

    Route::controller(App\Http\Controllers\PermissionController::class)->group(function(){
        Route::get('/permissions', 'index')->name('permission');
        Route::get('/get/permissions', 'permissions')->name('get.permissions');
        Route::get('/get/all/permissions', 'allPermissions')->name('get.all.permissions');
    });

    Route::controller(App\Http\Controllers\ClientController::class)->group(function(){
        Route::get('/clients', 'index')->name('clients');
        Route::get('/get/clients', 'clients')->name('get.clients');
        Route::post('/client/store', 'store')->name('store.clients');
        Route::get('/get/client/{client}', 'getClient')->name('get.client');
        Route::get('/client/edit/{client}', 'edit')->name('get.edit-client');
        Route::get('/client/export', 'export')->name('clients.export');
        Route::put('/client/update/{client}', 'update')->name('put.update-client');
        Route::post('/client/delete', 'destroy');
        Route::post('/client/upload/{client}', 'uploadSingleFile');
    });
    
    Route::controller(App\Http\Controllers\BlogController::class)->group(function(){
        Route::get('/blogs', 'index')->name('blogs');
        Route::get('/get/blogs', 'blogs')->name('get.blogs');
        Route::get('/create/blog', 'create')->name('create.blog');
        Route::post('/store/blog', 'store')->name('store.blog');
        Route::get('/edit/blog/{blog}', 'edit')->name('edit.blog');
        Route::post('/update/blog/picture/{blog}', 'updatePicture')->name('update.picture.blog');
        Route::post('/update/blog/{blog}', 'update')->name('update.blog');
        Route::post('/blogs/delete', 'destroy');
        Route::put('/blogs/status/{blog}', 'updateStatus');
    });

    Route::controller(App\Http\Controllers\SiteServiceController::class)->group(function(){
        Route::get('/site-services', 'index')->name('services');
        Route::get('/get/site-services', 'services')->name('get.services');
        Route::post('/store-gallery-file/{service}', 'storeGalleryFile')->name('store.gallery-file');
        Route::post('/update-gallery-file/{file}', 'updateGalleryFile')->name('update.gallery-file');
        Route::delete('/delete-gallery-file/{file}', 'deleteGalleryFile')->name('delete.gallery-file');
        Route::get('/site-services/edit/{service}', 'edit')->name('edit.service');
        Route::post('/site-services/update/{service}', 'update')->name('update.service');
        Route::post('/site-services/store', 'store')->name('store.services');
        Route::post('/store/faq', 'storeFaq')->name('store.faq.services');
        Route::post('/site-services/delete', 'destroy');
        Route::delete('/delete/faq/{faq}', 'delete')->name('delete.faq.services');
        Route::put('/site-service/status/{service}', 'updateStatus');
        Route::put('/site-service/quote/{service}', 'updateQuote');
    });

    Route::controller(\App\Http\Controllers\QuoteController::class)->group(function(){
        Route::get('/quotes', 'index')->name('quotes');
        Route::get('/site-service/{service}/quote/{quote}', 'edit')->name('quotes');
        Route::post('/site-service/quote/{quoteService}', 'update')->name('update.quote');
        Route::post('/store/quote', 'store')->name('store.quote');

        Route::post('/store-quote-texture-file/{service}', 'storeTextureGalleryFile')->name('store.texture-gallery-file');
        Route::post('/update-quote-texture-file/{file}', 'updateTextureGalleryFile')->name('update.texture-gallery-file');
        // Route::delete('/delete-quote-texture-file/{file}', 'deleteGalleryFile')->name('delete.gallery-file');

        Route::get('quotes-request', 'quoteRequest')->name('quotes-request');
        Route::get('/get/quotes-request', 'getQuoteRequest')->name('get.quotes-request');
        Route::get('/quote-request/edit/{quoteRequest}', 'editQuoteRequest')->name('edit.quotes-request');
        Route::post('/quote-request/update/{quoteRequest}', 'updateQuoteRequest')->name('update.quotes-request');
        Route::put('/quote-request/status/{quoteRequest}', 'updateStatus');

    });

    Route::controller(App\Http\Controllers\ServiceStateController::class)->group(function(){
        Route::get('/service-areas', 'index')->name('service-areas');
        Route::get('/get/service-areas', 'serviceAreas')->name('get.service-areas');
        Route::get('/service-areas/edit/{service}', 'edit')->name('edit.service-areas');
        Route::post('/service-areas/update/{service}', 'update')->name('update.service-areas');
        Route::post('/service-areas/store', 'store')->name('store.service-areas');
        Route::post('/store/service-county', 'storeCounty')->name('store.service-county');
        Route::post('/service-areas/delete', 'destroy');
        Route::delete('/delete/service-county/{county}', 'delete')->name('delete.service-county');
    });

    Route::controller(App\Http\Controllers\AuthorController::class)->group(function(){
        Route::get('/authors', 'index')->name('authors');
        Route::get('/get/authors', 'authors')->name('get.authors');
        Route::post('/store/author', 'store')->name('store.authors');
        Route::delete('/delete/author/{author}', 'delete')->name('delete.authors');
    });

    Route::controller(App\Http\Controllers\ScheduleBlogController::class)->group(function(){
        Route::get('/schedules-blog', 'index')->name('schedule-blog');
        Route::get('/get/schedules-blog', 'schedules')->name('get.schedules-blog');
        Route::post('/store/schedule-blog', 'store')->name('store.schedules-blog');
        Route::delete('/delete/schedules-blog/{schedule}', 'delete')->name('delete.schedules-blog');
    });

    Route::controller(App\Http\Controllers\CategoryController::class)->group(function(){
        Route::get('/categories', 'index')->name('categories');
        Route::get('/get/categories', 'categories')->name('get.categories');
        Route::post('/store/category', 'store')->name('store.categories');
        Route::delete('/delete/category/{category}', 'delete')->name('delete.categories');
    });

    Route::controller(App\Http\Controllers\TagController::class)->group(function(){
        Route::get('/tags', 'index')->name('tags');
        Route::get('/get/tags', 'tags')->name('get.tags');
        Route::post('/store/tag', 'store')->name('store.tags');
        Route::delete('/delete/tag/{tag}', 'delete')->name('delete.tags');
    });

    Route::controller(App\Http\Controllers\ContactUsController::class)->group(function(){
        Route::get('/leads', 'index')->name('leads');
        Route::get('/get/leads', 'leads')->name('get.leads');
        Route::put('/leads/{contact}', 'updateStatus');
        Route::post('/leads/delete', 'destroy');
    });

    Route::controller(App\Http\Controllers\CompanyProfileController::class)->group(function(){
        Route::get('/company-information', 'index');
        Route::put('/update/company', 'update');
        Route::get('/notification-emails', 'notificationEmails');
        Route::put('/notification-email/{email}', 'updateStatus');
        Route::put('/notification-email-main/{email}', 'updateMainStatus');
        Route::post('/notification-email/store', 'store')->name('store.notification-email');
        Route::post('/notification-email/delete', 'destroy');
    });

    Route::controller(App\Http\Controllers\SubscriberController::class)->group(function(){
        Route::get('/subscribers', 'index')->name('subscribers');
        Route::get('/get/subscribers', 'subscribers')->name('get.subscribers');
        Route::post('/subscribers/delete', 'destroy');
    });

});