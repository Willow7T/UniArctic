<style>
/* Customize the toggle button appearance */
.toggle-btn {
    width: 48px;
    height: 24px;
    border-radius: 9999px;
    background-color: #E5E7EB; /* Default background color */
    position: relative;
    cursor: pointer;
}

.toggle-btn::before {
    content: '';
    display: block;
    position: absolute;
    top: 2px;
    left: 2px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #FFFFFF;
    transition: transform 0.3s ease;
}

/* Move the slider when the checkbox is checked */
#anon:checked + .toggle-btn::before {
    transform: translateX(24px); /* Move the slider to the right */
}

/* Change background color of the toggle button when checked */
#anon:checked + .toggle-btn {
    background-color: #10B981; /* Green background color */
}


</style>

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
                            <div class="border-b border-gray-300 relative mb-6">
                                <label for="content" class="block text-lg font-medium text-gray-700 mb-4">Content (.docx file)</label>
                                <input type="file" id="content" name="content"  required accept=".docx">
                            </div>
                            <div class="border-b border-gray-300 relative mb-6">
                                <label for="content" class="block text-lg font-medium text-gray-700 mb-2">Choose the Issue</label>
                                <select id="magazine_id" name="magazine_id" class="block w-full py-2 px-3 border-0 outline-none focus:ring-0">
                                    @foreach ($magazines as $magazine)
                                        <option value="{{ $magazine->id }}">{{ $magazine->issue_name }}  
                                            {{ DateTime::createFromFormat('!m', $magazine->month)->format('F') }} 
                                            {{$magazine->year}}  
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="border-b flex items-center justify-between border-gray-300 relative mb-6">
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
