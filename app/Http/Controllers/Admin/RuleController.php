<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRuleRequest;
use App\Http\Requests\Admin\UpdateRuleRequest;
use App\Models\Depression;
use App\Models\Rule;
use App\Models\Symptom;
use App\Repositories\Contracts\RuleRepositoryInterface;

class RuleController extends Controller
{
    public function __construct(private readonly RuleRepositoryInterface $rules) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->rules->paginate(request('search'));

        return view('admin.rules.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $depressions = Depression::query()->orderBy('code')->get();
        $symptoms = Symptom::query()->orderBy('code')->get();

        return view('admin.rules.create', compact('depressions', 'symptoms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRuleRequest $request)
    {
        $data = $request->validated();

        $exists = Rule::query()
            ->where('depression_id', $data['depression_id'])
            ->where('symptom_id', $data['symptom_id'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['symptom_id' => 'Rule untuk kombinasi ini sudah ada.'])->withInput();
        }

        $this->rules->create($data);

        return redirect()->route('admin.rules.index')->with('success', 'Rule berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rule = Rule::findOrFail($id);

        return redirect()->route('admin.rules.edit', $rule);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rule = Rule::query()->with(['depression', 'symptom'])->findOrFail($id);
        $depressions = Depression::query()->orderBy('code')->get();
        $symptoms = Symptom::query()->orderBy('code')->get();

        return view('admin.rules.edit', compact('rule', 'depressions', 'symptoms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRuleRequest $request, string $id)
    {
        $rule = Rule::findOrFail($id);
        $data = $request->validated();

        $exists = Rule::query()
            ->where('depression_id', $data['depression_id'])
            ->where('symptom_id', $data['symptom_id'])
            ->where('id', '!=', $rule->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['symptom_id' => 'Rule untuk kombinasi ini sudah ada.'])->withInput();
        }

        $this->rules->update($rule, $data);

        return redirect()->route('admin.rules.index')->with('success', 'Rule berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rule = Rule::findOrFail($id);
        $this->rules->delete($rule);

        return redirect()->route('admin.rules.index')->with('success', 'Rule berhasil dihapus.');
    }
}
