<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/test", function(){
    return view("reservation.test");
 });
Route::get('/new-index', [App\Http\Controllers\HomeController::class, 'new_index']);
Route::get('/autocomplete', [App\Http\Controllers\SearchController::class, 'autocomplete'])->name('autocomplete');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');
Route::get('/select-location', [App\Http\Controllers\SearchController::class, 'selectLocation'])->name('selectLocation');


Auth::routes();

// AJAX Login Route
Route::post('/ajax-login', [App\Http\Controllers\Auth\LoginController::class, 'ajaxLogin'])->name('ajax.login');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(App\Http\Controllers\ReservationController::class)->group(function () {
    Route::get('/reservation', 'index')->name('reservation');
    Route::get('/view-modify-cancel', 'vMc')->name('reservation.vMc');
    Route::get('/get-receipt', 'receipt')->name('reservation.receipt');
    Route::get('/short-term-rental', 'shortTermRental')->name('reservation.shortTermRental');
    Route::get('/subscribe-with-enterprise', 'subscribeEnterprise')->name('reservation.subscribeEnterprise');   
    Route::get('/one-way-car-rental', 'oneWayEnterprise')->name('reservation.oneWayEnterprise');   
    Route::get('/long-term-car-rental', 'longTermEnterprise')->name('reservation.longTermEnterprise');   
    Route::get('/our-standard-care', 'ourStandardCare')->name('reservation.ourStandardCare');   
    Route::get('/get-ip', 'getIp')->name('reservation.getIp');   
    Route::get('/car_select/{days?}', 'carSelect')->name('reservation.carSelect');
    Route::get('/filter', 'filter')->name('reservation.filter');
    Route::get('/add-vehicle', 'addVehicle')->name('reservation.addVehicle');
    Route::get('/extras/{id?}', 'addExtras')->name('reservation.addExtras');
    Route::get('/add-equipment', 'addEquipment')->name('reservation.addEquipment');
    Route::get('/review-reserve', 'reviewReserve')->name('reservation.reviewReserve');
    Route::get('/get-loc-address', 'getLocAddress')->name('reservation.getLocAddress');
});
    
Route::controller(App\Http\Controllers\EnterpriseController::class)->group(function () {
    Route::get('/enterprise-plus', 'index')->name('enterprise');
    Route::get('/join-enterprise-plus', 'enterpriseJoin')->name('enterprise.join');
    Route::post('/enterprise-create', 'create')->name('enterprise.create');
    Route::post('/profileValidate', 'profileValidate')->name('enterprise.profileValidate');
    Route::get('/get-state', 'getState')->name('enterprise.getState');
   
});

Route::controller(App\Http\Controllers\RentallocationsController::class)->group(function () {
    Route::get('/jordan-car-rental-locations', 'index')->name('location.jordan'); 
    Route::get('/international-car-rental-locations', 'interLocation')->name('location.inter'); 
    Route::get('/single-location/{id?}', 'singleLocation')->name('location.singleLocation'); 
    Route::get('/location-result', 'locationResult')->name('location.locationResult'); 
    // Route::post('/location-search', 'locationSearch')->name('location.locationSearch'); 

    Route::match(['get', 'post'],'/location-search', 'locationSearch')->name('location.locationSearch'); 
});

Route::controller(App\Http\Controllers\VehicleController::class)->group(function () {
    Route::get('/car', 'car')->name('vehicle.car'); 
    Route::get('/suvs', 'suvs')->name('vehicle.suvs'); 
    Route::get('/trucks', 'trucks')->name('vehicle.trucks'); 
    Route::get('/vans', 'vans')->name('vehicle.vans');  
    Route::get('/exotic-cars', 'exotic')->name('vehicle.exotic'); 
    Route::get('/vehicle-detail/{id?}', 'detail')->name('vehicle.detail'); 
    Route::get('/all-vechicles', 'vechicle')->name('vehicle.vechicle'); 

});

Route::controller(App\Http\Controllers\ServiceController::class)->group(function () {

});

Route::controller(App\Http\Controllers\InspirationController::class)->group(function () {
    Route::get('/road-trips', 'index')->name('inspiration.trip'); 
    Route::get('/pursuits-with-enterprise', 'pursuit')->name('inspiration.pursuit'); 
    Route::get('/rent-a-car-after-an-accident', 'afterAccident')->name('inspiration.afterAccident'); 
});

