@extends('layout.app')

@section('content')
    @include('layout.nav.sidebarpm.sidebar') {{-- Include the sidebar --}}

    
    

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="flex justify-center items-center h-[75vh] px-8">
                <div class="text-center">
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold">Selamat datang, {{$user->nama_lengkap}}</h1>
                    <p class="mt-3 text-sm md:text-base lg:text-lg">
                        Anda bisa langsung melakukan permohonan. Pilih <strong>tipe permohonan</strong>,<br>
                        <strong>lanjutkan</strong>, lalu lengkapi persyaratan, kemudian <strong>kirim</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
@endsection
