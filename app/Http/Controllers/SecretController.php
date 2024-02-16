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
        // Validate.
        $this->validate($request, [
            'secret' => 'nullable|string',
            'file'   => 'nullable',
            'file.*' => 'mimes:jpeg,jpg,gif,png,bmp,tif,tiff,doc,docx,xls,xlsx,ppt,pptx,txt,csv,psv,pdf,zip,7z,rar|max:10000'
        ]);

        // Create a new Secret.
        $secret = new Secret();

        // Add secret info.
        $secret->slug = Str::random(32);
        $secret->expires_at = Carbon::parse($request->expires ?: '+1 hour');

        // Add text secret.
        if ($request->secret) {
            $secret->secret = encrypt($request->secret);
        }

        // Add file data.
        if (($file = $request->file('file')) && $request->file('file')->isValid()) {
            $secret->file_name      = $file->getClientOriginalName();
            $secret->file_size      = $file->getSize();
            $secret->file_extension = $file->extension();
            $secret->file_mime      = $file->getClientMimeType();
            $secret->file_contents  = Crypt::encrypt(file_get_contents($file->path()));
        }

        // Done.
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
