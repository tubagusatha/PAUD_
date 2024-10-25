
@extends('layout.app')

@section('content')

    <!-- Button to open modal -->
    <button id="login-button"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        Login
    </button>

    <!-- Modal -->
    <div id="popup-modal" tabindex="-1" class="hidden fixed inset-0 flex items-center justify-center z-50">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full max-w-md">
            <button type="button"
                class="absolute top-3 right-3 text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <!-- Loading Content -->
            <div id="loading-content" class="flex flex-col items-center justify-center p-4 md:p-5">
                <div class="spinner-border"></div>
                <p class="text-gray-500 dark:text-gray-400">Loading...</p>
            </div>

            <!-- Success Content -->
            <div id="success-content" class="hidden p-4 md:p-5 text-center">
                <svg class="mx-auto mb-2 text-green-500 w-24 h-24 checkmark" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 10l3 3 7-7" />
                </svg>
                <h2 class="text-lg font-bold text-gray-500 dark:text-gray-400">Login Berhasil</h3>
                    <h3 class="mb-5 text-base font-normal text-gray-500 dark:text-gray-400">Sistem akan mengarahkan mu
                        ke menu utama</h3>
                    <button id="continue-button" type="button"
                        class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Ketuk untuk melanjutkan
                    </button>
            </div>
        </div>
    </div>



   <!-- Button to open modal -->
<button id="attention-button" class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button">
    Perhatian
</button>

<!-- Modal -->
<div id="attention-modal" tabindex="-1" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full max-w-md">
        <button type="button" class="absolute top-3 right-3 text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="attention-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center">
            <!-- Attention Icon -->
            <svg class="mx-auto mb-4 text-red-500 w-12 h-12 attention-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 3v3m0 15h.01M2.93 4.93l1.42 1.42M21.07 4.93l-1.42 1.42M4.93 21.07l1.42-1.42M19.07 21.07l-1.42-1.42M4 12a8 8 0 1 1 16 0 8 8 0 0 1-16 0Z"/>
            </svg>
            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Perhatian</h3>
            <div class="flex justify-center">
                <button id="cancel-button" type="button" class="text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Batal
                </button>
                <button id="confirm-button" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ms-3">
                    Teruskan
                </button>
            </div>
        </div>
    </div>
</div>


    <style>
        /* Spinner styling */
        .spinner-border {
            width: 48px;
            height: 48px;
            border: 4px solid transparent;
            border-top-color: #007bff;
            /* Adjust color as needed */
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Keyframes for spinning animation */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Checkmark animation */
        @keyframes checkmark {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .checkmark {
            animation: checkmark 0.5s ease-in-out;
        }

        /* Attention icon styling */
        @keyframes attention-icon {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .attention-icon {
            animation: attention-icon 0.5s ease-in-out;
        }
    </style>



    <script>
        // Handling the Login Button
        document.getElementById('login-button').addEventListener('click', function() {
            // Show the modal
            document.getElementById('popup-modal').classList.remove('hidden');

            // Show loading content initially
            document.getElementById('loading-content').classList.remove('hidden');
            document.getElementById('success-content').classList.add('hidden');

            // After 4 seconds, switch to success content
            setTimeout(function() {
                document.getElementById('loading-content').classList.add('hidden');
                document.getElementById('success-content').classList.remove('hidden');
            }, 4000);
        });

        // Handling the Attention Button
        document.getElementById('attention-button').addEventListener('click', function() {
            // Show the attention modal
            document.getElementById('attention-modal').classList.remove('hidden');
        });

        document.querySelector('[data-modal-hide="popup-modal"]').addEventListener('click', function() {
            // Hide the popup modal
            document.getElementById('popup-modal').classList.add('hidden');
        });

        document.querySelector('[data-modal-hide="attention-modal"]').addEventListener('click', function() {
            // Hide the attention modal
            document.getElementById('attention-modal').classList.add('hidden');
        });

        document.getElementById('continue-button').addEventListener('click', function() {
            // Handle the continuation action
            console.log('Proceeding to the next step');
            document.getElementById('popup-modal').classList.add('hidden');
        });

        document.getElementById('cancel-button').addEventListener('click', function() {
            // Handle the cancel action
            console.log('Action cancelled');
            document.getElementById('attention-modal').classList.add('hidden');
        });

        document.getElementById('confirm-button').addEventListener('click', function() {
            // Handle the confirmation action
            console.log('Action confirmed');
            document.getElementById('attention-modal').classList.add('hidden');
        });
    </script>

@endsection