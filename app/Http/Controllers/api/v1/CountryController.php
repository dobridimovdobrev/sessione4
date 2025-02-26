<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\ResponseMessages;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\CountryResource;
use App\Http\Resources\api\v1\CountryCollection;
use App\Http\Requests\api\v1\CountryStoreRequest;
use App\Http\Requests\api\v1\CountryUpdateRequest;


class CountryController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterCountry = $request->all();
        //this is query biulder
        $query = Country::query();
        
        foreach($filterCountry as $key => $value){
            //check if request = key\
            if(in_array($key,['country_id', 'name', 'continent', 'iso2','iso3', 'phone_prefix'])){
            //if the key exist make the query
            $query = $query->where($key,'LIKE', "%$value%");
            // this is for executiong query
            }
            
        }
        
        $countries =$query->get();
        return new CountryCollection($countries);
    }

    /**
     * Store a newly created resource in storage.      
     */
    public function store(CountryStoreRequest $request)
    {
        $country = Country::create($request->validated());
        return new CountryResource($country);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        $country = new CountryResource($country);
        return $country;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryUpdateRequest $request, Country $country)
    {
        $validateCountry = $request->validated();
        $country->fill($validateCountry);
        $country->save();
        return new CountryResource($country);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {   $countryName = $country->name;
        $country->deleteOrFail();
        return ResponseMessages::success(['message'=>'the country: ' . $countryName . ' is deleted'],200);
    }
}
