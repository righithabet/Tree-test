<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('add-tree', 'App\Http\Controllers\TreeController@add_tree_index');
Route::post('add-tree', 'App\Http\Controllers\TreeController@add_tree');
Route::post('add-tree-node', 'App\Http\Controllers\TreeController@add_tree_node');
Route::get('all-trees', 'App\Http\Controllers\TreeController@all_trees_index');
Route::get('show-tree/{id}', 'App\Http\Controllers\TreeController@show_tree_index');
Route::get('edit-tree/{id}', 'App\Http\Controllers\TreeController@edit_tree_index');
Route::get('delete-tree/{id}', 'App\Http\Controllers\TreeController@delete_tree');
