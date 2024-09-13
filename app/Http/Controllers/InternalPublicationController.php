<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InternalPublicationController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $publications =  Publication::where('startDate', '>=', Carbon::now())
            ->latest()->paginate(env('PAGINATION'));

        return Inertia::render('Publications/Publication', [
            'publications' => $publications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Publications/CreatePublication');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       /* $request->validate([
            'client' => 'required',
            'name' => 'required',
            'rfc' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'locations_maps' => 'required',
            'path_information_tax' => 'required',
            'brand_reach' => 'required',
            'primary_color' => 'required',
            'secundary_color' => 'required',
            'path_logo' => 'required',
            'status' => 'required',
        ]);

        $resume = $request->file('path_information_tax');
        $resumeFileName = 'information_tax-'. $request->name. '.' . $resume->getClientOriginalExtension();

        $filePath = Storage::disk('s3')->putFile(
            $request->client.'/tax_information',
            $resume,
            $resumeFileName,
            'public'
        );

        $logo = $request->file('path_logo');
        $logo_FileName = 'logo-'. $request->name. '.' . $resume->getClientOriginalExtension();

        $logoPath = Storage::disk('s3')->putFile(
            $request->client.'/logo',
            $logo,
            $logo_FileName,
            'public'
        );

        Brand::create([
            'client_id' => $request->client,
            'name' => $request->name,
            'rfc' => $request->rfc,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'locations_maps' => $request->locations_maps,
            'path_information_tax' => $filePath,
            'brand_reach' => $request->brand_reach,
            'primary_color' => $request->primary_color,
            'secundary_color' => $request->secundary_color,
            'path_logo' => $logoPath,
            'status' => $request->status == 1 ? true: false,
            'private_s3_bucket' => false,
            'private_db' => false
        ]);

        return redirect()->route('Publications.index');*/
    }

    /**
     * Display the specified resource.
     */
    public function show(String $brand_id)
    {
       /* $clients = Client::get();
        $brand = Brand::find($brand_id);
        $brand->status = $brand->status ? 1: 0;
        $brand->client = $brand->client_id;
        return Inertia::render('Brand/CreateBrand', [
            'brand' => $brand,
            'clients' => $clients,
            'editable' => false
        ]);*/
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $brand_id)
    {
       /* $clients = Client::get();
        $brand = Brand::find($brand_id);
        $brand->status = $brand->status ? 1: 0;
        $brand->client = $brand->client_id;
        return Inertia::render('Brand/CreateBrand', [
            'brand' => $brand,
            'clients' => $clients,
            'editable' => true
        ]);*/
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
    public function destroy(String $brand_id)
    {
       /* Brand::where('id', $brand_id)
        ->orderBy('id')
        ->first()
        ->update([
            'status' => false
        ]);

        return redirect()->route('brands.index');*/
    }

}
