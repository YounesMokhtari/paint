<?php

namespace App\Http\Controllers;

use App\Models\Courses\Course;
use App\Models\ArtWorks\ArtWork;
use App\Models\ArtWorks\ArtWorkFields;
use App\Models\Category;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        $categories = Category::all()->map(function ($category) {
            return [
                'name' => $category->name,
                'url' => route('categories.show', $category->slug),
                'description' => $category->description,
                'icon_svg' => $category->icon_svg,
            ];
        });
        // $categories = [
        //     [
        //         'name' => __('landing.categories.watercolor.name'),
        //         'url' => route('categories.show', 'watercolor'),
        //         'description' => __('landing.categories.watercolor.description'),
        //         'icon' => '<svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        //             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        //                   d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
        //         </svg>'
        //     ],
        //     [
        //         'name' => __('landing.categories.oil_painting.name'),
        //         'url' => route('categories.show', 'oil-painting'),
        //         'description' => __('landing.categories.oil_painting.description'),
        //         'icon' => '<svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        //             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        //                   d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
        //         </svg>'
        //     ],
        //     [
        //         'name' => __('landing.categories.sketching.name'),
        //         'url' => route('categories.show', 'sketching'),
        //         'description' => __('landing.categories.sketching.description'),
        //         'icon' => '<svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        //             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        //                   d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        //         </svg>'
        //     ],
        //     [
        //         'name' => __('landing.categories.digital_art.name'),
        //         'url' => route('categories.show', 'digital-art'),
        //         'description' => __('landing.categories.digital_art.description'),
        //         'icon' => '<svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        //             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        //                   d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        //         </svg>'
        //     ],
        //     [
        //         'name' => __('landing.categories.miniature.name'),
        //         'url' => route('categories.show', 'miniature'),
        //         'description' => __('landing.categories.miniature.description'),
        //         'icon' => '<svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        //             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        //                   d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        //         </svg>'
        //     ],
        //     [
        //         'name' => __('landing.categories.calligraphy.name'),
        //         'url' => route('categories.show', 'calligraphy'),
        //         'description' => __('landing.categories.calligraphy.description'),
        //         'icon' => '<svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        //             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        //                   d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        //         </svg>'
        //     ]
        // ];

        $featuredCourses = Course::query()
            ->with(['creator', 'category'])
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        $communityArtworks = ArtWork::query()
            ->with('user')
            ->where(ArtWorkFields::IS_APPROVED, true)
            ->latest()
            ->take(8)
            ->get();

        return view('landing', compact('categories', 'featuredCourses', 'communityArtworks'));
    }
}
