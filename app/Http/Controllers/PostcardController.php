<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepostcardRequest;
use App\Http\Requests\UpdatepostcardRequest;
use App\Models\postcard;

class PostcardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepostcardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(postcard $postcard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(postcard $postcard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepostcardRequest $request, postcard $postcard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(postcard $postcard)
    {
        //
    }
}
