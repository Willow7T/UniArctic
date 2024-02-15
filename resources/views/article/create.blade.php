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
                    <form method="POST" action="{{ route('article.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" required>
                        </div>
                        <div>
                            <label for="intro">Intro</label>
                            <input type="text" id="intro" name="intro" required>
                        </div>
                        <div>
                            <label for="content">Content (.docx file)</label>
                            <input type="file" id="content" name="content"  required accept=".docx">
                        </div>
                        <div>
                            <label for="magazine">Magazine</label>
                            <select id="magazine_id" name="magazine_id">
                                @foreach ($magazines as $magazine)
                                    <option value="{{ $magazine->id }}">{{ $magazine->issue_name }}</option>
                                @endforeach
                            </select>
                        </div>
                            <label for="anon">Submit as Anon</label>
                            <input type="checkbox" id="anon" name="anon">
                        </div>
                        <div>
                            <x-button type="submit">
                                Create
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>