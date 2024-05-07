<?php



namespace App;




use Illuminate\Support\Facades\Http;

Class VkService {
    public function callApi($id) {
        $response = Http::get(config('services.vk.url'). 'wall.get', [
            'owner_id' => $id,
            'access_token' => config('services.vk.token'),
            'v' => config('services.vk.version'),
            'fields' => 'items'
        ]);
        dd($response->json());
    }
}
