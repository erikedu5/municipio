<?php

namespace App\Http\Controllers;

use App\Models\ImagesOffer;
use App\Models\ImagesPublication;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Inertia\Inertia;

class OfferController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $offers =  Offer::latest()->paginate(env('PAGINATION'));

        return Inertia::render('Offers/Offer', [
            'offers' => $offers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Offers/CreateOffer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => 'required',
            "subtitle" => 'required',
            "description" => 'required',
            "startDate" => 'required',
            "endDate" => 'required'
        ]);

        $bandsaved = Offer::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'startDate' => new Carbon($request->startDate),
            'endDate' => new Carbon($request->endDate),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Guarda la imagen en el disco y almacena la ruta
                $path = $image->store('images', 'public');
                ImagesOffer::create([
                    'path' => $path,
                    'main_image' => false,
                    'offer_id' => $bandsaved->id
                ]);
            }
        }

        return redirect()->route('offersInternal.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $publication_id)
    {
        $offer = Offer::find($publication_id);
        $images = ImagesOffer::where('offer_id', $offer->id)->get()->map(function($image) {
            return FacadesStorage::url($image->path); // Genera la URL pública
        });
        $offer->images = $images;

        return Inertia::render('Offers/CreateOffer', [
            'offer' => $offer,
            'editable' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       /* if (!empty($request->file('path_information_tax'))) {
            $resume = $request->file('path_information_tax');
            $resumeFileName = 'information_tax-'. $request->name. '.' . $resume->getClientOriginalExtension();

            $filePath = Storage::disk('s3')->putFile(
                $request->client.'/tax_information',
                $resume,
                $resumeFileName,
                'public'
            );
        }

        if (!empty($request->file('path_logo'))) {
            $logo = $request->file('path_logo');
            $logo_FileName = 'logo-'. $request->name. '.' . $logo->getClientOriginalExtension();

            $logoPath = Storage::disk('s3')->putFile(
                $request->client.'/logo',
                $logo,
                $logo_FileName,
                'public'
            );
        }

        $updateArr =[
            'name' => $request->name,
            'rfc' => $request->rfc,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'locations_maps' => $request->locations_maps,
            'path_information_tax' => isset($filePath) ? $filePath: $request->path_information_tax,
            'brand_reach' => $request->brand_reach,
            'primary_color' => $request->primary_color,
            'secundary_color' => $request->secundary_color,
            'path_logo' => isset($logoPath) ? $logoPath: $request->path_logo,
            'status' => $request->status == 1 ? true: false
        ];

        Brand::where('id', $request->id)
        ->orderBy('id')
        ->first()
        ->update($updateArr);

        return redirect()->route('brands.index');*/
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $publication_id)
    {
        $publication = Offer::find($publication_id);
        ImagesPublication::where('publication_id', $publication_id)->delete();
        $publication->delete();

        return redirect()->route('offersInternal.index');
    }

}
