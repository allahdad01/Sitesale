<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\App;
use App\Core\Router;
use App\Core\Request;
use App\Middleware\CsrfMiddleware;
use App\Middleware\RateLimitMiddleware;
use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\ContactController;
use App\Controllers\AdminController;
use App\Controllers\Admin\SettingsController;
use App\Controllers\Admin\SectionController;
use App\Controllers\Admin\EnquiryController;
use App\Controllers\Admin\HeroController;
use App\Controllers\Admin\AwardsController;
use App\Controllers\Admin\AboutController as AdminAboutController;
use App\Controllers\Admin\ServiceController as AdminServiceController;
use App\Controllers\Admin\TestimonialController;
use App\Controllers\Admin\TeamMemberController;
use App\Controllers\Admin\TimelineController;
use App\Controllers\Admin\PackageController;
use App\Controllers\Admin\BlogController as AdminBlogController;
use App\Controllers\PackagesController;
use App\Controllers\BookingController;
use App\Controllers\LocaleController;
use App\Controllers\BlogController;
use App\Controllers\Admin\BookingController as AdminBookingController;
use App\Controllers\Admin\ContactController as AdminContactController;
use App\Controllers\Admin\FooterController as AdminFooterController;
use App\Controllers\Admin\FaqController as AdminFaqController;
use App\Middleware\AuthMiddleware;

App::boot();

$router = new Router();
$router->addMiddleware(CsrfMiddleware::class);
$router->addMiddleware(RateLimitMiddleware::class);

