<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ActivityController extends Controller
{


    public function index(): View
    {
        $activities = Activity::orderBy('activity_date')->get();
        return view('activities.index', compact('activities'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('activities.create', compact('categories'));
    }

    public function store(StoreActivityRequest $request): RedirectResponse
    {
        $activity = Activity::create($request->validated());
        return redirect()->route('activities.show', $activity)->with('success', 'Kegiatan berhasil dibuat.');
    }

    public function show(Activity $activity): View
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        $categories = Category::orderBy('name')->get();
        return view('activities.edit', compact('activity', 'categories'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity): RedirectResponse
    {
        $activity->update($request->validated());
        return redirect()->route('activities.show', $activity)->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}