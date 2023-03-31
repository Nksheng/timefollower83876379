<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;
use Inertia\Response;

class MoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Moods/Index', [
            'moods' => Mood::with('user:id,name')
                ->latest()
                ->where(
                    'user_id',
                    '=',
                    $request->user()->id
                )
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'moodtitle' => 'required|string|max:255',
            'datetime' => 'required|date|before:tomorrow',
        ]);
 
        $request->user()->moods()->create($validated);
 
        return redirect(route('moods.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mood  $mood
     * @return \Illuminate\Http\Response
     */
    public function show(Mood $mood)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mood  $mood
     * @return \Illuminate\Http\Response
     */
    public function edit(Mood $mood)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mood  $mood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mood $mood): RedirectResponse
    {
        $this->authorize('update', $mood);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'moodtitle' => 'required|string|max:255',
            'datetime' => 'required|date|before:tomorrow',
        ]);
 
        $mood->update($validated);
 
        return redirect(route('moods.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mood  $mood
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mood $mood): RedirectResponse
    {
        $this->authorize('delete', $mood);
 
        $mood->delete();
 
        return redirect(route('moods.index'));
    }
}
