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

    public function index(Request $request): View
    {
        $activities = Activity::with('category')
            ->search($request->query('search'))
            ->filterCategory($request->query('category_id'))
            ->fiterStatus($request->query('status'))
            ->sortByDate($request->query('sort'))
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();
        return view('activities.index', compact('activities', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('activities.create', compact('categories'));
    }

    public function store(StoreActivityRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = 'Draft';
        $activity = Activity::create($data);
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

    public function publish(Activity $activity): RedirectResponse
    {
        $this->service->publish($activity);
        return redirect()->route('activities.show', $activity)->with('success', 'kegiatan berhasil dipublish');
    }

    public function complete(Activity $activity): RedirectResponse
    {
        $this->service->complete($activity);
        return redirect()->route('activities.show', $activity)->with('success', 'kegiatan berhasil diselesaikan');
    }

    public function trash(): view
    {
        $activities = Activity::onlyTrashed()
            ->with('category')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return view('activities.trash', compact('activities'));
    }

    public function restore(int $id): RedirectResponse
    {
        $activity = Activity::onlyTrashed()->findOrFail($id);
        $activity->restore();
        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil dikembalikan');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $activity = Activity::onlyTrashed()->findOrFail($id);
        $activity->forceDelete();
        return redirect()->route('activities.trash')->with('success', 'Kegiatan berhasil dihapus permanen');
    }
}