<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRecommendationRequest;
use App\Http\Requests\Admin\UpdateRecommendationRequest;
use App\Models\Depression;
use App\Models\Recommendation;
use App\Repositories\Contracts\RecommendationRepositoryInterface;

class RecommendationController extends Controller
{
    public function __construct(private readonly RecommendationRepositoryInterface $recommendations) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->recommendations->paginate(request('search'));

        return view('admin.recommendations.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $depressions = Depression::query()->orderBy('code')->get();

        return view('admin.recommendations.create', compact('depressions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecommendationRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = (bool) ($data['is_active'] ?? true);

        $this->recommendations->create($data);

        return redirect()->route('admin.recommendations.index')->with('success', 'Rekomendasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recommendation = Recommendation::findOrFail($id);

        return redirect()->route('admin.recommendations.edit', $recommendation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recommendation = Recommendation::findOrFail($id);
        $depressions = Depression::query()->orderBy('code')->get();

        return view('admin.recommendations.edit', compact('recommendation', 'depressions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecommendationRequest $request, string $id)
    {
        $recommendation = Recommendation::findOrFail($id);
        $data = $request->validated();
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $this->recommendations->update($recommendation, $data);

        return redirect()->route('admin.recommendations.index')->with('success', 'Rekomendasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recommendation = Recommendation::findOrFail($id);
        $this->recommendations->delete($recommendation);

        return redirect()->route('admin.recommendations.index')->with('success', 'Rekomendasi berhasil dihapus.');
    }
}
