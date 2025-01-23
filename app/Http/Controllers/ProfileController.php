<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            $path = $request->file('profile_picture')->store('images', 'public');
            $validatedData['profile_picture'] = basename($path);
        } else {
            $validatedData['profile_picture'] = $request->user()->profile_picture;
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Convert birth_date to proper format
        if ($request->filled('birth_date')) {
            $validatedData['birth_date'] = Carbon::parse($request->birth_date)->toDateString();
        }

        // Add address fields
        $addressFields = ['address_line', 'city', 'state', 'postal_code', 'country'];
        foreach ($addressFields as $field) {
            if ($request->filled($field)) {
                $validatedData[$field] = $request->$field;
            }
        }

        $request->user()->fill($validatedData);
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
