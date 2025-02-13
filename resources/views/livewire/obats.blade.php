<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    @if (session()->has('message'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
        {{ session('message') }}
    </div>
    @endif

    <div class="text-2xl">List Obat</div>
    <div class="mt-8 text-2xl flex justify-center">
        <div class="mr-3">
            <x-button wire:click="confirmObatAdd">
                Tambah Obat
            </x-button>
        </div>
    </div>

    <div class="mt-6">
        <div class="flex justify-between mr-2 mb-5">
            <input type="text" wire:model.live="search" class="rounded-md" placeholder="Cari ...">
            <button wire:click="toggleActive"
                class="btn bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                {{ $active ? 'Semua' : 'Tersedia' }}
            </button>
        </div>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ID</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Nama Obat</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Harga</div>
                    </th>
                    <th class="px-4 py-2">
                        Status
                    </th>
                    <th class="py-2">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach($obats as $obat)
                <tr>
                    <td class="border px-4 py-2">{{ $obat->id }}</td>
                    <td wire:key="{{ $obat->id }}" class="border px-4 py-2">{{ $obat->nama }}</td>
                    <td class="border px-4 py-2">Rp. {{ number_format($obat->harga, 0) }}</td>
                    <td class="border px-4 py-2">{{ $obat->status ? 'Tersedia' :
                        'Tidak Tersedia'
                        }}</td>

                    <!-- Validasi Role -->
                    @if (auth()->user()->isAdmin())
                    <td class="border py-2 flex justify-center gap-3">
                        <x-secondary-button wire:click="confirmObatDeletion( {{ $obat->id }} )"
                            wire:loading.attr="disabled">
                            {{ __('Edit') }}
                        </x-secondary-button>
                        <x-danger-button wire:click="confirmObatDeletion( {{ $obat->id }} )"
                            wire:loading.attr="disabled">
                            {{ __('Hapus') }}
                        </x-danger-button>
                    </td>
                    @else
                    <td class="border py-2 flex justify-center gap-3">
                        <x-secondary-button wire:click="confirmObatDeletion( {{ $obat->id }} )"
                            wire:loading.attr="disabled" class="bg-blue-500 hover:bg-blue-700 text-white">
                            {{ __('Order') }}
                        </x-secondary-button>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">
        {{$obats->links()}}
    </div>

    <!-- Delete Obat Confirmation Modal -->
    <x-dialog-modal wire:model.live="confirmingObatDeletion">
        <x-slot name="title">
            {{ __('Hapus Obat') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Apa anda yakin ingin menghapus obat?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingObatDeletion', false)" wire:loading.attr="disabled">
                {{ __('Batal') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteObat({{$confirmingObatDeletion}})"
                wire:loading.attr="disabled">
                {{ __('Yakin') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Add Obat Confirmation Modal -->
    <x-dialog-modal wire:model.live="confirmingObatAdd">
        <x-slot name="title">
            {{ __('Tambahkan Obat') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <label>Nama Obat:</label>
                <input type="text" wire:model="nama" class="mt-1 block w-full">
                @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-6 sm:col-span-4 mt-4">
                <label>Harga:</label>
                <input type="text" wire:model="harga" class="mt-1 block w-full">
                @error('harga') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-6 sm:col-span-4 mt-4">
                <label for="" class="flex items-center">
                    <input type="checkbox" wire:model="status" class="form-checkbox" />
                    <span class="ml-2 text-sm text-gray-600">Tersedia</span>
                </label>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingObatAdd', false)" wire:loading.attr="disabled">
                {{ __('Batal') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="saveObat()" wire:loading.attr="disabled">
                {{ __('Simpan') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>