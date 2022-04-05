<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countriesQuery = Country::query();

        if ($request->has('search')) {
            $search = $request->input('search');

            // this:
            $countriesQuery->where('name', 'LIKE', '%' . $search . '%');
            $countriesQuery->orWhere('code', '=',  $search);

            // is the same as doing:

            $countriesQuery
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('code', '=',  $search);
        }

        $countries = $countriesQuery->paginate();

        return response()->json($countries);
    }

    public function show($id)
    {
        $country = Country::find($id);

        return response()->json($country);
    }
}