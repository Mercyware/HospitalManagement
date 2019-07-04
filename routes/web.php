<?php

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
//Login and Logout

Route::get('/', 'LoginController@index')->name('login'); // The Login PPage
Route::post('/login', 'LoginController@create'); // Logining a User In
Route::get('/logout', 'LoginController@destroy')->name('logout');
//Route::get('/patients', 'PatientController@getIndex')
//  ->name('home');


Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.show');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.request');

Route::get('/patients.data', 'PatientController@anyData')
    ->name('patients.data');


Route::group(['middleware' => ['auth']], function () {

    Route::resource('roles', 'RoleController');
    Route::resource('patients', 'PatientController');
    Route::resource('diagnosis', 'DiagnosisController');
    Route::resource('dental', 'DentalController');
    Route::resource('eye', 'EyeController');
//    Route::resource('appointment', 'AppointmentController');


});

Route::get('/home', 'PatientController@index'); // The Login PPage
Route::get('/dashboard/{date_from?}/{date_to?}', 'DashboardController@dashboard')->name('dashboard'); // The Dashboard

//Charts
Route::get('/chart/patientbygender/{date_from?}/{date_to?}', 'DashboardController@patientByGenderPie')->name('patientbygender'); // The Dashboard
Route::get('/chart/analytics/{date_from?}/{date_to?}', 'DashboardController@patientsAnalytics')->name('patientAnalytics'); // The Dashboard

//Patients


/// //Patient Diagnosis
//Route::get('/diagnose/dental/{patient}', 'DiagnosisController@create')->name('diagnose'); // Patients
//Route::get('/diagnose/eye/{patient}', 'DiagnosisController@create_eye')->name('eyediagnose'); // Patients
////Route::get('/diagnose/{patient}', 'DiagnosisController@create'); // Create A New Branch
//Route::post('/diagnose/dental/{patient}', 'DiagnosisController@dentalstore'); // Create A New Branch
//Route::post('/diagnose/eye/{patient}', 'DiagnosisController@eyestore'); // Create A New Branch

//Staffs/users
//Route::get('/user/create', 'UsersController@create')->name('staffForm'); // Create A New Staff
Route::get('/user', ['as' => 'user', 'uses' => 'UsersController@index']);
Route::post('/user/create', 'UsersController@store'); // Create A New Staff
Route::get('/user/create', ['as' => 'createUser', 'uses' => 'UsersController@create']);
Route::get('/user/update/{user}', 'UsersController@update'); // Create A New Branch
Route::patch('/user/update/{user}', 'UsersController@updateuser')->name('updateuser'); // Patients
Route::get('/user/view/{user}', 'UsersController@view')->name('viewuser'); // Patients
Route::get('/user/activate/{user}/{status}', 'UsersController@activate')->name('activateuser'); // Patients

//


/// //Branch Name
Route::get('/branch/create', 'BranchController@create'); // Create A New Branch
Route::post('/branch/create', 'BranchController@store'); // Create A New Branch


/// //Patient Billing
Route::post('/billing/{patient}/store', 'BillingController@store'); // Create A New Branch


//Drugs
Route::get('/drugs', 'DrugController@index'); // Patients
Route::get('/drugs/update/{drug}', 'DrugController@drugupdate')->name('updatedrug');; // Patients
Route::patch('/drugs/update/{drugid}', 'DrugController@storeupdate'); // Patients
Route::get('/drugs/create', 'DrugController@create')->name('createdrug'); // Patients
Route::post('/drugs/create', 'DrugController@store'); // Create A New Branch

//DrugAdminister
Route::get('/drugs/administer/{patient}', 'DrugAdministerController@index')->name('administer'); // Patients
Route::post('/drugs/administer/{patient}', 'DrugAdministerController@store'); // Patients
Route::post('/drugs/administer', 'DrugAdministerController@getdrugs'); // Patients
Route::get('/drugs/medication', 'DrugAdministerController@medication')->name('medication'); // Patients
Route::get('/drugs/medication/{patient}/{date_created}', 'DrugAdministerController@show')->name('showmedication'); // Patients
Route::post('/drugs/medication/create/{patient}/{date_created}', 'DrugAdministerController@storemedication')->name('storemedication'); // Patients


//Invoice
Route::get('/invoice/patient/{patient}', 'InvoiceController@getinvoice')->name('getinvoice'); // Patients
Route::post('/invoice/patient/ajaxcall/{patient}/{page}', 'InvoiceController@getinvoiceajax')->name('getinvoiceajax'); // Patients

Route::get('/invoice/makepayment/{patient}/{invoice}', 'PaymentController@makePayment')->name('makepayment'); // Patients
Route::post('/invoice/makepayment', 'PaymentController@makePaymentSubmit')->name('makepayment.post'); // Patients

