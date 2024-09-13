<?php

namespace App\Http\Controllers;

use App\Models\ImagesPublication;
use App\Models\Offer;
use App\Models\publication;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PublicationController extends Controller
{
   public function Index() {
        $publications = publication::where('startDate', '<=', Carbon::now())
        ->where('endDate', '>=', Carbon::now())->get();
        foreach($publications as $publication) {
            $publication->images = ImagesPublication::where('publication_id', $publication->id)->get();
        }

        
        $offers = Offer::where('startDate', '<=', Carbon::now())
        ->where('endDate', '>=', Carbon::now())->get();
        foreach($publications as $publication) {
            $offers->images = ImagesPublication::where('publication_id', $publication->id)->get();
        }

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'publications' => $publications,
            'offers' => $offers
        ]);
    }
}
