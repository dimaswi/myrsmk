<div class="m-10">
    <div class="mx-10">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Stok Kurang</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">Barang dalam jumlah yang kurang memadai.</p>
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
                    <th scope="col" class="px-4 py-3">Stok Awal</th>
                    <th scope="col" class="px-4 py-3">Stok</th>
                    <th scope="col" class="px-4 py-3">Masuk</th>
                    <th scope="col" class="px-4 py-3">Keluar</th>
                    <th scope="col" class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($stoks as $key => $value)
                    <tr class="border-b dark:border-gray-700">
                        <td class="px-4 py-3" style="width: 20%">
                            @if ($editedStockIndex !== $key)
                                {{ $value->nama_barang }}
                            @else
                                <input type="text" wire:model="nama_barang"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                            @endif
                        </td>
                        <td class="px-4 py-3" style="width: 10%">
                            @if ($editedStockIndex !== $key)
                                Rp. {{ number_format($value->harga) }}
                            @else
                                <input type="number" wire:model="harga"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                            @endif
                        </td>
                        <td class="px-4 py-3" style="width: 10%">
                            @if ($editedStockIndex !== $key)
                                {{ $value->stok_awal }}
                            @else
                                <input type="number" wire:model="stok_awal"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                            @endif
                        </td>
                        <td class="px-4 py-3" style="width: 5%">
                            @if ($editedStockIndex !== $key)
                                {{ $value->total_stok }}
                            @else
                                <input type="number" wire:model="total_stok"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                            @endif
                        </td>
                        <td class="px-4 py-3" style="width: 5%">
                            @if ($editedStockIndex !== $key)
                                {{ $value->stok_masuk }}
                            @else
                                <input type="number" wire:model="jumlah"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                            @endif
                        </td>
                        <td class="px-4 py-3" style="width: 5%">
                            @if ($editedStockIndex !== $key)
                                {{ $value->stok_keluar }}
                            @else
                                <input type="number" wire:model="stok_keluar"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                            @endif
                        </td>
                        <td class="px-4 py-3" style="width: 5%">
                            @if ($editedStockIndex !== $key)
                                <button wire:click.prevent="editedStock({{ $key }}, {{ $value->id }})"
                                    class="px-3 py-1 text-yellow-600 font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </button>
                            @else
                                <button wire:click.prevent="updateStok({{ $value->id }})"
                                    class="px-3 py-1 text-blue-600 font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
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
