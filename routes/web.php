<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\LeavelController;
use App\Http\Controllers\Admin\AbsenceController;
use App\Http\Controllers\Admin\BuyBookController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\AddChildController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\SellBookController;
use App\Http\Controllers\Admin\TreasuryController;
use App\Http\Controllers\Admin\ChildRoomController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\BuyUniformController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SellUniformController;
use App\Http\Controllers\Admin\ChildTransferController;
use App\Http\Controllers\Admin\LevelTransferController;
use App\Http\Controllers\Admin\EmployeeSalaryController;
use App\Http\Controllers\Admin\GeneralAccountController;
use App\Http\Controllers\Admin\DaycareSettiengController;
use App\Http\Controllers\Admin\EducationalYearController;
use App\Http\Controllers\Report\ChildrenReportController;
use App\Http\Controllers\Admin\GeneralExpenseseController;
use App\Http\Controllers\Admin\TreasuryTransferController;
use App\Http\Controllers\Admin\ChildRegistrationController;
use App\Http\Controllers\Admin\IndebtednessLevelController;
use App\Http\Controllers\Admin\EducationalExpensesController;
use App\Http\Controllers\Admin\EmployeeAbcencePermissionController;
use App\Http\Controllers\Admin\EducationalExpensesCollectionController;

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

