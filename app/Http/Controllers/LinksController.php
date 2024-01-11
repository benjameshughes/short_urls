<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return the index view
        return view('links.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return the create view
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // redirect the short url to the original url and increment the clicks
        $link = Url::where('short_url', $id)->firstOrFail();
        $link->increment('visits');

        return redirect()->away($link->url, 301);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
