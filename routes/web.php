<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@HomePage');
Route::get('/about', 'HomeController@aboutPage');

Route::get('/contact-us', 'HomeController@contact');
Route::post('/send/contact', 'ContactController@sendContact')->name('send.contact');

Route::get('/services', 'HomeController@servicesPage');
Route::get('/services/{service}', 'HomeController@singleService')->name('service.show');

Route::get('/projects', 'HomeController@projectsPage');
Route::get('/projects/{project}', 'HomeController@singleProject')->name('project.show');

Route::get('/blogs', 'HomeController@blogsPage');
Route::get('/blogs/{blog}', 'HomeController@showBlog')->name('blog.show');

Route::get('/doctors', 'HomeController@TeamMembersPage');
Route::get('/doctors/{id}/{name}', 'HomeController@showTeamMember')->name('team.show');

Route::post('rate/doctor/{name}', 'HomeController@rateDoctor')->name('rate.doctor');

Route::get('/lang/{language}', 'HomeController@changeLanguage');

Route::match(['get', 'post'], 'webhook', 'MessengerController@index');

// Admin ROUTES
Auth::routes(['register' => false]);


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'] , function () {

    Route::get('dashboard', 'AdminController@showDashboard');

    Route::get('lang/{lang}','LanguageController@changeLanguage')->name('admin.lang');

    Route::resource('pages', 'PageController')->except(['create', 'store', 'destroy']);

    Route::resource('slider', 'SliderController');

    Route::resource('services', 'ServiceController');

    Route::resource('projects', 'ProjectController');

    Route::resource('contacts', 'ContactController');

    Route::resource('testimonials', 'TestimonialController');

    Route::resource('blogs', 'BlogController');

    Route::resource('team-members', 'TeamMemberController');

    Route::get('rates', 'RateController@index')->name('rates.index');
    Route::delete('rates/delete/{id}', 'RateController@destroy')->name('rates.destroy');

    Route::get('settings/contact-info', 'ContactInfoController@contactInfo')->name('settings.contact');
    Route::post('settings/contact-info', 'ContactInfoController@store')->name('settings.contact.store');

    Route::get('settings/seo', 'SeoController@showSeoPage')->name('settings.seo');
    Route::post('settings/seo', 'SeoController@store')->name('settings.seo.store');

    Route::get('settings/analytics', 'AnalyticsController@showPage')->name('settings.analytics');
    Route::post('settings/analytics', 'AnalyticsController@store')->name('settings.analytics');

    Route::resource('website-settings', 'SettingController');

    Route::resource('logos', 'LogoController');

    Route::post('upload/image', 'ImageController@uploadPhoto')->name('upload.image');
    Route::post('remove/image', 'ImageController@removePhoto')->name('remove.image');

    Route::get('profile/edit', 'ProfileController@edit')->name('edit.profile');
    Route::post('profile/edit', 'ProfileController@update')->name('update.profile');

    Route::get('themes', 'ThemeController@index')->name('themes.index');
    Route::post('themes/{id}', 'ThemeController@changeTheme')->name('themes.change');

    Route::get('themes/{name}', 'ThemeController@showTheme')->name('theme.show');

    Route::get('settings/tokens', 'FacebookController@showPage')->name('settings.tokens');
    Route::post('settings/tokens', 'FacebookController@store')->name('settings.tokens');

    Route::get('clear/notifications', 'NotificationController@clearAll')->name('clear.notifications');
    Route::get('view/notifications', 'NotificationController@viewAll')->name('view.notifications');
});
