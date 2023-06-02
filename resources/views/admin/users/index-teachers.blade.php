<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('AiExaming - teachers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    {{ __("All teachers on the platform.") }}
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
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Join date</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
              </thead>

              <tbody>

                @forelse ($users as $user)

                    @if ($user->rank == 'teacher' and $user->rank != 'banned')

                        <tr class="bg-white">
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->created_at }}</td>

                            <td class="border px-4 py-2">

                                <form class="delete-form inline" action="{{ route('user.down', $user->id) }}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-300 focus:bg-yellow-300 active:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="button" >
                                        {{ __('Down') }}
                                    </button>
                                </form>

                                <form class="delete-form inline" action="{{ route('user.ban', $user->id) }}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="button" >
                                        {{ __('Ban') }}
                                    </button>
                                </form>

                            </td>


                        </tr>
                    @endif


                        @empty

                        <tr class="bg-white">

                            <td class="border px-4 py-2">No users yet.</td>

                        </tr>
                @endforelse

                <!-- Add more rows as needed -->
              </tbody>

            </table>

          </div>
        </div>
    </div>



</x-app-layout>
