<div>
    <div class="flex flex-col xl:flex-row gap-5 justify-between">
        <div class="flex justify-center mx-auto">
            <div class="bg-slate-300 dark:bg-slate-800 ml-2 mb-2 p-2 xl:w-fit sm:w-[400px]">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center">
                    Create a Monthly Issues
                </h3>
                <div class="max-w-72 mx-auto">
                    <form wire:submit.prevent="createMagazine" >
                        <x-alert type="success" class="bg-green-700 text-green-100 p-4" />
                        <x-alert type="error" class="bg-red-700 text-red-100 p-4" />
                        <div class="flex flex-col gap-x-5">
                            <div class="relative mb-6 mx-2 flex flex-col">
                                <label for="issue_name">Issue Name:</label>
                                <input class="dark:bg-slate-800 dark:text-slate-100" type="text" id="issue_name" name="issu_name" wire:model="issue_name" required>
                                <label for="month_year">Month and Year:</label>
                                <select class="dark:bg-slate-800 dark:text-slate-100" id="month_year" wire:model="month_year" required>
                                    <option value="">Select Month and Year</option>
                                    @foreach($monthList as $monthItem)
                                    <option value="{{ $monthItem['month'] . '-' . $monthItem['year'] }}">
                                        {{ date("F", mktime(0, 0, 0, $monthItem['month'], 10)) }} {{ $monthItem['year'] }}
                                    </option>
                                    @endforeach
                                </select>
        
                                <img class="w-42 h-64 pb-5 mx-auto my-3" id="imagePreview" wire:ignore src="#" alt="Image Preview">
                                <label for="image"
                                    class="mb-5  dark:text-slate-100 dark:bg-[#5a32a3] dark:hover:bg-[#6f42c1] px-4 py-2 bg-[#007bff] border border-transparent rounded-md 
                                    font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0056b3] focus:bg-gray-700 active:bg-gray-900 f
                                    mx-5 ocus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Image(.jpeg/.jpg/.png)
                                </label>
                                <input class="" type="file" id="image" name="image" wire:model="image" accept=".jpeg,.jpg,.png" hidden
                                    onchange="previewImage(event, 'imagePreview')">   
                            </div>
                            <div class="mx-auto">
                                <x-button type="submit"> Save </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center">
                Monthly Issues Status
            </h3>
            <div class="flex flex-col gap-x-5 mx-auto">
                <div class="relative mb-6 mx-auto mt-4">
                    <form wire:submit.prevent="$refresh"></form>
                    <label for="search">Issue Name:</label>
                    <input type="text" id="search" name="search" wire:model.blur="search" required>
                    <x-button type="submit">Search</x-button>
                </div>
                <div class="relative mb-6 mx-auto">
                    <label for="status">Status:</label>
                    <select id="status" wire:model.live="status" name="status">
                        <option value="0">Unpublish</option>
                        <option value="1">Published</option>
                    </select>
                    <select id="year" wire:model.live="year" name="year">
                        <option value="">Year</option>
                        @foreach($yearMagList as $yearItem)
                        <option value="{{ $yearItem }}">{{ $yearItem }}</option>
                        @endforeach
                    </select>
                    <select id="month" wire:model.live="month" name="month">
                        <option value="">Month</option>
                        @foreach($monthMagList as $monthItem)
                        <option value="{{ $monthItem }}">{{ date("F", mktime(0, 0, 0, $monthItem, 10)) }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="">
                {{-- show Issue data --Issue name, year, month, publish, article count --}}
                <table class="border-collapse border border-slate-500 w-full sm:w-3/4 lg:w-1/2 mx-auto overflow-x-auto">
                    <tr>
                        <th class="border border-slate-600 p-2 text-center">Issue Name</th>
                        <th class="border border-slate-600 p-2 text-center">Year</th>
                        <th class="border border-slate-600 p-2 text-center">Month</th>
                        <th class="border border-slate-600 p-2 text-center">Publish</th>
                        <th class="border border-slate-600 p-2 text-center">Article Count</th>
                        <th class="border border-slate-600 p-2 text-center">Download Published</th>
                    </tr>
                    @foreach($magazines as $index=>$magazine)
                    <tr class="{{ $index % 2 == 0 ? ' bg-gray-200 dark:bg-slate-800' : 'bg-white dark:bg-slate-900' }}">
                        <td class="border border-slate-600 p-2 text-center">{{ $magazine->issue_name }}</td>
                        <td class="border border-slate-600 p-2 text-center">{{ $magazine->year }}</td>
                        <td class="border border-slate-600 p-2 text-center">{{ date("F", mktime(0, 0, 0, $magazine->month, 10)) }}</td>
                        <td class="border border-slate-600 p-2 text-center">{{ $magazine->published ? 'Published' : 'Unpublished' }}</td>
                        <td class="border border-slate-600 p-2 text-center">{{ $magazine->articles->count() }}</td>
                        <td class="border border-slate-600 p-2 text-center">
                            <x-button wire:click="download({{$magazine}})" type="button" name="download">
                                Download As Zip
                            </x-button>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{$magazines->links(data: ['scrollTo' => false])}}
            </div>
            @if (auth()->user()->role_id == 1)
            <div class="flex flex-col gap-5">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Download Year Magazine
                </h3>
                <div class="flex flex-row gap-4">
                    <select id="yeardown" wire:model="yeardown" name="yeardown">
                        <option value="">Year</option>
                        @foreach($yearMagList as $yearItem)
                        <option value="{{ $yearItem }}">{{ $yearItem }}</option>
                        @endforeach
                    </select>
                    <x-button wire:click="Yeardown" name="year-down-button">
                        Download year magazine .zip
                    </x-button>
                </div>
                <x-alert type="noticeDown" class="bg-green-700 text-green-100 p-4" />
                <x-alert type="errorDown" class="bg-red-700 text-green-100 p-4" />
            </div>
            @endif
        </div>
        <div class="flex justify-center mx-auto">
            <div class="bg-slate-300 dark:bg-slate-800 ml-2 mb-2 p-2 xl:w-fit sm:w-[500px]">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center">
                    Make Changes to Monthly Issues
                </h3>
                <div class="max-w-72 mx-auto">
                    <form wire:submit.prevent="updateMagazine">
                        <x-alert type="success2" class="bg-green-700 text-green-100 p-4" />
                        <x-alert type="error2" class="bg-red-700 text-red-100 p-4" />
                        <div class="flex flex-col gap-x-5">
                            <div class="relative mb-6 mx-2 flex flex-col">
                                <label for="magazine_idupdate">Monthly Issues:</label>
                                <select id="magazine_idupdate" wire:model="magazine_idupdate" name="magazine_idupdate"
                                    wire:change="ImageMag()">
                                    <option value="">Select an Issue</option>
                                    @foreach($magazines as $magazine)
                                    <option value="{{ $magazine->id }}">{{ $magazine->issue_name }} {{ date("F", mktime(0,
                                        0, 0,
                                        $magazine->month, 10)) }} {{ $magazine->year }}</option>
                                    @endforeach
                                </select>
                
                                <label for="issue_nameupdate">Issue Name: </label>
                                <input type="text" id="issue_nameupdate" name="issue_nameupdate"
                                    wire:model="issue_nameupdate">
                           
                
                                <label for="statusupdate">Status:</label>
                                <select id="statusupdate" wire:model="statusupdate" name="statusupdate"> 
                                    <option value="0">Unpublish</option>
                                    <option value="1">Published</option>
                                </select>
                                
                                <div class="flex justify-between">
                                    <label for="imagebefore" class="dark:text-slate-100">
                                        Previous Image
                                    </label>
                                    <label for="imagebefore" class="dark:text-slate-100">
                                        Update Image
                                        <p>Image Preview</p>
                                    </label>
                                </div>
                                <div class="flex justify-between">
                                    
                                    <img class="w-40 h-60 pb-5 mx-auto my-3" id="imagebeforePreview"
                                        src="{{asset('storage/'. ($selectedMagazine->image ?? 'background/SampleMag.jpg'))}}"
                                        alt="Image Preview">
                                    
                                    <img class="w-40 h-60 pb-5 mx-auto my-3" id="imageupdatePreview" wire:ignore src="#" alt="">
                                </div>
                                   
                                <input type="file" id="imageupdate" name="imageupdate" wire:model="imageupdate"
                                    accept=".jpeg,.jpg,.png" hidden
                                    onchange="previewImage(event, 'imageupdatePreview')">
            
                                    <label for="imageupdate"
                                    class="mb-4 dark:text-slate-100 dark:bg-[#5a32a3] dark:hover:bg-[#6f42c1] px-4 py-2 bg-[#007bff] border border-transparent rounded-md 
                                    font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0056b3] focus:bg-gray-700 active:bg-gray-900 f
                                    mx-auto ocus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Image(.jpeg/.jpg/.png)
                                </label>   
                            </div>
                            <div class="mx-auto">
                                <x-button type="submit"> Save </x-button>
                            </div>
                        </div> 
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage(event, imageId) {
    var reader = new FileReader();
    reader.onload = function(e) {
        var img = new Image();
        img.onload = function() {
            if ( img.height <= img.width) {
                alert("Please upload a portrait image.");
            } else {
                var output = document.getElementById(imageId);
                output.src = img.src;
            }
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>