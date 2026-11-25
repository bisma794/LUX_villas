<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EntityController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SectionController as AdminSectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// ---- Admin ----
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('pages', AdminPageController::class)->except(['show']);
        Route::post('/pages/{page}/sections', [AdminPageController::class, 'attach'])->name('pages.attach');
        Route::delete('/pages/{page}/sections/{section}', [AdminPageController::class, 'detach'])->name('pages.detach');
        Route::post('/pages/{page}/sections/{section}/move', [AdminPageController::class, 'move'])->name('pages.move');
        Route::resource('sections', AdminSectionController::class)->except(['show']);
        Route::post('/sections/upload', [AdminSectionController::class, 'upload'])->name('sections.upload');
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

        // CMS Entity Management Routes (Matching Side Panel Options)
        Route::get('/developer', [EntityController::class, 'developers'])->name('developers');
        Route::get('/city', [EntityController::class, 'cities'])->name('cities');
        Route::get('/community', [EntityController::class, 'communities'])->name('communities');
        Route::get('/community/{slug}/edit', [EntityController::class, 'editCommunity'])->name('communities.edit');
        Route::post('/community/{slug}/update', [EntityController::class, 'updateCommunity'])->name('communities.update');
        Route::get('/amenities-library', [EntityController::class, 'amenities'])->name('amenities');
        Route::post('/amenities-library', [EntityController::class, 'storeAmenity'])->name('amenities.store');
        Route::get('/blog-posts', [EntityController::class, 'blogs'])->name('blogs');
        Route::get('/off-plan-project', [EntityController::class, 'offplanProjects'])->name('offplan-projects');
        Route::get('/listing-project', [EntityController::class, 'listingProjects'])->name('listing-projects');
        Route::get('/client-reviews', [EntityController::class, 'reviews'])->name('reviews');
        Route::post('/client-reviews', [EntityController::class, 'updateReviews'])->name('reviews.update');
    });
});

// ---- Frontend: the 11 Figma pages keep their exact URLs and route names ----
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', fn () => app(PageController::class)->show('about'))->name('about');
Route::get('/villas-for-sale', fn () => app(PageController::class)->show('villas-for-sale'))->name('villas');
Route::get('/listing/the-valley-prime-location', fn () => app(PageController::class)->show('listing/the-valley-prime-location'))->name('listing');
Route::get('/projects/golf-vale-emaar-south', fn () => app(PageController::class)->show('projects/golf-vale-emaar-south'))->name('project-details');
Route::get('/ai-villa-assessment', fn () => app(PageController::class)->show('ai-villa-assessment'))->name('assessment');
Route::get('/enquiry', fn () => app(PageController::class)->show('enquiry'))->name('enquiry');
Route::get('/blog', fn () => app(PageController::class)->show('blog'))->name('blog');
Route::get('/communities', fn () => app(PageController::class)->show('communities'))->name('communities');
Route::get('/communities/{slug}', function ($slug) {
    return view('pages.community_show', ['slug' => $slug]);
})->name('community-show');
Route::get('/communities/the-valley', function () {
    return view('pages.community_show', ['slug' => 'the-valley']);
})->name('community-inner');
Route::get('/projects', fn () => app(PageController::class)->show('projects'))->name('projects');

// ---- Frontend: any other published dynamic page (created in /admin/pages) ----
Route::get('/{path}', [PageController::class, 'show'])->where('path', '.*')->name('dynamic');
