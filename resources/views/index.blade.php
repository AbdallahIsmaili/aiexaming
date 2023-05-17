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
                  <th class="px-4 py-2">Active</th>
                  <th class="px-4 py-2">Duration</th>
                </tr>
              </thead>
              <tbody>
                <tr class="bg-white">
                  <td class="border px-4 py-2">Title 1</td>
                  <td class="border px-4 py-2 text-center">
                    <span class="inline-block px-2 py-1 rounded" style="background-color: #34D399; color: #fff;">Active</span>
                  </td>
                  <td class="border px-4 py-2">5 hours</td>
                </tr>
                <tr class="bg-gray-100">
                  <td class="border px-4 py-2">Title 2</td>
                  <td class="border px-4 py-2 text-center">
                    <span class="inline-block px-2 py-1 rounded" style="background-color: #FF5A5F; color: #fff;">Inactive</span>
                  </td>
                  <td class="border px-4 py-2">2 hours</td>
                </tr>
                <tr class="bg-white">
                  <td class="border px-4 py-2">Title 3</td>
                  <td class="border px-4 py-2 text-center">
                    <span class="inline-block px-2 py-1 rounded" style="background-color: #34D399; color: #fff;">Active</span>
                  </td>
                  <td class="border px-4 py-2">8 hours</td>
                </tr>
                <!-- Add more rows as needed -->
              </tbody>
            </table>
          </div>
        </div>
    </div>





</x-app-layout>
