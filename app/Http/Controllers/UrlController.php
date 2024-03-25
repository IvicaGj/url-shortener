<?php

namespace App\Http\Controllers;

use App\Models\ShortenedUrl;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UrlController extends Controller
{
    public function index()
    {
        dd(ShortenedUrl::all());
        return view('url.index');
    }

    public function shortenUrl(Request $request)
    {
        $request->validate([
            'url' => ['required', 'url', Rule::unique('shortened_urls', 'original_url')],
        ]);

        $url = $request->url;
        $hash = hash('crc32b', $url);
        $shortenedUri = url("/$hash");
        
        $shortenedUrl = ShortenedUrl::where('original_url', $url)->first();
        
        if (!$shortenedUrl) {
            $shortenedUrl = ShortenedUrl::create([
                'original_url' => $url,
                'shortened_url' => $shortenedUri
            ]);
        }
        
        return response()->json([
            'shortenedUrl' => $shortenedUri
        ]);
    }

    public function serveShortenedUrl(Request $request)
    {
        $shortenedUrl = ShortenedUrl::where('shortened_url', url("/$request->hash"))->first();

        if (!$shortenedUrl) {
            return abort(404);
        }

        $shortenedUrl->increment('visits');

        return redirect($shortenedUrl->original_url);
    }
}
