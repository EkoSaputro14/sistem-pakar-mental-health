<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private readonly UserRepositoryInterface $users) {}

    public function index()
    {
        $items = $this->users->paginate(request('search'), request('role'));

        return view('admin.users.index', compact('items'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => ['required', 'in:admin,user'],
        ]);

        $this->users->update($user, $data);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }
}
