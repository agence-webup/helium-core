<?php

namespace App\Http\Controllers\Helium;

use App\Models\Helium\HeliumUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return view('helium-core::pages.user.index');
    }

    public function show($id)
    {
        $user = HeliumUser::findOrFail($id);
        return view('helium-core::pages.user.show', compact('user'));
    }

    public function create()
    {
        return view('helium-core::pages.user.create');
    }

    public function edit($id)
    {
        $user = HeliumUser::findOrFail($id);
        return view('helium-core::pages.user.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:helium_users,email',
        ]);

        $data['password'] = bcrypt(Str::random(16));
        HeliumUser::create($data);

        return redirect()->route('helium::user.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = HeliumUser::findOrFail($id);
        $user->update($data);
        $user->save();

        return redirect()->route('helium::user.show', $user->id);
    }

    public function destroy($id)
    {
        HeliumUser::findOrFail($id)->delete();

        return redirect()->route('helium::user.index');
    }
}
