<?php



Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function()

{
Route::get('/index','Dashboardcontrller@index')->name('index');

Route::Resource('users','Usercontroller')->except(['show']);
Route::Resource('categories','Categorycontroller')->except(['show']);

Route::Resource('products','ProductController')->except(['show']);

Route::Resource('clients','clientController')->except(['show']);

});
});


Route::get('/c', function(){

    return view('dashboard.index');
    });
    
    Route::get('/cu', function(){

        return view('dashboard.users.index');
        });
        

?>