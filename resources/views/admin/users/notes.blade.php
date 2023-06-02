<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('AiExaming - users exams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    {{ __("All users exams on the platform.") }}
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
                    <th class="px-4 py-2">User name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Exam title</th>
                    <th class="px-4 py-2">Taken at</th>
                    <th class="px-4 py-2">Score</th>
                </tr>
              </thead>

              <tbody>

                @forelse ($usersExams as $usersExam)

                        <tr class="bg-white">
                            <td class="border px-4 py-2">{{ $usersExam->user->name }}</td>
                            <td class="border px-4 py-2">{{ $usersExam->user->email }}</td>
                            <td class="border px-4 py-2">{{ $usersExam->exam->title }}</td>
                            <td class="border px-4 py-2">{{ $usersExam->submitted_at }}</td>
                            <td class="border px-4 py-2">{{ $usersExam->score }}</td>
                        </tr>

                        @empty

                        <tr class="bg-white">

                            <td class="border px-4 py-2">No users yet.</td>

                        </tr>
                @endforelse

                <!-- Add more rows as needed -->
              </tbody>

            </table>

            {!! $usersExams->links() !!}

          </div>
        </div>
    </div>



</x-app-layout>
