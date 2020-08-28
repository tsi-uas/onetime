<?php

namespace App\Http\Controllers;

use DB;
use Str;
use Carbon\Carbon;
use App\Models\Secret;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
     * Show the user the basic secret page.
     *
     * @param Secret $secret
     *
     * @return Renderable
     */
    public function show(Secret $secret)
    {
        // Show it to the user.
        return view('show', compact('secret'));
    }

    /**
     * Delete the secret and show it to the user for real. This is so things
     * like Slack's auto URL preview functionality doesn't destroy the secret
     * befor the user actually clicks the link.
     *
     * @param Secret $secret
     *
     * @return string
     */
    public function load(Secret $secret)
    {
        // Delete the secret.
        $secret->delete();

        // Show it to the user.
        return view('load', compact('secret'))->render();
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
