<?php

namespace App\Http\Controllers\Sanctum;

use App\Assets\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalController as Controller;
use App\Transformers\Tokens\TokensTransformer;

class TokensController extends Controller
{ 
    use Device;

    public function __construct()
    {
        parent::__construct();        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tokens = $request->user()->tokens;
        return $this->showAll($tokens, TokensTransformer::class, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->user()->createToken($this->setTokenName($request));

        return response()->json(['token' => 'Bearer ' . $token->plainTextToken], 201);
    }

   
    public function destroyAllTokens(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['data' => [
            'message' => 'Los Tokens fueron revocados.'
        ]], 200);
    }


    public function destroy(Request $request, $id)
    {
        $token = $request->user()->tokens()->where('id', $id)->first();

        $token->delete();

        return response()->json(['data' => [
            'message' => 'El token ha sido revocado.'
        ]], 200);
    }
}