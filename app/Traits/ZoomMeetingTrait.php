<?php
namespace App\Traits;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * trait ZoomMeetingTrait
 */
trait ZoomMeetingTrait
{
    public $client;
    public $jwt;
    public $headers;

    public function __construct()
    {
        $this->client = new Client();
        $this->jwt = $this->generateZoomToken();
        $this->headers = [

            'Authorization' => 'Bearer'. $this->getZoomAccessToken(),
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ];
    }
    public function generateZoomToken()
    {
        $key    = config('app.zoom_api_key');
        $secret = config('app.zoom_api_secret');
        $payload = [
            'iss' => $key,
            'exp' => strtotime('+1 minute'),
        ];

        return JWT::encode($payload, $secret, 'HS256');
    }
    function getZoomAccessToken() {
        $secret = config('app.zoom_api_secret');
        $payload = array(
            "iss" => config('app.zoom_api_key'),
            'exp' => time() + 3600,
        );
        // return JWT::encode($payload, $key);
        return JWT::encode($payload, $secret, 'HS256');    
    }
   
    private function retrieveZoomUrl()
    {
        return config('app.zoom_api_url');
    }

    public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);

            return $date->format('Y-m-d\TH:i:s');
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : '.$e->getMessage());

            return '';
        }
    }

    public function create($data)
    {
        try {
            $path = 'users/me/meetings';
            $url  = $this->retrieveZoomUrl();
            $body = [
                'headers' => $this->headers,
                'body'    => json_encode([
                    'topic'      => $data['topic'],
                    'type'       => self::MEETING_TYPE_SCHEDULE,
                    'start_time' => $this->toZoomTimeFormat($data['start_time']),
                    'duration'   => $data['duration'],
                    'agenda'     => (! empty($data['agenda'])) ? $data['agenda'] : null,
                    'timezone'     => $data["time_zone"],
                    'settings'   => [
                        'host_video'        => ($data['host_video'] == "1") ? true : false,
                        'participant_video' => ($data['participant_video'] == "1") ? true : false,
                        'waiting_room'      => true,
                    ],
                ]),
            ];
    
            $response =  $this->client->post($url.$path, $body);
    
            return [
                'success' => $response->getStatusCode() === 201,
                'data'    => json_decode($response->getBody(), true),
            ];
        } catch (GuzzleException $ex) {
            Log::error('ZoomJWT->create : '.$ex->getMessage());

            return $ex->getMessage();
        }
       
    }

    public function update($id, $data)
    {
        $path = 'meetings/'.$id;
        $url = $this->retrieveZoomUrl();

        $body = [
            'headers' => $this->headers,
            'body'    => json_encode([
                'topic'      => $data['topic'],
                'type'       => self::MEETING_TYPE_SCHEDULE,
                'start_time' => $this->toZoomTimeFormat($data['start_time']),
                'duration'   => $data['duration'],
                'agenda'     => (! empty($data['agenda'])) ? $data['agenda'] : null,
                'timezone'     => $data['time_zone'],
                'settings'   => [
                    'host_video'        => ($data['host_video'] == "1") ? true : false,
                    'participant_video' => ($data['participant_video'] == "1") ? true : false,
                    'waiting_room'      => true,
                ],
            ]),
        ];
        $response =  $this->client->patch($url.$path, $body);

        return [
            'success' => $response->getStatusCode() === 204,
            'data'    => json_decode($response->getBody(), true),
        ];
    }

    public function get($id)
    {
        $path = 'meetings/'.$id;
        $url = $this->retrieveZoomUrl();
        $this->jwt = $this->generateZoomToken();
        $body = [
            'headers' => $this->headers,
            'body'    => json_encode([]),
        ];

        $response =  $this->client->get($url.$path, $body);

        return [
            'success' => $response->getStatusCode() === 204,
            'data'    => json_decode($response->getBody(), true),
        ];
    }

    /**
     * @param string $id
     * 
     * @return bool[]
     */
    public function delete($id)
    {
        try {
            $path = 'meetings/'.$id;
            $url = $this->retrieveZoomUrl();
            $body = [
                'headers' => $this->headers,
                'body'    => json_encode([]),
            ];

            $response =  $this->client->delete($url.$path, $body);
            
            return [
                'success' => $response->getStatusCode() === 204,
            ];
            
        } catch (\Exception $ex) {
            return [
                'success' => false,
                'message' => 'Oops! Something went wrong.'
            ];
        }
    }
}