<?php
use App\Http\Controllers\SitemapController;

use App\Http\Livewire\Public\Auth\AdminLogin;
use App\Http\Livewire\Public\Auth\ForgotPassword;
use App\Http\Livewire\Public\Auth\Login;
use App\Http\Livewire\Public\Auth\Profile;
use App\Http\Livewire\Public\Auth\Register;
use App\Http\Livewire\Public\Auth\ResetPassword;
use App\Http\Livewire\Public\Auth\VerifyEmail;
use App\Http\Livewire\Public\Blog;
use App\Http\Livewire\Public\Home;
use App\Http\Livewire\Public\Pages as PublicPage;

use App\Http\Livewire\Public\Install\Welcome as SWWelcome;
use App\Http\Livewire\Public\Install\Requirements as SWRequirements;
use App\Http\Livewire\Public\Install\Environment as SWDatabase;
use App\Http\Livewire\Public\Install\Account as SWAccount;
use App\Http\Livewire\Public\Install\Import as SWImport;
use App\Http\Livewire\Public\Install\Finished as SWFinished;

use App\Models\Admin\General;
use App\Models\Admin\Languages;
use App\Models\Admin\Page;
use App\Models\Admin\PageTranslation;

use App\Http\Livewire\Admin\Update;
use App\Http\Livewire\Admin\Profile\Index as AdminProfileIndex;
use App\Http\Livewire\Admin\Dashboard as AdminDashboardIndex;
use App\Http\Livewire\Admin\Posts\Index as AdminPostIndex;
use App\Http\Livewire\Admin\Posts\Translations\Index as AdminPostTranslationsIndex;
use App\Http\Livewire\Admin\Posts\Translations\Create as AdminPostTranslationsCreate;
use App\Http\Livewire\Admin\Posts\Translations\Edit as AdminPostTranslationsEdit;

use App\Http\Livewire\Admin\Pages\Index as AdminPagesIndex;
use App\Http\Livewire\Admin\Pages\Translations\Index as AdminPagesTranslationsIndex;
use App\Http\Livewire\Admin\Pages\Translations\Create as AdminPagesTranslationsCreate;
use App\Http\Livewire\Admin\Pages\Translations\Edit as AdminPagesTranslationsEdit;
use App\Http\Livewire\Admin\Pages\AuthPages as AdminPagesAuthPages;

use App\Http\Livewire\Admin\Tools\Index as AdminToolsIndex;
use App\Http\Livewire\Admin\Tools\History as AdminToolsHistoryIndex;
use App\Http\Livewire\Admin\Tools\Translations\Index as AdminToolsTranslationsIndex;
use App\Http\Livewire\Admin\Tools\Translations\Create as AdminToolsTranslationsCreate;
use App\Http\Livewire\Admin\Tools\Translations\Edit as AdminToolsTranslationsEdit;
use App\Http\Livewire\Admin\Tools\Categories as AdminToolsCategoriesIndex;

use App\Http\Livewire\Admin\Users\Index as AdminUsersIndex;
use App\Http\Livewire\Admin\Report as AdminReportIndex;
use App\Http\Livewire\Admin\Cache as AdminCacheIndex;
use App\Http\Livewire\Admin\Sitemap as AdminSitemapIndex;
use App\Http\Livewire\Admin\About as AdminAboutIndex;
use App\Http\Livewire\Admin\License as AdminLicenseIndex;

use App\Http\Livewire\Admin\Settings\General as AdminGeneralIndex;
use App\Http\Livewire\Admin\Settings\Menus as AdminMenusIndex;
use App\Http\Livewire\Admin\Settings\Header as AdminHeaderIndex;
use App\Http\Livewire\Admin\Settings\Footer\Index as AdminFooterIndex;
use App\Http\Livewire\Admin\Settings\Footer\Create as AdminFooterTranslationsCreate;
use App\Http\Livewire\Admin\Settings\Footer\Edit as AdminFooterTranslationsEdit;

