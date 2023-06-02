@if ($userID === Auth::id())

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Result for: '). $exam->title }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                            <h3 class="font-semibold text-4xl text-center mb-10">Your result after taking the exam: {{ $exam->title }}</h3>


                            <div class="flex justify-center">

                                <p>Duration: {{ $exam->duration }} </p>
                                <p> &nbsp; &nbsp; Ending date: {{ $exam->ending_date }}</p>
                                <p> &nbsp; &nbsp; Level: {{ $exam->difficulty_level }}</p>

                            </div>

                            @if ($score >= 50)
                                <div class="flex justify-center mt-10">
                                    <p class="text-4xl">Your score is: {{ round($score) }}</p>
                                </div>
                            @else
                                <div class="flex justify-center mt-10">
                                    <p class="text-4xl">Sorry, you did not pass the exam.</p>
                                </div>
                            @endif

                            <div class="text-center mt-4">

                                <form action="{{ route('startExam', $exam->id) }}" method="POST">

                                    @csrf
                                    @method('POST')

                                    @if (date('Y-m-d') < $exam->starting_date)
                                        <button type="submit" class="bg-yellow-300 hover:bg-yellow-500 text-white font-bold py-2 my-10 px-16 rounded" disabled>
                                            Exam Not Available Yet
                                        </button>
                                    @elseif (date('Y-m-d') > $exam->ending_date)
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 my-10 px-16 rounded" disabled>
                                            Exam Ended
                                        </button>
                                    @elseif ($score >= 50)
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 my-10 px-16 rounded">
                                            Retake the exam
                                        </button>
                                    @else
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 my-10 px-16 rounded" disabled>
                                            You did not pass the exam
                                        </button>
                                    @endif
                                </form>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

@else

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Access denied') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 mt-10 bg-white border-b border-gray-200">

                            <h3 class="font-semibold text-4xl text-center mb-10">Don't do those things; they may result in a ban.</h3>

                            <div class="text-center mt-4">

                                <a href="{{ route('home.index') }}" class="bg-yellow-300 hover:bg-yellow-500 text-white font-bold py-2 my-10 px-16 rounded" disabled>
                                    Back to safety.
                                </a>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

@endif
