<?php
use App\Blog;
use App\Comentar;
use App\Category;
use App\Gallery;
use App\Tag;
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

Route::get('/', function () {
    return view('beranda');
});


/*
materi 1 laravel pengenalan routing 
routing itu seperti rute darat atau air atau udara 
routig dapat memanggil controler
routing dapat langsung mencetak ke layar browser
*/

Route::get('/halo/{tiitle}', function($tiitle) {
return "halo".$tiitle;
});

Route::get('/materi', function() {
return view('materi1');
});

Route::get('blade1',function(){
    return view('blade1');
});

Route::get('/about',function(){
    return view('about');
});

Route::get('/blog','BlogController@index');
Route::get('/blog/category/{category}','BlogController@category');
Route::get('/blog/cek','BlogController@cekLogin');

Route::get('/blog/{id}','BlogController@liatid');

Route::get('/portofolio',function(){
    return view('portofolio');
});

Route::post('/add','BlogController@insert');
Route::get('/editprofile/{id}','BlogController@edituser');
Route::get('/editprofile1/{id}','BlogController@edituser1');

Route::get('/beranda','BerandaController@index');

Route::get('/post','BlogController@index1');
Route::get('/post/login','BlogController@login');
Route::get('/delete/{id}','BlogController@delete');
Route::get('/update/{id}','BlogController@update');
Route::get('/deleteuser/{id}','BlogController@deleteUser');
Route::post('/paymentprem','BlogController@paymentPrem');
Route::post('/paymentplat','BlogController@paymentPlat');
Route::post('/updates','BlogController@updates');

Route::get('/profile',function(){
    return view('profile');
});
Route::get('/addblog',function(){
    $user = Auth::user()->id;
    $blog = Category::where('user_id','=',$user)->get();;
    $tag = Tag::where('user_id','=',$user)->get();
    return view('formaddblog',['blog'=>$blog,'tag'=>$tag]);
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('comentars','ComentarController');
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('/category','BlogController@listCategory')->name('listCategory');
Route::get('/addcategory','BlogController@addCategory')->name('addCategory');
Route::get('/blog/update/category/{id}','BlogController@viewCategory');
Route::post('/blog/update/category','BlogController@updateCategory')->name('updateCategory');
Route::get('/category/delete/{id}','BlogController@deleteCategory')->name('deleteCategory');
Route::get('/galery','BlogController@gallery');
Route::post('/galery/add','BlogController@addGalery');
Route::get('/form/add/galery',function()
{
    return view('galery.formgalery');
});
Route::get('/detail/galery/{id}','BlogController@detailGalery');
Route::get('/post/galery',function()
{
    $galerry = Gallery::where('user_id','=',Auth::user()->id)->get();
    return view('galery.postgalery',['gallery'=>$galerry,'no'=>1]);
});
Route::get('/delete/gallery/{id}',function($id)
{
    $galerry = Gallery::where('id','=',$id);
    $galerry->delete();
    return redirect('/post/galery');
});

Route::get('/form/add/tag',function()
{
    $tag = Tag::where('user_id','=',Auth::user()->id)->get();   
    return view('tag.formaddtag',['tag'=>$tag,'no'=>1]);
});

Route::post('/add/tag','BlogController@addTag');
Route::get('/tag/delete/{id}','BlogController@deleteTag');
Route::get('/mail/send/{type}/{userMail}','BlogController@sendMail');
Route::get('/json','BlogController@json');