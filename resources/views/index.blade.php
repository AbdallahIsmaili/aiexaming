<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('AiExaming') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    {{ __("Latest exams & updates can be found here!") }}
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
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Subject</th>
                    <th class="px-4 py-2">Duration</th>
                    <th class="px-4 py-2">starting date</th>
                    <th class="px-4 py-2">ending date</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
              </thead>

              <tbody>

                  @forelse ($exams as $exam)
                    <tr class="bg-white">
                        <td class="border px-4 py-2">{{ $exam->title }}</td>
                        <td class="border px-4 py-2">{{ $exam->subject->title }}</td>
                        <td class="border px-4 py-2">{{ $exam->duration }}</td>
                        <td class="border px-4 py-2">{{ $exam->starting_date }}</td>
                        <td class="border px-4 py-2">{{ $exam->ending_date }}</td>

                        <td class="border px-4 py-2">

                            @if (date('Y-m-d') < $exam->starting_date)
                                <a href="{{ route('exam.show', $exam->id) }}" style="width: 300px" class="bg-yellow-300 hover:bg-yellow-500 text-white font-bold py-2 my-4 px-10 rounded" disabled>
                                    Exam Not Available Yet
                                </a>

                            @elseif (date('Y-m-d') > $exam->ending_date)
                                <a href="{{ route('exam.show', $exam->id) }}" style="width: 300px" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 my-4 px-10 rounded" disabled>
                                    Exam Ended
                                </a>

                            @else
                                <a href="{{ route('exam.show', $exam->id) }}" style="width: 300px" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 my-4 px-10 rounded">
                                    Start Taking Exam
                                </a>
                            @endif

                        </td>


                    </tr>

                    @empty

                    <tr class="bg-white">

                        <td class="border px-4 py-2">No exams yet.</td>

                    </tr>
                    @endforelse

                <!-- Add more rows as needed -->
              </tbody>

            </table>

          </div>
        </div>
    </div>



</x-app-layout>
