
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
