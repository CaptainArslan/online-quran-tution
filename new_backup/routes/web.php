<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\ContactController as AdminContactController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\ExpenseController;
use App\Http\Controllers\admin\FaqsController;
use App\Http\Controllers\admin\InquiriesController;
use App\Http\Controllers\admin\InquiryController;
use App\Http\Controllers\admin\NotificationController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\PaymentManagerController;
use App\Http\Controllers\admin\ReviewsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\admin\SupportController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\tutorController;
use App\Http\Controllers\Admin\VideoController;
//use App\Http\Controllers\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoupanController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\student\ChildrenController;
use App\Http\Controllers\student\PaymentController as StudentPaymentController;
use App\Http\Controllers\student\StudentController;
use App\Http\Controllers\student\Ticket\SupportTicketController;
use App\Http\Controllers\tutor\AppointmentController;
use App\Http\Controllers\tutor\TutorController as TutorTutorController;
use App\Http\Controllers\Webhook\WebhookController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

// Authentication Routes...
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin/login');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin/login')->name('admin/login');

Route::post('email-update', [HomeController::class, 'emailUpdate'])
    ->name('email.update')->middleware('auth');

Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// static pages routes
Route::get('/home', [HomeController::class, 'check_user'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('enroll/{plan_id?}', [HomeController::class, 'enroll'])->name('enroll');
Route::get('pricing/', [HomeController::class, 'pricing'])->name('pricing');
Route::get('how_it_works', [HomeController::class, 'how_it_works'])->name('how_it_works');
Route::get('login', [HomeController::class, 'login'])->name('login');
Route::post('enroll', [EnrollmentController::class, 'enroll'])->name('enroll_submit');

Route::get('enrollment_message', [EnrollmentController::class, 'enroll_message'])->name('enroll_msg');
Route::get('/courses', [HomeController::class, 'courses'])->name('courses');
Route::get('/blogs/{tags?}', [HomeController::class, 'blogs'])->name('blogs');
Route::get('blog-detail/{id?}/{slug?}', [HomeController::class, 'blog_detail'])->name('blog.detail');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/privacy/policy', [HomeController::class, 'privacy_policy'])->name('privacy.policy');
Route::get('/contact-us', [ContactController::class, 'contact'])->name('contact');
Route::post('contact-us', [ContactController::class, 'contact_submit'])->name('contact_submit');
Route::get('testimonials', [HomeController::class, 'testimonials'])->name('testimonials');

//additional pages added in iteration
Route::get('/quran-for-kids', [HomeController::class, 'for_kids'])->name('forkids');
Route::get('/online-madrasa-uk', [HomeController::class, 'madrasauk'])->name('madrasauk');
Route::get('/islamic-lessons-for-kids', [HomeController::class, 'islamiclessons'])->name('islamiclessons');
Route::get('/skype-quran-classes', [HomeController::class, 'skypeclasses'])->name('skypeclass');
Route::get('/tajweed-classes', [HomeController::class, 'tajweedclasses'])->name('tajweedclasses');
Route::get('/quran-hifz-program', [HomeController::class, 'hifzquran'])->name('hifzquran');
//auth routes
Route::post('admin/reset_password', [profileController::class, 'resetPassword'])->name('reset_password')->middleware('auth');
Route::post('admin/update_profile', [profileController::class, 'update_Profile'])->name('update_profile')->middleware('auth');

Route::middleware(['globals', 'verified'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::middleware('admin')->group(function () {

                Route::post('/assign/skypeID', [AdminController::class, 'assign_skypeID'])->name('assign.skypeID');

                Route::get('/financial-statement', [PaymentController::class, 'financialStatement'])->name('financial.statement');
                Route::get('/financial-statement/today', [PaymentController::class, 'financialStatementToday'])->name('financial.statement.today');
                Route::get('/financial-statement/this-month', [PaymentController::class, 'financialStatementmonthly'])->name('financial.statement.monthly');

                Route::get('/subscription-detail/{id?}', [PaymentController::class, 'getSubscriptionDetail'])->name('get.subscription.detail');

                Route::get('new-trilas', [InquiryController::class, 'newTrials'])->name('new.trial');
                Route::get('regular-students', [InquiryController::class, 'regularStudents'])->name('regular.students');
                //dashboard routes
                Route::get('inquiries-all', [AdminDashboardController::class, 'inquiries'])->name('inquiries');
                Route::get('inquiries-status', [AdminDashboardController::class, 'inquiriesStatus'])->name('inquiries.status');

                Route::get('/user_profile', [AdminController::class, 'user_Profile'])->name('user_Profile');
                Route::get('pending_payments', [PaymentController::class, 'pending_payments'])->name('pending.payments');
                Route::post('payment-payouts', [PaymentController::class, 'payment'])->name('payment');

                //review route
                Route::get('/cancel-subscription/{subscription_id?}', [PaymentController::class, 'cancelSub'])->name('cancel.subscrip');
                Route::post('/create/new-plan', [PaymentController::class, 'createPlan'])->name('create.new.subscription');
                Route::resource('reviews', ReviewsController::class);
                Route::get('/tutor-reviews', [ReviewsController::class, 'tutorReviews'])->name('tutor.reviews');
                // admin open tickets
                Route::get('enquiries', [SupportController::class, 'tickets'])->name('support.enquiries');
                Route::get('enquiries/{ticket_id}', [SupportController::class, 'detail'])->name('support.enquiry_detail');

                Route::post('save-comment', [SupportController::class, 'save_comment'])->name('support.save_comment');
                Route::get('close-enquiry/{id?}', [SupportController::class, 'close_enquriy'])->name('support.close_enquriy');

                //Plan
                Route::get('plan_add_form', [AdminController::class, 'plan_add_form'])->name('plan_add_form');
                Route::post('plan_create', [AdminController::class, 'plan_create'])->name('plan_create');
                Route::post('private-plan/create', [AdminController::class, 'private_plan'])->name('private_plan');
                Route::get('plan_list', [AdminController::class, 'plan_list'])->name('plan_list');
                Route::get('plan_edit/{id}', [AdminController::class, 'plan_edit'])->name('plan_edit');
                Route::post('plan_update/{id}', [AdminController::class, 'plan_update'])->name('plan_update');

                //Schedule
                Route::get('schedules-list/{id?}', [InquiryController::class, 'schedule'])->name('inquiry.schedule');
                Route::get('tutor-specific-schedules-list/{id}', [InquiryController::class, 'getTutorSpecificSchedulesList']);
                Route::get('/edit/inquiry-schedule/{id}', [InquiryController::class, 'editScheduleList'])->name('edit.inquiry.schedule');
                Route::post('/update/inquiry-schedule', [InquiryController::class, 'updateScheduleList'])->name('update.inquiry.schedule');

                //Country
                Route::get('country_list', [AdminController::class, 'country_list'])->name('country_list');
                Route::get('country_add', [AdminController::class, 'country_add'])->name('country_add');
                Route::post('country_store', [AdminController::class, 'country_store'])->name('country_store');
                Route::get('country_delete/{id}', [AdminController::class, 'country_delete'])->name('country_delete');
                Route::get('country_edit/{id}', [AdminController::class, 'country_edit'])->name('country_edit');
                Route::post('country_update/{id}', [AdminController::class, 'country_update'])->name('country_update');

                Route::get('inquiry/tutors-list/{id}', [InquiryController::class, 'tutorsForInquiry'])->name('assign.tutors.list');
                Route::get('inquiry/tutor-schedules/{inquiry}/{tutor_id}', [InquiryController::class, 'inquiryTutorSchedules'])->name('inquiry.tutor_schedules');
                Route::get('assign-inquiry/to-tutor/{inquiry}/{tutor_id}', [InquiryController::class, 'inquiryAssigned'])->name('assign.inquiry.tutor');
                // tutor
                Route::get('/tutor/{id?}', [tutorController::class, 'tutor'])->name('tutor');
                Route::post('/add_tutor', [tutorController::class, 'add_tutor'])->name('add_tutor');
                Route::get('/tutor_list', [tutorController::class, 'tutor_list'])->name('tutor_list');
                Route::get('/remove_tutor/{id?}', [tutorController::class, 'remove_tutor'])->name('remove_tutor');
                Route::get('pendingstatus/{id}', [tutorController::class, 'pendingstatus'])->name('pendingstatus');
                Route::get('approvestatus/{id}', [tutorController::class, 'approvestatus'])->name('approvestatus');
                Route::get('tutor-payout/{id?}', [tutorController::class, 'tutorPayout'])->name('tutor.payout');
                Route::get('/tutor/inquiries/{id?}', [tutorController::class, 'tutorInquiries'])->name('tutor.inquiries');
                Route::get('tutor-inquiries-schedule-detail', [tutorController::class, 'tutorInquiriesSchedule'])->name('tutor_inq_sch_detail');

                //Student
                Route::get('student-list', [AdminController::class, 'studen_list'])->name('studen_list');
                Route::get('student-all', [AdminController::class, 'student_all'])->name('student_all');
                Route::get('student-unallocated', [AdminController::class, 'unallocated_student'])->name('unallocated_students');
                Route::get('student-inquiry/detail-info/{inquiry_id}', [InquiryController::class, 'studentInquiryDetail'])->name('student.inquiry.detail');
                Route::get('bulk-inquiries/delete', [InquiryController::class, 'delelteBulkInquiries'])->name('inquiryes.bulk.del');

                Route::get('student-payouts/{id?}', [AdminController::class, 'studentPayouts'])->name('student.payouts');
                Route::get('student_delete/{id}', [AdminController::class, 'student_delete'])->name('student_delete');
                Route::get('student_schedule/edit/{id?}', [AdminController::class, 'studentScuduleEdit'])->name('student.edit.schedule');
                // setting
                Route::post('store_settings', [SettingController::class, 'updateSettings'])->name('store_settings');
                // Route::get('/setting/{id?}', [SettingController::class, 'setting'])->name('setting');
                // Route::post('/add_setting', [SettingController::class, 'add_setting'])->name('add_setting');
                // page

                Route::get('/videos', [VideoController::class, 'list'])->name('videos');
                Route::get('/add-video', [VideoController::class, 'add'])->name('add.video');
                Route::post('/store-video', [VideoController::class, 'store'])->name('store.video');
                Route::get('/delete-video/{id?}', [VideoController::class, 'delete'])->name('delete.video');
                Route::get('/edit-video/{id?}', [VideoController::class, 'edit'])->name('edit.video');
                Route::post('/update-video/{id?}', [VideoController::class, 'update'])->name('update.video');

                Route::get('/page/{id?}', [PagesController::class, 'page'])->name('page');
                Route::post('/add_page', [PagesController::class, 'add_page'])->name('add_page');
                Route::get('/page_list', [PagesController::class, 'page_list'])->name('page_list');
                Route::delete('/remove_page', [PagesController::class, 'remove_page'])->name('remove_page');
                // coupon
                Route::get('/coupon/{id?}', [CouponController::class, 'coupon'])->name('coupon');
                Route::post('/add_coupon', [CouponController::class, 'add_coupon'])->name('add_coupon');
                Route::get('/coupon_list', [CouponController::class, 'coupon_list'])->name('coupon_list');
                Route::get('/remove_coupon/{id?}', [CouponController::class, 'remove_coupon'])->name('remove_coupon');
                Route::post('payment', [CouponController::class, 'emailCoupon'])->name('email.coupon');

                // inqueries
                Route::get('/inquiries/paid/', [InquiryController::class, 'paid_inquiries'])->name('paid_inquiries');
                Route::get('/inquiries/', [InquiryController::class, 'all_inquiries'])->name('all_inquiries');
                Route::get('/inquiries/not-paid', [InquiryController::class, 'not_paid_inquiries'])->name('not_paid_inquiries');
                Route::get('failed-payment', [InquiryController::class, 'failedPayment'])->name('failed.payment');
                Route::get('cancel-subscriptions/list', [InquiryController::class, 'cancelSubs'])->name('cancel.subscription');
                Route::get('pending-subscriptions/list', [InquiryController::class, 'pendingpays'])->name('pending.subscription');
                Route::get('trial-inquiries', [InquiryController::class, 'trialInquiries'])->name('trial.inquiries');
                Route::get('students-tutor/removed', [InquiryController::class, 'removedTutors'])->name('removed.tutors');
                Route::get('payment-status/{customerId}', [InquiryController::class, 'getPaymentStatus'])->name('payment_status');
                Route::get('get-all-customers', [InquiryController::class, 'getCustomersList'])->name('payment_status');

                Route::get('/cancel/payments/{paymentId}', [InquiryController::class, 'cancelPayment'])->name('cancle.payment');
                Route::get('/reinitiate/payments/{paymentId}', [InquiryController::class, 'reinitiatePayment'])->name('reinitiate.payment');

                Route::get('/student-inquiry/detail/{id?}', [InquiryController::class, 'detail'])->name('inquiry.detail');
                Route::get('send-reminder/{id}', [InquiryController::class, 'sendReminder'])->name('send.payment.reminder');
                // Go card less
                Route::get('pending-subscriptions/submission', [InquiryController::class, 'pending_submission'])->name('pending.subscription.submission');
                Route::get('pending-subscriptions/submitted', [InquiryController::class, 'submitted'])->name('pending.subscription.submitted');
                Route::get('pending-subscriptions/confirmed', [InquiryController::class, 'confirmed'])->name('pending.subscription.confirmed');
                Route::get('pending-subscriptions/paid_out', [InquiryController::class, 'paid_out'])->name('pending.subscription.paid_out');
                Route::get('pending-subscriptions/cancelled', [InquiryController::class, 'cancelled'])->name('pending.subscription.cancelled');
                Route::get('pending-subscriptions/customer_approval_denied', [InquiryController::class, 'customer_approval_denied'])->name('pending.subscription.customer_approval_denied');
                Route::get('pending-subscriptions/failed', [InquiryController::class, 'failed'])->name('pending.subscription.failed');
                Route::get('pending-subscriptions/charged_back', [InquiryController::class, 'charged_back'])->name('pending.subscription.charged_back');
                Route::get('pending-subscriptions/pending_customer_approval', [InquiryController::class, 'pending_customer_approval'])->name('pending.subscription.pending_customer_approval');

                //export
                Route::get('all-inquiry-export', [InquiryController::class, 'allInquiryExport'])->name('all.inquiry.export');
                Route::get('paid-inquiry-export', [InquiryController::class, 'paidInquiryExport'])->name('paid.inquiry.export');
                Route::get('not_paid-inquiry-export', [InquiryController::class, 'notPaidInquiryExport'])->name('not_paid.inquiry.export');
                Route::get('cancel-sub-inquiry-export', [InquiryController::class, 'CancelSubInquiryExport'])->name('cancelSub.inquiry.export');

                // Contact messages
                Route::get('/contact_messages', [AdminContactController::class, 'contact_messages'])->name('contact_messages');

                Route::get('/paypal-pending-inquiries', [InquiryController::class, 'inquiriesPaypalPending'])->name('inquiries.paypal.pending');
                Route::post('/paypal-inquiries-mail', [InquiryController::class, 'inquiriesPaypalMail'])->name('inquiries.paypal.mail');

                Route::get('inquiry-filter/{type}', [InquiryController::class, 'inquiryFilter'])->name('inquiry.filter');
                Route::get('/inquiry_forward/{id}', [InquiryController::class, 'inquiry_forward'])->name('forward.inquiry');
                //Route::post('create_appointment', [InquiryController::class, 'create_appointment'])->name('create_appointment');
                Route::get('change-inquiry-statu/{id}/{status}', [InquiryController::class, 'changeStatus'])->name('change.inquiry.status');
                Route::post('change-inquiry-status/{id}/{status}', [InquiryController::class, 'startClass'])->name('change.inquiry.start.class');
                Route::post('direct-debit-start/{id}', [InquiryController::class, 'directStartDate'])->name('add.debit.date');
                Route::get('remove-inquiry-statu/{id}', [InquiryController::class, 'deleteInquiry'])->name('inquiry.delete');
                Route::get('delete-inquiry/{id}', [InquiryController::class, 'destroy'])->name('destroy.inquiry');
                Route::get('remove-tutor-inquiry/{id?}', [InquiryController::class, 'removeTutorFromInquiry'])->name('remove.tutor.Inquiry');

                //subscription
                Route::get('subscription_list', [InquiryController::class, 'subscription_list'])->name('subscription_list');

                // payment_manager
                Route::get('/payment_manager/{id?}', [PaymentManagerController::class, 'payment_manager'])->name('payment_manager');
                Route::post('/add_payment_manager', [PaymentManagerController::class, 'add_payment_manager'])->name('add_payment_manager');
                Route::get('/payment_manager_list', [PaymentManagerController::class, 'payment_manager_list'])->name('payment_manager_list');
                Route::get('/remove_payment_manager/{id?}', [PaymentManagerController::class, 'remove_payment_manager'])->name('remove_payment_manager');
                // cms
                Route::name('cms.')->group(function () {
                    Route::get('/cms/{id?}', [AdminController::class, 'add_cms'])->name('add');
                });
                Route::name('faqs.')->group(function () {
                    Route::get('faqs', [FaqsController::class, 'faqs'])->name('add');
                    Route::post('store_faqs/{id?}', [FaqsController::class, 'store'])->name('store');
                    Route::get('faqs_list', [FaqsController::class, 'list'])->name('list');
                    Route::get('faqs_edit/{id?}', [FaqsController::class, 'edit'])->name('edit');
                    Route::get('faqs_delete/{id?}', [FaqsController::class, 'delete'])->name('delete');
                });
                Route::name('notifications.')->group(function () {
                    Route::get('manage_notifications', [NotificationController::class, 'manage_notifications'])->name('manage.notifications');
                    Route::post('allow_mail', [NotificationController::class, 'allow_mail'])->name('allow.mail');
                });
                Route::name('blogs.')->group(function () {
                    Route::get('blogs_add', [BlogController::class, 'add'])->name('add');
                    Route::post('store_blogs/{id?}', [BlogController::class, 'store'])->name('store');
                    Route::get('blogs_list', [BlogController::class, 'list'])->name('list');
                    Route::get('edit_blog/{id?}', [BlogController::class, 'edit'])->name('edit');
                    Route::get('delete_blog/{id?}', [BlogController::class, 'delete'])->name('delete');
                    Route::get('blog_visibility/{id}/{visibility}', [BlogController::class, 'blog_visibility'])->name('change.visibility');
                });

                Route::name('testimonial.')->prefix('testimonial')->group(function () {
                    Route::get('list', [TestimonialController::class, 'list'])->name('list');
                    Route::get('add', [TestimonialController::class, 'add'])->name('add');
                    Route::get('edit/{id?}', [TestimonialController::class, 'edit'])->name('edit');
                    Route::get('status/{id?}', [TestimonialController::class, 'status'])->name('status');
                    Route::post('save/{id?}', [TestimonialController::class, 'save'])->name('save');
                    Route::get('delete/{id?}', [TestimonialController::class, 'delete'])->name('delete');
                });

                Route::name('expense.')->prefix('expense')->group(function () {
                    Route::get('list', [ExpenseController::class, 'list'])->name('list');
                    Route::get('add', [ExpenseController::class, 'add'])->name('add');
                    Route::get('edit/{id?}', [ExpenseController::class, 'edit'])->name('edit');
                    Route::post('save/{id?}', [ExpenseController::class, 'save'])->name('save');
                    Route::get('delete/{id?}', [ExpenseController::class, 'delete'])->name('delete');
                });

                Route::get('chat', [ReviewsController::class, 'chat'])->name('chat');
                Route::get('conversation/{id?}', [ReviewsController::class, 'conversation'])->name('conversation');
            });

            //admin or manager shared route
            Route::post('create_appointment', [InquiryController::class, 'create_appointment'])->name('create_appointment');
            Route::get('remove-tutor/{id?}', [InquiryController::class, 'removeTutor'])->name('shared.tutor.remove');
            Route::get('/edit/inquiry-schedule/{id}', [InquiryController::class, 'editScheduleList'])->name('shared.edit.inquiry.schedule');

            Route::get('/inquiry_forward/{id?}', [InquiryController::class, 'inquiry_forwards'])->name('shared.inquiry_forward');
            Route::get('change-inquiry-status/{id}/{status}', [InquiryController::class, 'changesStatus'])->name('shared.change.inquiry.status');
            Route::get('schedule/trial-class/{id}', [InquiryController::class, 'scheduleTrialClass'])->name('shared.schedule.trial.class');
            Route::post('schedule/trial-class', [InquiryController::class, 'setTrialClass'])->name('shared.set.trial.class');
            Route::post('paymentss', [PaymentManagerController::class, 'payment'])->name('shared.payment');
            Route::post('tutor_salary', [PaymentManagerController::class, 'tutor_salary'])->name('shared.tutor.salary');
            Route::get('tutors/inquiries/{id?}', [InquiryController::class, 'tutorInquiries'])->name('shared.tutor.inquiries');
            Route::get('shared/inquiry_forward/{id?}', [InquiriesController::class, 'inquiry_forward'])->name('inquiry_forward');
            Route::get('pay-out/{tutor_id?}', [PaymentManagerController::class, 'pay_out'])->name('shared.pay_out');
            Route::get('shared/tutor_list', [PaymentManagerController::class, 'tutor_list'])->name('shared.tutor_list');
            Route::get('shared/student_list', [PaymentManagerController::class, 'student_list'])->name('shared.student_list');
            Route::get('shared/show_inquiries/{status?}', [InquiryController::class, 'show_inquiries'])->name('shared.inquiries.show');
            Route::get('shared/schedule-list/{id?}', [InquiriesController::class, 'schedule'])->name('shared.inquiry.schedule');
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

            Route::get('/inquiry-interest/{id}/{status}', [InquiryController::class, 'inquiryInterest'])->name('inquiry.interest');
        });
    });
});