Route::get('/invoice/show/{date}/{patient}', 'PaymentController@invoiceShow')->name('invoiceshow'); // Patients


Route::post('/invoice/pay/{patient}/{bill_date}', 'PaymentController@storepayment'); // Patients

Route::get('/invoice/show/{patient}/{bill_date}', 'PaymentController@showinvoice')->name('showinvoice'); // Patients


//Patient Teeth Status
Route::get('/patient/tooth/{patient}', 'ToothController@index')->name('toothshow'); // Patients
Route::get('/patient/tooth/ajaxcall/{patient}/{position}/{tooth}/{part}', 'ToothController@store')->name('store'); // Patients
Route::get('/patient/tooth/ajaxcall/{patient}/{position}/{tooth}', 'ToothController@storetooth')->name('storetooth'); // Patients
Route::get('/patient/gettooth/ajaxcall/{patient}/{position}/{tooth}/{part}', 'ToothController@gettooth')->name('gettooth'); // Patients


//PatientMedical History

Route::get('/patient/eye/history/{patient}', 'PatientHistoryController@index')->name('eyehistoryindex'); // Patients
Route::get('/patient/eye/history/ajaxcall/{patient}/{page}', 'PatientHistoryController@eyehistory')->name('eyehistory'); // Patients

Route::get('/patient/dental/history/{patient}', 'PatientHistoryController@dentalhistory')->name('dentalhistory'); // Patients
Route::get('/patient/dental/history/ajaxcall/{patient}/{page}', 'PatientHistoryController@dentalhistoryajax')->name('dentalhistoryajax'); // Patients


//Appoitntment
Route::get('/appointment/create/{patient}', 'AppointmentController@create')->name('appointmentcreate'); // Patients
Route::post('/appointment/create/{patient}', 'AppointmentController@store')->name('appointmentstore'); // Patients
Route::get('/appointment/view/{appointment}', 'AppointmentController@view_appointment')->name('appointmentview'); // Patients
Route::get('/appointment/confirm/{appointment}', 'AppointmentController@confirm')->name('appointmentconfirm'); // Patients
Route::get('/appointment/cancel/{appointment}', 'AppointmentController@cancel')->name('appointmentcancel'); // Patients
Route::get('/appointment/delete/{appointment}', 'AppointmentController@delete')->name('appointmentdelete'); // Patients
Route::get('/appointment/update/{appointment}', 'AppointmentController@update')->name('appointmentupdate'); // Patients
Route::patch('/appointment/update/{appointment}', 'AppointmentController@updatestore'); // Patients


/*
 * Get all Test
 */
Route::get('/tests/{test_id?}', 'TestsController@view')->name('tests.all');
Route::get('/tests/get/all/{parent_id}', 'TestsController@getTestData')->name('tests.all.data');


//Test
Route::get('/tests/create/{parent_id?}', 'TestsController@create')->name('test.create'); // Patients
Route::post('/tests/create', 'TestsController@createtest'); // Patients
Route::get('/tests/update/{test}', 'TestsController@viewtest')->name('test.update'); // Patients
Route::patch('/tests/update/{test}', 'TestsController@update')->name('test.update.patch'); // Patients


//Laboratory
Route::get('/laboratory/{patient}', 'LaboratoryController@create')->name('laboratory.patient.test'); // Patients
Route::post('/laboratory/gettests', 'LaboratoryController@gettests'); // Patients
Route::post('/laboratory/test/{patient}', 'LaboratoryController@store'); // Patients
Route::post('/laboratory', 'LaboratoryController@view'); // Patients
Route::get('/laboratory/result/{patient}/{testdate}', 'LaboratoryController@result')->name('laboratory.patient.test.result'); // Patients
//A List of all Patient Diagnostics
Route::get('/laboratory/tests/{patient_id}', 'LaboratoryController@allPatientTests')
    ->name('laboratory.test.list');
Route::post('/laboratory/tests', 'LaboratoryController@allPatientTestsData')
    ->name('laboratory.test.data');

//
Route::get('/laboratory/update/tests/{date}/{patient_id}', 'LaboratoryController@updateTest')
    ->name('laboratory.test.update');
Route::post('/laboratory/update/tests/{patient_id}', 'LaboratoryController@storeUpdateTest')
    ->name('laboratory.test.update');

//Create Expenses
Route::get('/expenses/create', 'ExpensesController@create'); // Patients
Route::post('/expenses/create', 'ExpensesController@store'); // Patients

