<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;


class UserController extends Controller
{

    public function toggleAdmin(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return redirect()->route('users.index')->with('status', 'User role updated successfully!');
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birth_date' => ['nullable', 'date', 'before_or_equal:' . now()->toDateString()],
            'role' => ['nullable', 'in:user,admin'],
            'address_line' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
        ]);

        $birth_date = Carbon::createFromDate(
            $request->birth_date,
        );
        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'birth_date' => $birth_date,
                'role' => $request->role,
                'address_line' => $request->address_line,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
        ]);
            event(new Registered($user));

        return Redirect::route('users.index')->with('status', 'user added successfully!');
    }
    public function edit(User $user)
    {
        if (auth()->user()->role !== 'admin' && auth()->id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin' && auth()->id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name'                => ['required', 'string', 'max:255'],
            'email'               => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'birth_date'          => ['nullable', 'date', 'before_or_equal:' . now()->toDateString()],
            'about_me'            => ['nullable', 'string'],
            'profile_picture'     => ['nullable', 'image', 'max:2048'],
            'address_line'        => ['required', 'string', 'max:255'],
            'city'                => ['required', 'string', 'max:100'],
            'state'               => ['nullable', 'string', 'max:100'],
            'postal_code'         => ['required', 'string', 'max:20'],
            'country'             => ['required', 'string', 'max:100'],
            'password'            => ['nullable', 'confirmed', 'min:8'], // Add password validation
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->birth_date = $request->birth_date;
        $user->about_me = $request->about_me;

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('images', 'public');
            $user->profile_picture = basename($path);
        }

        $user->address_line = $request->address_line;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->postal_code = $request->postal_code;
        $user->country = $request->country;

        // Update the password only if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.show', $user->id)
                        ->with('status', 'Profile updated successfully!');
    }

    public function destroy(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('status', 'User deleted successfully!');
    }

}
