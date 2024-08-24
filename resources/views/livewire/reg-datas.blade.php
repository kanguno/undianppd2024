<div class="p-10 grid">
    <h1 class="font-bold text-2xl text-center">Data Undian Pajak Daerah Tahun 2024</h1>

    <x-loading/>
    @if(!empty($notification))
    <div x-data="{ open: @entangle('open'), notificationType: @entangle('notificationType') }"
             x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 flex p-5 items-center justify-center z-50">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div :class="{
                'text-green-500': notificationType === 'success',
                'text-red-500': notificationType === 'error',
                'text-blue-500': notificationType === 'info'
            }"
                 class="relative bg-white text-center font-semibold rounded-2xl shadow-lg p-4 max-w-md mx-auto"
                 role="alert"
                 aria-live="assertive">
                 
                <button @click="open = false" class="absolute top-2 right-2 text-gray-900" aria-label="Close notification">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <p class="p-2 my-2 mx-5">{{ $notification }}</p>
            </div>
        </div>
        @endif

   
    <table class="my-10 mx-auto min-w-full rounded-md shadow-md bg-white">
        <tr >
            <td class="flex justify-between border-2">
                <!-- Radio buttons (hidden) -->
                <input type="radio" class="hidden" id="tab1" wire:model.live="statusid" name="statusid" value="1">
                <input type="radio" class="hidden" id="tab2" wire:model.live="statusid" name="statusid" value="3">
                <input type="radio" class="hidden" id="tab3" wire:model.live="statusid" name="statusid" value="4">
                <input type="radio" class="hidden" id="tab4" wire:model.live="statusid" name="statusid" value="0">

                <!-- Labels for radio buttons -->
                <div class="flex items-end">
                    <label for="tab1" class="tab-label px-4 py-2 cursor-pointer {{ $statusid === '1' ? 'border-t-2 border-x-2 border-t-[#818cf8] rounded-t-lg  bg-white -mb-1 ' : '' }} transition-colors duration-300">Belum Divalidasi</label>
                    <label for="tab2" class="tab-label px-4 py-2 cursor-pointer {{ $statusid === '3' ? 'border-t-2 border-x-2 border-t-[#818cf8] rounded-t-lg  bg-white -mb-1' : '' }} transition-colors duration-300">Diterima</label>
                    <label for="tab3" class="tab-label px-4 py-2 cursor-pointer {{ $statusid === '4' ? 'border-t-2 border-x-2 border-t-[#818cf8] rounded-t-lg  bg-white -mb-1' : '' }} transition-colors duration-300">Ditolak</label>
                    <label for="tab4" class="tab-label px-4 py-2 cursor-pointer {{ $statusid === '0' ? 'border-t-2 border-x-2 border-t-[#818cf8] rounded-t-lg  bg-white -mb-1' : '' }} transition-colors duration-300">Semua</label>
                </div>
                <div class="p-2 mr-2 grid float-end">
                    <div>
                    <label for="jmldata">Jumlah Data yang Ditampilkan :</label>
                            <select wire:model.live="jmldata" name="jmldata" id="jmldata" class="hover:cursor-pointer border-none w-auto">
                                <option value="1">1</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                    </div>
                    
                    <button wire:click="exportData({{$statusid}})" class="bg-green-700 w-fit px-4 py-2 text-white justify-self-end mt-3 rounded-lg shadow-lg">Export Data</button>
                </div>
                
            </td>
        </tr>
        <tr>
            <td  class="p-5">
                <table class="my-10 mx-auto min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">No.</th>
                            <th class="border px-4 py-2">NIK</th>
                            <th class="border px-4 py-2">Nama WP</th>
                            <th class="border px-4 py-2">No. Pendaftaran</th>
                            <th class="border px-4 py-2">Merchant</th>
                            <th class="border px-4 py-2">Tanggal Transaksi</th>
                            <th class="border px-4 py-2">Status</th>
                            @if($statusid=='3')
                            <th class="border px-4 py-2">No. Undian</th>
                            @endif
                            @if($statusid=='4'||$statusid=='0')
                            <th class="border px-4 py-2">Keterangan</th>
                            @endif
                            @if($statusid>'0')
                            <th class="border px-4 py-2">Action</th>
                            @endif
                            <th class="border px-4 py-2">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataregs as $index => $reg)
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $index + 1 + ($dataregs->currentPage() - 1) * $dataregs->perPage() }}</td>
                                <td class="border px-4 py-2 text-center">{{ $reg->nik }}</td>
                                <td class="border px-4 py-2 text-center">{{ $reg->nm_wp }}</td>
                                <td class="border px-4 py-2 text-center">{{ $reg->id }}</td>
                                <td class="border px-4 py-2 text-center">{{ $reg->nm_merchant }}</td>
                                <td class="border px-4 py-2 text-center">{{ $reg->tgl_bill }}</td>
                                <td class="border px-4 py-2 text-center">{{ $reg->reg_status }}</td>
                                    @if($statusid=='0')
                                    <td class="border px-4 py-2 text-center">{{ $reg->keterangan }}</td>
                                    @elseif($statusid=='1')
                                    <td class="border px-4 py-2 text-center">
                                        <button wire:click="ValidasiData({{$reg->id}})" 
                                        @if ($reg->status_id == '1')
                                        class="btn py-1 px-2 bg-blue-600 text-white rounded-md"
                                        @elseif ($reg->status_id == '2') class="btn py-1 px-2 bg-gray-600 text-white rounded-md" disabled
                                        @endif
                                        >Validasi</button>
                                    </td>
                                    @elseif($statusid=='3')
                                    <td class="border px-4 py-2 text-center">{{ $reg->no_undian }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <a wire:click="KirimData({{ $reg->id }}, '{{ $reg->status_id }}')" class="btn py-1 px-2 bg-green-600 text-white rounded-md">Kirim</a>
                                    </td>
                                    @elseif($statusid=='4')
                                    <td class="border px-4 py-2 text-center">{{ $reg->keterangan }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <a wire:click="KirimData({{ $reg->id }}, '{{ $reg->status_id }}')" class="btn py-1 px-2 bg-green-600 text-white rounded-md">Kirim</a>
                                    </td>
                                    @endif
                                
                                <td class="border px-4 py-2 text-center">
                                    <button wire:click="resetValidasi({{$reg->id}})" class="btn py-1 px-2 bg-yellow-600 text-white rounded-md">Reset</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border px-4 py-2 text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    

    <!-- Paginasi -->
    <div class="mt-4">
    {{ $dataregs->links() }}
    </div>
<script>
    window.addEventListener('redirect', event => {
        console.log('Event detail received:', event.detail); // Cek detail event
        if (event.detail && typeof event.detail.url === 'string') {
            console.log('Attempting to open URL:', event.detail.url); // Cek URL
            window.open(event.detail.url, '_blank');
        } else {
            console.error('URL is not present in event.detail or is not a string.');
        }
    });
</script>
</div>