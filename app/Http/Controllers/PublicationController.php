<?php

namespace App\Http\Controllers;

use App\Models\ImagesOffer;
use App\Models\ImagesPublication;
use App\Models\Offer;
use App\Models\publication;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PublicationController extends Controller
{
   public function Index() {
        $publications = publication::where('startDate', '<=', Carbon::now())
        ->where('endDate', '>=', Carbon::now())->get();
        foreach($publications as $publication) {
            $images = ImagesPublication::where('publication_id', $publication->id)->get()->map(function($image) {
                return Storage::url($image->path); // Genera la URL pública
            });
            $publication->images = $images;
        }


        $offers = Offer::where('startDate', '<=', Carbon::now())
        ->where('endDate', '>=', Carbon::now())->get();
        foreach($offers as $offer) {
            $images = ImagesOffer::where('offer_id', $offer->id)->get()->map(function($image) {
                return Storage::url($image->path); // Genera la URL pública
            });
            $offer->images = $images;
        }

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'publications' => $publications,
            'offers' => $offers
        ]);
    }
}