// login & logout
Route::get('/login', [LoginController::class, 'loginForm'])->name('admin.login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('/')->group(function () {
    // Dashboard
    Route::get('/', [IndexController::class, 'index'])->name('dashboard');
    // DaycareSettiengs
    Route::get('daycareSettieng', [DaycareSettiengController::class, 'create'])->name('daycareSettieng.create');
    Route::post('daycareSettieng', [DaycareSettiengController::class, 'store'])->name('daycareSettieng.store');
    // educationalYear
    Route::get('educationalYear', [EducationalYearController::class, 'create'])->name('educationalYear.create');
    Route::post('educationalYear', [EducationalYearController::class, 'store'])->name('educationalYear.store');
    Route::get('educationalYear/{id}', [EducationalYearController::class, 'edit'])->name('educationalYear.edit');
    Route::post('educationalYear/{id}', [EducationalYearController::class, 'update'])->name('educationalYear.update');
    Route::get('educationalYear/delete/{id}', [EducationalYearController::class, 'destroy'])->name('educationalYear.destroy');
    // users
    Route::get('user', [UserController::class, 'create'])->name('user.create');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::get('user/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    // القاعات
    Route::get('classroom', [ClassroomController::class, 'create'])->name('classroom.create');
    Route::post('classroom', [ClassroomController::class, 'store'])->name('classroom.store');
    Route::get('classroom/{id}', [ClassroomController::class, 'edit'])->name('classroom.edit');
    Route::post('classroom/{id}', [ClassroomController::class, 'update'])->name('classroom.update');
    Route::get('classroom/delete/{id}', [ClassroomController::class, 'destroy'])->name('classroom.destroy');
    //  الرسوم الدراسية
    Route::get('educationalExpenses', [EducationalExpensesController::class, 'create'])->name('educationalExpenses.create');
    Route::post('educationalExpenses', [EducationalExpensesController::class, 'store'])->name('educationalExpenses.store');
    Route::get('educationalExpenses/{id}', [EducationalExpensesController::class, 'edit'])->name('educationalExpenses.edit');
    Route::post('educationalExpenses/{id}', [EducationalExpensesController::class, 'update'])->name('educationalExpenses.update');
    Route::get('educationalExpenses/delete/{id}', [EducationalExpensesController::class, 'destroy'])->name('educationalExpenses.destroy');
    // اضافة طفل
    Route::get('addChild', [AddChildController::class, 'create'])->name('addChild.create');
    Route::post('addChild', [AddChildController::class, 'store'])->name('addChild.store');
    Route::get('addChild/{id}', [AddChildController::class, 'edit'])->name('addChild.edit');
    Route::post('addChild/{id}', [AddChildController::class, 'update'])->name('addChild.update');
    Route::get('addChild/delete/{id}', [AddChildController::class, 'destroy'])->name('addChild.destroy');
    Route::get('children/search',[AddChildController::class,'childrenSearch'])->name('children.search');
    Route::get('children/data',[AddChildController::class,'childrenData'])->name('children.data.show');
    Route::get('children/name/search',[AddChildController::class,'childrenNameSearch'])->name('children.name.search');
    Route::get('children/name/data',[AddChildController::class,'childrenNameData'])->name('children.data.name.show');
    // المراحل
    Route::get('leavel', [LeavelController::class, 'create'])->name('leavel.create');
    Route::post('leavel', [LeavelController::class, 'store'])->name('leavel.store');
    Route::get('leavel/{id}', [LeavelController::class, 'edit'])->name('leavel.edit');
    Route::post('leavel/{id}', [LeavelController::class, 'update'])->name('leavel.update');
    Route::get('leavel/delete/{id}', [LeavelController::class, 'destroy'])->name('leavel.destroy');
    // التحويل من خزينة لاخرى
    Route::get('treasuryTransfer', [TreasuryTransferController::class, 'create'])->name('treasuryTransfer.create');
    Route::post('treasuryTransfer', [TreasuryTransferController::class, 'store'])->name('treasuryTransfer.store');
    Route::get('treasuryTransfer/{id}', [TreasuryTransferController::class, 'edit'])->name('treasuryTransfer.edit');
    Route::post('treasuryTransfer/{id}', [TreasuryTransferController::class, 'update'])->name('treasuryTransfer.update');
    Route::get('treasuryTransfer/delete/{id}', [TreasuryTransferController::class, 'destroy'])->name('treasuryTransfer.destroy');
    Route::get('treasuryTransfer/balanceFrom/ajax/{id}', [TreasuryTransferController::class, 'treasuryTransferBalanceFromAjax'])->name('treasuryTransfer.balanceFrom.ajax');
    Route::get('treasuryTransfer/balanceTo/ajax/{id}', [TreasuryTransferController::class, 'treasuryTransferBalanceToAjax'])->name('treasuryTransfer.balanceTo.ajax');
    // تسجل الاطفال
    Route::get('childRegistration', [ChildRegistrationController::class, 'create'])->name('childRegistration.create');
    Route::post('childRegistration', [ChildRegistrationController::class, 'store'])->name('childRegistration.store');
    Route::get('childRegistration/{id}', [ChildRegistrationController::class, 'edit'])->name('childRegistration.edit');
    Route::post('childRegistration/{id}', [ChildRegistrationController::class, 'update'])->name('childRegistration.update');
    Route::get('childRegistration/delete/{id}', [ChildRegistrationController::class, 'destroy'])->name('childRegistration.destroy');
    Route::get('childRegistration/age/ajax/{id}', [ChildRegistrationController::class, 'childRegistrationAgeAjax'])->name('childRegistration.age.Ajax');
    Route::get('childRegistration/idNum/ajax/{id}/{acceptance_date}', [ChildRegistrationController::class, 'childRegistrationidNumAjax'])->name('childRegistration.idNum.Ajax');
    Route::get('childRegistration/gender/ajax/{id}', [ChildRegistrationController::class, 'childRegistrationGenderAjax'])->name('childRegistration.gender.Ajax');
    Route::get('childRegistration/city/ajax/{id}', [ChildRegistrationController::class, 'childRegistrationCityAjax'])->name('childRegistration.city.Ajax');
    // اضافة طفل الى قاعة
    Route::get('childRoom', [ChildRoomController::class, 'create'])->name('childRoom.create');
    Route::post('childRoom', [ChildRoomController::class, 'store'])->name('childRoom.store');
    Route::get('childRoom/{id}', [ChildRoomController::class, 'edit'])->name('childRoom.edit');
    Route::post('childRoom/{id}', [ChildRoomController::class, 'update'])->name('childRoom.update');
    Route::get('childRoom/delete/{id}', [ChildRoomController::class, 'destroy'])->name('childRoom.destroy');
    Route::get('childRoom/ajax/{level}', [ChildRoomController::class, 'childRoomAjax'])->name('childRoom.Ajax');
    Route::get('childRoom/classRoom/ajax/{id}', [ChildRoomController::class, 'childRoomClassRoomAjax'])->name('childRoom.classRoom.ajax');
    Route::get('childRoom/count/ajax/{id}', [ChildRoomController::class, 'childRoomCountAjax'])->name('childRoom.count.ajax');
    Route::get('childRoom/paid/ajax/{id}', [ChildRoomController::class, 'childRoomPaidAjax'])->name('childRoom.paid.ajax');
    // نقل طفل من قاعة الى اخرى
    Route::get('childTransfer', [ChildTransferController::class, 'create'])->name('childTransfer.create');
    Route::post('childTransfer', [ChildTransferController::class, 'store'])->name('childTransfer.store');
    Route::get('childTransfer/{id}', [ChildTransferController::class, 'edit'])->name('childTransfer.edit');
    Route::post('childTransfer/{id}', [ChildTransferController::class, 'update'])->name('childTransfer.update');
    Route::get('childTransfer/delete/{id}', [ChildTransferController::class, 'destroy'])->name('childTransfer.destroy');
    Route::get('childTransfer/ajax/{id}', [ChildTransferController::class, 'childTransferAjax'])->name('childTransfer.childTransferAjax');
    Route::get('childTransfer/count/ajax/{id}', [ChildTransferController::class, 'childTransferCountAjax'])->name('childTransfer.count.ajax');
    Route::get('childTransfer/paid/ajax/{id}', [ChildTransferController::class, 'childTransferPaidAjax'])->name('childTransfer.paid.ajax');
    // نقل طفل من مرحلة الى اخرى
    Route::get('levelTransfer', [LevelTransferController::class, 'create'])->name('levelTransfer.create');
    Route::post('levelTransfer', [LevelTransferController::class, 'store'])->name('levelTransfer.store');
    Route::get('levelTransfer/{id}', [LevelTransferController::class, 'edit'])->name('levelTransfer.edit');
    Route::post('levelTransfer/{id}', [LevelTransferController::class, 'update'])->name('levelTransfer.update');
    Route::get('levelTransfer/delete/{id}', [LevelTransferController::class, 'destroy'])->name('levelTransfer.destroy');
    Route::get('levelTransfer/ajax/{id}', [LevelTransferController::class, 'levelTransferAjax'])->name('level.childTransfer.ajax');
    // Route::get('childTransfer/count/ajax/{id}', [LevelTransferController::class, 'childTransferCountAjax'])->name('childTransfer.count.ajax');
    // Route::get('childTransfer/paid/ajax/{id}', [LevelTransferController::class, 'childTransferPaidAjax'])->name('childTransfer.paid.ajax');
    // المصروفات العامة =>(الاعدادات العامة)
    Route::get('generalExpensese', [GeneralExpenseseController::class, 'create'])->name('generalExpensese.create');
    Route::post('generalExpensese', [GeneralExpenseseController::class, 'store'])->name('generalExpensese.store');
    Route::get('generalExpensese/{id}', [GeneralExpenseseController::class, 'edit'])->name('generalExpensese.edit');
    Route::post('generalExpensese/{id}', [GeneralExpenseseController::class, 'update'])->name('generalExpensese.update');
    Route::get('generalExpensese/delete/{id}', [GeneralExpenseseController::class, 'destroy'])->name('generalExpensese.destroy');
    // غياب واستأذان الاطفال
    Route::get('absence', [AbsenceController::class, 'create'])->name('absence.create');
    Route::post('absence', [AbsenceController::class, 'store'])->name('absence.store');
    Route::get('absence/{id}', [AbsenceController::class, 'edit'])->name('absence.edit');
    Route::post('absence/{id}', [AbsenceController::class, 'update'])->name('absence.update');
    Route::get('absence/delete/{id}', [AbsenceController::class, 'destroy'])->name('absence.destroy');
    // Route::get('children/absence/ajax/{id}/{date}', [AbsenceController::class, 'childrenAbcenceAjax'])->name('children.absence.Ajax');
    Route::get('absence/classRoom/ajax/{id}/{date}', [AbsenceController::class, 'classRoomAbcenceAjax'])->name('classRoom.absence.Ajax');
    Route::get('holiday/classRoom/ajax/{id}/{date}', [AbsenceController::class, 'classRoomHolidayAjax'])->name('classRoom.holiday.Ajax');
    // permission
    Route::get('permission', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('permission', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('permission/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('permission/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::get('permission/delete/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');
    // تسجيل اجازة للاطفال
    Route::get('holiday', [HolidayController::class, 'create'])->name('holiday.create');
    Route::post('holiday', [HolidayController::class, 'store'])->name('holiday.store');
    Route::get('holiday/{id}', [HolidayController::class, 'edit'])->name('holiday.edit');
    Route::post('holiday/{id}', [HolidayController::class, 'update'])->name('holiday.update');
    Route::get('holiday/delete/{id}', [HolidayController::class, 'destroy'])->name('holiday.destroy');
    Route::get('holiday/absence/ajax/{id}/{date}', [HolidayController::class, 'holidayAbcenceAjax'])->name('holiday.absence.Ajax');
    // اضافة خزنة
    Route::get('treasury', [TreasuryController::class, 'create'])->name('treasury.create');
    Route::post('treasury', [TreasuryController::class, 'store'])->name('treasury.store');
    Route::get('treasury/{id}', [TreasuryController::class, 'edit'])->name('treasury.edit');
    Route::post('treasury/{id}', [TreasuryController::class, 'update'])->name('treasury.update');
    Route::get('treasury/delete/{id}', [TreasuryController::class, 'destroy'])->name('treasury.destroy');
    // تحصيل المصروفات الدراسية
    Route::get('educationalExpensesCollection', [EducationalExpensesCollectionController::class, 'create'])->name('educationalExpensesCollection.create');
    Route::post('educationalExpensesCollection', [EducationalExpensesCollectionController::class, 'store'])->name('educationalExpensesCollection.store');
    Route::get('educationalExpensesCollection/{id}', [EducationalExpensesCollectionController::class, 'edit'])->name('educationalExpensesCollection.edit');
    Route::post('educationalExpensesCollection/{id}', [EducationalExpensesCollectionController::class, 'update'])->name('educationalExpensesCollection.update');
    Route::get('educationalExpensesCollection/delete/{id}', [EducationalExpensesCollectionController::class, 'destroy'])->name('educationalExpensesCollection.destroy');
    Route::get('educationalExpensesCollection/print/{id}', [EducationalExpensesCollectionController::class, 'print'])->name('educationalExpensesCollection.print');
    Route::get('educational/Expenses/Collection/ajax/{id}', [EducationalExpensesCollectionController::class, 'expensesAjax'])->name('educationalExpensesCollection.expenses.Ajax');
    Route::get('level/expenses/ajax/{id}', [EducationalExpensesCollectionController::class, 'levelExpensesAjax'])->name('level.expenses.ajax');
    Route::get('child/rest/ajax/{id}', [EducationalExpensesCollectionController::class, 'childRestAjax'])->name('child.rest.ajax');
    // generalAccount
    Route::get('generalAccount', [GeneralAccountController::class, 'create'])->name('generalAccount.create');
    Route::post('generalAccount', [GeneralAccountController::class, 'store'])->name('generalAccount.store');
    Route::get('generalAccount/{id}', [GeneralAccountController::class, 'edit'])->name('generalAccount.edit');
    Route::post('generalAccount/{id}', [GeneralAccountController::class, 'update'])->name('generalAccount.update');
    Route::get('generalAccount/delete/{id}', [GeneralAccountController::class, 'destroy'])->name('generalAccount.destroy');
    Route::get('generalAccount/ajax/{id}', [GeneralAccountController::class, 'generalAccountAjax'])->name('generalAccount.Ajax');
    // employee
    Route::get('employee', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('employee', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('employee/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    // employeeAbcencePermission
    Route::get('employeeAbcencePermission', [EmployeeAbcencePermissionController::class, 'create'])->name('employeeAbcencePermission.create');
    Route::post('employeeAbcencePermission', [EmployeeAbcencePermissionController::class, 'store'])->name('employeeAbcencePermission.store');
    Route::get('employeeAbcencePermission/{id}', [EmployeeAbcencePermissionController::class, 'edit'])->name('employeeAbcencePermission.edit');
    Route::post('employeeAbcencePermission/{id}', [EmployeeAbcencePermissionController::class, 'update'])->name('employeeAbcencePermission.update');
    Route::get('employeeAbcencePermission/delete/{id}', [EmployeeAbcencePermissionController::class, 'destroy'])->name('employeeAbcencePermission.destroy');
    Route::get('employeeAbcencePermission/ajax/{date}', [EmployeeAbcencePermissionController::class, 'employeeAbcencePermissionAjax'])->name('employeeAbcencePermission.treasuryAjax');
    // employeeSalary
    Route::get('employeeSalary', [EmployeeSalaryController::class, 'create'])->name('employeeSalary.create');
    Route::post('employeeSalary', [EmployeeSalaryController::class, 'store'])->name('employeeSalary.store');
    Route::get('employeeSalary/{id}', [EmployeeSalaryController::class, 'edit'])->name('employeeSalary.edit');
    Route::post('employeeSalary/{id}', [EmployeeSalaryController::class, 'update'])->name('employeeSalary.update');
    Route::get('employeeSalary/delete/{id}', [EmployeeSalaryController::class, 'destroy'])->name('employeeSalary.destroy');
    Route::get('employeeSalary/ajax/{id}', [EmployeeSalaryController::class, 'employeeSalaryAjax'])->name('employeeSalary.Ajax');
    Route::get('employeeJobAjax/ajax/{id}', [EmployeeSalaryController::class, 'employeeJobAjax'])->name('employeeJobAjax.Ajax');
    //اضافه مديونيه لمرحله
    Route::group(['prefix' => 'IndebtednessLevels/','as'=>'IndebtednessLevels.'], function () {
        Route::get('create', [IndebtednessLevelController::class, 'create'])->name('create');
        Route::post('store', [IndebtednessLevelController::class, 'store'])->name('store');
        Route::get('edit/{id}', [IndebtednessLevelController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [IndebtednessLevelController::class, 'update'])->name('update');
        Route::get('destroy/{name}/{level_id}', [IndebtednessLevelController::class, 'destroy'])->name('destroy');
        Route::get('delete/{id}', [IndebtednessLevelController::class, 'delete'])->name('delete');
        Route::get('show/{level_id}/{name?}', [IndebtednessLevelController::class, 'show'])->name('show');

    });
    Route::get('educationalExpenses/year/ajax/{id}', [IndebtednessLevelController::class, 'ajaxYear'])->name('educationalExpense.year.ajax');
    Route::get('educationalExpenses/level/ajax/{id}', [IndebtednessLevelController::class, 'ajaxLevel'])->name('educationalExpense.level.ajax');
    Route::get('educationalExpenses/amount/ajax/{id}', [IndebtednessLevelController::class, 'ajax'])->name('educationalExpense.amount.ajax');

    Route::get('educationalExpenses/level/ajax/{level}/{id}', [IndebtednessLevelController::class, 'ajaxAmount'])->name('educationalExpense.ajaxAmount.ajax');

    //اضافه شراء كتب
    Route::group(['prefix' => 'buyBooks/','as'=>'buyBooks.'], function () {
        Route::get('create', [BuyBookController::class, 'create'])->name('create');
        Route::post('store', [BuyBookController::class, 'store'])->name('store');
        Route::get('edit/{id}', [BuyBookController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [BuyBookController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [BuyBookController::class, 'destroy'])->name('destroy');
        Route::get('delete/{id}', [BuyBookController::class, 'delete'])->name('delete');
        Route::get('show/{id}', [BuyBookController::class, 'show'])->name('show');

    });//بيع كتب

    Route::group(['prefix' => 'sellBooks/','as'=>'sellBooks.'], function () {
        Route::get('create', [SellBookController::class, 'create'])->name('create');
        Route::post('store', [SellBookController::class, 'store'])->name('store');
        Route::get('edit/{id}', [SellBookController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [SellBookController::class, 'update'])->name('update');
        Route::get('print/{id}', [SellBookController::class, 'print'])->name('print');
        Route::get('destroy/{date}/{child_id}/{level_id}', [SellBookController::class, 'destroy'])->name('destroy');
        Route::get('delete/{id}', [SellBookController::class, 'delete'])->name('delete');
        Route::get('show/{date}/{child_id}/{level_id}', [SellBookController::class, 'show'])->name('show');
        Route::get('sellPrice/book/ajax/{id}', [SellUniformController::class, 'sellPriceBookAjax'])->name('sellPrice.book.ajax');

    });
    // اضافة شراء زى
    Route::group(['prefix' => 'buyUniform/','as'=>'buyUniform.'], function () {
    Route::get('create', [BuyUniformController::class, 'create'])->name('create');
    Route::post('store', [BuyUniformController::class, 'store'])->name('store');
    Route::get('edit/{id}', [BuyUniformController::class, 'edit'])->name('edit');
    Route::post('update/{id}', [BuyUniformController::class, 'update'])->name('update');
    Route::get('delete/{id}', [BuyUniformController::class, 'destroy'])->name('destroy');
    });
    // اضافة بيع زى
    Route::get('sellUniform', [SellUniformController::class, 'create'])->name('sellUniform.create');
    Route::post('sellUniform', [SellUniformController::class, 'store'])->name('sellUniform.store');
    Route::get('sellUniform/{id}', [SellUniformController::class, 'edit'])->name('sellUniform.edit');
    Route::post('sellUniform/{id}', [SellUniformController::class, 'update'])->name('sellUniform.update');
    Route::get('sellUniform/delete/{id}', [SellUniformController::class, 'destroy'])->name('sellUniform.destroy');
    Route::get('sellUniform/print/{id}', [SellUniformController::class, 'print'])->name('sellUniform.print');
    Route::get('sellUniform/children/ajax/{id}', [SellUniformController::class, 'sellUniformChildrenAjax'])->name('sellUniform.children.ajax');
    Route::get('treasury/balance/ajax/{id}', [BuyUniformController::class, 'treasuryBalanceAjax'])->name('treasury.balance.ajax');
    Route::get('sellPrice/ajax/{id}', [SellUniformController::class, 'sellPriceAjax'])->name('sell.price.ajax');
    // reports
    Route::get('childRegistration/info/index', [ChildrenReportController::class, 'clildIndex'])->name('childRegistration.info.index');
    Route::get('childRegistration/children/ajax/{id}', [ChildrenReportController::class, 'childRegistrationChildrenAjax'])->name('childRegistration.children.ajax');
    Route::get('childRegistration/info/show', [ChildrenReportController::class, 'clildShow'])->name('childRegistration.info.show');
    Route::get('children/data/show', [ChildrenReportController::class, 'clildrenData'])->name('childRegistration.data.show');
    Route::get('childLevel/info/index', [ChildrenReportController::class, 'childLevelIndex'])->name('childLevel.info.index');
    Route::get('childLevel/info/show', [ChildrenReportController::class, 'childLevelShow'])->name('childLevel.info.show');
    Route::get('childDontPaid/info/index', [ChildrenReportController::class, 'childDontPaidIndex'])->name('childDontPaid.info.index');
    Route::get('childDontPaid/info/show', [ChildrenReportController::class, 'childDontPaidShow'])->name('childDontPaid.info.show');
    Route::get('abcencePermission/info/index', [ChildrenReportController::class, 'abcencePermissionIndex'])->name('abcencePermission.info.index');
    Route::get('abcencePermission/info/show', [ChildrenReportController::class, 'abcencePermissionShow'])->name('abcencePermission.info.show');
    Route::get('absence/info/index', [ChildrenReportController::class, 'absenceIndex'])->name('absence.info.index');
    Route::get('absence/info/show', [ChildrenReportController::class, 'absenceShow'])->name('absence.info.show');

    Route::get('tressury/process/info/index', [ChildrenReportController::class, 'tressuryProcessIndex'])->name('tressury.process.info.index');
    Route::get('tressury/process/info/show', [ChildrenReportController::class, 'tressuryProcessShow'])->name('tressury.process.info.show');

/////تقرير باسم القاعه
    Route::get('classRoom/students/info/index', [ChildrenReportController::class, 'classRoomStudents'])->name('classRoom.Students.info.index');
    Route::get('classRoom/students/info/show', [ChildrenReportController::class, 'classRoomStudentShow'])->name('classRoom.Students.info.show');

    Route::get('ducationalExpense/level/ajax/{id}', [ChildrenReportController::class, 'educationalExpenseAjax'])->name('educationalExpenseAjax.level.ajax');

    // تقرير غياب الموظفين
    Route::get('employee/absence/info/index', [ChildrenReportController::class, 'employeeAbsenceIndex'])->name('employee.absence.info.index');
    Route::get('employee/absence/info/show', [ChildrenReportController::class, 'employeeAbsenceShow'])->name('employee.absence.info.show');
});
