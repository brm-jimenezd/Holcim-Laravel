<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use Auth;
use File;
use Image;

class Page1Controller extends Controller
{
  public function index(Request $request)
  {
    $pages = Page::orderBy('updated_at', 'desc');
    //busqueda
    if($request->q && !empty($request->q)) {
      $pages->where(function($query) use ($request) {
        $query->where('name', 'LIKE', '%'.$request->q.'%')->orWhere('content', 'LIKE', '%'.$request->q.'%');
      });
    }
    if($request->wt) { $pages->withTrashed(); }
    if(Auth::user()->role == 'Mod') {
      $pages = $pages->where('user_id', Auth::user()->id);
    }
    $pages = $pages->paginate(30);
    return view('admin.pages.index', compact('pages'));
  }
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255'
    ]);
    $page = new Page;
    $page->user_id = Auth::user()->id;
    $page->name = $request->name;
    //slug
    $validateSlug = Page::where('slug', str_slug($request->name))->withTrashed()->count();
    $page->slug = str_slug($request->name).($validateSlug > 0 ? $validateSlug : '');
    $page->save();

    app('App\Http\Controllers\Admin\LogController')->store('Page store id '.$page->id, $page);
    flash('Se guardo el registro con éxito.')->success();
    return redirect()->route('admin.pages.edit', $page->id);
  }
  public function edit($id)
  {
    $page = Page::withTrashed()->findOrFail($id);
    return view('admin.pages.edit', compact('page'));
  }
  public function update(Request $request, $id)
  {
    $page = Page::withTrashed()->findOrFail($id);
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:pages,slug,'.$page->id.'|max:255',
      'picture' => 'mimes:jpeg,bmp,png,gif',
    ]);
    $page->name = $request->name;
    $page->slug = $request->slug;
    $page->description = $request->description;
    $page->content = $request->content;
    $page->active = ($request->active ? true : false);

    //upload Pictures
    if($request->hasFile('picture') && $request->file('picture')->isValid()) {
      $filename = $page->id.'-page-'.$page->slug.'.'.$request->picture->extension();
      Image::make($request->file('picture'))->fit(625,2025)->save('uploads/'.$filename);
      $page->picture = $filename;
    }
    //if is in TrashCan
    if($page->trashed()) { $page->restore(); }
    $page->save();

    app('App\Http\Controllers\Admin\LogController')->store('Page updated id '.$page->id, $page);
    flash('Se guardo el registro con éxito.')->success();
    return redirect()->route('admin.pages.index');
  }
  public function destroy($id)
  {
    $page = Page::withTrashed()->findOrFail($id);
    app('App\Http\Controllers\Admin\LogController')->store('Page destroy id '.$page->id, $page);
    if($page->trashed() && Auth::user()->role == 'Admin') {
      $page->forceDelete();
    } else {
      $page->delete();
    }
    flash('Registro eliminado con éxito.')->error();
    return redirect()->route('admin.pages.index');

  }
}
