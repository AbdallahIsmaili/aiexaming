<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Take exam: '). $exam->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                        <h3 class="font-semibold text-4xl text-center mb-10">Let's take that exam: {{ $exam->title }}</h3>


                        <div class="flex justify-center">

                            <p>Duration: {{ $exam->duration }} </p>
                            <p> &nbsp; &nbsp; Ending date: {{ $exam->ending_date }}</p>
                            <p> &nbsp; &nbsp; Level: {{ $exam->difficulty_level }}</p>

                        </div>

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
                                @else
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 my-10 px-16 rounded">
                                        Start Taking Exam
                                    </button>
                                @endif
                            </form>

                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
