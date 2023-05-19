<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Updating: ' . $subject->title) }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div id="update-toast" class="update-toast"></div>

                    <!-- Main content -->
                    <form id="updateForm" class="max-w-7xl mx-auto p-6" method="POST"
                        action="{{ route('subject.update', $subject->id) }}">
                        @method('PUT')
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="subject_name" :value="__('Title')" />
                            <x-text-input id="subject_name" class="block mt-1 w-full" type="text" name="subject_name"
                                value="{{ $subject->title }}" required autofocus autocomplete="subject_name" />
                            <x-input-error :messages="$errors->get('subject_name')" class="mt-2" />
                        </div>

                        <!-- Subject Description -->
                        <div class="mt-4">
                            <x-input-label for="subject_desc" :value="__('Subject Description')" />
                            <x-textarea-input id="subject_desc" class="block mt-1 w-full" name="subject_desc"
                                value="{{ $subject->description }}" required autocomplete="subject_desc">
                            </x-textarea-input>

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
</x-app-layout>

<script>
    $(document).ready(function () {
        $('#updateForm').submit(function (e) {
            e.preventDefault(); // Prevent form submission

            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function (response) {
                    // Show toast message
                    showToast(response.message);
                    form[0].reset(); // Reset the form

                    // Redirect after toast disappears
                    setTimeout(function () {
                        window.location.href = "{{ route('subject.index') }}";
                    }, 3000);
                },
                error: function (xhr) {
                    // Show toast message with error
                    showToast('An error occurred. Please try again.');
                },
            });
        });

        // Function to display toast message
        function showToast(message) {
            var toast = $('#update-toast');
            toast.text(message);
            toast.addClass('show-toast');
            setTimeout(function () {
                toast.removeClass('show-toast');
            }, 3000);
        }
    });
</script>
