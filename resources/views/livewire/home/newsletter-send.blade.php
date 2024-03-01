<div>
    <x-alert type="error" class="bg-red-100 text-red-500 p-4" />
    <x-alert type="success" class="bg-green-100 text-green-500 p-4" />
    <div class="py-8 lg:grid lg:grid-cols-5 gap-y-4 dark:text-gray-100 sm:flex sm:flex-col sm:flex-warp">
        <div class="lg:col-span-2 shadow-lg shadow-sky-300 dark:shadow-purple-500 mx-4">
            <h1 class="text-lg font-bold p-2">Stay in the loop! Subscribe to our newsletter.</h1>
            <p class="p-2">Connect with us and learn from other members of our community.</p>
            <b class="p-2">Subscribe Now!</b>
        </div>
        <div class="py-16 lg:col-span-3 flex flex-row gap-2">
            <div>
                <input class="rounded" type="email" name="email" id="email" wire:model="email" required>
                <p wire:click="unsubscribe" class="text-red-400 text-right hover:cursor-pointer hover:text-red-500">Unsubcribe</p>
            </div>
            <div>
                <x-button wire:click="subscribe">Subscribe</x-button>

            </div>
        </div>
        
    </div>
</div>


</div>