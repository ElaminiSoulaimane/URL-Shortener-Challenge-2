<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Url;

class UrlController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'long_url' => 'required|url|max:900|min:5',
            ]);

            $longUrl = $request->input('long_url');
            $shortUrl = Str::random(5);
            $url = Url::create([
                'long_url' => $longUrl,
                'short_url' => $shortUrl,
                'click_count' => 0,
            ]);

            return response()->json($url, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Duplicate entry error. The record already exists.'], 422);
        }
    }


    public function index()
    {
        $urls = Url::all();

        return response()->json($urls);
    }

    public function redirectShortUrl($short_url)
    {
        $url = Url::where('short_url', $short_url)->first();
        if ($url) {
            $url->increment('click_count');
            return redirect($url->long_url);
        }
        abort(404);
    }
}