$router->get('/', [HomeController::class, 'index']);
$router->get('/home', [HomeController::class, 'index']);
$router->get('/lang/{locale}', [LocaleController::class, 'switch']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/contact', [ContactController::class, 'index']);
$router->post('/contact/submit', [ContactController::class, 'submit']);

$router->get('/admin/login', [AdminController::class, 'login']);
$router->post('/admin/login', [AdminController::class, 'authenticate']);
$router->get('/admin', [AdminController::class, 'dashboard'], [AuthMiddleware::class]);
$router->get('/admin/logout', [AdminController::class, 'logout']);
$router->get('/admin/settings', [SettingsController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/settings', [SettingsController::class, 'update'], [AuthMiddleware::class]);
$router->get('/admin/hero', [HeroController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/hero/update', [HeroController::class, 'update'], [AuthMiddleware::class]);
$router->post('/admin/hero/slides/add', [HeroController::class, 'addSlide'], [AuthMiddleware::class]);
$router->get('/admin/hero/slides/delete/{id}', [HeroController::class, 'deleteSlide'], [AuthMiddleware::class]);

$router->get('/admin/about', [AdminAboutController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/about/update', [AdminAboutController::class, 'update'], [AuthMiddleware::class]);

$router->get('/admin/awards', [AwardsController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/awards/update', [AwardsController::class, 'update'], [AuthMiddleware::class]);
$router->post('/admin/awards/add', [AwardsController::class, 'add'], [AuthMiddleware::class]);
$router->get('/admin/awards/delete/{id}', [AwardsController::class, 'delete'], [AuthMiddleware::class]);

$router->get('/admin/contact', [AdminContactController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/contact/update', [AdminContactController::class, 'update'], [AuthMiddleware::class]);

$router->get('/admin/footer', [AdminFooterController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/footer/update', [AdminFooterController::class, 'update'], [AuthMiddleware::class]);

$router->get('/admin/faq', [AdminFaqController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/faq/add', [AdminFaqController::class, 'add'], [AuthMiddleware::class]);
$router->get('/admin/faq/delete/{id}', [AdminFaqController::class, 'delete'], [AuthMiddleware::class]);

$router->get('/admin/services', [AdminServiceController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/services/add', [AdminServiceController::class, 'add'], [AuthMiddleware::class]);
$router->get('/admin/services/toggle/{id}', [AdminServiceController::class, 'toggle'], [AuthMiddleware::class]);
$router->get('/admin/services/delete/{id}', [AdminServiceController::class, 'delete'], [AuthMiddleware::class]);

$router->get('/admin/testimonials', [TestimonialController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/testimonials/add', [TestimonialController::class, 'add'], [AuthMiddleware::class]);
$router->get('/admin/testimonials/delete/{id}', [TestimonialController::class, 'delete'], [AuthMiddleware::class]);

$router->get('/admin/team-members', [TeamMemberController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/team-members/add', [TeamMemberController::class, 'add'], [AuthMiddleware::class]);
$router->get('/admin/team-members/edit/{id}', [TeamMemberController::class, 'edit'], [AuthMiddleware::class]);
$router->post('/admin/team-members/update/{id}', [TeamMemberController::class, 'update'], [AuthMiddleware::class]);
$router->get('/admin/team-members/toggle/{id}', [TeamMemberController::class, 'toggle'], [AuthMiddleware::class]);
$router->get('/admin/team-members/delete/{id}', [TeamMemberController::class, 'delete'], [AuthMiddleware::class]);

$router->get('/admin/timeline', [TimelineController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/timeline/add', [TimelineController::class, 'add'], [AuthMiddleware::class]);
$router->get('/admin/timeline/edit/{id}', [TimelineController::class, 'edit'], [AuthMiddleware::class]);
$router->post('/admin/timeline/update/{id}', [TimelineController::class, 'update'], [AuthMiddleware::class]);
$router->get('/admin/timeline/toggle/{id}', [TimelineController::class, 'toggle'], [AuthMiddleware::class]);
$router->get('/admin/timeline/delete/{id}', [TimelineController::class, 'delete'], [AuthMiddleware::class]);

$router->get('/admin/sections', [SectionController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/sections/add', [SectionController::class, 'add'], [AuthMiddleware::class]);
$router->post('/admin/sections/store', [SectionController::class, 'store'], [AuthMiddleware::class]);
$router->get('/admin/sections/edit/{id}', [SectionController::class, 'edit'], [AuthMiddleware::class]);
$router->post('/admin/sections/update/{id}', [SectionController::class, 'update'], [AuthMiddleware::class]);
$router->get('/admin/sections/toggle/{id}', [SectionController::class, 'toggle'], [AuthMiddleware::class]);
$router->get('/admin/sections/delete/{id}', [SectionController::class, 'delete'], [AuthMiddleware::class]);
$router->post('/admin/sections/reorder', [SectionController::class, 'reorder'], [AuthMiddleware::class]);
$router->get('/admin/enquiries', [EnquiryController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/enquiries/view/{id}', [EnquiryController::class, 'view'], [AuthMiddleware::class]);
$router->get('/admin/enquiries/read/{id}', [EnquiryController::class, 'markRead'], [AuthMiddleware::class]);
$router->get('/admin/enquiries/replied/{id}', [EnquiryController::class, 'markReplied'], [AuthMiddleware::class]);

$router->get('/admin/packages', [PackageController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/packages/add', [PackageController::class, 'add'], [AuthMiddleware::class]);
$router->post('/admin/packages/store', [PackageController::class, 'store'], [AuthMiddleware::class]);
$router->get('/admin/packages/edit/{id}', [PackageController::class, 'edit'], [AuthMiddleware::class]);
$router->post('/admin/packages/update/{id}', [PackageController::class, 'update'], [AuthMiddleware::class]);
$router->get('/admin/packages/toggle/{id}', [PackageController::class, 'toggle'], [AuthMiddleware::class]);
$router->get('/admin/packages/featured/{id}', [PackageController::class, 'toggleFeatured'], [AuthMiddleware::class]);
$router->get('/admin/packages/delete/{id}', [PackageController::class, 'delete'], [AuthMiddleware::class]);

$router->get('/admin/blog', [AdminBlogController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/blog/add', [AdminBlogController::class, 'add'], [AuthMiddleware::class]);
$router->post('/admin/blog/store', [AdminBlogController::class, 'store'], [AuthMiddleware::class]);
$router->get('/admin/blog/edit/{id}', [AdminBlogController::class, 'edit'], [AuthMiddleware::class]);
$router->post('/admin/blog/update/{id}', [AdminBlogController::class, 'update'], [AuthMiddleware::class]);
$router->get('/admin/blog/featured/{id}', [AdminBlogController::class, 'toggleFeatured'], [AuthMiddleware::class]);
$router->get('/admin/blog/delete/{id}', [AdminBlogController::class, 'delete'], [AuthMiddleware::class]);

$router->get('/packages', [PackagesController::class, 'index']);
$router->get('/packages/{slug}', [PackagesController::class, 'show']);
$router->get('/packages/{slug}/book', [BookingController::class, 'create']);
$router->post('/booking/store', [BookingController::class, 'store']);
$router->get('/booking/confirm/{id}', [BookingController::class, 'confirm']);

$router->get('/admin/bookings', [AdminBookingController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/bookings/view/{id}', [AdminBookingController::class, 'view'], [AuthMiddleware::class]);
$router->get('/admin/bookings/confirm/{id}', [AdminBookingController::class, 'confirm'], [AuthMiddleware::class]);
$router->get('/admin/bookings/complete/{id}', [AdminBookingController::class, 'complete'], [AuthMiddleware::class]);
$router->get('/admin/bookings/cancel/{id}', [AdminBookingController::class, 'cancel'], [AuthMiddleware::class]);
$router->post('/admin/bookings/notes/{id}', [AdminBookingController::class, 'updateNotes'], [AuthMiddleware::class]);
$router->get('/blog', [BlogController::class, 'index']);
$router->get('/blog/{slug}', [BlogController::class, 'show']);

$router->dispatch(new Request());
