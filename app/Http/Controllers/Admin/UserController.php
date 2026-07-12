<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    public function __construct(private readonly UserRepositoryInterface $users) {}

    public function index()
    {
        $items = $this->users->paginate(request('search'));

        return view('admin.users.index', compact('items'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
}
