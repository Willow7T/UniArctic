<x-form-section submit="updatePassword">
    <x-slot name="title">
        <div class="dark:text-slate-100">
            {{ __('Update Password') }}
        </div>   
    </x-slot>

    <x-slot name="description">
        <div class="dark:text-slate-300">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </div>         
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4 ">
            <x-label for="current_password" value="{{ __('Current Password') }}" class="dark:text-slate-300"/>
            <x-input id="current_password" name="current_password" type="password" class="mt-1 block w-full border-gray-100 border-2 dark:bg-slate-800 dark:text-slate-100 dark:border-slate-200 
            focus:outline-none focus:border-blue-800 focus:ring-blue-800 dark:focus:border-purple-600 dark:focus:ring-purple-600
             hover:border-blue-600 rounded-md sm:text-sm dark:hover:border-purple-600" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 dark:text-slate-300">
            <x-label for="password" value="{{ __('New Password') }}" class="dark:text-slate-300"/>
            <x-input id="password" type="password" name="password" class="mt-1 block w-full border-gray-100 border-2 dark:bg-slate-800 dark:text-slate-100 dark:border-slate-200 
            focus:outline-none focus:border-blue-800 focus:ring-blue-800 dark:focus:border-purple-600 dark:focus:ring-purple-600
             hover:border-blue-600 rounded-md sm:text-sm dark:hover:border-purple-600" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="dark:text-slate-300"/>
            <x-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border-gray-100 border-2 dark:bg-slate-800 dark:text-slate-100 dark:border-slate-200 
            focus:outline-none focus:border-blue-800 focus:ring-blue-800 dark:focus:border-purple-600 dark:focus:ring-purple-600
             hover:border-blue-600 rounded-md sm:text-sm dark:hover:border-purple-600" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
