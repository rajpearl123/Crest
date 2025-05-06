<?php 

namespace App\Helpers;

class InstagramPosts {
    public static function fetchInstagramPosts()
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
                "x-rapidapi-key: a47946e639msh6ca2e0f8df7ee16p17e064jsnb1f141613be3"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return ['error' => "cURL Error: " . $err];
        }

        $data = json_decode($response, true);

        if (!isset($data['items']) || !is_array($data['items'])) {
            return [];
        }
    
        
        // Extract images
        $posts = array_map(function ($post) {
            return [
                'image_url' => $post['image_versions2']['candidates'][0]['url'] ?? null
            ];
        }, $data['items']);
    
        // Filter out null values
        $posts = array_filter($posts, function ($post) {
            return !empty($post['image_url']);
        });
    
        // Shuffle the posts to get random images each time
        shuffle($posts);
    
        // Return only 6 posts
        return array_slice($posts, 0, 6);
    }

}