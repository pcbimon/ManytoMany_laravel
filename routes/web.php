<?php
use App\Role;
use App\User;
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
    return view('welcome');
});
Route::get('/create', function()
{
  $user = User::find(1);
  $role = new Role(['name'=>'Administator']);
  $user->roles()->save($role);
});
Route::get('/read', function()
{
  $user = User::findOrfail(1);
  foreach ($user->roles as $role) {
    return $role;//or echo
  }
});
Route::get('/update', function()
{
  $user = User::findOrfail(1);
  if($user->has('roles')){
    foreach ($user->roles as $role) {
      if ($role->name == 'Administator') {
        $role->name = 'Subscriber';
        $role->save();
      }
    }
  }
});
Route::get('/delete', function()
{
  $user = User::findOrfail(1);
  // $user->roles()->delete();
  foreach ($user->roles as $role) {
    $role->where('id', 2)->delete();
  }
});
