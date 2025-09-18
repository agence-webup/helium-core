<?php

namespace Webup\Helium\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Webup\Helium\Facades\HeliumCore;

class UserController extends Controller
{
    public function index()
    {
        $class = HeliumCore::userClass();

        return view('helium-core::pages.user.index', [
            'users' => $class::all(),
        ]);
    }

    public function create()
    {
        return view('helium-core::pages.user.create');
    }

    public function edit($id)
    {
        $class = HeliumCore::userClass();
        $user = $class::findOrFail($id);

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

        $class = HeliumCore::userClass();
        $class::create($data);

        return redirect()->to(HeliumCore::route('user.index'));
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

        $class = HeliumCore::userClass();
        $user = $class::findOrFail($id);

        $user->fill($data);
        $user->save();

        return redirect()->to(HeliumCore::route('user.show', $user->id));
    }

    public function destroy($id)
    {
        $class = HeliumCore::userClass();
        $class::findOrFail($id)->delete();

        return redirect()->to(HeliumCore::route('user.index'));
    }
}
