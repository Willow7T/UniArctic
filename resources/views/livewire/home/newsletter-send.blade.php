<div>
    <x-alert type="error" class="bg-red-100 text-red-500 p-4" />
    <x-alert type="success" class="bg-green-100 text-green-500 p-4" />
    <input type="email" name="email" id="email" wire:model="email" required>
    <x-button wire:click="subscribe">Subscribe</x-button>
    <x-secondary-button wire:click="unsubscribe" class="dark:bg-slate-900 dark:text-red-400 text-red-500 
    border-red-500 dark:border-red-400 hover:bg-red-300 hover:text-red-100 dark:hover:bg-red-500 dark:hover:text-red-300">Unsubscribe</x-secondary-button>
    <div wire:loading wire:target="subscribe">
        Processing...
    </div>
</div>
