<div>
    <div class="p-2">
        <div>
            <h1 class="pl-2 font-bold ">
                Most Viewed Articles
            </h1>
        </div>
       <table class="m-3 table-fixed border-collapse border border-slate-500 w-11/12">
             <thead>
                  <tr>
                    <th class="border border-slate-600">Article</th>
                    <th class="border border-slate-600">Author</th>
                    <th class="border border-slate-600">Views</th>
                  </tr>
             </thead>
             <tbody >
                @foreach($articles as $article)
                <tr>
                    <td class="border border-slate-600 text-left">{{ $article->title }}</td>
                    <td class="border border-slate-600 text-center">{{$article->author->name}}</td>
                    <td class="border border-slate-600 text-right">{{ $article->views_count }} views</td>
                </tr>
            @endforeach
             </tbody>
        </table>
        <div>
            <h1 class="pl-2 font-bold ">
                Top Contributing Students
            </h1>
        </div>
       <table class="m-3 table-fixed border-collapse border border-slate-500 w-11/12">
             <thead>
                  <tr>
                    <th class="border border-slate-600">Author</th>
                    <th class="border border-slate-600">Articles</th>
                  </tr>
             </thead>
             <tbody >
                @foreach($authors as $author)
                <tr>
                    <td class="border border-slate-600 text-left">{{ $author->name }}</td>
                    <td class="border border-slate-600 text-right">{{ $author->articles_count }}</td>
                </tr>
                @endforeach
             </tbody>
       </table>
    </div>
    
</div>
