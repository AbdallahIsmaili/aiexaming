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

                    <div id="toast" class="toast"></div>
                    <div id="delete-toast" class="delete-toast"></div>


                        <!-- Main content -->
                    <form id="submitForm" class="max-w-7xl mx-auto p-6" method="POST" action="{{ route('subject.store') }}">

                            @csrf

                            <!-- Name -->
                        <div>
                                <x-input-label for="subject_name" :value="__('Title')" />
                                <x-text-input id="subject_name" class="block mt-1 w-full" type="text" name="subject_name" :value="old('subject_name')" required autofocus autocomplete="subject_name" />
                                <x-input-error :messages="$errors->get('subject_name')" class="mt-2" />
                        </div>

                            <!-- Subject Description -->
                        <div class="mt-4">
                                <x-input-label for="subject_desc" :value="__('Subject Description')" />
                                <x-textarea-input id="subject_desc" class="block mt-1 w-full" name="subject_desc" :value="old('subject_desc')" required autocomplete="subject_desc"></x-textarea-input>
                                <x-input-error :messages="$errors->get('subject_desc')" class="mt-2" />
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
                  <th class="px-4 py-2">Title</th>
                  <th class="px-4 py-2">Description</th>
                  <th class="px-4 py-2">Actions</th>
                </tr>
              </thead>
              <tbody>

                @forelse ($exams as $exam)
                    <tr class="bg-white">
                        <td class="border px-4 py-2">{{ $exam->title }}</td>
                        <td class="border px-4 py-2">{{ $exam->description }}</td>
                        <td class="border px-4 py-2 text-center">

                            <a href="{{ route('exam.edit', $exam->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                U
                            </a>

                            <form id="deleteForm{{ $exam->id }}" class="delete-form inline" action="{{ route('exam.destroy', $exam->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="button" data-id="{{ $exam->id }}">
                                    {{ __('D') }}
                                </button>
                            </form>



                        </td>
                    </tr>
                @empty
                    <tr class="bg-white">
                        <td colspan="3">No Exams Found.</td>
                    </tr>
                @endforelse


                <!-- Add more rows as needed -->
              </tbody>
            </table>
          </div>
        </div>
    </div>


<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>


</x-app-layout>


<script>

    $(document).ready(function() {

        $('#submitForm').submit(function(e) {
            e.preventDefault(); // Prevent form submission

            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(response) {
                    // Show toast message
                    showToast(response.message);
                    form[0].reset(); // Reset the form
                },
                error: function(xhr) {
                    // Show toast message with error
                    showToast('An error occurred. Please try again.');
                }
            });
        });

        // Function to display toast message
        function showToast(message) {
            var toast = $('#toast');
            toast.text(message);
            toast.addClass('show-toast');
            setTimeout(function() {
                toast.removeClass('show-toast');
            }, 3000);
        }


        $('.delete-button').click(function(e) {
            e.preventDefault(); // Prevent default button behavior

            var button = $(this);
            var form = button.closest('form');
            var url = form.attr('action');
            var method = form.attr('method');

            $.ajax({
                url: url,
                type: method,
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                success: function(response) {
                    // Show toast message
                    showToast(response.message);
                    // Remove the deleted row from the table
                    button.closest('tr').remove();
                },
                error: function(xhr) {
                    // Show toast message with error
                    showToast('An error occurred. Please try again.');
                }
            });
        });

        // Function to display toast message
        function showToast(message) {
            var toast = $('#delete-toast');
            toast.text(message);
            toast.addClass('show-toast');
            setTimeout(function() {
                toast.removeClass('show-toast');
            }, 3000);
        }

    });
</script>



