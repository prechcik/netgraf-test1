<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class APIController extends Controller
{

    public function add(Request $req) {
        $pet = new \stdClass();
        $pet->id = 0;
        $pet->name = $req->input('name');
        $pet->status = $req->input('status');
        $response = Http::withHeaders([
            'accept' => 'application/json'
        ])->post("https://petstore.swagger.io/v2/pet/", $pet);
        if ($response->status() == 404) return back()->with(['status' => 'Nie znaleziono rekordu o podanym numerze']);
        if ($response->status() == 400) return back()->with(['status' => 'Podany nr ID jest nieprawidłowy']);
        return back()->with(['status' => "Pomyślnie dodano rekord, ID: " . $response->json()["id"]]);
    }

    public function update(Request $req) {
        $pet = new \stdClass();
        $pet->id = $req->input('id');
        $pet->name = $req->input('name');
        $pet->status = $req->input('status');
        $response = Http::withHeaders([
            'accept' => 'application/json'
        ])->put("https://petstore.swagger.io/v2/pet/", $pet);
        if ($response->status() == 404) return back()->with(['status' => 'Nie znaleziono rekordu o podanym numerze']);
        if ($response->status() == 400) return back()->with(['status' => 'Podany nr ID jest nieprawidłowy']);
        return back()->with(['status' => "Pomyślnie zedytowano rekord"]);
    }

    public function get(Request $req) {
        $response = Http::withHeaders([
            'accept' => 'application/json'
            ])->get("https://petstore.swagger.io/v2/pet/" . $req->input('id'));
        if ($response->status() == 404) return back()->with(['status' => 'Nie znaleziono rekordu o podanym numerze']);
        if ($response->status() == 400) return back()->with(['status' => 'Podany nr ID jest nieprawidłowy']);
        return back()->with(['status' => "OK", 'response' => $response->json()]);
    }

    public function delete(Request $req) {
        $response = Http::withHeaders([
            'accept' => 'application/json'
            ])->delete("https://petstore.swagger.io/v2/pet/" . $req->input('id'));
        if ($response->status() == 404) return back()->with(['status' => 'Nie znaleziono rekordu o podanym numerze']);
        if ($response->status() == 400) return back()->with(['status' => 'Podany nr ID jest nieprawidłowy']);
        return back()->with(['status' => "Pomyślnie usunięto rekord"]);
    }

}
