<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
class InstagramController extends Controller
{
    public function fetchInstagramPosts()
    {
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://instagram-scrapper-posts-reels-stories-downloader.p.rapidapi.com/posts_by_user_id?user_id=59733027635",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: instagram-scrapper-posts-reels-stories-downloader.p.rapidapi.com",
                "x-rapidapi-key: a8189e9965msh527539f31026b84p1fafbdjsn7d89dddf46aa"
            ],
        ]);
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    
        if ($err) {
            return ['error' => "cURL Error: " . $err];
        }
    
        $data = json_decode($response, true);
    
        // Return only the images to your frontend
        return collect($data['items'] ?? [])->map(function ($item) {
            return [
                'proxy_url' => url('/proxy-image?url=' . urlencode($item['image_versions2']['candidates'][0]['url'] ?? '')),
            ];
        })->toArray();
    }

}
