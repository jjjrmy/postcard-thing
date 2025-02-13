<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostcardRequest;
use App\Http\Requests\UpdatePostcardRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use App\Models\Postcard;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

class PostcardController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware(HandlePrecognitiveRequests::class, only: ['store', 'update']),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostcardRequest $request)
    {
        $validated = $request->validated();
        
        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('postcards', 'public');
            $validated['image_url'] = "/{$path}";
        }

        $postcard = Postcard::create($validated);

        // return redirect()->route('postcards.edit', $postcard);
        return redirect()->route('postcards.show', $postcard);
    }

    /**
     * Display the specified resource.
     */
    public function show(Postcard $postcard)
    {
        return Inertia::render('show', ['postcard' => $postcard]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postcard $postcard)
    {
        return Inertia::render('edit', ['postcard' => $postcard]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostcardRequest $request, Postcard $postcard)
    {
        $validated = $request->validated();

        if ($request->hasFile('image_url')) {
            Storage::disk('public')->delete(ltrim((string) $postcard->image_url, '/'));
            $path = $request->file('image_url')->store('postcards', 'public');
            $validated['image_url'] = "/{$path}";
        }

        $postcard->update($validated);

        return redirect()->route('postcards.edit', $postcard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Postcard $postcard)
    {
        Storage::disk('public')->delete(ltrim((string) $postcard->image_url, '/'));
        $postcard->delete();

        return redirect()->route('postcards.create');
    }
}
