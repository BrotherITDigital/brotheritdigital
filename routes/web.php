<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminPortfolioController;
use App\Http\Controllers\Admin\AdminTeamController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminClientController;

/* ===== PUBLIC ROUTES ===== */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/team', [TeamController::class, 'index'])->name('team');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: " . url('/sitemap.xml');
    return response($content, 200, ['Content-Type' => 'text/plain']);
})->name('robots');

Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'bn', 'ar'])) {
        session()->put('locale', $locale);
    }
    return back();
})->name('lang.switch');

/* ===== RUN MIGRATIONS ROUTE ===== */
Route::get('/run-migrations', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        return '<h1>Migrations and seeders ran successfully!</h1><p><a href="/">Go to Home</a></p>';
    } catch (\Throwable $e) {
        return 'Error running migrations: ' . $e->getMessage() . '<br><br>Trace:<br><pre>' . $e->getTraceAsString() . '</pre>';
    }
});

/* ===== AUTH ROUTES ===== */
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])
    ->name('login')->middleware('guest');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])
    ->middleware('guest');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout')->middleware('auth');

/* ===== ADMIN ROUTES ===== */
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Services
    Route::resource('services', AdminServiceController::class);

    // Portfolio
    Route::resource('portfolios', AdminPortfolioController::class);
    Route::resource('portfolio-categories', AdminPortfolioCategoryController::class);

    // Team
    Route::resource('team', AdminTeamController::class);

    // Blog
    Route::resource('blog', AdminBlogController::class);
    Route::post('blog/{id}/toggle-publish', [AdminBlogController::class, 'togglePublish'])->name('blog.toggle-publish');

    // Testimonials
    Route::resource('testimonials', AdminTestimonialController::class);

    // FAQs
    Route::resource('faqs', AdminFaqController::class);

    // Clients
    Route::resource('clients', AdminClientController::class);

    // Contact Messages
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{id}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::delete('contacts/{id}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
    Route::post('contacts/{id}/read', [AdminContactController::class, 'markRead'])->name('contacts.read');

    // Settings
    Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');

    // Users
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('users', [AdminUserController::class, 'store'])->name('users.store');
    Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Media Manager
    Route::get('media', [AdminController::class, 'media'])->name('media');
    Route::post('media/upload', [AdminController::class, 'uploadMedia'])->name('media.upload');
    Route::delete('media/delete', [AdminController::class, 'deleteMedia'])->name('media.delete');
});