use App\Http\Livewire\Admin\Settings\Sidebars as AdminSidebarsIndex;
use App\Http\Livewire\Admin\Settings\Gdpr as AdminGdprIndex;
use App\Http\Livewire\Admin\Settings\Advertisements as AdminAdvertisementsIndex;
use App\Http\Livewire\Admin\Settings\Smtp as AdminSmtpIndex;
use App\Http\Livewire\Admin\Settings\ApiKeys as AdminApiKeysIndex;
use App\Http\Livewire\Admin\Settings\Proxy\Index as AdminProxyIndex;
use App\Http\Livewire\Admin\Settings\Captcha as AdminCaptchaIndex;
use App\Http\Livewire\Admin\Settings\SocialLogin as AdminSocialLoginIndex;

use App\Http\Livewire\Admin\Settings\Languages\Index as AdminLanguagesIndex;
use App\Http\Livewire\Admin\Settings\Languages\Translations\Create as AdminLanguagesTranslationsCreate;
use App\Http\Livewire\Admin\Settings\Languages\Translations\Edit as AdminLanguagesTranslationsEdit;

use App\Http\Livewire\Admin\Settings\Redirects\Index as AdminRedirectsIndex;
use App\Http\Livewire\Admin\Settings\Advanced as AdminAdvancedIndex;

use App\Http\Livewire\Admin\Indexing\Submit as AdminIndexingSubmitIndex;
use App\Http\Livewire\Admin\Indexing\History as AdminIndexingHistoryIndex;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

Route::group([], function () {

    try {

        $request = Request::capture();
        
        $allLangData = Languages::get(['code'])->pluck('code')->toArray();

        $activeLangData = Languages::where('status', true)->get(['code'])->pluck('code')->toArray();

		if (empty($activeLangData)) {
		    $activeLangData = ['en'];
		}

        if ($request->is('admin/*')) {

            Config::set('localization.supported-locales', $allLangData);

            Config::set('translatable.locales', $allLangData);

        } else {

            Config::set('localization.supported-locales', $activeLangData);

            Config::set('translatable.locales', $activeLangData);
        }

        if (General::first()->automatic_language_detection) {

            Config::set('localization.accept-language-header', true);

            Config::set('localization.hide-default-in-url', false);

        } else {

            $default = Languages::where('default', true)->first()->code;

            Config::set('app.locale', $default);

            Config::set('localization.hide-default-in-url', true);
        }

    } catch (\Exception $e) {

    }
});

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

if (file_exists( 'update.php' ))
{
	Route::get('/update', Update::class)->name('update');
}

//Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

//Install
Route::group(['middleware' => 'swinstall', 'prefix' => 'install'], function () {

	Route::get('/', SWWelcome::class)->name('sw_welcome');

	Route::get('/requirements', SWRequirements::class)->name('sw_requirements');

	Route::get('/database', SWDatabase::class)->name('sw_database');

	Route::get('/account', SWAccount::class)->name('sw_account');

	Route::get('/import', SWImport::class)->name('sw_import');
	
	Route::get('/finished', SWFinished::class)->name('sw_finished');

});

//Cookie
Route::get('/cookies/accept', function(){
    Cookie::queue('cookies', time(), 43200);
});

//Reset License
Route::get('/reset-license/{purchase_code}/{domain}', [AdminLicenseIndex::class, 'onResetLicense'])->name('admin.license.reset');

//Theme Mode Toggle
Route::get('/theme/mode', function () {

    $default_mode = \App\Models\Admin\General::first()->default_theme_mode;

    $current_mode = Cookie::get('theme_mode', $default_mode);

    $new_mode = ($current_mode === 'theme-dark') ? 'theme-light' : 'theme-dark';

    Cookie::queue('theme_mode', $new_mode, 43200);

});

