<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    /**
     * Set the application locale and store in session
     */
    public function set(Request $request, $locale)
    {
        // Validate locale
        if (in_array($locale, ['en', 'id'])) {
            // Store in session
            session(['locale' => $locale]);
            
            // Set for current request
            App::setLocale($locale);
        }

        // Get the previous URL or default to home
        $previousUrl = url()->previous();
        
        // Redirect back to the previous page
        return redirect($previousUrl);
    }
}
