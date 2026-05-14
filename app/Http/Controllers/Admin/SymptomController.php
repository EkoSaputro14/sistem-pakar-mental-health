<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSymptomRequest;
use App\Http\Requests\Admin\UpdateSymptomRequest;
use App\Models\Symptom;
use App\Repositories\Contracts\SymptomRepositoryInterface;

class SymptomController extends Controller
{
    public function __construct(private readonly SymptomRepositoryInterface $symptoms) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->symptoms->paginate(request('search'));

        return view('admin.symptoms.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.symptoms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSymptomRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = (bool) ($data['is_active'] ?? true);

        $this->symptoms->create($data);

        return redirect()->route('admin.symptoms.index')->with('success', 'Gejala berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $symptom = Symptom::findOrFail($id);

        return redirect()->route('admin.symptoms.edit', $symptom);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $symptom = Symptom::findOrFail($id);

        return view('admin.symptoms.edit', compact('symptom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSymptomRequest $request, string $id)
    {
        $symptom = Symptom::findOrFail($id);
        $data = $request->validated();
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $this->symptoms->update($symptom, $data);

        return redirect()->route('admin.symptoms.index')->with('success', 'Gejala berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $symptom = Symptom::findOrFail($id);
        $this->symptoms->delete($symptom);

        return redirect()->route('admin.symptoms.index')->with('success', 'Gejala berhasil dihapus.');
    }
}
