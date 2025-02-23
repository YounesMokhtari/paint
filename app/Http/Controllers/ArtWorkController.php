<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtWorkRequest;
use App\Http\Requests\UpdateArtWorkRequest;
use App\Models\ArtWorks\ArtWork;
use App\Models\ArtWorks\ArtWorkFields;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ArtWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ArtWork::query()->with('user');

        // اعمال فیلتر دسته‌بندی
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // اعمال جستجو
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhereHas('user', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        $artWorks = $query->latest()->paginate(12)->withQueryString();
        return view('art-works.index', compact('artWorks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('art-works.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtWorkRequest $request)
    {
        $data = $request->validated();
        $directory = 'art-works';
        $fileName = $request->file(ArtWorkFields::IMAGE)->getClientOriginalName();


        $file = Storage::putFileAs('art-works', $request->file(ArtWorkFields::IMAGE), $request->file(ArtWorkFields::IMAGE)->getClientOriginalName());
        $imageUrl = Storage::url($file); // تبدیل مسیر به URL کامل
        $data[ArtWorkFields::IMAGE] = $imageUrl;
        $artWork = ArtWork::create($data + ['user_id' => Auth::id()]);
        return redirect()->route('art-works.index')->with('success', 'Art work created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ArtWork $artWork)
    {
        return view('art-works.show', compact('artWork'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArtWork $artWork)
    {
        return view('art-works.edit', compact('artWork'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtWorkRequest $request, ArtWork $artWork)
    {
        $artWork->update($request->validated());
        return redirect()->route('art-works.index')->with('success', 'Art work updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArtWork $artWork)
    {
        $artWork->delete();
        return redirect()->route('art-works.index')->with('success', 'Art work deleted successfully');
    }
}
