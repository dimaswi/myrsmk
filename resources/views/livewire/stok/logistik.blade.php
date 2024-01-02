@if (auth()->user()->hasRole('Logistik'))
    @can('manage_logistik')
        <div>
            @section('metas')
                <title>{{ __('Stok') }}</title>
            @endsection

            <section class="mt-10">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <!-- Start coding here -->
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-auto">
                        <div class="p-4 grid place-items-center">
                            <ul class="inline-flex -space-x-px text-sm">
                                <li class="">
                                    <button wire:click="pageCreate"
                                        class="flex items-center justify-center px-3 h-8 leading-tight text-white bg-blue-500 border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Tambah</button>
                                </li>
                                <li>
                                    <button wire:click="pageTersedia"
                                        class=" @if ($tersedia == true) flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-200 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white @else flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white @endif">Tersedia
                                        &nbsp; <span
                                            class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-red-800 bg-red-200 rounded-full">
                                            {{ $tersedias->count() }}
                                        </span></button>
                                </li>
                                <li>
                                    <button wire:click="pageKurang"
                                        class=" @if ($kurang == true) flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-200 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white @else flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white @endif">Kurang
                                        &nbsp; <span
                                            class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-red-800 bg-red-200 rounded-full">
                                            {{ $kurangs->count() }}
                                        </span></button>
                                </li>
                                <li>
                                    <button wire:click="pageKosong"
                                        class="@if ($kosong == true) flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-200 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white @else flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white @endif">Kosong
                                        &nbsp; <span
                                            class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-red-800 bg-red-200 rounded-full">
                                            {{ $kosongs->count() }}
                                        </span></button>
                                </li>
                            </ul>
                        </div>

                        @if ($tersedia == true)
                            @livewire('stok.tersedia')
                        @elseif ($kurang == true)
                            @livewire('stok.kurang')
                        @elseif ($kosong == true)
                            @livewire('stok.kosong')
                        @elseif ($buat == true)
                            <div class="m-10">
                                <div class="mx-10">
                                    <h2 class="text-base font-semibold leading-7 text-gray-900">Tambah Barang</h2>
                                    <p class="mt-1 text-sm leading-6 text-gray-600">Anda dapat memasukan barang disini.</p>
                                </div>

                                <form class="max-w-full mx-10 mt-10" wire:submit.prevent="store">
                                    <div class="flex">
                                        <div class="flex-1 mr-2">
                                            <label for="website-admin"
                                                class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Nama
                                                Barang</label>
                                            <div class="flex">
                                                <span
                                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                                                    </svg>
                                                </span>
                                                <input type="text" wire:model="nama_barang"
                                                    class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="">
                                            </div>
                                        </div>

                                        <div class="flex-1">
                                            <label for="website-admin"
                                                class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Jenis
                                                Barang</label>
                                            <div class="flex">
                                                <span
                                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 20" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                                                    </svg>

                                                </span>
                                                <select wire:model="jenis_barang"
                                                    class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option selected>Pilih Jenis Barang</option>
                                                    <option value="BHP">Barang Habis Pakai</option>
                                                    <option value="Rumah Tangga">Rumah Tangga</option>
                                                    <option value="Dapur">Dapur</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex mt-4">
                                        <div class="flex-1 mr-2">
                                            <label for="website-admin"
                                                class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Harga
                                                Barang</label>
                                            <div class="flex">
                                                <span
                                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                                    </svg>


                                                </span>
                                                <input type="number" wire:model="harga"
                                                    class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="">
                                            </div>
                                        </div>

                                        <div class="flex-1 mr-2">
                                            <label for="website-admin"
                                                class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Tanggal</label>
                                            <div class="flex">
                                                <span
                                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                    </svg>


                                                </span>
                                                <input type="date" wire:model="tanggal"
                                                    class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="">
                                            </div>
                                        </div>

                                        <div class="flex-1">
                                            <label for="website-admin"
                                                class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Stok
                                                Awal</label>
                                            <div class="flex">
                                                <span
                                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z" />
                                                    </svg>
                                                </span>
                                                <input type="number" wire:model="stok_awal"
                                                    class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex mt-4">
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    @endcan
@else
    @can('manage_user_logistik')
        <div>
            @section('metas')
                <title>{{ __('Stok') }}</title>
            @endsection

            <section class="mt-10">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <!-- Start coding here -->
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-auto">

                        <div class="m-10">
                            <div class="mx-10">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Stok Tersedia</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Barang dalam jumlah yang memadai.</p>
                            </div>

                            <!-- Start coding here -->
                            <div class="flex items-center justify-between d p-4">
                                <div class="flex">
                                    {{-- <div class="relative w-full px-2">
                    <input type="date"
                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "
                        placeholder="Search" required="" wire:model.live.debounce.300ms="search">
                </div> --}}
                                    <div class="relative w-full px-2">
                                        <input type="text"
                                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "
                                            placeholder="Search" required="" wire:model.live.debounce.300ms="search">
                                    </div>
                                </div>

                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-4 py-3">Nama Barang</th>
                                            <th scope="col" class="px-4 py-3">Harga</th>
                                            <th scope="col" class="px-4 py-3">Masuk</th>
                                            <th scope="col" class="px-4 py-3">Sisa</th>
                                            <th scope="col" class="px-4 py-3"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($stoks as $key => $value)
                                            <tr class="border-b dark:border-gray-700">
                                                <td class="px-4 py-3" style="width: 30%">
                                                    @if ( $editedStockIndex !== $key )
                                                        {{ $value->nama_barang }}
                                                    @else
                                                        <input type="nama" wire:model="nama_barang_edit"
                                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3" style="width: 10%">
                                                    @if ( $editedStockIndex !== $key )
                                                        {{ $value->harga }}
                                                    @else
                                                        <input type="number" wire:model="harga_edit"
                                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3" style="width: 5%">
                                                    @if ($editedStockIndex !== $key)
                                                        {{ $value->stok_masuk }}
                                                    @else
                                                        <input type="number" wire:model="stok_masuk_edit"
                                                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3" style="width: 5%">
                                                    @if ($editedStockIndex !== $key)
                                                        {{ $value->stok_sisa }}
                                                    @else
                                                        <input type="number" wire:model="stok_sisa_edit"
                                                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3" style="width: 5%">
                                                    @if ($editedStockIndex !== $key)
                                                        <button wire:click="editedStock({{ $key }}, {{ $value->id }})"
                                                            class="px-3 py-1 text-green-600 font-bold">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                                            </svg>
                                                        </button>
                                                    @else
                                                        <button wire:click="updateStok({{ $value->id }})"
                                                            class="px-3 py-1 text-blue-600 font-bold">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m4.5 12.75 6 6 9-13.5" />
                                                            </svg>

                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="m-4">
                                                <td colspan="6">
                                                    <center class="font-bold">Data Kosong</center>
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
                                        <select wire:model.live="perPage"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                {{ $stoks->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    @endcan
@endif
