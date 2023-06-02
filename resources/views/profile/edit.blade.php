<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <h5 class="text-xl p-4">Taked exams: </h5>
                
                <table class="w-full">
                    <thead>
                    <tr style="background-color: #000; color: #fff;" class="bg-gray-100">
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Subject</th>
                        <th class="px-4 py-2">Taked on</th>
                        <th class="px-4 py-2">Score</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                    </thead>

                    <tbody>

                        @forelse ($userExams as $userExam)

                            @if ($userExam->score != null && $userExam->submitted_at != null)



                            <tr class="bg-white">
                                <td class="border px-4 py-2">{{ $userExam->exam->title }}</td>
                                <td class="border px-4 py-2">{{ $userExam->exam->subject->title }}</td>
                                <td class="border px-4 py-2">{{ $userExam->submitted_at }}</td>
                                <td class="border px-4 py-2">{{ $userExam->score }}</td>

                                <td class="border px-4 py-2">

                                    @if (date('Y-m-d') > $userExam->exam->ending_date)
                                        <a style="width: 300px" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 my-4 px-10 rounded" disabled>
                                            Exam Ended
                                        </a>

                                    @else
                                        <a href="{{ route('exam.show', $userExam->exam->id) }}" style="width: 300px" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 my-4 px-10 rounded">
                                            Retake the exam
                                        </a>

                                    </td>

                                </tr>
                            @endif


                            @endif

                        @empty

                            <tr class="bg-white">

                                <td class="border px-4 py-2">No exams taken yet.</td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
