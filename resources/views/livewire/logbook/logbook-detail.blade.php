<div class="pb-20">
    @section('metas')
        <title>{{ __('Detail Logbook') }}</title>
    @endsection



    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-4">

                <div>
                    <label for="default-input"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><strong>Nama</strong></label>
                    <input type="text" value="{{ $data->nama }}" disabled id="default-input"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div class="mt-4">
                    <label for="default-input"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><strong>Unit
                            Kerja</strong></label>
                    <input type="text" value="{{ $data->unit }}" disabled id="default-input"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3 mt-4">
                    <div class="mb-3">
                        <div>
                            <label for=""
                                class="block text-sm text-gray-700 capitalize dark:text-gray-200"><strong>Tugas
                                    Pokok</strong></label>
                            <input type="text" disabled
                                value="{{ round(($tugas->count() / $datas->count()) * 100) }}%"
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div>
                            <label for=""
                                class="block text-sm text-gray-700 capitalize dark:text-gray-200"><strong>Bukan
                                    Tugas</strong></label>
                            <input type="text" disabled
                                value="{{ round(($bukan_tugas->count() / $datas->count()) * 100) }}%"
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div>
                            <label for=""
                                class="block text-sm text-gray-700 capitalize dark:text-gray-200"><strong>Tugas
                                    Tambahan</strong></label>
                            <input type="text" disabled
                                value="{{ round(($tugas_tambahan->count() / $datas->count()) * 100) }}%"
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between d p-4 mt-4">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3"></th>
                                    <th scope="col" class="px-4 py-3">Jam Kerja</th>
                                    <th scope="col" class="px-4 py-3">Kegiatan</th>
                                    <th scope="col" class="px-4 py-3">Lokasi</th>
                                    <th scope="col" class="px-4 py-3">Bersama</th>
                                    <th scope="col" class="px-4 py-3">Nilai</th>
                                    <th scope="col" class="px-4 py-3">status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $value)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-3" style="width: 1%">{{ $key+1 }}</td>
                                        <td class="px-4 py-3" style="width: 15% ">{{ $value->jam_kerja }}</td>
                                        <td class="px-4 py-3" style="width: 24%">{{ $value->kegiatan }}</td>
                                        <td class="px-4 py-3" style="width: 10%">{{ $value->lokasi }}</td>
                                        <td class="px-4 py-3" style="width: 10%">{{ $value->bersama }}</td>
                                        <td class="px-10 py-3" style="width: 15%">
                                            <div class="max-w-full">
                                                <select wire:click="set($event.target.value, {{ $value->id }})"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">

                                                    @if ($value->tugas == 1)
                                                        <option value="" disabled>Pilih Penilaian Tugas</option>
                                                        <option value="tugas" selected>Tugas</option>
                                                        <option value="tambahan">Tugas Tambahan</option>
                                                        <option value="bukan">Bukan Tugas</option>
                                                    @elseif ($value->tugas_tambahan == 1)
                                                        <option value="" disabled>Pilih Penilaian Tugas</option>
                                                        <option value="tugas">Tugas</option>
                                                        <option value="tambahan" selected>Tugas Tambahan</option>
                                                        <option value="bukan">Bukan Tugas</option>
                                                    @elseif ($value->bukan_tugas == 1)
                                                        <option value="" disabled>Pilih Penilaian Tugas</option>
                                                        <option value="tugas">Tugas</option>
                                                        <option value="tambahan">Tugas Tambahan</option>
                                                        <option value="bukan" selected>Bukan Tugas</option>
                                                    @else
                                                        <option value="" selected>Pilih Penilaian Tugas</option>
                                                        <option value="tugas">Tugas</option>
                                                        <option value="tambahan">Tugas Tambahan</option>
                                                        <option value="bukan">Bukan Tugas</option>
                                                    @endif

                                                </select>
                                            </div>
                                        </td>
                                        <td style="width: 10%">
                                            @if ($value->tugas == 1)
                                                <center> <span class="text-sm text-green-400">Tugas Pokok</span>
                                                </center>
                                            @elseif ($value->tugas_tambahan == 1)
                                                <center> <span class="text-sm text-green-400">Tugas Tambahan</span>
                                                </center>
                                            @elseif ($value->bukan_tugas == 1)
                                                <center> <span class="text-sm text-green-400">Bukan Tugas</span>
                                                </center>
                                            @else
                                                <center> <span class="text-sm text-red-600">Belum Dinilai</span>
                                                </center>
                                            @endif
                                        </td>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="px-4 py-3">Tugas Pokok</th>
                                    <th class="px-4 py-3">
                                        {{ round(($tugas->count() / $datas->count()) * 100) }}%
                                    </th>
                                </tr>
                                <tr>
                                    <th class="px-4 py-3">Tugas Tambahan</th>
                                    <th class="px-4 py-3">
                                        {{ round(($tugas_tambahan->count() / $datas->count()) * 100) }}%
                                    </th>
                                </tr>
                                <tr>
                                    <th class="px-4 py-3">Bukan Tugas</th>
                                    <th class="px-4 py-3">
                                        {{ round(($bukan_tugas->count() / $datas->count()) * 100) }}%
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
