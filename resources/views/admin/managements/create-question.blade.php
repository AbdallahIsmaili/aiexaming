<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Question for the exam: ') . $exam->title }}
        </h2>
    </x-slot>


    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
            <div class="col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">


                    <div id="delete-toast" class="delete-toast"></div>


                        <!-- Main content -->
                    <form id="submitForm" class="max-w-7xl mx-auto p-6" method="POST" action="{{ route('question.store') }}" enctype="multipart/form-data">

                        @csrf

                        <!-- Exam  -->
                        <div class="mt-4">
                            <x-input-label for="exam_title" :value="__('Exam')" />

                            <select id="exam_title" disabled>
                                <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                            </select>

                            <x-input-error :messages="$errors->get('subject_name')" class="mt-2" />
                        </div>

                        <!-- Subject  -->
                        <div class="mt-4">
                            <x-input-label for="subject_name" :value="__('Subject')" />

                            <select id="subject_name" disabled>
                                <option value="{{ $exam->subject->id }}">{{ $exam->subject->title }}</option>
                            </select>

                            <x-input-error :messages="$errors->get('subject_name')" class="mt-2" />
                        </div>

                        <input type="hidden" name="subject_name" value="{{ $exam->subject->id }}">
                        <input type="hidden" name="exam_title" value="{{ $exam->id }}">


                        <!-- Question Text -->

                        <div class="mt-4">
                            <x-input-label for="question_text" :value="__('Question_text')" />

                            <textarea class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="question_text" class="block mt-1 w-full" name="question_text" required autocomplete="question_text"></textarea>

                            <x-input-error :messages="$errors->get('question_text')" class="mt-2" />
                        </div>

                        <!-- Exam Deficulity -->
                        <div class="mt-4">
                            <x-input-label for="difficulty_level" :value="__('Difficulty level')" />

                            <select id="difficulty_level" name="difficulty_level" required>
                                <option value="easy">Easy</option>
                                <option value="normal">Normal</option>
                                <option value="hard">Hard</option>
                                <option value="insane">Insane</option>
                            </select>

                            <x-input-error :messages="$errors->get('difficulty_level')" class="mt-2" />
                        </div>

                        {{-- Add Attachements: --}}

                        <div class="mt-4">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">You can add an attachment video or audio or picture : SVG, PNG, JPG or GIF.</p>
                            <label class="block">
                                <span class="sr-only">You can add an attachment video or audio.</span>
                                <input type="file" name="attachment_url" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-500 file:text-white
                                hover:file:bg-blue-600
                                "/>
                            </label>
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
                  <th class="px-4 py-2">Question</th>
                  <th class="px-4 py-2">Difficulty level</th>
                  <th class="px-4 py-2">Attachements</th>
                  <th class="px-4 py-2">Actions</th>
                </tr>
              </thead>
              <tbody>

            @php
                $user = Auth::user();
            @endphp


                @forelse ($questions as $question)
                    @if ($question->exam_id == $exam->id)
                        <tr class="bg-white">
                            <td class="border px-4 py-2">{{ $exam->creator->name }}</td>
                            <td class="border px-4 py-2">{{ $question->question_text }}</td>
                            <td class="border px-4 py-2">{{ $question->difficulty_level }}</td>
                            <td class="border px-4 py-2">
                                @if ($question->url)

                                    <a href="{{ $question->url }}" target="_blank">See attachement</a>

                                @else

                                    <p>No attachements provided.</p>

                                @endif
                            </td>

                            <td class="border px-4 py-2 text-center">

                                <a href="{{ route('question.edit', $question->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    U
                                </a>

                                <a href="{{ route('question.option.create', $question->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    O
                                </a>

                                <a href="{{ route('question.show', $question->id) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    S
                                </a>

                                <form class="delete-form inline" action="{{ route('question.destroy', $question->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit">
                                        {{ __('D') }}
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endif
                @empty
                    <tr class="bg-white">
                        <td colspan="3">No Questions Found.</td>
                    </tr>
                @endforelse


                <!-- Add more rows as needed -->
              </tbody>
            </table>
          </div>
        </div>
    </div>

</x-app-layout>

