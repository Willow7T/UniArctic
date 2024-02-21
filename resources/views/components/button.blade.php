<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 
border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest 
bg-blue-600 dark:text-slate-100 dark:bg-purple-700
dark:hover:bg-purple-600 hover:bg-blue-900
focus:bg-gray-700 active:bg-gray-900 
focus:outline-none focus:ring-2 
focus:ring-indigo-500 focus:ring-offset-2 
transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