//Public Pages
Route::localizedGroup(function () {

	//Verified
	Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	    $request->fulfill();
	    return redirect('/');
	})->middleware(['auth', 'signed'])->name('verification.verify');

	Route::group(['middleware' => 'auth'], function() {

		//User Profile
		Route::get('/profile', Profile::class)->name('user.profile');

		//Verify Email
		Route::get('/verify-email', VerifyEmail::class)->name('verify.email');
		
		//User logout
		Route::get('/logout', [AdminProfileIndex::class, 'onLogout'])->name('user.logout');

	});

	//Reset Password with Token
	Route::group(['middleware' => 'guest'], function() {

		//Google Login
		Route::get('auth/google', [Login::class, 'onRedirectToGoogle'])->name('social.google.login');
		Route::get('auth/google/callback', [Login::class, 'onHandleGoogleCallback'])->name('social.google.callback');

		//Facebook Login
		Route::get('auth/facebook', [Login::class, 'onRedirectToFacebook'])->name('social.facebook.login');
		Route::get('auth/facebook/callback', [Login::class, 'onHandleFacebookCallback'])->name('social.facebook.callback');

		//Login
		Route::get('/login', Login::class)->name('login');

		//Register
		Route::get('/register', Register::class)->name('register');

		//Forgot Password
		Route::get('/forgot-password', ForgotPassword::class)->name('password.forgot');

		//Reset Password
		Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
	});

	//Home
	Route::get('/', Home::class)->name('home');

	//Blog
	try {
		
		if ( General::first()->blog_page_status == true ) {
			Route::get('/blog', Blog::class)->name('blog');
		}

	} catch (\Exception $e) {
		
	}

	//Blog Post
	Route::get('/blog/{slug}', PublicPage::class)->where('slug', '^((?!admin.*).)*$')->name('public.blog');

	//Instant Indexing
	Route::get('/{hash}.txt', function($hash) {

	    $apiKey = \App\Models\Admin\ApiKeys::where('indexnow_api_key', $hash)->first();

	    if (!$apiKey) {
	        abort(404);
	    }

	    return response($apiKey->indexnow_api_key, 200)->header('Content-Type', 'text/plain');

	})->name('admin.settings.indexing');

	//Page
	Route::get('/{slug}', PublicPage::class)->where('slug', '^((?!admin.*).)*$')->name('public.page');
	
	//Admin Login
	Route::group(['middleware' => ['guest', 'localized-auth']], function() {

		Route::get('/admin/login', AdminLogin::class)->name('admin.login');

	});

});

