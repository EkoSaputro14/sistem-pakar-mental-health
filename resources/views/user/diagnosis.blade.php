<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Panduan Skrining</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Diagnosis Depresi
                </h2>
            </div>
            <div class="inline-flex items-center gap-2 rounded-full border border-teal-100 bg-teal-50 px-4 py-2 text-sm font-semibold text-teal-700 dark:border-teal-400/20 dark:bg-teal-400/10 dark:text-teal-200">
                <i data-lucide="list-checks" class="h-4 w-4"></i>
                {{ $symptoms->count() }} gejala
            </div>
        </div>
    </x-slot>

    @php
        $symptomSteps = $symptoms->values()->map(fn ($symptom) => [
            'id' => (string) $symptom->id,
            'code' => $symptom->code,
            'question' => $symptom->question,
        ]);

        $initialAnswers = collect(old('answers', []))
            ->mapWithKeys(fn ($value, $key) => [(string) $key => (string) $value])
            ->all();
    @endphp

    <div
        x-data="{
            step: 'identitas',
            current: 0,
            symptoms: @js($symptomSteps),
            answers: @js($initialAnswers),
            get total() { return this.symptoms.length },
            get answered() { return Object.keys(this.answers).filter((key) => this.answers[key] !== '').length },
            get progress() { return this.total ? Math.round((this.answered / this.total) * 100) : 0 },
            get currentSymptom() { return this.symptoms[this.current] || {} },
            next() { if (this.current < this.total - 1) this.current++ },
            previous() { if (this.current > 0) this.current-- },
        }"
        class="py-6 sm:py-10"
    >
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('user.diagnosis.submit') }}" class="space-y-6">
                @csrf

                <!-- Step 1: Identitas -->
                <section x-show="step === 'identitas'" x-transition.opacity.duration.250ms class="rounded-[2rem] border border-white/70 bg-white/75 p-5 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-7">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-teal-50 text-teal-600 dark:bg-teal-500/10 dark:text-teal-400">
                            <i data-lucide="user" class="h-6 w-6"></i>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Langkah 1 dari 2</p>
                            <h3 class="text-2xl font-bold tracking-tight text-slate-950 dark:text-white">Identitas Mahasiswa</h3>
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                            <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full" :value="old('tanggal_lahir')" required />
                            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="semester" value="Semester" />
                            <select id="semester" name="semester" class="mt-1 block w-full rounded-xl border-slate-200 bg-white/70 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-slate-900/50 dark:text-slate-200" required>
                                <option value="">-- Pilih Semester --</option>
                                @for ($i = 1; $i <= 14; $i++)
                                    <option value="{{ $i }}" @selected(old('semester') == $i)>Semester {{ $i }}</option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="tahun_angkatan" value="Tahun Angkatan" />
                            <select id="tahun_angkatan" name="tahun_angkatan" class="mt-1 block w-full rounded-xl border-slate-200 bg-white/70 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-slate-900/50 dark:text-slate-200" required>
                                <option value="">-- Pilih Tahun --</option>
                                @for ($y = date('Y'); $y >= 2015; $y--)
                                    <option value="{{ $y }}" @selected(old('tahun_angkatan') == $y)>{{ $y }}</option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('tahun_angkatan')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="prodi" value="Program Studi" />
                            <x-text-input id="prodi" name="prodi" type="text" class="mt-1 block w-full" :value="old('prodi')" placeholder="Contoh: Teknik Informatika" required />
                            <x-input-error :messages="$errors->get('prodi')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="button" x-on:click="step = 'questions'" class="inline-flex items-center justify-center gap-2 rounded-full bg-teal-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700">
                            Lanjut ke Pertanyaan
                            <i data-lucide="arrow-right" class="h-4 w-4"></i>
                        </button>
                    </div>
                </section>

                <!-- Step 2: Pertanyaan Diagnosis -->
                <div x-show="step === 'questions'" x-transition.opacity.duration.250ms>

                <section class="rounded-[2rem] border border-white/70 bg-white/75 p-5 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-7">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Pertanyaan <span x-text="current + 1"></span> dari <span x-text="total"></span></p>
                            <h3 class="mt-2 text-2xl font-bold tracking-tight text-slate-950 dark:text-white" x-text="currentSymptom.question"></h3>
                            <p class="mt-2 text-sm font-semibold text-teal-700 dark:text-teal-300" x-text="currentSymptom.code"></p>
                        </div>

                        <div class="w-full lg:w-72">
                            <div class="flex items-center justify-between text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                <span>Progress</span>
                                <span x-text="progress + '%'"></span>
                            </div>
                            <div class="mt-3 h-3 overflow-hidden rounded-full bg-slate-200/80 dark:bg-white/10">
                                <div class="h-full rounded-full bg-gradient-to-r from-teal-500 via-sky-400 to-indigo-400 transition-all duration-700 ease-out" :style="`width: ${progress}%`"></div>
                            </div>
                        </div>
                    </div>

                    @error('answers')
                        <div class="mt-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700 dark:border-rose-400/20 dark:bg-rose-500/10 dark:text-rose-200">
                            {{ $message }}
                        </div>
                    @enderror
                </section>

                <section class="rounded-[2rem] border border-white/70 bg-white/75 p-5 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-7">
                    @foreach ($symptoms as $index => $symptom)
                        <div x-show="current === {{ $index }}" x-transition.opacity.duration.250ms>
                            <div class="grid gap-3 sm:grid-cols-2">
                                @foreach ($answerOptions as $opt)
                                    @php
                                        $old = old('answers.'.$symptom->id);
                                        $selected = ((string) $old !== '' ? (float) $old : null) === (float) $opt['value'];
                                        $v = (float) $opt['value'];
                                        $tone = match (true) {
                                            $v <= 0.0 => 'peer-checked:from-emerald-50 peer-checked:to-teal-50 peer-checked:text-emerald-700 dark:peer-checked:from-emerald-400/10 dark:peer-checked:to-teal-400/10 dark:peer-checked:text-emerald-200',
                                            $v <= 0.3 => 'peer-checked:from-sky-50 peer-checked:to-cyan-50 peer-checked:text-sky-700 dark:peer-checked:from-sky-400/10 dark:peer-checked:to-cyan-400/10 dark:peer-checked:text-sky-200',
                                            $v <= 0.6 => 'peer-checked:from-amber-50 peer-checked:to-orange-50 peer-checked:text-amber-700 dark:peer-checked:from-amber-400/10 dark:peer-checked:to-orange-400/10 dark:peer-checked:text-amber-200',
                                            default => 'peer-checked:from-rose-50 peer-checked:to-pink-50 peer-checked:text-rose-700 dark:peer-checked:from-rose-400/10 dark:peer-checked:to-pink-400/10 dark:peer-checked:text-rose-200',
                                        };
                                        $icon = match (true) {
                                            $v <= 0.0 => 'smile',
                                            $v <= 0.3 => 'cloud-sun',
                                            $v <= 0.6 => 'cloud-rain',
                                            default => 'cloud-lightning',
                                        };
                                    @endphp
                                    <label class="group cursor-pointer">
                                        <input
                                            type="radio"
                                            name="answers[{{ $symptom->id }}]"
                                            value="{{ $opt['value'] }}"
                                            class="peer sr-only"
                                            x-model="answers['{{ $symptom->id }}']"
                                            @checked($selected)
                                        >
                                        <span class="flex min-h-28 items-center gap-4 rounded-[1.5rem] border border-slate-200 bg-white/80 p-4 text-slate-700 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-teal-200 hover:shadow-lg peer-checked:border-teal-400 peer-checked:bg-gradient-to-br {{ $tone }} peer-checked:shadow-lg peer-focus-visible:ring-2 peer-focus-visible:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:border-teal-300/40">
                                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-slate-100 text-slate-500 transition group-hover:bg-teal-50 group-hover:text-teal-700 peer-checked:bg-white/80 dark:bg-white/10 dark:text-slate-300">
                                                <i data-lucide="{{ $icon }}" class="h-5 w-5"></i>
                                            </span>
                                            <span>
                                                <span class="block text-base font-bold">{{ $opt['label'] }}</span>
                                            </span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </section>

                <section class="flex flex-col-reverse gap-3 rounded-[2rem] border border-white/70 bg-white/75 p-4 shadow-lg shadow-slate-200/40 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:flex-row sm:items-center sm:justify-between">
                    <button type="button" x-on:click="step = 'identitas'" class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white/80 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-white dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                        <i data-lucide="arrow-left" class="h-4 w-4"></i>
                        Ubah Identitas
                    </button>

                    <div class="flex gap-3">
                        <button type="button" x-on:click="previous()" x-bind:disabled="current === 0" class="inline-flex flex-1 items-center justify-center gap-2 rounded-full border border-slate-200 bg-white/80 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-white disabled:cursor-not-allowed disabled:opacity-40 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10 sm:flex-none">
                            <i data-lucide="arrow-left" class="h-4 w-4"></i>
                            Sebelumnya
                        </button>
                        <button type="button" x-show="current < total - 1" x-on:click="next()" class="inline-flex flex-1 items-center justify-center gap-2 rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-teal-700 dark:bg-white dark:text-slate-950 dark:hover:bg-teal-100 sm:flex-none">
                            Lanjut
                            <i data-lucide="arrow-right" class="h-4 w-4"></i>
                        </button>
                        <button type="submit" x-show="current === total - 1" class="inline-flex flex-1 items-center justify-center gap-2 rounded-full bg-teal-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700 sm:flex-none">
                            Hitung Diagnosis
                            <i data-lucide="sparkles" class="h-4 w-4"></i>
                        </button>
                    </div>
                </section>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>
