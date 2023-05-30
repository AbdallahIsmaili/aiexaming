<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-green-500 leading-tight">
            {{ __('Add options for the question: ') . $question->question_text }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div id="delete-toast" class="delete-toast"></div>

                    <!-- Main content -->
                    <form id="submitForm" class="max-w-7xl mx-auto p-6" method="POST" action="{{ route('option.store') }}" >
                        @csrf

                        {{-- Question id: --}}

                        <input type="hidden" name="question_id" value="{{ $question->id }}">

                        <!-- Correct answer -->
                        <div class="mt-6">
                            <x-input-label for="question_text" :value="__('Correct answer')" class="text-green-500" />

                            <x-text-input id="duration" class="block mt-1 w-full border-green-500 focus:border-green-500" type="text" name="correct" placeholder="Correct answer here" required  />

                            <x-input-error :messages="$errors->get('correct')" class="mt-2" />

                        </div>

                        <!-- Wrong answer 1 -->
                        <div class="mt-6">
                            <x-input-label for="question_text" :value="__('Wrong answer 1')" class="text-red-500" />

                            <x-text-input id="duration" class="block mt-1 w-full" type="text" name="wrong_one" placeholder="Wrong answer here" required  />

                            <x-input-error :messages="$errors->get('wrong_one')" class="mt-2" />

                        </div>

                        <!-- Wrong answer 2 -->
                        <div class="mt-6">
                            <x-input-label for="question_text" :value="__('Wrong answer 2')" class="text-red-500" />

                            <x-text-input id="duration" class="block mt-1 w-full" type="text" name="wrong_two" placeholder="Wrong answer here" required  />

                            <x-input-error :messages="$errors->get('wrong_two')" class="mt-2" />

                        </div>

                        <!-- Wrong answer 3 -->
                        <div class="mt-6">
                            <x-input-label for="question_text" :value="__('Wrong answer 3')" class="text-red-500" />

                            <x-text-input id="duration" class="block mt-1 w-full" type="text" name="wrong_three" placeholder="Wrong answer here" required  />

                            <x-input-error :messages="$errors->get('wrong_three')" class="mt-2" />

                        </div>

                        <div class="flex items-center justify-end mt-10">

                            @if(count($options) >= 4)

                                <button disabled="disabled">Unable</button>

                            @else

                                <x-primary-button class="ml-3"  >
                                    {{ __('Submit') }}
                                </x-primary-button>

                            @endif

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
                    <th class="px-4 py-2">Option Text</th>
                    <th class="px-4 py-2">Status</th>
                  <th class="px-4 py-2">Actions</th>
                </tr>
              </thead>
              <tbody>

            @php
                $user = Auth::user();
            @endphp


                @forelse ($options as $option)
                    @if ($option->question_id == $question->id)
                        <tr class="bg-white">
                            <td class="border px-4 py-2">{{ $option->option_text }}</td>
                            <td class="border px-4 py-2">{{ $option->is_correct }}</td>

                            <td class="border px-4 py-2 text-center">

                                <a href="{{ route('option.edit', $option->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    U
                                </a>


                            </td>
                        </tr>
                    @endif
                @empty

                    <tr class="bg-white">
                        <td colspan="3">No options Found.</td>
                    </tr>

                @endforelse


                <!-- Add more rows as needed -->
              </tbody>
            </table>
          </div>
        </div>
    </div>

</x-app-layout>
