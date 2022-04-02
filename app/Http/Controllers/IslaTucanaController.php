<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IslaTucana;

class IslaTucanaController extends Controller
{
    public function index(){
        return view('isla-tucana.index');
    }
    public function newGame(){
        // $cards = IslaTucana::all();
        // return response()->json($cards);
        $cards = IslaTucana::all();
        $deck = [];
        foreach($cards as $typeOfCard){
            for($i=0; $i<$typeOfCard->quantity; $i++){
                array_push($deck, $typeOfCard->concept);
            }
        }
        shuffle($deck);
        return response()->json($deck);
    }
    public function getAllCards(){
    }
    public function shuffleAllCards(){
        $cards = IslaTucana::all();
        $deck = [];
        foreach($cards as $typeOfCard){
            for($i=0; $i<$typeOfCard->quantity; $i++){
                array_push($deck, $typeOfCard->concept);
            }
        }
        return $deck;
    }
}
