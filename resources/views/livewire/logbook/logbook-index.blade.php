<div>
    @section('metas')
        <title>{{ __('Logbook') }}</title>
    @endsection

    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full px-2">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search" required="" wire:model.live.debounce.300ms="search">
                        </div>
                        <div class="relative w-full mr-2">
                            <input type="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Tanggal" required="" wire:model.live.debounce.300ms="tanggal">
                        </div>
                    </div>


                    <a href="{{ route('logbook_create') }}"
                        class="flex items-center justify-center px-3 py-2 space-x text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>

                        <span>Logbook</span>
                    </a>

                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">Tanggal</th>
                                <th scope="col" class="px-4 py-3">Nama</th>
                                <th scope="col" class="px-4 py-3">Unit</th>
                                <th scope="col" class="px-4 py-3">Tugas</th>
                                <th scope="col" class="px-4 py-3">Bukan</th>
                                <th scope="col" class="px-4 py-3">Tambahan</th>
                                <th scope="col" class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logbooks as $key => $value)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3" style="width: 18%">{{ $value->created_at }}</td>
                                    <td class="px-4 py-3" style="width: 25%">{{ $value->nama }}</td>
                                    <td class="px-4 py-3" style="width: 25%">{{ $value->unit }}</td>
                                    <td class="px-4 py-3" style="width: 4%">20%</td>
                                    <td class="px-4 py-3" style="width: 4%">20%</td>
                                    <td class="px-4 py-3" style="width: 4%">20%</td>
                                    <td class="px-4 py-3" style="width: 15%">
                                        <button wire:click="showDetails({{ $value->uid }})"
                                            class="px-3 py-1 text-blue-600 font-bold">
                                            Lihat
                                        </button>

                                        <button wire:click="exportExcel({{ $value->uid }})"
                                            class="px-3 py-1 text-green-600 font-bold">
                                            Excel
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b dark:border-gray-700">
                                    <td colspan="4" class="font-bold text-center px-4 py-3">
                                        <p>Data Kosong</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


                <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select wire:model.live="perpage"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{ $logbooks->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