//Admin Dashboard
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isadmin', 'localized-auth']], function() {

		Config::set('app.version', '2.0.0' );

		Route::get('/' , function(){
		      return redirect()->back();
		})->name('admin');

		Route::get('/dashboard', AdminDashboardIndex::class)->name('admin.dashboard.index');

		Route::group(['prefix' => 'posts'], function() {
			Route::get('/', AdminPostIndex::class)->name('admin.posts.index');
			Route::get('/{page_id}/translations', AdminPostTranslationsIndex::class)->name('admin.posts.translations.index');
			Route::get('/{page_id}/translations/{locale}/create', AdminPostTranslationsCreate::class)->name('admin.posts.translations.create');
			Route::get('/translations/{trans_id}/edit', AdminPostTranslationsEdit::class)->name('admin.posts.translations.edit');
		});

		Route::group(['prefix' => 'pages'], function() {
			Route::get('/', AdminPagesIndex::class)->name('admin.pages.index');
			Route::get('/{page_id}/translations', AdminPagesTranslationsIndex::class)->name('admin.pages.translations.index');
			Route::get('/{page_id}/translations/{locale}/create', AdminPagesTranslationsCreate::class)->name('admin.pages.translations.create');
			Route::get('/translations/{trans_id}/edit', AdminPagesTranslationsEdit::class)->name('admin.pages.translations.edit');
			Route::get('/authentication', AdminPagesAuthPages::class)->name('admin.pages.authentication.index');
		});

		Route::group(['prefix' => 'tools'], function() {
			Route::get('/', AdminToolsIndex::class)->name('admin.tools.index');
			Route::get('/{page_id}/translations', AdminToolsTranslationsIndex::class)->name('admin.tools.translations.index');
			Route::get('/{page_id}/translations/{locale}/create', AdminToolsTranslationsCreate::class)->name('admin.tools.translations.create');
			Route::get('/translations/{trans_id}/edit', AdminToolsTranslationsEdit::class)->name('admin.tools.translations.edit');
			Route::get('/categories', AdminToolsCategoriesIndex::class)->name('admin.tools.categories.index');
			Route::get('/history', AdminToolsHistoryIndex::class)->name('admin.tools.history.index');
		});

		Route::get('/users', AdminUsersIndex::class)->name('admin.users.index');
		Route::get('/report', AdminReportIndex::class)->name('admin.report.index');
		Route::get('/cache', AdminCacheIndex::class)->name('admin.cache.index');
		Route::get('/sitemap', AdminSitemapIndex::class)->name('admin.sitemap.index');
		Route::get('/about', AdminAboutIndex::class)->name('admin.about.index');
		Route::get('/license', AdminLicenseIndex::class)->name('admin.license.index');
		
		Route::group(['prefix' => 'settings'], function () {

			Route::get('/general', AdminGeneralIndex::class)->name('admin.general.index');
			Route::get('/menus', AdminMenusIndex::class)->name('admin.menus.index');
			Route::get('/header', AdminHeaderIndex::class)->name('admin.header.index');

			Route::group(['prefix' => 'footer'], function() {
				Route::get('/', AdminFooterIndex::class)->name('admin.footer.index');
				Route::get('/create/translations/{locale}', AdminFooterTranslationsCreate::class)->name('admin.footer.translations.create');
				Route::get('/edit/translations/{trans_id}', AdminFooterTranslationsEdit::class)->name('admin.footer.translations.edit');
			});

			Route::get('/sidebars', AdminSidebarsIndex::class)->name('admin.sidebars.index');
			Route::get('/gdpr', AdminGdprIndex::class)->name('admin.gdpr.index');
			Route::get('/advertisements', AdminAdvertisementsIndex::class)->name('admin.advertisements.index');
			Route::get('/smtp', AdminSmtpIndex::class)->name('admin.smtp.index');
			Route::get('/api-keys', AdminApiKeysIndex::class)->name('admin.apikeys.index');
			Route::get('/proxy', AdminProxyIndex::class)->name('admin.proxy.index');
			Route::get('/captcha', AdminCaptchaIndex::class)->name('admin.captcha.index');
			Route::get('/social-login', AdminSocialLoginIndex::class)->name('admin.sociallogin.index');

			Route::group(['prefix' => 'languages'], function() {
				Route::get('/', AdminLanguagesIndex::class)->name('admin.languages.index');
				Route::get('/create/translations', AdminLanguagesTranslationsCreate::class)->name('admin.languages.translations.create');
				Route::get('/edit/translations/{lang_id}', AdminLanguagesTranslationsEdit::class)->name('admin.languages.translations.edit');
			});

			Route::get('/redirects', AdminRedirectsIndex::class)->name('admin.redirects.index');
			Route::get('/advanced', AdminAdvancedIndex::class)->name('admin.advanced.index');

		});

		Route::group(['prefix' => 'indexing'], function () {

			Route::get('/submit', AdminIndexingSubmitIndex::class)->name('admin.indexing.submit');

			Route::get('/history', AdminIndexingHistoryIndex::class)->name('admin.indexing.history');
		});

		Route::group(['prefix' => 'user'], function () {

			Route::get('/profile', AdminProfileIndex::class)->name('admin.profile.index');

			Route::get('/logout', [AdminProfileIndex::class, 'onLogout'])->name('admin.logout');
		});

});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth', 'isadmin']], function () {
 	\UniSharp\LaravelFilemanager\Lfm::routes();
});