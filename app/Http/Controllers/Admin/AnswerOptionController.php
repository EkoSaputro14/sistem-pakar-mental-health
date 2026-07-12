<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnswerOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerOptionController extends Controller
{
    public function index()
    {
        $items = AnswerOption::query()->orderBy('sort_order')->orderBy('value')->get();

        return view('admin.answer-options.index', compact('items'));
    }

    public function create()
    {
        return view('admin.answer-options.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label' => ['required', 'string', 'max:255'],
            'value' => ['required', 'numeric', 'min:0', 'max:1'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ], [
            'label.required' => 'Label wajib diisi.',
            'value.required' => 'Nilai CF wajib diisi.',
            'value.min' => 'Nilai CF minimal 0.',
            'value.max' => 'Nilai CF maksimal 1.',
            'sort_order.required' => 'Urutan wajib diisi.',
        ]);

        $data = $validator->validated();
        $data['is_active'] = (bool) ($data['is_active'] ?? true);

        AnswerOption::create($data);

        return redirect()->route('admin.answer-options.index')->with('success', 'Opsi jawaban berhasil ditambahkan.');
    }

    public function edit(AnswerOption $answerOption)
    {
        return view('admin.answer-options.edit', ['item' => $answerOption]);
    }

    public function update(Request $request, AnswerOption $answerOption)
    {
        $validator = Validator::make($request->all(), [
            'label' => ['required', 'string', 'max:255'],
            'value' => ['required', 'numeric', 'min:0', 'max:1'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ], [
            'label.required' => 'Label wajib diisi.',
            'value.required' => 'Nilai CF wajib diisi.',
            'value.min' => 'Nilai CF minimal 0.',
            'value.max' => 'Nilai CF maksimal 1.',
            'sort_order.required' => 'Urutan wajib diisi.',
        ]);

        $data = $validator->validated();
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $answerOption->update($data);

        return redirect()->route('admin.answer-options.index')->with('success', 'Opsi jawaban berhasil diperbarui.');
    }

    public function destroy(AnswerOption $answerOption)
    {
        $answerOption->delete();

        return redirect()->route('admin.answer-options.index')->with('success', 'Opsi jawaban berhasil dihapus.');
    }
}
