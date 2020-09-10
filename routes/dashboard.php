<?php

Route::group(['prefix'=> 'dashboard'], function(){
	Route::group(['prefix'=> 'auth'], function(){
		Route::get('logout', ['as'=>'get.dashboard.auth.logout','uses'=>'Dashboard\DashboardController@getLogout']);
	});

	Route::group(['prefix'=> 'cate'], function(){
		Route::get('{code}/list', ['as'=>'get.dashboard.cate.list','uses'=>'Dashboard\CateController@list']);
		Route::get('{code}/create', ['as'=>'get.dashboard.cate.create','uses'=>'Dashboard\CateController@create']);
		Route::get('{code}/edit/{id}', ['as'=>'get.dashboard.cate.edit','uses'=>'Dashboard\CateController@edit'])->where('id', '[0-9]+');;
		Route::get('{code}/delete/{id}', ['as'=>'get.dashboard.cate.delete','uses'=>'Dashboard\CateController@delete'])->where('id', '[0-9]+');
		Route::post('{code}/create', ['as'=>'post.dashboard.cate.create','uses'=>'Dashboard\CateController@postCreate']);
		Route::post('{code}/edit/{id}', ['as'=>'post.dashboard.cate.edit','uses'=>'Dashboard\CateController@postEdit'])->where('id', '[0-9]+');

		Route::group(['prefix'=> 'book'], function(){
			Route::group(['prefix'=> 'nha-xuat-ban'], function(){
				Route::get('list', ['as'=>'get.dashboard.cate.book.nxb.list','uses'=>'Dashboard\BookController@nxb_list']);
				Route::get('create', ['as'=>'get.dashboard.cate.book.nxb.create','uses'=>'Dashboard\BookController@nxb_create']);
				Route::get('edit/{id}', ['as'=>'get.dashboard.cate.book.nxb.edit','uses'=>'Dashboard\BookController@nxb_edit'])->where('id', '[0-9]+');;
				Route::get('delete/{id}', ['as'=>'get.dashboard.cate.book.nxb.delete','uses'=>'Dashboard\BookController@nxb_delete'])->where('id', '[0-9]+');
				Route::post('create', ['as'=>'post.dashboard.cate.book.nxb.create','uses'=>'Dashboard\BookController@postCreateNXB']);
				Route::post('edit/{id}', ['as'=>'post.dashboard.cate.book.nxb.edit','uses'=>'Dashboard\BookController@postEditNXB'])->where('id', '[0-9]+');
			});

			Route::group(['prefix'=> 'tac-gia'], function(){
				Route::get('list', ['as'=>'get.dashboard.cate.book.author.list','uses'=>'Dashboard\BookController@author_list']);
				Route::get('create', ['as'=>'get.dashboard.cate.book.author.create','uses'=>'Dashboard\BookController@author_create']);
				Route::get('edit/{id}', ['as'=>'get.dashboard.cate.book.author.edit','uses'=>'Dashboard\BookController@author_edit'])->where('id', '[0-9]+');;
				Route::get('delete/{id}', ['as'=>'get.dashboard.cate.book.author.delete','uses'=>'Dashboard\BookController@author_delete'])->where('id', '[0-9]+');
				Route::post('create', ['as'=>'post.dashboard.cate.book.author.create','uses'=>'Dashboard\BookController@postCreateAuthor']);
				Route::post('edit/{id}', ['as'=>'post.dashboard.cate.book.author.edit','uses'=>'Dashboard\BookController@postEditAuthor'])->where('id', '[0-9]+');
			});

			Route::group(['prefix'=> 'noi-xuat-ban'], function(){
				Route::get('list', ['as'=>'get.dashboard.cate.book.make.list','uses'=>'Dashboard\BookController@make_list']);
				Route::get('create', ['as'=>'get.dashboard.cate.book.make.create','uses'=>'Dashboard\BookController@create']);
				Route::get('edit/{id}', ['as'=>'get.dashboard.cate.book.make.edit','uses'=>'Dashboard\BookController@edit'])->where('id', '[0-9]+');;
				Route::get('delete/{id}', ['as'=>'get.dashboard.cate.book.make.delete','uses'=>'Dashboard\BookController@delete'])->where('id', '[0-9]+');
				Route::post('create', ['as'=>'post.dashboard.cate.book.make.create','uses'=>'Dashboard\BookController@postCreate']);
				Route::post('edit/{id}', ['as'=>'post.dashboard.cate.book.make.edit','uses'=>'Dashboard\BookController@postEdit'])->where('id', '[0-9]+');
			});
		});
	});


	Route::group(['prefix'=> 'post'], function(){
		Route::get('list', ['as'=>'get.dashboard.post.list','uses'=>'Dashboard\PostController@list']);
		Route::get('create', ['as'=>'get.dashboard.post.create','uses'=>'Dashboard\PostController@create']);
		Route::get('edit/{id}', ['as'=>'get.dashboard.post.edit','uses'=>'Dashboard\PostController@edit'])->where('id', '[0-9]+');;
		Route::get('delete/{id}', ['as'=>'get.dashboard.post.delete','uses'=>'Dashboard\PostController@delete'])->where('id', '[0-9]+');
		Route::post('create', ['as'=>'post.dashboard.post.create','uses'=>'Dashboard\PostController@postCreate']);
		Route::post('edit/{id}', ['as'=>'post.dashboard.post.edit','uses'=>'Dashboard\PostController@postEdit'])->where('id', '[0-9]+');

		Route::get('tags', ['as'=>'get.dashboard.post.tag','uses'=>'Dashboard\PostController@tags']);
		Route::post('tags', ['as'=>'post.dashboard.post.tag','uses'=>'Dashboard\PostController@postTag']);
		Route::get('tags/delete/{id}', ['as'=>'get.dashboard.post.tag.delete','uses'=>'Dashboard\PostController@deleteTag'])->where('id', '[0-9]+');
	});

	Route::group(['prefix'=> 'product'], function(){
		Route::get('list', ['as'=>'get.dashboard.product.list','uses'=>'Dashboard\ProductController@list']);
		Route::get('create', ['as'=>'get.dashboard.product.create','uses'=>'Dashboard\ProductController@create']);
		Route::get('edit/{id}', ['as'=>'get.dashboard.product.edit','uses'=>'Dashboard\ProductController@edit'])->where('id', '[0-9]+');;
		Route::get('delete/{id}', ['as'=>'get.dashboard.product.delete','uses'=>'Dashboard\ProductController@delete'])->where('id', '[0-9]+');
		Route::post('create', ['as'=>'post.dashboard.product.create','uses'=>'Dashboard\ProductController@postCreate']);
		Route::post('edit/{id}', ['as'=>'post.dashboard.product.edit','uses'=>'Dashboard\ProductController@postEdit'])->where('id', '[0-9]+');

	});

	Route::group(['prefix'=> 'ke-sach'], function(){
		Route::get('list', ['as'=>'get.dashboard.ks.list','uses'=>'Dashboard\BookshelfController@list']);
		Route::get('create', ['as'=>'get.dashboard.ks.create','uses'=>'Dashboard\BookshelfController@create']);
		Route::get('edit/{id}', ['as'=>'get.dashboard.ks.edit','uses'=>'Dashboard\BookshelfController@edit'])->where('id', '[0-9]+');;
		Route::get('delete/{id}', ['as'=>'get.dashboard.ks.delete','uses'=>'Dashboard\BookshelfController@delete'])->where('id', '[0-9]+');
		Route::post('create', ['as'=>'post.dashboard.ks.create','uses'=>'Dashboard\BookshelfController@postCreate']);
		Route::post('edit/{id}', ['as'=>'post.dashboard.ks.edit','uses'=>'Dashboard\BookshelfController@postEdit'])->where('id', '[0-9]+');
	});


	Route::group(['prefix'=> 'user'], function(){
		Route::get('list', ['as'=>'get.dashboard.user.list','uses'=>'Dashboard\UserController@list']);
		Route::get('create', ['as'=>'get.dashboard.user.create','uses'=>'Dashboard\UserController@create']);
		Route::get('edit/{id}', ['as'=>'get.dashboard.user.edit','uses'=>'Dashboard\UserController@edit'])->where('id', '[0-9]+');;
		Route::get('delete/{id}', ['as'=>'get.dashboard.user.delete','uses'=>'Dashboard\UserController@delete'])->where('id', '[0-9]+');
		Route::post('create', ['as'=>'post.dashboard.user.create','uses'=>'Dashboard\UserController@postCreate']);
		Route::post('edit/{id}', ['as'=>'post.dashboard.user.edit','uses'=>'Dashboard\UserController@postEdit'])->where('id', '[0-9]+');

		Route::get('roles/list', ['as'=>'get.dashboard.user.roles','uses'=>'Dashboard\UserController@getRoles']);
	});

});
