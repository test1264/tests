<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function show($slug)
    {
        $page = Pages::getBySlug($slug);

        if(count($page) === 0) {
            abort(404);
        }

        return view('page', [
            'page' => $page[0]
        ]);
    }

    public function admin() {
        return view('admin.index');
    }

    public function store(Request $request) {
        $request->validate([
            'slug' => 'required|min:3|unique:pages',
            'title' => 'required|min:3'
        ]);

        $pageData = $request->all();

        Pages::store($pageData);

        return redirect($pageData['slug']);
    }
}
