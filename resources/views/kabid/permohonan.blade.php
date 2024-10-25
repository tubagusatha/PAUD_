@extends('layout.app')


@section('content')
    @include('layout.nav.sidebarkabid.sidebar')

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="flex justify-start h-[75vh] p-8 bg-slate-50 w-full">
                <div class="text-start">
                    <h1 class="text-sm md:text-2xl lg:text-xl font-medium mb-3">Data Permohonan PAUD</h1>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-9">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-2 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">No Resi</th>
                                    <th scope="col" class="px-6 py-3">Tipe Permohonan</th>
                                    <th scope="col" class="px-6 py-3">Status Pengajuan</th>
                                    <th scope="col" class="px-6 py-3">Tanggal Pengajuan</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permohonans as $permohonan)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $permohonan->no_resi }}
                                        </th>
                                        <td class="px-6 py-4">
                                            @if ($permohonan->tipe_permohonan == true)
                                                Izin Operasional Paud
                                            @else
                                                Izin Satuan Paud
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($permohonan->tipe_permohonan == true)
                                                Pengajuan Baru
                                            @else
                                                Pengajuan Perpanjangan
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">{{ $permohonan->created_at->format('d/m/Y') }}</td>
                                        @if ($permohonan->status->id < 4)
                                            <td class="px-6 py-4 text-yellow-300">{{ $permohonan->status->name }}</td>
                                        @else
                                            <td class="px-6 py-4 text-green-500">{{ $permohonan->status->name }}</td>
                                        @endif

                                        <td class="px-6 py-4">
                                            @if ($permohonan->status->id == 9)
                                                <a href="{{ route('kabid.show.tosekdin', $permohonan->id) }}"
                                                    class="bg-blue-500 py-1 px-5 rounded-sm font-medium text-white dark:text-blue-500 hover:underline">
                                                    Detail
                                                </a>
                                            @else
                                                @if ($permohonan->status->id < 4)
                                                    <a href="{{ route('kabid.show', $permohonan->id) }}"
                                                        class="bg-blue-500 py-1 px-5 rounded-sm font-medium text-white dark:text-blue-500 hover:underline">
                                                        Detail
                                                    </a>
                                                @else
                                                    @if ($permohonan->status->id == 12)
                                                        <span class="text-gray-500">Sudah Di Kembalikan </span>
                                                    @else
                                                        <span class="text-gray-500">Sudah Di Disposikan</span>
                                                    @endif
                                                @endif
                                            @endif


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
