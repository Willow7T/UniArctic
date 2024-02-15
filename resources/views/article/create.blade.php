

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Article
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- <img src="{{ asset('storage/background/images.jpg') }}" alt="Home Image"> --}}
                    <form method="POST" action="{{ route('article.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <div class="border-b border-gray-300 relative mb-6">
                                <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
                                <input type="text" placeholder="Give the Title for your article" class="block w-full py-2 px-3 border-0 outline-none focus:ring-0 placeholder-transparent" id="title" name="title" required>
                            </div>                           
                            <div class="border-b border-gray-300 relative mb-6">
                                <label for="intro" class="block text-lg font-medium text-gray-700">Intro</label>
                                <input type="text" placeholder="Write the Intro for your article" class="block w-full py-2 px-3 border-0 outline-none focus:ring-0 placeholder-transparent" id="intro" name="intro" required>
                            </div>  
                            {{-- add image upload with image preview .jpeg/.jpg/.png --}}
                            <img class="max-w-xs max-h-64 pb-5" id="imagePreview" src="#" alt="Image Preview" style="display: none;">
                            <div class="flex flex-row gap-x-5">
                                <div class=" relative mb-6">
                                    <label for="image" class="
                                        px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Image (.jpeg/.jpg/.png file)
                                    </label>                
                                        <input type="file" id="image" name="image"  required accept=".jpeg,.jpg,.png" onchange="previewImage(event)">
                                </div>
    
                                <div class=" relative mb-6">
                                    <label for="content" class="
                                    px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Content (.docx file)
                                </label>                
                                        <input type="file" id="content" name="content"  required accept=".docx" onchange="previewDocxFileName(event)">                    
                                </div>
                                <div class=" relative mb-6">
                                    {{-- content name preview --}}
                                    <label for="content" id="contentPreview" class="
                                        font-semibold text-ls text-gray-900  tracking-widest">
                                    .docx file
                                </label>                
                                </div>
                            </div>
                            

                            <div class="border-b border-gray-300 relative mb-6">
                                <label for="magazine_id" class="block text-lg font-medium text-gray-700 mb-2">Choose the Issue</label>
                                <select id="magazine_id" name="magazine_id" class="block w-full py-2 px-3 border-0 outline-none focus:ring-0">
                                    @foreach ($magazines as $magazine)
                                        <option value="{{ $magazine->id }}">{{ $magazine->issue_name }}  
                                            {{ DateTime::createFromFormat('!m', $magazine->month)->format('F') }} 
                                            {{$magazine->year}}  
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-center justify-between relative mb-6">
                                <label for="anon" class="block font-medium text-lg text-gray-700">Submit as Anonymous</label>
                                <div class="relative">
                                    <input type="checkbox" id="anon" name="anon" class="hidden">
                                    <button class="toggle-btn"></button>
                                </div>
                            </div>
                                
                            <div>
                                <x-button type="submit">
                                    Submit
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    // Function to handle focus and blur events for placeholder behavior
    function handlePlaceholderBehavior(inputId) {
        const inputElement = document.getElementById(inputId);
        inputElement.addEventListener("focus", function() {
            this.setAttribute("data-placeholder", this.getAttribute("placeholder"));
            this.removeAttribute("placeholder");
        });
        inputElement.addEventListener("blur", function() {
            this.setAttribute("placeholder", this.getAttribute("data-placeholder"));
            this.removeAttribute("data-placeholder");
        });
    }

    // Call the function for each input element
    handlePlaceholderBehavior("title");
    handlePlaceholderBehavior("intro");

    // ios button style
    
document.addEventListener("DOMContentLoaded", function() {
    // Handle click events on the toggle button
    document.querySelector('.toggle-btn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default action (form submission)
        document.querySelector('#anon').click(); // Trigger checkbox click
    });
});


</script>