Route::name('tutor.')->group(function () {
    Route::prefix('tutor')->group(function () {
        Route::middleware('tutor')->group(function () {
            Route::get('/user_profile', [TutorTutorController::class, 'tutor_info'])->name('user_profile');
            Route::post('/edit_profile', [TutorTutorController::class, 'edit_info'])->name('edit_profile');
            Route::post('/reset_password', [TutorTutorController::class, 'reset_password'])->name('reset_password');
            // Route::get('logout', [TutorTutorController::class, 'logout'])->name('logout');
            Route::post('edit_pic', [TutorTutorController::class, 'edit_pic'])->name('edit_pic');
            Route::get('appointments', [AppointmentController::class, 'appointments'])->name('appointments');
            Route::get('session_list', [TutorTutorController::class, 'session_list'])->name('session_list');
            Route::get('session_add_form/{id}', [TutorTutorController::class, 'session_add_form'])->name('session_add_form');
            Route::post('create-inquiry-schedule', [TutorTutorController::class, 'inquiry_schedule'])->name('inquiry_schedule_create');
            Route::post('session_create', [TutorTutorController::class, 'session_create'])->name('session_create');
            Route::get('single_user_session_list/{id}', [TutorTutorController::class, 'single_user_session_list'])->name('single_user_session_list');
            Route::get('update-schedule/{id}', [TutorTutorController::class, 'editSchedule'])->name('edit.schedule');
            Route::post('/update/inquiry-schedule', [TutorTutorController::class, 'updateScheduleList'])->name('update.schedule');

            Route::get('payments', [TutorTutorController::class, 'payments'])->name('payments');

            Route::post('student-reviews', [TutorTutorController::class, 'review'])->name('review.student');

            Route::get('link-zoom', [TutorTutorController::class, 'linkZooom'])->name('link.zoom');
        });
    });
});

