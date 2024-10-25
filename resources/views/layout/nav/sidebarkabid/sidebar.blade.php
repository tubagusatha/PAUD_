

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
          <a href="{{url('logout')}}" class=" font-bold rounded block px-4 py-2 text-sm border text-white hover:bg-slate-600 " role="menuitem">Keluar</a>
          </div>
      </div>
    </div>
  </nav>
  


  <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
     <div class="h-full px-3 pb-4 overflow-y-auto bg-slate-800 dark:bg-gray-800">
        <p class="text-slate-500 mt-5">Umum</p>
        <ul class="space-y-2 font-medium">
           <li class="mt-2">
              <a href="{{ route('kabid.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-slate-600 dark:hover:bg-gray-700 group">
                 <img src="{{asset('assets/image/ic_dashboard.png')}}" class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" alt="" srcset="">
                 <span class="ms-3 text-white">Dashboard</span>
              </a>
           </li>

           <li>
              <a href="{{ route('kabid.permohonan', ['uuid' => $user->uuid]) }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white  hover:bg-slate-600 dark:hover:bg-gray-700 group ">
                 <img src="{{asset('assets/image/ic_permohonan.png')}}" alt="" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" srcset="">
                 <span class="flex-1 ms-3 whitespace-nowrap text-white">Permohonan</span>
              </a>
           </li>
        </ul>
     </div>
  </aside>
  