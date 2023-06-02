<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('AiExaming - users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    {{ __("All users on the platform.") }}
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

                    @if ($user->rank == 'user' or $user->rank == 'banned')

                        <tr class="bg-white">
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->created_at }}</td>


                            <td class="border px-4 py-2">

                                @if ($user->rank == 'user')

                                    <form class="delete-form inline" action="{{ route('user.rise', $user->id) }}" method="POST">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="button" >
                                            {{ __('Rise') }}
                                        </button>
                                    </form>

                                    <form class="delete-form inline" action="{{ route('user.ban', $user->id) }}" method="POST">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="button" >
                                            {{ __('Ban') }}
                                        </button>
                                    </form>

                                @endif

                                @if ($user->rank == 'banned')

                                    <form class="delete-form inline" action="{{ route('user.unban', $user->id) }}" method="POST">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="button" >
                                            {{ __('Unban') }}
                                        </button>
                                    </form>

                                @else

                                @endif

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
