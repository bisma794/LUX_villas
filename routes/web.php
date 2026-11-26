<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EntityController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SectionController as AdminSectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Middleware\AdminNoIndex;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// ---- Admin (strictly noindex / blocked from search crawlers) ----
Route::prefix('admin')->name('admin.')->middleware([AdminNoIndex::class])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('pages', AdminPageController::class)->except(['show']);
        Route::post('/pages/{page}/sections', [AdminPageController::class, 'attach'])->name('pages.attach');
        Route::delete('/pages/{page}/sections/{section}', [AdminPageController::class, 'detach'])->name('pages.detach');
        Route::post('/pages/{page}/sections/{section}/move', [AdminPageController::class, 'move'])->name('pages.move');
        Route::post('/pages/{page}/reorder', [AdminPageController::class, 'reorder'])->name('pages.reorder');
        Route::resource('sections', AdminSectionController::class)->except(['show']);
        Route::post('/sections/upload', [AdminSectionController::class, 'upload'])->name('sections.upload');
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

        // CMS Entity Management Routes (Matching Side Panel Options)
        Route::get('/developer', [EntityController::class, 'developers'])->name('developers');
        Route::get('/city', [EntityController::class, 'cities'])->name('cities');
        Route::get('/community', [EntityController::class, 'communities'])->name('communities');
        Route::get('/community/create', [EntityController::class, 'createCommunity'])->name('communities.create');
        Route::post('/community/store', [EntityController::class, 'storeCommunity'])->name('communities.store');
        Route::get('/community/{slug}/edit', [EntityController::class, 'editCommunity'])->name('communities.edit');
        Route::post('/community/{slug}/update', [EntityController::class, 'updateCommunity'])->name('communities.update');
        Route::delete('/community/{slug}', [EntityController::class, 'destroyCommunity'])->name('communities.destroy');
        Route::get('/amenities-library', [EntityController::class, 'amenities'])->name('amenities');
        Route::post('/amenities-library', [EntityController::class, 'storeAmenity'])->name('amenities.store');
        Route::delete('/amenities-library/{key}', [EntityController::class, 'destroyAmenity'])->name('amenities.destroy');
        Route::get('/blog-posts', [EntityController::class, 'blogs'])->name('blogs');
        Route::get('/blog-posts/create', [EntityController::class, 'createBlog'])->name('blogs.create');
        Route::post('/blog-posts', [EntityController::class, 'storeBlog'])->name('blogs.store');
        Route::get('/blog-posts/{slug}/edit', [EntityController::class, 'editBlog'])->name('blogs.edit');
        Route::post('/blog-posts/{slug}/update', [EntityController::class, 'updateBlog'])->name('blogs.update');
        Route::delete('/blog-posts/{slug}', [EntityController::class, 'destroyBlog'])->name('blogs.destroy');
        Route::get('/off-plan-project', [EntityController::class, 'offplanProjects'])->name('offplan-projects');
        Route::get('/off-plan-project/create', [EntityController::class, 'createOffplanProject'])->name('offplan-projects.create');
        Route::post('/off-plan-project/store', [EntityController::class, 'storeOffplanProject'])->name('offplan-projects.store');
        Route::get('/off-plan-project/{slug}/edit', [EntityController::class, 'editOffplanProject'])->name('offplan-projects.edit');
        Route::post('/off-plan-project/{slug}/update', [EntityController::class, 'updateOffplanProject'])->name('offplan-projects.update');
        Route::delete('/off-plan-project/{slug}', [EntityController::class, 'destroyOffplanProject'])->name('offplan-projects.destroy');
        Route::get('/listing-project', [EntityController::class, 'listingProjects'])->name('listing-projects');
        Route::get('/listing-project/create', [EntityController::class, 'createListingProject'])->name('listing-projects.create');
        Route::post('/listing-project/store', [EntityController::class, 'storeListingProject'])->name('listing-projects.store');
        Route::get('/listing-project/{slug}/edit', [EntityController::class, 'editListingProject'])->name('listing-projects.edit');
        Route::post('/listing-project/{slug}/update', [EntityController::class, 'updateListingProject'])->name('listing-projects.update');
        Route::delete('/listing-project/{slug}', [EntityController::class, 'destroyListingProject'])->name('listing-projects.destroy');
        Route::get('/client-reviews', [EntityController::class, 'reviews'])->name('reviews');
        Route::post('/client-reviews', [EntityController::class, 'updateReviews'])->name('reviews.update');
    });
});

// ---- Frontend: the 11 Figma pages keep their exact URLs and route names ----
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', fn () => app(PageController::class)->show('about'))->name('about');
Route::get('/villas-for-sale', fn () => app(PageController::class)->show('villas-for-sale'))->name('villas');
Route::get('/buy-listing', fn () => app(PageController::class)->show('listing/the-valley-prime-location'))->name('buy-listing');
Route::get('/listing/the-valley-prime-location', fn () => app(PageController::class)->show('listing/the-valley-prime-location'))->name('listing');
Route::get('/listing/{slug}', function ($slug) {
    return view('pages.listing_show', ['slug' => $slug]);
})->name('listing-show');
Route::get('/projects/{slug}', function ($slug) {
    return view('pages.offplan_show', ['slug' => $slug]);
})->name('project-show');
Route::get('/projects/golf-vale-emaar-south', function () {
    return view('pages.offplan_show', ['slug' => 'golf-vale-emaar-south']);
})->name('project-details');
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