Route::controller(App\Http\Controllers\PromotionController::class)->group(function () {
    Route::get('/deals-promotions', 'index')->name('promotion'); 
    Route::get('/email-specials', 'emailSpecial')->name('promotion.emailSpecial'); 
    Route::get('/travel-partners', 'travelPartner')->name('promotion.travelPartner'); 
});

Route::controller(App\Http\Controllers\CustomerserviceController::class)->group(function () {
    Route::get('/faq', 'faq')->name('customer.faq'); 
    Route::get('/faq-pickup/{id?}', 'faqPickup')->name('customer.faqPickup'); 
    Route::get('/contact', 'contact')->name('customer.contact'); 
    Route::get('/site-map', 'siteMap')->name('customer.siteMap'); 
    Route::get('/rent-car-after-accident', 'accident')->name('customer.accident'); 
    Route::get('/supporting-those-service', 'supportService')->name('customer.supportService'); 
    Route::get('/car-rental-guide', 'guide')->name('customer.guide'); 
});

Route::controller(App\Http\Controllers\CompanyController::class)->group(function () {
    Route::get('/about', 'about')->name('company.about'); 
    Route::get('/mobility-solutions', 'mobilitySolution')->name('company.mobilitySolution'); 
    Route::get('/meet-our-people', 'meetPeople')->name('company.meetPeople'); 
    Route::get('/careers', 'career')->name('company.career'); 
    Route::get('/community', 'community')->name('company.community'); 
    Route::post('/job-alert', 'jobAlert')->name('company.jobAlert'); 
    Route::get('/select-job', 'selectJob')->name('company.selectJob'); 
    Route::post('/job-filter', 'jobFilter')->name('company.jobFilter'); 
    Route::get('/job-discription/{id?}', 'jobdis')->name('company.jobdis'); 
    Route::post('/apply-job', 'applyJob')->name('company.applyJob'); 
    Route::get('/career-form', 'careerForm')->name('company.careerForm'); 
    Route::post('/career-form-save', 'careerFormSave')->name('company.careerFormSave'); 
});

Route::controller(App\Http\Controllers\BusinessController::class)->group(function () {
    Route::get('/business-car-rental', 'carRental')->name('business.carRental');
    Route::get('/travel-admin', 'travelAdmin')->name('business.travelAdmin');
    Route::get('/travel-advisor-login', 'advisorLogin')->name('business.advisorLogin');
    Route::get('/military-government-rental-discounts', 'rentalDiscount')->name('business.rentalDiscount');
    Route::get('/business-rental-form', 'businessForm')->name('business.businessForm');
    Route::post('/business-rental-form-submit', 'businessFormSubmit')->name('business.businessFormSubmit');
    Route::post('/business-rental-form-ajax', 'businessFormAjax')->name('business.businessFormAjax');

});