//Create Expenses
Route::get('/store/create', 'StoreController@create')->name('createproduct'); // Patients
Route::post('/store/create', 'StoreController@store'); // Patients
Route::get('/store/update/{item}', 'StoreController@show')->name('updateproduct'); // Patients
Route::patch('/store/update/{item}', 'StoreController@update'); // Patients


Route::get('/store/take/{item}', 'ItemsController@view'); // Patients
Route::post('/store/store/storetake', 'ItemsController@store'); // Patients


//Datatables

/*
 * Get Patient Via DataTables
 */


/*
 * Get All Patient Invoices
 */
Route::get('/invoice', 'InvoiceController@getAdvanceFilter')
    ->name('invoice');
Route::post('/invoices', 'InvoiceController@getAdvanceFilterData');


//Patient Diagnosis Invoice
Route::get('/invoice/patient/diagnosis/{patient_id}', 'InvoiceController@diagnosisInvoice')
    ->name('invoice.patient.diagnosis');
Route::post('/invoices/patient/diagnosis/data/{patient_id}', 'InvoiceController@diagnosisInvoiceData')
    ->name('invoice.patient.diagnosis.data');;

//Patient Diagnostic Invoice
Route::get('/invoice/patient/diagnostic/{patient_id}', 'InvoiceController@diagnosticInvoice')
    ->name('invoice.patient.diagnostic');
Route::post('/invoices/patient/diagnostic/data/{patient_id}', 'InvoiceController@diagnosticInvoiceData')
    ->name('invoice.patient.diagnostic.data');;


//Patient Laboratory Invoice
Route::get('/invoice/patient/laboratory/{patient_id}', 'InvoiceController@laboratoryInvoice')
    ->name('invoice.patient.laboratory');
Route::post('/invoices/patient/laboratory/data/{patient_id}', 'InvoiceController@laboratoryInvoiceData')
    ->name('invoice.patient.laboratory.data');;
/*
 * Company Account
 */
Route::get('/account', 'AccountsController@getIndex')
    ->name('account');
Route::get('/accounts', 'AccountsController@anyData');


/*
 * Get Drugs Via DataTables
 */

Route::get('/drugs', 'DrugController@getIndex')
    ->name('drugs');
Route::get('/drugs/all', 'DrugController@anyData');


/*
 * Get Drugs Via DataTables
 */
Route::get('/drugs/medication', 'DrugAdministerController@getIndex')
    ->name('medication');
Route::post('/medication.data', 'DrugAdministerController@anyData')
    ->name('medication.data');

/*
 * Get all User
 */
Route::get('/user', 'UsersController@getIndex')
    ->name('user');
Route::post('/user.data', 'UsersController@anyData')
    ->name('user.data');


/*
 * Get all User
 */
Route::get('/appointment/{patient}', 'AppointmentController@getIndex');
Route::post('/appointment', 'AppointmentController@anyData');


/*
 * Get all User
 */
Route::get('/appointments/all', 'AppointmentController@getAppoint')->name('allappointment');
Route::post('/appointments', 'AppointmentController@getAppointData');


/*
 * Company Account
 */
Route::get('/laboratory', 'LaboratoryController@getIndex')
    ->name('laboratory');
Route::get('/laboratories', 'LaboratoryController@anyData')->name('laboratories');


/*
 * Expenses
 */
Route::get('/expense', 'ExpensesController@getIndex')
    ->name('expense');
Route::get('/expenses', 'ExpensesController@anyData');


Route::get('/store', 'StoreController@view')
    ->name('store');
Route::post('/store/all', 'StoreController@anyData');

Route::get('/drugs/history', 'DrugController@history')
    ->name('drughistory');
Route::get('/drugs/histories', 'DrugController@histories');


Route::get('/drugs/report', 'DrugController@report')
    ->name('drugreport');
Route::post('/drugs/reports', 'DrugController@reports')->name('drugsreports');


//Contact Information
Route::get('/contact/create', 'ContactController@contactView')
    ->name('contact.create');
Route::post('/contact/create', 'ContactController@storeContact')
    ->name('contact.createStore');


//Blood Bank
Route::get('/blood/bank', 'BloodBankController@bloodBank')
    ->name('blood.bank');
Route::post('/blood/bank/data', 'BloodBankController@bloodBankData')
    ->name('blood.bank.data');

Route::get('/blood/bank/create', 'BloodBankController@bloodBankCreateView')
    ->name('blood.bank.create');
Route::post('/blood/bank/create', 'BloodBankController@bloodBankCreateStore')
    ->name('blood.bank.store');

Route::get('/blood/bank/edit/{id}', 'BloodBankController@bloodBankEditView')
    ->name('blood.bank.edit');
