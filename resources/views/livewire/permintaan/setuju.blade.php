<div class="m-10">
    @if ($openDetail)
        <div class="mx-10">
            <div class="mb-10">
                <button type="button" wire:click.prevent="isDetailClose('{{ $nomor_permintaan }}')"
                    class="text-blue-500 hover:bg-blue-800 rounded-full font-bold text-xl ">
                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg></span>
                </button>
            </div>
            <div class="mb-10">
                <label for="website-admin" class="block mb-2 text-lg font-bold text-gray-900 dark:text-white">
                    Permintaan</label>
            </div>

            <div class="flex">
                <div class="flex-1">
                    <p class="block text-gray-600 dark:text-white">Nomor Permintaan - {{ $nomor_permintaan }}</p>
                </div>
                <div class="flex-1">
                    <p class="block text-gray-600 dark:text-white">Pemohon - {{ $unit }}</p>
                </div>
            </div>

            <div class="mb-10 mt-10">
                <hr>
            </div>

            <div class="mb-10">
                <label for="website-admin" class="block mb-2 text-lg font-bold text-gray-900 dark:text-white">
                    Tanggal</label>
            </div>

            <div class="flex">
                <div class="flex-1">
                    <p class="block text-gray-600 dark:text-white">Tanggal Permintaan - {{ $tanggal }}</p>
                </div>
                @if ($total_harga >= 500000)
                    <div class="flex-1">
                        <p class="block text-gray-600 dark:text-white">Surat Permintaan -
                        <button type="button" wire:click.prevent="downloadSurat('{{ $nomor_permintaan }}')"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Surat</button>
                        </p>
                    </div>
                @else
                @endif
            </div>

            <div class="mb-10 mt-10">
                <hr>
            </div>

            <div class="mb-10">
                <label for="website-admin" class="block mb-2 text-lg font-bold text-gray-900 dark:text-white">
                    List Permintaan</label>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Barang</th>
                            <th scope="col" class="px-4 py-3">Jumlah Barang</th>
                            <th scope="col" class="px-4 py-3">Harga Satuan</th>
                            <th scope="col" class="px-4 py-3">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permintaan as $key => $value)
                                <tr class="border-b dark:border-gray-700">
                                    {{-- @if ($editedSuratIndex !== $key) --}}
                                    <td class="px-4 py-3" style="width: 50%">{{ $value->nama_barang }}</td>
                                    <td class="px-4 py-3" style="width: 15%">{{ $value->jumlah }}</td>
                                    <td class="px-4 py-3" style="width: 15%">Rp. {{ number_format($value->harga) }}</td>
                                    <td class="px-4 py-3" style="width: 20%">Rp.
                                        {{ number_format($value->harga * $value->jumlah) }}</td>
                                </tr>
                            @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="px-4 py-3 font-bold">
                                <center>Total</center>
                            </td>
                            <td class="px-4 py-3 font-bold">Rp. {{ number_format($total_harga) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @else
        <div class="mx-10">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Permintaan Disetujui</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Permintaan sudah disetujui oleh logistik.</p>
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
                        <th scope="col" class="px-4 py-3">Nomor</th>
                        <th scope="col" class="px-4 py-3">Unit</th>
                        <th scope="col" class="px-4 py-3">Tanggal</th>
                        <th scope="col" class="px-4 py-3">Harga</th>
                        <th scope="col" class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (auth()->user()->hasRole('Logistik'))
                                @php
                                    $data = $setujuis_logistiks;
                                @endphp
                            @else
                                @php
                                    $data = $setujuis;
                                @endphp
                            @endif
                    @forelse($data as $value)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-3 font-bold" style="width: 10%">{{ $value->nomor_permintaan }}
                            </td>
                            <td class="px-4 py-3" style="width: 35%">{{ $value->unit }}</td>
                            <td class="px-4 py-3" style="width: 10%">{{ $value->tanggal }}</td>
                            <td class="px-4 py-3" style="width: 15%">Rp. {{ number_format($value->total) }}
                            <td class="px-4 py-3" style="width: 20%">
                                @if ($value->tanda_terima == 1)
                                    <button class="text-green-500 font-bold" type="button" disabled>Diterima</button>
                                @else                                    @can('manage_logistik')
                                        <button wire:click.prevent="diterima('{{ $value->nomor_permintaan }}')"
                                            class="px-3 py-1 text-green-600 font-bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                        </button>
                                    @endcan
                                    @endif
                                    <button wire:click="isDetailOpen('{{ $value->nomor_permintaan }}')"
                                        class="px-3 py-1 text-blue-600 font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                        </svg>
                                    </button>
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
            {{ $setujuis->links() }}
        </div>
    @endif

</div>
