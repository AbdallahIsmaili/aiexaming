<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions: '). $question->exam->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('user-response.store') }}" method="POST">

                        @csrf

                        <h3 class="font-semibold text-4xl text-center mb-10">{{ $question->question_text }}</h3>

                        @if ($question->url)
                            @if (Str::contains($question->url, ['.jpg', '.jpeg', '.png', '.gif', '.bmp']))
                                <img src="{{ $question->url }}" alt="Question Image" class="mx-auto mb-10">
                            @elseif (Str::contains($question->url, ['.mp4', '.avi', '.mov', '.wmv']))
                                <video src="{{ $question->url }}" controls class="mx-auto mb-4"></video>
                            @elseif (Str::contains($question->url, ['.mp3', '.wav', '.ogg']))
                                <audio src="{{ $question->url }}" controls class="mx-auto mb-10"></audio>
                            @endif
                        @endif


                        @if (session('user_exam_id'))
                            @php
                                $user_exam_id = session('user_exam_id');
                            @endphp
                        @endif

                        <input type="hidden" name="user_exam_id" value="{{ isset($user_exam_id) ? $user_exam_id : '' }}">

                        <input type="hidden" name="question_id" value="{{ $question->id }}">

                        <input type="hidden" name="exam_id" value="{{ $question->exam_id }}">

                        <div class="flex justify-center">
                            <ul class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                @forelse ($options->shuffle() as $option)
                                    <li>
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" id="{{ $option->id }}" name="selected_option_id" value="{{ $option->id }}" class="form-radio h-5 w-5 text-indigo-600">
                                            <span class="text-lg">{{ $option->option_text }}</span>
                                        </label>

                                    </li>
                                @empty
                                    <li><p>No options yet.</p></li>
                                @endforelse
                            </ul>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 my-10 px-4 rounded">
                                Next Question
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