/* admin */
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminHomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/user-list', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.list');
    // Route::get('/home-page', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.homePage');

    Route::controller(App\Http\Controllers\Admin\HomeController::class)->group(function () {
        Route::get('/home-page', 'index')->name('admin.homePage'); 
        Route::post('/create-offer', 'createOffer')->name('admin.createOffer'); 
        Route::post('/rental-heading', 'rentalHeading')->name('admin.rentalHeading'); 
        Route::post('/rental-offer', 'rentalOffer')->name('admin.rentalOffer'); 
        Route::post('/rental-card', 'rentalCard')->name('admin.rentalCard'); 
        Route::post('/home-learn', 'homeLearn')->name('admin.homeLearn'); 
        Route::post('/home-banner', 'homeBanner')->name('admin.homeBanner'); 
    });
    Route::controller(App\Http\Controllers\Admin\ReservationController::class)->group(function () {
        Route::get('/reservation', 'index')->name('admin.reservation'); 
        Route::post('/reservation-intro', 'reservationIntro')->name('admin.reservationIntro'); 
        Route::post('/reservation-first-cards-section', 'reservationFirstcard')->name('admin.reservationFirstcard'); 
        Route::post('/reservation-second-cards-section', 'reservationSecondcard')->name('admin.reservationSecondcard'); 
        Route::post('/reservation-third-cards-section', 'reservationThirdcard')->name('admin.reservationThirdcard'); 
        Route::post('/reservation-vmc', 'reservationVmc')->name('admin.reservationVmc'); 
        Route::post('/reservation-receipt', 'reservationReceipt')->name('admin.reservationReceipt'); 
        Route::post('/reservation-shortTerm-banner', 'reservationshortTermBanner')->name('admin.reservationshortTermBanner'); 
        Route::post('/reservation-shortTerm-benefit', 'reservationshortTermBenefit')->name('admin.reservationshortTermBenefit'); 
        Route::post('/reservation-shortTerm-card', 'reservationshortTermCard')->name('admin.reservationshortTermCard'); 
        Route::post('/reservation-shortTerm-business', 'reservationshortTermBusiness')->name('admin.reservationshortTermBusiness'); 
        Route::post('/reservation-subscribe', 'reservationSubscribe')->name('admin.reservationSubscribe'); 
        Route::post('/reservation-content', 'reservationContent')->name('admin.reservationContent'); 
        Route::post('/reservation-sub-card', 'reservationSubCard')->name('admin.reservationSubCard'); 
        Route::post('/reservation-sub-work', 'reservationSubWork')->name('admin.reservationSubWork'); 
        Route::post('/reservation-sub-workheading', 'reservationSubWorkheading')->name('admin.reservationSubWorkheading'); 
        Route::post('/reservation-sub-link', 'reservationSubLink')->name('admin.reservationSubLink'); 
        Route::post('/reservation-sub-lastlink', 'reservationSubLastlink')->name('admin.reservationSubLastlink'); 
        Route::get('/long-term', 'LongTermRental')->name('admin.LongTermRental'); 
        Route::post('/edit-long-term', 'editLongTermRental')->name('admin.editLongTermRental'); 
        Route::post('/edit-card-text', 'editLongTermCardText')->name('admin.editLongTermCardText'); 
        Route::post('/popular-text', 'editLongTermPopularText')->name('admin.editLongTermPopularText'); 
        Route::post('/reason-text', 'editLongTermReasonText')->name('admin.editLongTermReasonText'); 
        Route::post('/lease-vs-rental', 'editLongTermLeaseRental')->name('admin.editLongTermLeaseRental'); 
        Route::get('/one-way', 'oneWayRental')->name('admin.oneWayRental'); 
        Route::post('/edit-one-way', 'editOneWayRental')->name('admin.editOneWayRental'); 
        Route::post('/edit-one-way-type', 'editOneWayRentalType')->name('admin.editOneWayRentalType'); 
        Route::post('/edit-one-way-looking', 'editOneWayRentalLooking')->name('admin.editOneWayRentalLooking');
        Route::post('/edit-one-way-milage', 'editOneWayRentalmileage')->name('admin.editOneWayRentalmileage');
    });

    Route::controller(App\Http\Controllers\Admin\VehicleController::class)->group(function () {
        Route::get('/vehicle', 'index')->name('admin.vehicle'); 
        Route::post('/car-banner', 'carBaneer')->name('admin.vehicle.carBaneer'); 
        Route::post('/car-content', 'carContent')->name('admin.vehicle.carContent'); 
        Route::post('/suv-banner', 'suvBaneer')->name('admin.vehicle.suvBaneer'); 
        Route::post('/suv-content', 'suvContent')->name('admin.vehicle.suvContent'); 
        Route::post('/truck-banner', 'truckBaneer')->name('admin.vehicle.truckBaneer'); 
        Route::post('/truck-content', 'truckContent')->name('admin.vehicle.truckContent'); 
        Route::post('/van-banner', 'vanBaneer')->name('admin.vehicle.vanBaneer'); 
        Route::post('/van-content', 'vanContent')->name('admin.vehicle.vanContent'); 
    });

    Route::controller(App\Http\Controllers\Admin\NavbarController::class)->group(function () {
        Route::get('/navbar', 'index')->name('admin.nav');
        Route::post('/edit-navbar', 'editNav')->name('admin.nav.editNav');
        Route::get('/view-sub-navbar', 'subHeadingView')->name('admin.nav.subHeadingView');
        Route::get('/single-sub-navbar', 'singleHeadingView')->name('admin.nav.singleHeadingView');
        Route::post('/update-sub-navbar', 'updateSubHeading')->name('admin.nav.updateSubHeading');
        Route::post('/top-nav', 'topNav')->name('admin.nav.topNav');
    });

    Route::controller(App\Http\Controllers\Admin\LocationController::class)->group(function () {
        Route::get('/location', 'index')->name('admin.location');
        Route::post('/edit-heading', 'editHeading')->name('admin.location.editHeading');
        Route::post('/edit-content', 'editContent')->name('admin.location.editContent');
        Route::post('/edit-inter-heading', 'editInterHeading')->name('admin.location.editInterHeading');
        Route::post('/edit-inter-content', 'editInterContent')->name('admin.location.editInterContent');
        Route::post('/edit-inter-card', 'editInterCard')->name('admin.location.editInterCard');
        Route::post('/us-faq', 'editUsFaq')->name('admin.location.editUsFaq');
        Route::get('/get-cities', 'usCities')->name('admin.location.usCities');
        Route::post('/add-cities', 'addUsCities')->name('admin.location.addUsCities');
        Route::get('/countries', 'showCountries')->name('admin.location.showCountries');
        Route::post('/region-countries', 'addRegionCountries')->name('admin.location.addRegionCountries');
        Route::post('/us-popular', 'addUsPopular')->name('admin.location.addUsPopular');
    
    });

    Route::controller(App\Http\Controllers\Admin\BusinessController::class)->group(function () {
        Route::get('/business', 'index')->name('admin.business');
        Route::post('/business-banner', 'businessBanner')->name('admin.business.businessBanner');
        Route::post('/business-today', 'businessToday')->name('admin.business.businessToday');
        Route::post('/business-today-heading', 'businessTodayHeading')->name('admin.business.businessTodayHeading');
        Route::post('/business-benifit', 'businessBenifits')->name('admin.business.businessBenifit');
        Route::post('/business-benifit-heading', 'businessBenifitHeading')->name('admin.business.businessBenifitHeading');
        Route::post('/business-loyalty', 'businessLoyalty')->name('admin.business.businessLoyalty');
        Route::post('/business-rentailProgram', 'businessRentailProgram')->name('admin.business.businessRentailProgram');
        Route::post('/business-rentail', 'businessRentail')->name('admin.business.businessRentail');
        Route::post('/business-rentailImages', 'businessRentailImages')->name('admin.business.businessRentailImages');
        Route::post('/business-center', 'businessCenter')->name('admin.business.businessCenter');
        Route::post('/business-safety', 'businessSafety')->name('admin.business.businessSafety');
        Route::post('/business-tool', 'businessTool')->name('admin.business.businessTool');
        Route::post('/business-tool-heading', 'businessToolHeading')->name('admin.business.businessToolHeading');
        Route::post('/Signing-up', 'signingUp')->name('admin.business.signingUp');

        Route::post('/choose-enterprise-heading', 'chooseenterpriseHeading')->name('admin.business.chooseenterprise');
        Route::post('/choose-enterprise-content', 'chooseenterpriseContent')->name('admin.business.choosecontent');
        Route::get('/business-retail-form', 'retailForm')->name('admin.retailForm');
        Route::post('/business-retail-form', 'retailFormSave')->name('admin.retailFormSave');
    });

    Route::controller(App\Http\Controllers\Admin\TravelController::class)->group(function () {
        Route::get('/travel-administrator', 'index')->name('admin.travel');
        Route::post('/add-travel-admin', 'addTrevalAdmin')->name('admin.travel.addTrevalAdmin');
        Route::post('/add-travel-advisorContent', 'addTrevalAdvisorContent')->name('admin.travel.AdvisorContent');
        Route::post('/add-travel-advisorPledge', 'addTrevalAdvisorPledge')->name('admin.travel.AdvisorPledge');
        Route::post('/add-travel-advisorPolicy', 'addTrevalAdvisorPolicy')->name('admin.travel.AdvisorPolicy');
        Route::post('/add-travel-advisorGuide', 'addTrevalAdvisorGuide')->name('admin.travel.AdvisorGuide');
        Route::post('/add-travel-guideHeading', 'addTrevalGuideHeading')->name('admin.travel.GuideHeading');
    });

    Route::controller(App\Http\Controllers\Admin\MilitaryController::class)->group(function () {
        Route::get('/military-rentals', 'index')->name('admin.military');
        Route::post('/add-military-banner', 'addMilitaryBanner')->name('admin.military.militaryBanner');
        Route::post('/add-military-discount', 'addMilitaryDiscountContent')->name('admin.military.militaryDiscountContent');
        Route::post('/add-military-serve', 'addMilitaryServeContent')->name('admin.military.militaryServeContent');
       
    });

    Route::controller(App\Http\Controllers\Admin\CustomerController::class)->group(function () {
        Route::get('/faq', 'index')->name('admin.faq');
        Route::post('/edit-faq', 'editFaq')->name('admin.service.editFaq');
        Route::get('/view-faq-question', 'viewFaq')->name('admin.service.viewFaq');
        Route::get('/view-question', 'viewQuestion')->name('admin.service.viewQuestion');
        Route::post('/edit-question', 'editQuestion')->name('admin.service.editQuestion');      
        Route::get('/customer-service', 'serviceFaq')->name('admin.service.serviceFaq');
        Route::post('/customer-service-faq', 'serviceHeadFaq')->name('admin.service.serviceHeadFaq');
        Route::post('/service-sideHeading', 'serviceSideHeading')->name('admin.service.serviceSideHeading');
        Route::get('/service-sideHeading-view', 'serviceSideHeadingView')->name('admin.service.serviceSideHeadingView');
        Route::get('/side-singleHeading-detail', 'singleHeadingDetail')->name('admin.service.singleHeadingDetail');
        Route::post('/side-singleHeading-edit', 'singleHeadingedit')->name('admin.service.singleHeadingedit');
        Route::get('/side-detail-view', 'singleDetailView')->name('admin.service.singleDetailView');
        Route::get('/side-singleDetail-view', 'detailView')->name('admin.service.detailView');
        Route::post('/side-singleDetail-update', 'detailUpdate')->name('admin.service.detailUpdate');
    });

    Route::controller(App\Http\Controllers\Admin\CountryWebsiteController::class)->group(function () {
        Route::get('/website-country', 'index')->name('admin.website');
        Route::get('/country', 'viewCountry')->name('admin.website.viewCountry');
        Route::post('/update-country-link', 'updateCountryLink')->name('admin.website.updateCountryLink');
        Route::get('/delete-country-link', 'deleteCountryLink')->name('admin.website.deleteCountryLink');
    });

    Route::controller(App\Http\Controllers\Admin\ContactController::class)->group(function () {
        Route::get('/contact-us', 'index')->name('admin.contact');
        Route::post('/add-contact', 'addContact')->name('admin.contact.addContact');
        Route::post('/update-contact', 'updateContact')->name('admin.contact.updateContact');
        Route::post('/section-contact', 'section1Contact')->name('admin.contact.section1Contact');
        Route::post('/banner-contact', 'bannerContact')->name('admin.contact.bannerContact');
        Route::post('/last-section-contact', 'lastSectionContact')->name('admin.contact.lastSectionContact');
    });

    Route::controller(App\Http\Controllers\Admin\PromotionController::class)->group(function () {
        Route::get('/promotion', 'index')->name('admin.promotion');
        Route::post('/add-promotion', 'add')->name('admin.promotion.add');
        Route::post('/update-offer', 'updateOffer')->name('admin.promotion.updateOffer');
        Route::post('/program', 'program')->name('admin.promotion.program');
        Route::post('/program-image', 'updateImage')->name('admin.promotion.updateImage');
    });

    Route::controller(App\Http\Controllers\Admin\InspirationController::class)->group(function () {
        Route::get('/inspiration', 'index')->name('admin.inspiration');
        Route::post('/banner-content', 'BannerContent')->name('admin.inspiration.BannerContent');
        Route::post('/planning-content', 'planningContent')->name('admin.inspiration.planningContent');
        Route::post('/destination-content', 'destinationContent')->name('admin.inspiration.destinationContent');
        Route::post('/best-trip-content', 'bestTripContent')->name('admin.inspiration.bestTripContent');
        Route::post('/feature-heading', 'featureHeading')->name('admin.inspiration.featureHeading');
        Route::post('/edit-feature-card', 'editFeatureCard')->name('admin.inspiration.editFeatureCard');
        Route::post('/faq-message', 'editFaqMessage')->name('admin.inspiration.editFaqMessage');
        Route::get('/explore-jordan', 'explore')->name('admin.inspiration.explore');
        Route::post('/jordan-banner', 'jordanBanner')->name('admin.inspiration.jordanBanner');
        Route::post('/jordan-people', 'jordanPeople')->name('admin.inspiration.jordanPeople');
        Route::post('/jordan-image', 'jordanImage')->name('admin.inspiration.jordanImage');
        Route::post('/edit-jordan-image', 'editJordanImage')->name('admin.inspiration.editJordanImage');
        Route::get('/delete-jordan-image', 'deleteJordanImage')->name('admin.inspiration.deleteJordanImage');
    });

    Route::controller(App\Http\Controllers\Admin\MobilitySolutionController::class)->group(function () {
        Route::get('/mobility', 'index')->name('admin.mobility');
        Route::post('/add-mobility-card', 'addMobilityCard')->name('admin.mobility.addMobilityCard');
        Route::post('/mobility-content', 'mobilityContent')->name('admin.mobility.mobilityContent');
        Route::post('/mobility-bannerImage', 'mobilityBannerImage')->name('admin.mobility.mobilityBannerImage');
    });

    Route::controller(App\Http\Controllers\Admin\MeetQurPeopleController::class)->group(function () {
        Route::get('/meet-our-people', 'index')->name('admin.meet');
        Route::post('/add-meet-content', 'addContent')->name('admin.meet.addContent');
        Route::post('/edit-meet-slider', 'editslider')->name('admin.meet.editslider');
        Route::post('/edit-meet-culture', 'editCulture')->name('admin.meet.editCulture');
        Route::post('/edit-meet-review', 'editReview')->name('admin.meet.editReview');
        Route::post('/edit-meet-card', 'editCard')->name('admin.meet.editCard');
        Route::post('/edit-meet-roadSuccess', 'editRoadSuccess')->name('admin.meet.editRoadSuccess');
    });

    Route::controller(App\Http\Controllers\Admin\AboutController::class)->group(function () {
        Route::get('/about-us', 'index')->name('admin.about');
        Route::post('/edit-about-content', 'editAboutContent')->name('admin.about.editAboutContent');
        Route::post('/edit-about-multiImage', 'editAboutmultiImage')->name('admin.about.editAboutmultiImage');
        Route::post('/edit-about-Value', 'editAboutValue')->name('admin.about.editAboutValue');
        Route::post('/edit-about-slider', 'editAboutSlider')->name('admin.about.editAboutSlider');
        Route::post('/edit-about-cards', 'editAboutCards')->name('admin.about.editAboutCards');
        Route::post('/edit-about-banner', 'editAboutBanner')->name('admin.about.editAboutBanner');
        Route::get('/delete-about-multiImage', 'deleteAboutMultiImage')->name('admin.about.deleteAboutMultiImage');
    });

    Route::controller(App\Http\Controllers\Admin\CareerController::class)->group(function () {
        Route::get('/career', 'index')->name('admin.career');
        Route::post('/add-career-content', 'addContent')->name('admin.career.addContent');
        Route::post('/edit-career-card', 'editCard')->name('admin.career.editCard');
        Route::post('/edit-career-logoBanner', 'editLogoBanner')->name('admin.career.editLogoBanner');
    });

    Route::controller(App\Http\Controllers\Admin\LearnEnterpriseController::class)->group(function () {
        Route::get('/learn-enterprise', 'index')->name('admin.learn');
        Route::post('/add-learn-content', 'addLearnContent')->name('admin.learn.addLearnContent');
        Route::post('/add-learn-reward', 'addLearnreward')->name('admin.learn.addLearnreward');
        Route::post('/add-learn-benifit', 'addLearnBenifit')->name('admin.learn.addLearnBenifit');
        Route::post('/add-learn-rewardPoint', 'addLearnRewardPoint')->name('admin.learn.addLearnRewardPoint');
        Route::post('/add-learn-rewardHeading', 'addLearnRewardHeading')->name('admin.learn.addLearnRewardHeading');
    });

    Route::controller(App\Http\Controllers\Admin\StandardCareController::class)->group(function () {
        Route::get('/standard-of-care', 'index')->name('admin.StandardOfCare');
        Route::post('/add-standard-content', 'content')->name('admin.Standard.content');
        Route::post('/update-standard-card', 'standardCard')->name('admin.Standard.standardCard');
    });

    Route::controller(App\Http\Controllers\Admin\FooterController::class)->group(function () {
        Route::get('/terms-of-use', 'index')->name('admin.termsofuse');
        Route::post('addterms','addterms')->name('admin.terms.addterms');
        Route::post('updateterms','updateterms')->name('admin.terms.updateterms');
        
    });

    Route::controller(App\Http\Controllers\Admin\PrivacypolicyController::class)->group(function () {
        Route::get('/privacy-policy', 'index')->name('admin.privacypolicy');
        Route::post('addpolicy','addpolicies')->name('admin.policy.addpolicy');
        Route::post('updatepolicy','updatepolicies')->name('admin.policy.updatepolicy');
        
    });

    Route::controller(App\Http\Controllers\Admin\CookiespolicyController::class)->group(function () {
        Route::get('/cookie-policy', 'index')->name('admin.cookiepolicy');
        Route::post('addpolicy','addpolicy')->name('admin.cookie.addpolicy');
        
    });

    Route::controller(App\Http\Controllers\Admin\TermsconditionController::class)->group(function () {
        Route::get('/terms-conditions', 'index')->name('admin.termscondition');
        Route::post('addconditions','addconditions')->name('admin.conditions.addconditions');
        
    });

    Route::controller(App\Http\Controllers\Admin\JobController::class)->group(function () {
        Route::get('/jobs', 'index')->name('admin.index');
        Route::post('/job-edit', 'jobEdit')->name('admin.job.edit');
        Route::post('/add-profile', 'addProfile')->name('admin.job.addProfile');
        Route::post('/add-req', 'addReq')->name('admin.job.addReq');
        Route::post('/edit-req', 'editReq')->name('admin.job.editReq');
        Route::get('/view-job', 'viewJob')->name('admin.job.viewJob');
        Route::get('/delete-profile', 'deleteProfile')->name('admin.job.deleteProfile');
        Route::get('/view-req', 'viewReq')->name('admin.job.viewReq');
        Route::get('/delete-req', 'deleteReq')->name('admin.job.deleteReq');
 
        
    });

    Route::controller(App\Http\Controllers\Admin\PolicyController::class)->group(function () {
        Route::get('/rental-policies', 'index')->name('admin.policy.index');
        Route::get('/add-rental-policies', 'addPolicy')->name('admin.policy.addPolicy');
        Route::post('/add-policy', 'policy')->name('admin.policy.policy');
        Route::get('/edit-rental-policiy/{id?}', 'editPolicy')->name('admin.policy.editPolicy');
        Route::post('/edit-rental', 'editRentalPolicy')->name('admin.policy.editRentalPolicy');
        Route::get('/delete-policy', 'deletePolicy')->name('admin.policy.deletePolicy');
        Route::get('/hours-services', 'services')->name('admin.policy.services');
        Route::post('/add-hours-services', 'addHours')->name('admin.policy.addHours');
        Route::get('/show-hours-services', 'showHours')->name('admin.policy.showHours');
    });

    Route::controller(App\Http\Controllers\Admin\JordanController::class)->group(function () {
        Route::get('/jodan-vehicles', 'index')->name('admin.jodan.vehicles');
        Route::post('/add-jodan-vehicles', 'AddJordenVechile')->name('admin.jodan.AddVechile');
        Route::get('/delete-jodan-vehicles', 'deleteJordenVechile')->name('admin.jodan.deleteVechile');
    });




});



Route::controller(App\Http\Controllers\FooterdataController::class)->group(function() {
    Route::get('terms-of-use', 'termsofuse')->name('terms_of_use');
    Route::get('privacy-policy', 'privacypolicy')->name('privacy_policy');
    Route::get('cookie-policy', 'cookiepolicy')->name('cookie_policy');
    Route::get('terms-conditions', 'termsconditions')->name('terms_conditions');
});




Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    if($locale=="en"){
      return redirect('/en');
    }
    else{
      return redirect('/ar');
    }
});


Route::get('en', [App\Http\Controllers\HomeController::class, 'language']);
Route::get('ar', [App\Http\Controllers\HomeController::class, 'language']);




Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return "Cache is cleared! you can continue from fresh.";
});
