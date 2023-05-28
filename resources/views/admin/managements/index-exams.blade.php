<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Exams Management') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
            <div class="col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">


                    <div id="delete-toast" class="delete-toast"></div>


                        <!-- Main content -->
                    <form id="submitForm" class="max-w-7xl mx-auto p-6" method="POST" action="{{ route('exam.store') }}">

                            @csrf

                            <!-- Title -->
                        <div class="mt-4">
                            <x-input-label for="exam_title" :value="__('Title')" />
                            <x-text-input id="exam_title" class="block mt-1 w-full" type="text" name="exam_title" :value="old('exam_title')" required autofocus autocomplete="exam_title" />
                            <x-input-error :messages="$errors->get('exam_title')" class="mt-2" />
                        </div>

                        <!-- Subject  -->
                        <div class="mt-4">
                            <x-input-label for="subject_name" :value="__('Subject')" />

                            <select id="subject_name" name="subject_name" required>
                                <option selected>Choose a subject</option>
                                @forelse ($subjects as $subject)

                                    <option value="{{ $subject->id }}">{{ $subject->title }}</option>

                                @empty

                                    No subject to choose.

                                @endforelse
                            </select>

                            <x-input-error :messages="$errors->get('subject_name')" class="mt-2" />
                        </div>

                            <!-- Exam Description -->
                        <div class="mt-4">
                            <x-input-label for="exam_desc" :value="__('Exam Description')" />
                            <x-textarea-input id="exam_desc" class="block mt-1 w-full" name="exam_desc" :value="old('exam_desc')" required autocomplete="exam_desc"></x-textarea-input>
                            <x-input-error :messages="$errors->get('exam_desc')" class="mt-2" />
                        </div>

                        <!-- Exam Duration -->
                        <div class="mt-4">
                            <x-input-label for="duration" :value="__('Exam duration')" />
                            <x-text-input id="duration" class="block mt-1 w-full" type="text" name="duration" :value="old('duration')" placeholder="Hour : minutes" required autofocus autocomplete="duration" />
                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                        </div>

                        <!-- Exam Starting date -->
                        <div class="mt-4">
                            <x-input-label for="starting_date" :value="__('Exam starting date')" />
                            <x-text-input id="starting_date" class="block mt-1 w-full" type="date" name="starting_date" :value="old('starting_date')" required autofocus autocomplete="starting_date" />
                            <x-input-error :messages="$errors->get('starting_date')" class="mt-2" />
                        </div>

                        <!-- Exam Ending date -->
                        <div class="mt-4">
                            <x-input-label for="ending_date" :value="__('Exam ending date')" />
                            <x-text-input id="ending_date" class="block mt-1 w-full" type="date" name="ending_date" :value="old('ending_date')" required autofocus autocomplete="ending_date" />
                            <x-input-error :messages="$errors->get('ending_date')" class="mt-2" />
                        </div>

                        <!-- Exam Deficulity -->
                        <div class="mt-4">
                            <x-input-label for="difficulty_level" :value="__('Exam ending date')" />

                            <select id="difficulty_level" name="difficulty_level" required>
                                <option value="easy">Easy</option>
                                <option value="normal">Normal</option>
                                <option value="hard">Hard</option>
                                <option value="insane">Insane</option>
                            </select>

                            <x-text-input  />
                            <x-input-error :messages="$errors->get('difficulty_level')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                                <x-primary-button class="ml-3">
                                    {{ __('Submit') }}
                                </x-primary-button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
            <table class="w-full">
              <thead>
                <tr style="background-color: #000; color: #fff;" class="bg-gray-100">
                  <th class="px-4 py-2">Created by</th>
                  <th class="px-4 py-2">Title</th>
                  <th class="px-4 py-2">Description</th>
                  <th class="px-4 py-2">Duration</th>
                  <th class="px-4 py-2">Starting date</th>
                  <th class="px-4 py-2">Ending date</th>
                  <th class="px-4 py-2">Difficulty level</th>
                  <th class="px-4 py-2">Actions</th>
                </tr>
              </thead>
              <tbody>

            @php
                $user = Auth::user();
            @endphp

            @if ($user->rank == 'teacher')
                @php
                    $exams = \App\Models\Exam::where('user_id', $user->id)->get();
                @endphp

            @elseif ($user->rank == 'admin')
                @php
                    $exams = \App\Models\Exam::all();
                @endphp

            @endif

                @forelse ($exams as $exam)
                    <tr class="bg-white">
                        <td class="border px-4 py-2">{{ $exam->creator->name }}</td>
                        <td class="border px-4 py-2">{{ $exam->title }}</td>
                        <td class="border px-4 py-2">{{ $exam->description }}</td>
                        <td class="border px-4 py-2">{{ $exam->duration }}</td>
                        <td class="border px-4 py-2">{{ $exam->starting_date }}</td>
                        <td class="border px-4 py-2">{{ $exam->ending_date }}</td>
                        <td class="border px-4 py-2">{{ $exam->difficulty_level }}</td>
                        <td class="border px-4 py-2 text-center">

                            <a href="{{ route('exam.edit', $exam->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                U
                            </a>

                            <form id="deleteForm{{ $exam->id }}" class="delete-form inline" action="{{ route('exam.destroy', $exam->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit">
                                    {{ __('D') }}
                                </button>
                            </form>

                            <a href="{{ route('exam.question.create', $exam->id) }}" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                A
                            </a>

                            <a href="" class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                S
                            </a>


                        </td>
                    </tr>
                @empty
                    <tr class="bg-white">
                        <td colspan="3">No Exams Found.</td>
                    </tr>
                @endforelse


                <!-- Add more rows as needed -->
              </tbody>
            </table>
          </div>
        </div>
    </div>

</x-app-layout>

