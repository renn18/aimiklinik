<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div class="text-2xl">List Obat</div>
    <div class="mt-8 text-2xl flex justify-center">
        <div class="mr-3">
            <x-button>
                Tambah Obat
            </x-button>
        </div>
    </div>

    <div class="mt-6">
        <div class="flex justify-between mr-2 mb-5">
            <input type="text" wire:model.live="search" class="rounded-md" placeholder="Cari ...">
            <button wire:click="toggleActive"
                class="btn bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                {{ $active ? 'Tampilkan Semua' : 'Tampilkan Aktif' }}
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
                    <td class="border py-2 flex justify-center gap-3">
                        <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                            {{ __('Edit') }}
                        </x-secondary-button>
                        <x-danger-button wire:click="confirmObatDeletion( {{ $obat->id }} )"
                            wire:loading.attr="disabled">
                            {{ __('Hapus') }}
                        </x-danger-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">
        {{$obats->links()}}
    </div>

    <!-- Delete User Confirmation Modal -->
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
</div>