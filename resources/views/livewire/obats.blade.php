<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div class="mt-8 text-2xl">
        List Obat
    </div>

    <div class="mt-6">
        <div class="flex justify-between">
            <div></div>
            <div class="mr-2 mb-5">
                <input type="checkbox" class="mr-2 leading-tight" wire:model="active" />Hanya yang tersedia?
            </div>
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
                    <th class="px-4 py-2">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach($obats as $obat)
                <tr>
                    <td class="border px-4 py-2">{{ $obat->id }}</td>
                    <td class="border px-4 py-2">{{ $obat->nama }}</td>
                    <td class="border px-4 py-2">Rp. {{ number_format($obat->harga, 0) }}</td>
                    <td class="border px-4 py-2">{{ $obat->status ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                    <td class="border px-4 py-2">Edit/Delete</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>