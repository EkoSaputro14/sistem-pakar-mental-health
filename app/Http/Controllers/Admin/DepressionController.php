<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDepressionRequest;
use App\Http\Requests\Admin\UpdateDepressionRequest;
use App\Models\Depression;
use App\Repositories\Contracts\DepressionRepositoryInterface;

class DepressionController extends Controller
{
    public function __construct(private readonly DepressionRepositoryInterface $depressions) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->depressions->paginate(request('search'));

        return view('admin.depressions.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.depressions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepressionRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = (bool) ($data['is_active'] ?? true);

        $this->depressions->create($data);

        return redirect()->route('admin.depressions.index')->with('success', 'Kategori depresi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $depression = Depression::findOrFail($id);

        return redirect()->route('admin.depressions.edit', $depression);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $depression = Depression::findOrFail($id);

        return view('admin.depressions.edit', compact('depression'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepressionRequest $request, string $id)
    {
        $depression = Depression::findOrFail($id);
        $data = $request->validated();
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $this->depressions->update($depression, $data);

        return redirect()->route('admin.depressions.index')->with('success', 'Kategori depresi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $depression = Depression::findOrFail($id);
        $this->depressions->delete($depression);

        return redirect()->route('admin.depressions.index')->with('success', 'Kategori depresi berhasil dihapus.');
    }
}
