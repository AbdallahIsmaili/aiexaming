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
                    <form id="submitForm" class="max-w-7xl mx-auto p-6" method="POST" action="{{ route('exam.update', $exam->id) }}">

                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mt-4">
                            <x-input-label for="exam_title" :value="__('Title')" />
                            <x-text-input id="exam_title" class="block mt-1 w-full" type="text" name="exam_title" value="{{ $exam->title }}" required autofocus autocomplete="exam_title" />
                            <x-input-error :messages="$errors->get('exam_title')" class="mt-2" />
                        </div>

                        <!-- Subject  -->
                        <div class="mt-4">
                            <x-input-label for="subject_name" :value="__('Subject')" />

                            <select id="subject_name" name="subject_name" required>
                                <option selected>Choose a subject</option>
                                @forelse ($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ $subject->id === $exam->subject_id ? 'selected' : '' }}>{{ $subject->title }}</option>
                                @empty
                                    <option disabled>No subject available</option>
                                @endforelse
                            </select>


                            <x-input-error :messages="$errors->get('subject_name')" class="mt-2" />
                        </div>

                            <!-- Exam Description -->
                        <div class="mt-4">
                            <x-input-label for="exam_desc" :value="__('Exam Description')" />

                            <textarea class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="exam_desc" class="block mt-1 w-full" name="exam_desc" required autocomplete="exam_desc">{{ $exam->description }}</textarea>

                            <x-input-error :messages="$errors->get('exam_desc')" class="mt-2" />
                        </div>

                        <!-- Exam Duration -->
                        <div class="mt-4">
                            <x-input-label for="duration" :value="__('Exam duration')" />

                            <x-text-input id="duration" class="block mt-1 w-full" type="text" name="duration" value="{{ $exam->duration }}" placeholder="Hour : minutes" required autofocus autocomplete="duration" />

                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                        </div>

                        <!-- Exam Starting date -->
                        <div class="mt-4">
                            <x-input-label for="starting_date" value="__('Exam starting date')" />
                            <x-text-input id="starting_date" class="block mt-1 w-full" type="date" name="starting_date" value="{{ $exam->starting_date }}" required autofocus autocomplete="starting_date" />

                            <x-input-error :messages="$errors->get('starting_date')" class="mt-2" />
                        </div>

                        <!-- Exam Ending date -->
                        <div class="mt-4">
                            <x-input-label for="ending_date" :value="__('Exam ending date')" />

                            <x-text-input id="ending_date" class="block mt-1 w-full" type="date" name="ending_date" value="{{ $exam->ending_date }}" required autofocus autocomplete="ending_date" />

                            <x-input-error :messages="$errors->get('ending_date')" class="mt-2" />
                        </div>

                        <!-- Exam Deficulity -->
                        <div class="mt-4">
                            <x-input-label for="difficulty_level" :value="__('Exam ending date')" />

                            <select id="difficulty_level" name="difficulty_level" required>
                                <option value="easy" {{ $exam->difficulty_level === 'easy' ? 'selected' : '' }} >Easy</option>

                                <option value="normal" {{ $exam->difficulty_level === 'normal' ? 'selected' : '' }} >Normal</option>

                                <option value="hard" {{ $exam->difficulty_level === 'hard' ? 'selected' : '' }} >Hard</option>

                                <option value="insane" {{ $exam->difficulty_level === 'insane' ? 'selected' : '' }} >Insane</option>
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

</x-app-layout>

