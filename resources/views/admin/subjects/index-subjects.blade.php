<x-app-layout>


    @if (session('success'))

        <div id="toast" class="toast"></div>

    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subjects Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Main content -->
                    <form class="max-w-3xl mx-auto p-6" method="POST" action="{{ route('subject.store') }}">
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
</x-app-layout>

<script>
    function showToast(message) {
      var toast = document.getElementById("toast");
      toast.innerHTML = message;
      toast.classList.add("show-toast");
      setTimeout(function() {
        toast.classList.remove("show-toast");
      }, 5000);
    }
    @if (session('success'))
        showToast('{{ session('success') }}');
    @endif
</script>
