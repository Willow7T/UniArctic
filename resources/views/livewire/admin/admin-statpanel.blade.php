<div>
    <div class="p-2">
        <div>
            <h1 class="pl-2 font-bold ">
                Most Viewed Articles
            </h1>
        </div>
        <div class="m-3 h-[20rem] overflow-y-scroll">
            <table class="m-3 table-fixed border-collapse border border-slate-500 w-11/12">
                <thead>
                    <tr class="h-10">
                        <th class="border border-slate-600  p-4">Article Title</th>
                        <th class="border border-slate-600  p-4">Author</th>
                        <th class="border border-slate-600  p-4">Views</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach($articles as $index1=>$article)
                    <tr class="h-10 {{ $index1 % 2 == 0 ? ' bg-gray-200 dark:bg-slate-800' : 'bg-white dark:bg-slate-900' }}">
                        <td class="border border-slate-600  p-4 text-left">{{ $article->title }}</td>
                        <td class="border border-slate-600  p-4 text-center">{{ optional($article->author)->name ?? 'Deleted User' }}</td>
                        <td class="border border-slate-600  p-4 text-right">{{ $article->views_count }} views</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <h1 class="pl-2 font-bold ">
                Top Contributing Students
            </h1>
        </div>
        <div class="m-3 h-[20rem] overflow-y-scroll">
            <table class="m-3 table-fixed border-collapse border border-slate-500 w-11/12">
                <thead>
                     <tr class="h-10 ">
                       <th class="border border-slate-600 p-4 ">Author</th>
                       <th class="border border-slate-600 p-4 ">Article count</th>
                     </tr>
                </thead>
                <tbody >
                   @foreach($authors as $index2=>$author)
                   <tr class="{{ $index2 % 2 == 0 ? ' bg-gray-200 dark:bg-slate-800' : 'bg-white dark:bg-slate-900' }}">
                        {{-- <p>{{ $article->anonymous ? "Anonymous" : $article->author->name  }}</p> --}}
                        <td class="border border-slate-600 text-left p-4 ">{{ optional($author)->name ?? 'Deleted User' }}</td>
                        <td class="border border-slate-600 text-right p-4 ">{{ $author->articles_count }}</td>
                   </tr>
                   @endforeach
                        <td class="border border-slate-600 text-left p-4 ">Deleted Author"s"</td>
                        <td class="border border-slate-600 text-right p-4 ">{{ $deleted_authors[0]->counters}}</td>
                </tbody>
          </table>
        </div>
       
    </div>
    
</div>
