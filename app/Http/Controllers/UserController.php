<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Http\Client\Common\HttpMethodsClientInterface;
use Geocoder\Provider\GoogleMaps\GoogleMaps;
use Geocoder\Query\GeocodeQuery;
use App\Models\{
    Construction,
    Quote,
    Category,
};



class UserController extends Controller
{
    /**
     * Dashboard view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewDashboard()
    {
        #Get auth user
        $user = auth()->user();

        $allConstructions = Construction::where('user_id', $user->id)->get();
        return view('user.dashboard', [
            'allConstructions' => $allConstructions
        ]);
    }

    /**
     * Dashboard view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewQuote()
    {
        #Get auth user
        $user = auth()->user();

        $allQuotes = Quote::where('user_id', $user->id)->get();
        $categories = Category::rootCategories();
        $allConstructions = Construction::where('user_id', $user->id)->get();
        return view('user.quote', [
            'allQuotes' => $allQuotes,
            'categories' => $categories,
            'allConstructions' => $allConstructions
        ]);
    }

    public function fetchAddress($postalCode)
    {
        Log::info("fetch address started --------------------------------------");
        
        // Create a new instance of the GoogleMaps provider
        $client = new \Http\Adapter\Guzzle7\Client();
        $provider = new GoogleMaps($client, null, 'AIzaSyCmOo5CbK2lpnd2j5W1RSxMz_4CjqTopbY');
        // Log::info("fetch address started 00000000000000000000000000000000000000000");
        // $provider = new GoogleMaps($client);
        
        Log::info("fetch address started +++++++++++++++++++++++++++++++++++++++");
        // Query the provider for the given ZIP code
        $results = $provider->geocodeQuery(GeocodeQuery::create($postalCode));
        
        // Retrieve the first result
        $result = $results->first();
        Log::info("dfasdfasdfasd".$result);
        
        // Extract the address components
        $street = $result->getStreetName();
        $city = $result->getLocality();
        $state = $result->getAdminLevels()->first()->getName();
        $country = $result->getCountry();
        
        // Return the address data as a JSON response
        return response()->json([
            'street' => $street,
            'city' => $city,
            'state' => $state,
            'country' => $country,
        ]);
    }
}
