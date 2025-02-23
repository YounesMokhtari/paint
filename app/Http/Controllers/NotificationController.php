<?php


namespace App\Http\Controllers;

use App\Http\Requests\StoreArtWorkRequest;
use App\Http\Requests\UpdateArtWorkRequest;
use App\Models\ArtWorks\ArtWork;
use App\Models\ArtWorks\ArtWorkFields;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications=Auth::user()->notifications()->paginate();
        return view('notifications.index',['notifications'=>$notifications]);
    }
}
