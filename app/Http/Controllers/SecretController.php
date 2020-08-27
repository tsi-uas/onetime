<?php

namespace App\Http\Controllers;

use DB;
use Str;
use Carbon\Carbon;
use App\Models\Secret;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SecretController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the form for creating a secret.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Store a secret and show the user the URL for it.
     *
     * @param Request $request
     *
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Store the secret.
        $secret = new Secret();
        $secret->slug = Str::random(32);
        $secret->secret = encrypt($request->secret);
        $secret->expires_at = Carbon::parse($request->expires ?: '+1 hour');
        $secret->save();

        // Show the user the secret URL.
        return view('stored', compact('secret'));
    }

    /**
     * Show the user a secret and destroy it.
     *
     * @param Secret $secret
     *
     * @return Renderable
     */
    public function show(Secret $secret)
    {
        // Delete the secret.
        $secret->delete();

        // Show it to the user.
        return view('show', compact('secret'));
    }

    /**
     * Destroy the secret without showing it.
     *
     * @param Secret $secret
     *
     * @return Renderable
     */
    public function destroy(Secret $secret)
    {
        // Delete the secret.
        $secret->delete();

        // Show it to the user.
        return view('destroyed');
    }
}
