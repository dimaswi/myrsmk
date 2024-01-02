<div class="m-10">
    @section('metas')
        <title>{{ __('Logbook Create') }}</title>
    @endsection

    <h1
        class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
        {{ $judul}}</h1>

    <form wire:submit.prevent="store">

        <input type="hidden" wire:model="uid">

        <div>
            <label for="" class="block text-sm text-gray-700 capitalize dark:text-gray-200"><strong>Shift</strong>
                <span class="text-red-500 ">*</span></label>
            <select id="countries_multiple" wire:click="set($event.target.value)" wire:model="shift"
                class="form-multiselect bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" selected>Pilih Shift</option>
                @foreach ($shifts as $value)
                    <option value="{{ $value->shift }}">{{ $value->shift }}</option>
                @endforeach
            </select>
            @error('shift')
                <span class="text-red-300">{{ $message }}</span>
            @enderror
        </div>

        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

        <div class="grid gap-4 sm:grid-cols-5 sm:gap-6 mt-4">
            <div class="w-full">
                <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam
                    Kerja</label>

                <select wire:model="jam_kerja"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Pilih Jam Kerja</option>
                    @foreach ($jadwals as $value)
                        <option value="{{ $value->jam_kerja }}">{{ $value->jam_kerja }}</option>
                    @endforeach
                </select>

                @error('jam_kerja')
                    <span class="text-red-300">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full">
                <label for="brand"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kegiatan</label>
                <input type="text" wire:model="kegiatan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                @error('kegiatan')
                    <span class="text-red-300">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full">
                <label for="price"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi</label>
                <input type="text" wire:model="lokasi"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                @error('lokasi')
                    <span class="text-red-300">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full">
                <label for="price"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bersama</label>
                <input type="text" wire:model="bersama"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                @error('bersama')
                    <span class="text-red-300">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full">
                <label for="price"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Simpan</label>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">simpan</button>
            </div>
        </div>

    </form>

    

    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3"></th>
                                <th scope="col" class="px-4 py-3">Jam Kerja</th>
                                <th scope="col" class="px-4 py-3">Kegiatan</th>
                                <th scope="col" class="px-4 py-3">Lokasi</th>
                                <th scope="col" class="px-4 py-3">Bersama</th>
                                <th scope="col" class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logbooks as $key => $value)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3" style="width: 5%">{{ $key + 1 }}</td>
                                    <td class="px-4 py-3" style="width: 10%">{{ $value->jam_kerja }}</td>
                                    <td class="px-4 py-3" style="width: 25%">{{ $value->kegiatan }}</td>
                                    <td class="px-4 py-3" style="width: 10%">{{ $value->lokasi }}</td>
                                    <td class="px-4 py-3" style="width: 10%">{{ $value->bersama }}</td>
                                    <td style="width: 10%">
                                        @if ($value->tugas == 0 && $value->bukan_tugas == 0 && $value->tugas_tambahan == 0)
                                            <button wire:click="remove({{ $value->id }})"
                                                class="px-3 py-1 bg-red-500 text-white rounded">
                                                Hapus
                                            </button>
                                        @else
                                            <button disabled class="px-3 py-1 bg-blue-500 text-white rounded">Ternilai</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>
