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
                        <th class="border border-slate-600 backdrop-blur-sm p-4">Article</th>
                        <th class="border border-slate-600 backdrop-blur-sm p-4">Author</th>
                        <th class="border border-slate-600 backdrop-blur-sm p-4">Views</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach($articles as $article)
                    <tr class="h-10">
                        <td class="border border-slate-600 backdrop-blur-sm p-4 text-left">{{ $article->title }}</td>
                        <td class="border border-slate-600 backdrop-blur-sm p-4 text-center">{{ optional($article->author)->name ?? 'Deleted User' }}</td>
                        <td class="border border-slate-600 backdrop-blur-sm p-4 text-right">{{ $article->views_count }} views</td>
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
                     <tr class="h-10">
                       <th class="border border-slate-600 p-4 backdrop-blur-sm">Author</th>
                       <th class="border border-slate-600 p-4 backdrop-blur-sm">Articles</th>
                     </tr>
                </thead>
                <tbody >
                   @foreach($authors as $author)
                   <tr>
                        {{-- <p>{{ $article->anonymous ? "Anonymous" : $article->author->name  }}</p> --}}
                        <td class="border border-slate-600 text-left p-4 backdrop-blur-sm">{{ optional($author)->name ?? 'Deleted User' }}</td>
                        <td class="border border-slate-600 text-right p-4 backdrop-blur-sm">{{ $author->articles_count }}</td>
                   </tr>
                   @endforeach
                        <td class="border border-slate-600 text-left p-4 backdrop-blur-sm">Deleted Author"s"</td>
                        <td class="border border-slate-600 text-right p-4 backdrop-blur-sm">{{ $deleted_authors[0]->counters}}</td>
                </tbody>
          </table>
        </div>
       
    </div>
    
</div>
