<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Question: ') . $question->title }}
        </h2>
    </x-slot>


    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
            <div class="col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">


                    <div id="delete-toast" class="delete-toast"></div>


                        <!-- Main content -->
                    <form id="submitForm" class="max-w-7xl mx-auto p-6" method="POST" action="{{ route('question.update', $question->id ) }}" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <!-- Question Text -->

                        <div class="mt-4">
                            <x-input-label for="question_text" :value="__('Question_text')" />

                            <textarea class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="question_text" class="block mt-1 w-full" name="question_text" required autocomplete="question_text">{{ $question->question_text }}</textarea>

                            <x-input-error :messages="$errors->get('question_text')" class="mt-2" />
                        </div>

                        <!-- Exam Deficulity -->
                        <div class="mt-4">
                            <x-input-label for="difficulty_level" :value="__('Difficulty level')" />

                            <select id="difficulty_level" name="difficulty_level" required>
                                <option value="easy" {{ $question->difficulty_level === 'easy' ? 'selected' : '' }} >Easy</option>

                                <option value="normal" {{ $question->difficulty_level === 'normal' ? 'selected' : '' }} >Normal</option>

                                <option value="hard" {{ $question->difficulty_level === 'hard' ? 'selected' : '' }} >Hard</option>

                                <option value="insane" {{ $question->difficulty_level === 'insane' ? 'selected' : '' }} >Insane</option>
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

                        {{-- Keep Attachment Checkbox --}}
                        {{-- <div class="mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="keep_attachment" class="form-checkbox" value="true">
                                <span class="ml-2 text-sm text-gray-600">Keep current attachment</span>
                            </label>
                        </div> --}}

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


</x-app-layout>

