
<style>
    .bg-slate-900 {
        background-color: #1a202c;
    }

    .mt-32 {
        margin-top: 8rem;
    }

    .m-6 {
        margin: 1.5rem;
    }

    .text-center {
        text-align: center;
    }

    .font-bold {
        font-weight: 700;
    }

    .text-teal-400 {
        color: #38b2ac;
    }

    .bg-teal-400 {
        background-color: #4fd1c5;
    }

    .rounded-sm {
        border-radius: .125rem;
    }

    .text-right {
        text-align: right;
    }

    .p-10 {
        padding: 2.5rem;
    }

    .bg-slate-800 {
        background-color: #2d3748;
    }

    a {
        text-decoration: none;
        color: black;
    }

    .text-gray-100 {
        color: #f7fafc;
    }

    * {
        font-family: 'Nunito', sans-serif;
    }

    button {
        padding: 10px;
        border-radius: 5px;
        color: white;
        border: none;
        cursor: pointer;
    }

    .p-2 {
        padding: .5rem;
    }

    .py-5 {
        padding-top: 1.25rem;
        padding-bottom: 1.25rem;
    }

    .indent-8 {
        text-indent: 2rem;
    }
</style>

<div class="bg-slate-900 mt-32 m-6 p-10 text-gray-100">
    <div class="text-center">
        <h2 class="font-bold text-teal-400 bg-slate-800 p-2">UniArctic</h2>
        <h4>New Article Submission</h4>
        <p>{{$user->email}}</p>
        <p>{{$article->title}}</p>
    </div>
    <div>
        <p>Dear Coordinator,</p>
        <p class="indent-8">There is a article submitted in your faculty. Please check the articles before the deadline. Select the article for publishing.</p>
        {{-- <p></p> --}}
        <div class="text-center py-5">
            <button class="bg-teal-400 rounded-sm text-center "><a class="text-gray-100"
                    href="{{ route('article.show', ['id' => $article->id, 'title' => Str::slug($article->title)]) }}">Check Aritcles Submissions</a></button>
        </div>
        <p class="text-right">Thank you.</p>
    </div>
</div>