Route::post('/blood/bank/edit', 'BloodBankController@bloodBankEditStore')
    ->name('blood.bank.edit');


Route::get('/blood/bank/donations', 'BloodBankController@bloodDonation')
    ->name('blood.bank.donations');
Route::post('/blood/bank/donation/data', 'BloodBankController@bloodDonationData')
    ->name('blood.donation.data');

Route::get('/blood/donation/create/{donor}', 'BloodBankController@bloodDonationCreateStore')
    ->name('blood.donation.create');
Route::post('/blood/donation/create', 'BloodBankController@bloodDonationCreateStore')
    ->name('blood.donation.store');


Route::get('/blood/bank/history', 'BloodBankController@bloodHistory')
    ->name('blood.bank.history');
Route::post('/blood/bank/history/data', 'BloodBankController@bloodHistoryData')
    ->name('blood.history.data');


Route::get('/blood/history/create', 'BloodBankController@bloodHistoryCreateView')
    ->name('blood.history.create');
Route::post('/blood/history/create', 'BloodBankController@bloodHistoryCreateStore')
    ->name('blood.history.store');


//Blood Donor

Route::get('/blood/bank/donors', 'BloodBankController@bloodDonors')
    ->name('blood.bank.donors');
Route::post('/blood/bank/donors/data', 'BloodBankController@bloodDonorsData')
    ->name('blood.donors.data');

Route::get('/blood/donors/create', 'BloodBankController@bloodDonorCreateView')
    ->name('blood.donors.create');
Route::post('/blood/donors/create', 'BloodBankController@bloodDonorsCreateStore')
    ->name('blood.donors.store');


//Payment Prices
Route::get('/pricing/diagnosis/prices', 'DiagnosisPricesController@index')
    ->name('pricing.diagnosis.price');
Route::post('/pricing/diagnosis/prices/data', 'DiagnosisPricesController@indexData')
    ->name('pricing.diagnosis.price.data');


Route::get('/pricing/diagnosis/prices/create', 'DiagnosisPricesController@createDiagnosis')
    ->name('pricing.diagnosis.price.create');
Route::post('/pricing/diagnosis/prices/create', 'DiagnosisPricesController@storeDiagnosisPrice')
    ->name('pricing.diagnosis.price.store');

//Billing
Route::get('patient/billing/{patient_id}', 'BillingController@billing')
    ->name('patient.diagnosis.billing');
Route::post('patient/billing/store', 'BillingController@storeBilling')
    ->name('patient.diagnosis.billing.store');

Route::get('patient/billing/{bill_date}/{patient_id}/edit', 'BillingController@editBilling')
    ->name('patient.diagnosis.billing.edit');
Route::post('patient/billing/update', 'BillingController@updateBilling')
    ->name('patient.diagnosis.billing.update');

//Diagnostic
Route::get('/diagnostics', 'DiagnosticController@index')
    ->name('diagnostics');
Route::post('/diagnostics/data', 'DiagnosticController@indexData')
    ->name('diagnostics.data');

Route::get('/diagnostics/create', 'DiagnosticController@create')
    ->name('diagnostics.create');
Route::post('/diagnostics/create', 'DiagnosticController@store')
    ->name('diagnostics.store');

Route::get('/diagnostics/edit/{test_id}', 'DiagnosticController@edit')
    ->name('diagnostics.edit');
Route::post('/diagnostics/update', 'DiagnosticController@update')
    ->name('diagnostics.update');

//A List of all Patient Diagnostics
Route::get('/diagnostics/tests/{patient_id}', 'DiagnosticController@allPatientTests')
    ->name('diagnostics.test.list');
Route::post('/diagnostics/tests', 'DiagnosticController@allPatientTestsData')
    ->name('diagnostics.test.data');

Route::get('/diagnostics/create/tests/{patient_id}', 'DiagnosticController@test')
    ->name('diagnostics.test');
Route::post('/diagnostics/create/tests/{patient_id}', 'DiagnosticController@storeTest')
    ->name('diagnostics.test.store');

Route::get('/diagnostics/update/tests/{date}/{patient_id}', 'DiagnosticController@updateTest')
    ->name('diagnostics.test.update');
Route::post('/diagnostics/update/tests/{patient_id}', 'DiagnosticController@storeUpdateTest')
    ->name('diagnostics.test.update');

Route::get('/diagnostics/gettests', 'DiagnosticController@getTest')
    ->name('diagnostics.gettest');

//Payments
Route::get('/payment/patient/list/{patient_id}', 'PaymentController@showPayment')
    ->name('payments.patient.list');
Route::post('/payment/patient/list', 'PaymentController@showPaymentData')
    ->name('payments.patient.list.data');


