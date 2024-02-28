<div>
    <x-alert type="error" class="bg-red-100 text-red-500 p-4" />
    <x-alert type="success" class="bg-green-100 text-green-500 p-4" />
    <div class="py-8 lg:grid lg:grid-cols-5 gap-y-4 dark:text-gray-100 sm:flex sm:flex-col sm:flex-warp">
        <div class="lg:col-span-2 shadow-lg shadow-sky-300 dark:shadow-purple-500 mx-4">
            <h1 class="text-lg font-bold p-2">Stay in the loop! Subscribe to our newsletter.</h1>
            <p class="p-2">Connect with us and learn from other members of our community.</p>
            <b class="p-2">Subscribe Now!</b>
        </div>
        <div class="py-8 lg:col-span-3 mx-4">
            <input type="email" name="email" id="email" wire:model="email" required>
            <x-button wire:click="subscribe">Subscribe</x-button>
            <x-secondary-button wire:click="unsubscribe" class="dark:bg-slate-900 dark:text-red-400 text-red-500 
            border-red-500 dark:border-red-400 hover:bg-red-300 hover:text-red-100 dark:hover:bg-red-500 dark:hover:text-red-300">Unsubscribe</x-secondary-button>
            <div wire:loading wire:target="subscribe">
                Processing...
            </div>
        </div>
    </div>
    
   
</div>
