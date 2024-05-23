<?php

namespace App\Helpers;
use GuzzleHttp\Client;

final class ImgurHelper
{
  public final static function uploadToImgur($uploadedFile,$clientID)
  {
  
      // Create a new GuzzleHTTP client instance
      $client = new Client();
  
      try {
          // Send a POST request to Imgur API endpoint
          $response = $client->post('https://api.imgur.com/3/image', [
              'headers' => [
                  'Authorization' => 'Client-ID 3911c9c09922e68', // Replace with your Imgur client ID
              ],
              'multipart' => [
                  [
                      'name' => 'image',
                      'contents' => fopen($uploadedFile, 'r'), // Open the file for reading
                  ],
              ],
          ]);
  
          // Decode the JSON response
          $data = json_decode($response->getBody(), true);
  
          // Get the URL of the uploaded image
          $imageUrl = $data['data']['link'];
  
          // Do something with the $imageUrl, such as save it to your database
          // Or return it as a response
          return $data;
          // return response()->json(['imageUrl' => $imageUrl]);
      } catch (\Exception $e) {
          // Handle any errors
          return response()->json(['error' => $e->getMessage()], 500);
      }
  }

  public final static function curl_upload_img($image, $title, $client_id)
  {

    $curl_post_array = [
      'image' => $image,
      'title' => $title,
    ];
    $timeout = 30;

    $url = 'https://api.imgur.com/3/image.json';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_array);
    $curl_result = curl_exec($curl);
    curl_close($curl);
    $output = json_decode($curl_result, true);

    return $output;
  }
  public final static function curl_remove_img($imageDeleteHash, $client_id)
  {


    $url = "https://api.imgur.com/3/image/{$imageDeleteHash}";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $curl_result = curl_exec($curl);
    // $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $output = json_decode($curl_result, true);
    curl_close($curl);

    return $output;
  }
}
