<?php

namespace Webup\Helium\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Webup\Helium\Facades\Helium;
use Webup\Helium\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('helium-core::pages.user.index', [
            'users' => User::all(),
        ]);
    }

    public function create()
    {
        return view('helium-core::pages.user.create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('helium-core::pages.user.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique(config('helium-core.database.users-table'), 'email')],
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        User::create($data);

        return redirect()->route('helium-core::user.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'password' => [
                'sometimes',
                'nullable',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        if (Arr::has($data, 'password') && ($data['password'] == null || $data['password'] == '')) {
            unset($data['password']);
        }

        $user = User::findOrFail($id);
        $user->fill($data);
        $user->save();

        return redirect()->to(Helium::route('user.show', $user->id));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->to(Helium::route('user.index'));
    }
}
