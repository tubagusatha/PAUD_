

<nav class="fixed top-0 z-50 w-full bg-blue-400 border-b  dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
          <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
              <span class="sr-only">Open sidebar</span>
              <i class="fa-solid fa-bars text-xl text-white"></i>
              </svg>
           </button>
           <img src="{{ asset('assets/image/icon-karawang.png') }}" class="h-14 hidden lg:block" alt="Flowbite Logo" />

        </div>
        <div class="flex items-center">
            <div class="flex items-center ms-3">
              <div>
                <div class="w-full">
                    <i class="fa-solid fa-user text-white" style="font-size: 25px" data-dropdown-toggle="dropdown-user"  aria-expanded="false"></i>
                </div>
              </div>
              <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                <div class="px-4 py-3 mx-5 " role="none">
                  <p class="text-sm text-gray-900 dark:text-white" role="none">
                    {{$user->nama_lengkap}}
                  </p>
                  <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                    {{$user->email}}
                  </p>
                </div>
                <ul class="py-1" role="none">
                  <li>
                    <a href="{{ route('akun', $user->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Akun</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white mb-7" role="menuitem">Profil</a>
                  </li>
                  <li>
                    <a href="{{url('logout')}}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Keluar</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
      </div>
    </div>
  </nav>
  


  <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
     <div class="h-full px-3 pb-4 overflow-y-auto bg-slate-800 dark:bg-gray-800">
        <p class="text-slate-500 mt-5">Umum</p>
        <ul class="space-y-2 font-medium">
           <li class="mt-2">
              <a href="{{ route('dashboard.user', ['uuid' => $user->uuid]) }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-slate-600 dark:hover:bg-gray-700 group">
                 <img src="{{asset('assets/image/ic_dashboard.png')}}" class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" alt="" srcset="">
                 <span class="ms-3 text-white">Dashboard</span>
              </a>
           </li>

           <li>
              <a href="{{ route('permohonan.user', ['uuid' => $user->uuid]) }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white  hover:bg-slate-600 dark:hover:bg-gray-700 group ">
                 <img src="{{asset('assets/image/ic_permohonan.png')}}" alt="" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" srcset="">
                 <span class="flex-1 ms-3 whitespace-nowrap text-white">Permohonan</span>
              </a>
           </li>
        </ul>
     </div>
  </aside>
  