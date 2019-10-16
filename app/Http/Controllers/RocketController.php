<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Rocket;

//Rocket Controller
class RocketController extends Controller
{
    //TODO function that can be called to consume api based on the given link to avoid duplicate code
    
    //Function that consumes api using GuzzleHttp
    public function getAll(){
        $client = new Client();
        //Create a get request
        $response = $client->request('GET', 'https://api.spacexdata.com/v3/rockets?filter=rocket_id,rocket_name,country,flickr_images');
        //The body of the get request
        $body = $response->getBody()->getContents();
        //Decode the GET Request body into JSON
        $rockets = json_decode($body, true);
        return $rockets;
    }

    public function get(Request $request){
        $id = $request->id;
        $client = new Client();
        //Create a get request
        $response = $client->request('GET', 'https://api.spacexdata.com/v3/rockets/' . $id . "?filter=rocket_id,rocket_name,rocket_type,description,cost_per_launch,active,first_flight,country,flickr_images");
        //The body of the get request
        $body = $response->getBody()->getContents();
        //Decode the GET Request body into JSON
        $rockets = json_decode($body, true);
        return $rockets;
    }

    public function search(Request $request)
    {
        //Searched query made by the user
        $search_query = $request->search_query;

        $client = new Client();
        //Create a get request
        $response = $client->request('GET', 'https://api.spacexdata.com/v3/rockets?filter=rocket_id,rocket_name,rocket_type,description,cost_per_launch,active,first_flight,country,flickr_images');
        //The body of the get request
        $body = $response->getBody()->getContents();
        //Decode the GET Request body into JSON
        $rockets = json_decode($body, true);
        //Array containing the resulted rockets after the search
        $results = array();

        //Iterating over all rockets
        foreach($rockets as $rocket)
        {
            //Iterating over all parameters of one rocket
            foreach($rocket as $key => $value)
            {
                //choosing the parameters in which to search (any given parameter can be added)
                if($key == 'rocket_name' || $key == 'country')
                {
                    if (stripos($value, $search_query) !== false) 
                    {
                        array_push($results,$rocket);
                        break;
                    }
                }   
            }
        }

        //Return the array with the resulted rockets
        return $results;
    }
}
