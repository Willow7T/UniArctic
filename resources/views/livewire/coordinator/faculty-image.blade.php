<div>
    <form wire:submit="ImageUpload">
        <x-alert type="success" class="bg-green-700 text-green-100 p-4" />
        <x-alert type="error" class="bg-red-700 text-red-100 p-4" />
        @if (Auth::user()->faculty->image)
            <img class="max-w-xs max-h-64 pb-5 mx-auto" id="imagePreview" wire:ignore
            src="{{asset('storage/' . Auth::user()->faculty->image)}}" alt="Image Preview">
        <div class="flex flex-row gap-x-5">
        @endif
            <div class="relative mb-6 mx-auto">
                <label for="image"
                    class="dark:text-slate-100 dark:bg-[#5a32a3] dark:hover:bg-[#6f42c1] px-4 py-2 bg-[#007bff] border border-transparent rounded-md 
                    font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0056b3] focus:bg-gray-700 active:bg-gray-900 f
                    mx-5 ocus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Image (.jpeg/.jpg/.png file)
                </label>
                <input type="file" id="image" name="image" wire:model="image" accept=".jpeg,.jpg,.png"
                    onchange="previewImage(event)">
                <x-button type="submit"> Save </x-button>
            </div>
        </div>
    </form>
</div>
<script>
    function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(e) {
        var img = new Image();
        img.onload = function() {
            if ( img.height <= img.width) {
                alert("Please upload a portrait image.");
            } else {
                var output = document.getElementById('imagePreview');
                output.src = img.src;
            }
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>