Route::name('student.')->group(function () {
    Route::prefix('student')->group(function () {
        Route::get('thank-you', [StudentController::class, 'thankYou'])->name('thank.you')->middleware(['student', 'verified']);
        Route::middleware(['student', 'verified'])->group(function () {
            Route::get('dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

            Route::get('/s_user_profile', [StudentController::class, 'student_info'])->name('s_user_profile');
            Route::post('/edit_profile', [StudentController::class, 'edit_info'])->name('edit_profile');
            Route::post('/reset_password', [StudentController::class, 'reset_password'])->name('reset_password');
            Route::post('edit_pic', [StudentController::class, 'edit_pic'])->name('edit_pic');

            Route::get('/children', [ChildrenController::class, 'index'])->name('children');
            Route::get('/add/children', [ChildrenController::class, 'create'])->name('add.children');
            Route::get('/update/child/{id}', [ChildrenController::class, 'update'])->name('update.children');
            Route::post('/submit/children', [ChildrenController::class, 'submit'])->name('submit.children');
            Route::get('/delete/child/{id}', [ChildrenController::class, 'delete'])->name('delete.children');

            Route::post('/child/login', [ChildrenController::class, 'child_login'])->name('child.login');
            Route::get('/child/schedule/{id}', [ChildrenController::class, 'child_profile'])->name('child.schedule');

            //subscription
            Route::get('student_subscription', [StudentController::class, 'student_subscription'])->name('student_subscription');
            Route::get('canceled_payments', [StudentController::class, 'canceled_payments'])->name('canceled_payments');

            Route::get('student_all_session', [StudentController::class, 'student_all_session'])->name('student_all_session');
            Route::get('student_inquiries', [StudentController::class, 'student_inquiries'])->name('student_inquiries');

            //open tickets
            Route::get('/tickets', [SupportTicketController::class, 'index'])->name('ticket.tickets');
            Route::get('/tickets/{ticket_id}', [SupportTicketController::class, 'detail'])->name('ticket.tickets.detail');
            Route::get('/open-ticket', [SupportTicketController::class, 'open_ticket'])->name('ticket.open_ticket');
            Route::post('/save-ticket', [SupportTicketController::class, 'save_ticket'])->name('ticket.save_ticket');
            Route::post('/save-comment', [SupportTicketController::class, 'save_comment'])->name('ticket.save_comment');
            Route::get('/close-ticket/{id?}', [SupportTicketController::class, 'close_ticket'])->name('ticket.close_ticket');

            //payment subscription routes
            Route::get('/paypal-subscription/{plan_id}', [StudentPaymentController::class, 'payPalSubscriptions'])->name('paypal.subscription');
            Route::get('/gocardless-subscription/{plan_id}/{discount_value}/{inquiry_id}/{student_id}', [StudentPaymentController::class, 'gocardlessSubscriptions'])->name('gocardless.subscription');

            Route::post('/gocardless-apitesting', [WebhookController::class, 'testAPI']);

            // check inquiry payment status middleware route
            Route::get('session/{id}', [StudentController::class, 'session'])->name('session');

            //payment routes
            Route::get('/payments/{id}', [StudentPaymentController::class, 'index'])->name('payments.index');
            Route::post('/payments/', [StudentPaymentController::class, 'create'])->name('payments.create');

            Route::get('/reinitiate/payments/{paymentId}', [InquiryController::class, 'reInitiatePayment'])->name('reinitiate.payment');

            //gocardless
            Route::get('/redirection_to_gocardless/{plan_id}/{new_price}/{inquiry_id}', [StudentPaymentController::class, 'redirection_to_gocardless'])->name('redirection_to_gocardless');
            Route::get('/gocardless-information/{id?}', [StudentController::class, 'goCardlesssInfo'])->name('gocardless.info');

            //paypal subscription payment routes
            Route::post('/payments/paypal', [StudentPaymentController::class, 'createPaypal'])->name('payments.paypal.create');

            Route::get('/reviews', [StudentController::class, 'reviews'])->name('reviews');
        });
    });
});

Route::get('/proceed-payment', [EnrollmentController::class, 'proceedPaymentPaypal'])->name('payment.mail.paypal');
Route::get('/validate-promo', [CoupanController::class, 'validatePromo'])->name('validate.promo');
Route::get('/validate-promo-paypal', [CoupanController::class, 'validatePromoPaypal'])->name('validate.promo.paypal');
Route::get('/paymentsuccess/{inquiry_id?}', [EnrollmentController::class, 'payment_success']);
Route::get('/paymenterror', [EnrollmentController::class, 'payment_error']);

//webhooks routes
Route::post('/webhook', [WebhookController::class, 'paypalWebhook']);
Route::post('/gocardless-webhook', [WebhookController::class, 'gocardlessWebhook']);
Route::get('/testing-payment/charges/{id?}', [WebhookController::class, 'findPayment']);

Route::middleware('auth')->group(function () {
    Route::get('/messenger/{id?}', [MessengerController::class, 'messenger'])->name('messenger');
    Route::get('/get-chat', [MessengerController::class, 'getChat'])->name('get.chat');
    Route::post('/save-message', [MessengerController::class, 'savemessage'])->name('save.messsage');
    Route::get('/tutor-unread-messages', [MessengerController::class, 'tutorUnread'])->name('tutor.unread');
    Route::get('/student-unread-messages', [MessengerController::class, 'studentUnread'])->name('student.unread');
});

// Route::get('/test-cron/schedule-notification',[HomeController::class, 'mailNotificationCron']);
// Route::get('/test-cron/tutor-report',[HomeController::class, 'tutorreportNotification']);
Route::get('/check-sub/{id?}', [HomeController::class, 'checkSub']);

//location based searches
Route::get('/quran-teacher-leeds', [HomeController::class, 'leedslocation'])->name('leeds');
Route::get('/quran-teacher-derby', [HomeController::class, 'derbylocation'])->name('derby');
Route::get('/quran-teacher-sheffield', [HomeController::class, 'sheffieldlocation'])->name('sheffield');
Route::get('/quran-teacher-luton', [HomeController::class, 'lutonlocation'])->name('luton');
Route::get('/quran-teacher-southampton', [HomeController::class, 'southamptonlocation'])->name('southampton');
Route::get('/quran-teacher-london', [HomeController::class, 'londonlocation'])->name('london');
Route::get('/quran-teacher-birmingham', [HomeController::class, 'birminghamlocation'])->name('birmingham');
Route::get('/quran-teacher-glasgow', [HomeController::class, 'glasgowlocation'])->name('glasgow');
Route::get('/quran-teacher-blackburn', [HomeController::class, 'blackburnlocation'])->name('blackburn');
Route::get('/quran-teacher-newcastle', [HomeController::class, 'newcastlelocation'])->name('newcastle');
Route::get('/quran-teacher-bradford', [HomeController::class, 'bradfordlocation'])->name('bradford');
Route::get('/quran-teacher-manchester', [HomeController::class, 'manchesterlocation'])->name('manchester');
Route::get('/quran-teacher-liverpool', [HomeController::class, 'liverpoollocation'])->name('liverpool');
Route::get('/quran-teacher-stockport', [HomeController::class, 'stockportlocation'])->name('stockport');
Route::get('/quran-teacher-nottingham', [HomeController::class, 'nottinghamlocation'])->name('nottingham');
Route::get('/quran-teacher-bristol', [HomeController::class, 'bristollocation'])->name('bristol');
Route::get('/quran-teacher-cardiff', [HomeController::class, 'cardifflocation'])->name('cardiff');
Route::get('/quran-teacher-islington', [HomeController::class, 'islingtonlocation'])->name('islington');
Route::get('/quran-teacher-barking', [HomeController::class, 'barkinglocation'])->name('barking');
Route::get('/quran-teacher-leicester', [HomeController::class, 'leicesterlocation'])->name('leicester');
Route::get('/quran-teacher-walthamstow', [HomeController::class, 'walthamstowlocation'])->name('walthamstow');
Route::get('/quran-teacher-croydon', [HomeController::class, 'croydonlocation'])->name('croydon');
Route::get('/quran-teacher-halifax', [HomeController::class, 'halifaxlocation'])->name('halifax');
Route::get('/quran-teacher-oldham', [HomeController::class, 'oldhamlocation'])->name('oldham');
Route::get('/quran-teacher-oxford', [HomeController::class, 'oxfordlocation'])->name('oxford');
Route::get('/quran-teacher-reading', [HomeController::class, 'readinglocation'])->name('reading');
Route::get('/quran-teacher-shipley', [HomeController::class, 'shipleylocation'])->name('shipley');
Route::get('/quran-teacher-stokeon', [HomeController::class, 'stokeonlocation'])->name('stokeon');
Route::get('/quran-teacher-slough', [HomeController::class, 'sloughlocation'])->name('slough');
Route::get('/quran-teacher-wakefield', [HomeController::class, 'wakefieldlocation'])->name('wakefield');

//test purposes
Route::get('/cardless', [InquiryController::class, 'getGoCardless']);

Route::get('/clear', function () {
    // Artisan::call('cache:clear');
    Artisan::call('config:clear');
});
