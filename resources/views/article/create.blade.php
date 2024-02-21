

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-slate-100">
            Create Article
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow:sm sm:rounded-lg dark:bg-slake-900"> 
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-slate-900 dark:border-slate-900  dark:text-slate-100" >
                    <form id="create-article" method="POST" action="{{ route('article.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mx-auto">
                            <div class="border-b border-gray-300 relative mb-6 ">
                                <label for="title" class="block text-lg font-medium text-gray-700 dark:text-slate-100">Title</label>
                                <input type="text" placeholder="Give the Title for your article" class="block w-full py-2 px-3 border-0 outline-none focus:ring-0 placeholder-transparent dark:bg-slate-900 dark:text-slate-100" id="title" name="title" required>
                            </div>                           
                            <div class="border-b border-gray-300 relative mb-6">
                                <label for="intro" class="block text-lg font-medium text-gray-700 dark:text-slate-100">Intro</label>
                                <textarea placeholder="Write the Intro for your article" class="block w-full py-2 px-3 border-0 outline-none focus:ring-0 placeholder-transparent dark:bg-slate-900 dark:text-slate-100 resize-none" id="intro" name="intro" required></textarea>
                            </div>
                            <div class="border-b border-gray-300 relative mb-6">
                                <label for="tags" class="block text-lg font-medium text-gray-700 mb-2 dark:text-slate-100">Choose Tags</label>
                                <div class="grid grid-rows-2 grid-flow-col gap-4 pb-3">
                                    @foreach ($tags as $tag)
                                    <div class="form-check p-2 flex flex-col justify-center object-center">
                                        <label class="form-check-label dark:text-gray-100" for="tag{{ $tag->id }}">
                                            {{ $tag->name }}
                                        </label>
                                        <input class="form-check-input tag-checkbox rounded border-gray-300 text-[#007bff] focus:ring-[#007bff] dark:text-[#5a32a3] dark:focus:ring-[#6f42c1]" type="checkbox" value="{{ $tag->id }}" id="tag{{ $tag->id }}" name="tags[]">                                       
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- add image upload with image preview .jpeg/.jpg/.png --}}
                            <img class="max-w-xs max-h-64 pb-5" id="imagePreview" src="#" alt="Image Preview" style="display: none;">
                            <div class="flex flex-row gap-x-5">
                                <div class="relative mb-6">
                                    <label for="image" class="dark:text-slate-100 dark:bg-[#5a32a3] dark:hover:bg-[#6f42c1] px-4 py-2 bg-[#007bff] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0056b3] focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Image (.jpeg/.jpg/.png file)
                                    </label>                
                                    <input type="file" id="image" name="image" required accept=".jpeg,.jpg,.png" onchange="previewImage(event)">
                                </div>
                                <div class=" relative mb-6">
                                    <label for="content" class="
                                    dark:text-slate-100 dark:bg-[#5a32a3] dark:hover:bg-[#6f42c1] px-4 py-2 bg-[#007bff] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0056b3] focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Content (.docx file)
                                </label>                
                                        <input type="file" id="content" name="content"  required accept=".docx" onchange="previewDocxFileName(event)">                    
                                </div>
                                <div class=" relative mb-6">
                                    {{-- content name preview --}}
                                    <label for="content" id="contentPreview" class="
                                    dark:text-slate-100 font-semibold text-ls text-gray-900  tracking-widest">
                                    .docx file
                                </label>                
                                </div>
                            </div>

                           

                            <div class="border-b border-gray-300 relative mb-6">
                                <label for="magazine_id" class="block text-lg font-medium text-gray-700 mb-2 dark:text-slate-100">Choose the Issue</label>
                                <select id="magazine_id" name="magazine_id" class="block w-full py-2 px-3 border-0 outline-none focus:ring-0 dark:bg-slate-900 dark:text-slate-100">
                                    @foreach ($magazines as $magazine)
                                        <option value="{{ $magazine->id }}">{{ $magazine->issue_name }}  
                                            {{ DateTime::createFromFormat('!m', $magazine->month)->format('F') }} 
                                            {{$magazine->year}}  
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-center justify-between relative mb-6">
                                <label for="anon" class="block font-medium text-lg text-gray-700 dark:text-slate-100">Submit as Anonymous</label>
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

function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(e) {
        var img = new Image();
        img.onload = function() {
            if (img.width <= img.height) {
                alert("Please upload a landscape image.");
            } else {
                var output = document.getElementById('imagePreview');
                output.src = img.src;
                output.style.display = 'block';
            }
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
document.getElementById('create-article').addEventListener('submit', function(e) {
    var checkboxes = document.querySelectorAll('.tag-checkbox');
    var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
    if (!checkedOne) {
        alert('You must check at least one tag.');
        e.preventDefault();
    }
});
</script>
