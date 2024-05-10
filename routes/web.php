<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use App\Http\Controllers\Authcontroller;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\MyspaceController;

use App\Http\Controllers\ReviewController;

use App\Http\Controllers\CustomerController;

use App\Http\Controllers\ArticleController;

use App\Http\Controllers\FileManager;

use App\Http\Controllers\BhiController;


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

app()->setLocale('en');


// une route de check pour voir si l'utilisateur est déja connecté
//Route::post('check', [AuthController::class, 'checkLoginAdmin'])->name('checkA');


//LES ETATS DE CHAQUE UTILISATEUR


                            //POUR L'ADMINISTRATEUR
//GROUPER UN ENSEMBLRE DE ROUTES PROTEGEES



/*Route::name('admins.')->group(function(){

});*/

//MOT DE PASSE OUBLIE
Route::get('email_forget_form', function(){
    return view('email_forget_form');
});

Route::post('email_forget_form', [UserController::class, 'GetEmailForget']);

Route::get('/reset_pass_form/{id_client}', [UserController::class, 'ResetPassCustomerForm']);

Route::post('reset_pass_form/{id_client}', [UserController::class, 'ResetMyPass']);

//POUR GERER LA LANGUE ON GROUPE DANS CETTE ROUTE
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    //AVEC GUEST SI DEJA Loggé
    Route::middleware(['guest:admin'])->group(function(){

        
        //PAGE DE CONNEXION
        Route::view('admin', 'admins/admin')->name('admin');
        /*Route::get('/admin', function(){

            return view('admins/admin')->name('login');
        });*/

        //CONNEXION
        Route::post('admin_login', [AuthController::class, 'AdminLogin']);

        //PAGES D'ADMINISTRATIONS
        Route::get('welcome', DashboardController::class)->name('welcome');//->middleware('auth:admin');

        //AJOUT D'UN UTILISTAEUR
        Route::post('adduser', [UserController::class, 'AddUser']);

        //MON PROFILE
        Route::post('admin_profile', [UserController::class, 'Userprofile']);

        //un compte client
        Route::post('add_customer_user', [UserController::class, 'AddAccount']);

        //MODIFICATION D'UN COMPTE CLIENT
        //Route::post('')

        //Ajouter un journal de presse
        Route::post('addnewspaper', [ReviewController::class, 'AddNewspaper']);

        //Ajouter un client
        Route::post('addcompany', [CustomerController::class, 'AddCompany']);

        //EDITER UNE COMPAGNIE
        Route::post('editcustomerform', [CustomerController::class, 'EditForm']);
        Route::post('editcompany', [CustomerController::class, 'EditCompany']);

        //SUPPRIMER UNE COMPAGNIE CLIENTE
        Route::post('deletecompagny', [CustomerController::class, 'DeleteCompany']);

        //ajout d'une revue de presse
        Route::post('addreview', [ReviewController::class, 'AddPressReview']);

        //SUPPRIMER UNE REVUE DE PRESSE
        Route::post('deletereview', [ReviewController::class, 'DeletReview']);

        //ajouter un artcile de presse
        Route::post('addartcile', [ArticleController::class, 'AddArcticle']);

        //afficher les articles de la revue de presse
        Route::post('details', [Articlecontroller::class, 'DetailsView']);

        //SUPPRIMER UN ARTICLE DE PRESSE
        Route::post('deleteArticleForm', [ArticleController::class, 'DeleteArticle']);

        //Supprimer un utilisateur client
        Route::post('deletecustomer', [UserController::class, 'deleteCustomer']);

        //suppression d'un utilisateur admin
        Route::post('deleteadminuser', [UserController::class, 'deleteAdminUser']);

        //modifier un utilisateur admin
        Route::post('editformadminuser', [UserController::class, 'EditAdminForm']);
        Route::post('editadmin', [UserController::class, 'EditAdminUser']);
        /*Route::get('edit_admin_form', function(){

            return view('admins/edit_admin_form');
        });*/

        //SI ON VEUT MODIFIER LE MOT DE PASSE
        Route::post('adminpassword', [UserController::class, 'EditAdminPass']);

        //MODIFICAIOTN D'UN UTILISATEUR CLIENT
        Route::post('editcompagnyform', [UserController::class, 'EditCustomerForm']);
        Route::post('edit_customer_user', [UserController::class, 'EditUserAccount']);
        Route::post('edit_customer_user_password', [UserController::class, 'EditUserPass']);

        //SUPPRIMER UNE COMPAGNIE CLIENTE
        Route::post('deletecompagny', [CustomerController::class, 'DeleteCompany']);

        //LES BHI
        Route::get('bhi', function () {
            return view('admins/bhi_manage');
        })->name('bhi');


        //POUR ALLER DANS LES PRESSES ET AUTRES
        Route::get('press_review', function () {
        
            return view('admins/press_review');
            
        });

        //AFFICHAGE DES ARTICLES DE PRESSE ENREGISTRES
        Route::get('articles_view', function(){

            return view('admins/articles_view');
        });

        //MODIFICATION D'UN ARTICLE
        Route::post('editArticleForm', [ArticleController::class, 'EditArticleForm']);
        Route::post('editartcile', [ArticleController::class, 'EditArticle']);

        //RECHERCHER UNE REVUE
        Route::post('admin_searh_review', [ReviewController::class, 'AdminSerachReview']);

        //modification de la revue de presse
        Route::post('editViewForPressReview', [ReviewController::class, 'EditFormPr']);
        Route::post('editreview', [ReviewController::class, 'EditReview']);

        Route::get('companies', function () {
        
            return view('admins/companies');
            
        });

        Route::get('users', function () {
        
            return view('admins/users');
            
        });

        Route::get('customers', function () {
        
        //dd(session('theadmin')->pseudo);
        return view('admins/customers');
    
        
        });  

        //AJOUTER UN BHI
        Route::post('/addbhi', [BhiController::class, 'AddBhi']);

        //LES BHI
        Route::get('bhi', function () {
            return view('admins/bhi_manage');
        })->name('bhi');

        //TELECHARGEMENT D'UN BHI
        Route::post('/download', [FileManager::class, 'BhiDownload']);

        //MODIFIER UN BHI
        Route::post('form_edit_bhi', [BhiController::class, 'FormEditBhi']);

        Route::post('editbhi', [BhiController::class, 'EditBhi']);


    });

    //MIDDELWARE AUTH
    Route::middleware(['auth:admin'])->group(function(){

        //Route::view('/', 'admins/welcome');

        //CONNEXION
        //Route::post('admin_login', [AuthController::class, 'AdminLogin']);

        //PAGES D'ADMINISTRATIONS
        Route::get('welcome', DashboardController::class)->name('welcome');//->middleware('auth:admin');

        //AJOUT D'UN UTILISTAEUR
        Route::post('adduser', [UserController::class, 'AddUser']);

        //MON PROFILE
        Route::post('admin_profile', [UserController::class, 'Userprofile']);

        //un compte client
        Route::post('add_customer_user', [UserController::class, 'AddAccount']);

        //Ajouter un journal de presse
        Route::post('addnewspaper', [ReviewController::class, 'AddNewspaper']);

        //Ajouter un client
        Route::post('addcompany', [CustomerController::class, 'AddCompany']);

        //EDITER UNE COMPAGNIE
        Route::post('editcompagnyform', [CustomerController::class, 'EditForm']);
        Route::post('editcompany', [CustomerController::class, 'EditCompany']);

        //SUPPRIMER UNE COMPAGNIE CLIENTE
        Route::post('deletecompagny', [CustomerController::class, 'DeleteCompany']);

        //ajout d'une revue de presse
        Route::post('addreview', [ReviewController::class, 'AddPressReview']);

        //ajouter un artcile de presse
        Route::post('addartcile', [ArticleController::class, 'AddArcticle']);

        //SUPPRIMER UNE REVUE DE PRESSE
        Route::post('deletereview', [ReviewController::class, 'DeletReview']);

        //afficher les articles de la revue de presse
        Route::post('details', [Articlecontroller::class, 'DetailsView']);

        //SUPPRIMER UN ARTICLE DE PRESSE
        Route::post('deleteArticleForm', [ArticleController::class, 'DeleteArticle']);

        //Supprimer un utilisateur client
        Route::post('deletecustomer', [UserController::class, 'deleteCustomer']);

        //suppression d'un utilisateur admin
        Route::post('deleteadminuser', [UserController::class, 'deleteAdminUser']);

        //modifier un utilisateur admin
        Route::post('editformadminuser', [UserController::class, 'EditAdminForm']);
        Route::post('editadmin', [UserController::class, 'EditAdminUser']);
        //SI ON VEUT MODIFIER LE MOT DE PASSE
        Route::post('adminpassword', [UserController::class, 'EditAdminPass']);

        //MODIFICAIOTN D'UN UTILISATEUR CLIENT
        Route::post('editcustomerform', [UserController::class, 'EditCustomerForm']);
        Route::post('edit_customer_user', [UserController::class, 'EditUserAccount']);
        Route::post('edit_customer_user_password', [UserController::class, 'EditUserPass']);
        
        //MODIFICATION D'UN ARTICLE
        Route::post('editArticleForm', [ArticleController::class, 'EditArticleForm']);
        Route::post('editartcile', [ArticleController::class, 'EditArticle']);

        //RECHERCHER UNE REVUE
        Route::post('admin_searh_review', [ReviewController::class, 'AdminSerachReview']);

        Route::get('edit_admin_form', function(){

            return view('admins/edit_admin_form');
        });

        //AFFICHAGE DES ARTICLES DE PRESSE ENREGISTRES
        Route::get('articles_view', function(){

            return view('admins/articles_view');
        });

        //modification de la revue de presse
        Route::post('editViewForCustomer', function () {
        
            return view('admins/edit_review_form', [
                'id' => $request->id,
                ]);
            
        });

         //LES BHI
         Route::get('bhi', function () {
            return view('admins/bhi_manage');
        });


        //POUR ALLER DANS LES PRESSES ET AUTRES
        Route::get('press_review', function () {
        
            return view('admins/press_review');
            
        });

        //modification de la revue de presse
        Route::post('editViewForPressReview', [ReviewController::class, 'EditFormPr']);
        Route::post('editreview', [ReviewController::class, 'EditReview']);

        Route::get('companies', function () {
        
            return view('admins/companies');
            
        });

        Route::get('users', function () {
        
            return view('admins/users');
            
        });

        Route::get('customers', function () {
        return view('admins/customers');
    
        });  

        //LOGOUT
        Route::post('logout_admin', [AuthController::class, 'logoutAdmin']);

        //AJOUTER UN BHI
        Route::post('/addbhi', [BhiController::class, 'AddBhi']);

        //TELECHARGEMENT D'UN BHI
        Route::post('/download', [FileManager::class, 'BhiDownload']);

        //SUPPRIMIER UN BHI
        Route::post('deletebhi', [BhiController::class, 'DeleteBhi']);

        //MODIFIER UN BHI
        Route::post('form_edit_bhi', [BhiController::class, 'FormEditBhi']);

        Route::post('editbhi', [BhiController::class, 'EditBhi']);

    });


                            

    //POUR L'UTILISATEUR
    Route::middleware(['guest:web'])->group(function(){

        //PAGE DE CONNEXION
        Route::view('/', 'login')->name('login');


        //CONNEXION
        Route::post('customer_login', [AuthController::class, 'UserLogin']); 

        //TELECHARGEMENT D'UNE REVUE DE PRESSE VERSION ANGLAISE
        Route::post('/download_en', [FileManager::class, 'DownloadFile']);
        
        //MON PROFILE
        Route::post('user_customer_profile', [UserController::class, 'UserCustomerprofile']);
        Route::post('edit_customer_user', [UserController::class, 'EditMyAccount']);
        Route::post('edit_customer_user_password', [UserController::class, 'EditMyPass']);

         

    });


    Route::middleware(['auth:web'])->group(function(){

        //PAGE DE CONNEXION
        //Route::view('/', 'login')->name('login');

        //DECONNEXION
        Route::post('logout_user', [AuthController::class, 'logoutUser']);


        Route::get('customer_welcome', MyspaceController::class)->name('customer_welcome');

        //TELECHARGEMENT D'UNE REVUE DE PRESSE VERSION ANGLAISE
        Route::post('/download_en', [FileManager::class, 'DownloadFile']);

        //TELECHARGEMENT D'UN BHI
        Route::post('/download_en', [FileManager::class, 'BhiDownload']);


        //MON PROFILE
        Route::post('user_customer_profile', [UserController::class, 'UserCustomerprofile']);
        Route::post('edit_customer_user', [UserController::class, 'EditMyAccount']);
        Route::post('edit_customer_user_password', [UserController::class, 'EditMyPass']);

        Route::get('bhi_download', function(){
            return view('customers/dld_bhi');
        });

        //RECHERCHER UNE REVUE DE PRESSE
        Route::post('searh_review', [ReviewController::class, 'SerachReview']);

        //RECHERCHER UN BHI
        Route::post('search_bhi', [BhiController::class, 'SearchBhi']);



        

    });
	
});





