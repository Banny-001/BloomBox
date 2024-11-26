<?php

namespace App\Http\Controllers;
use App\Models\SpecialOccassion;
use Illuminate\Http\Request;

class SpecialOccassionController extends Controller
{
    public function productsBySpecialOccasion ($SpecialOccasionId)
    {
        $SpecialOccasion = SpecialOccassion ::find($SpecialOccasionId);

        if (!$SpecialOccasion ) {
            return response()->json(['message' => 'Occasion not found'], 404);
        }

        $products = $SpecialOccasion ->products;

        return response()->json($products);
    }
}
