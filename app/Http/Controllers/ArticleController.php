<?php

namespace App\Http\Controllers;

use App\Mail\ArticleCreationNoti;
use App\Models\Article;
use App\Models\Magazine;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use App\Mail\ArticleUpNotiStu;
use App\Mail\ArticleUpNotiCoor;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Exception;

class ArticleController extends Controller
{

    //Create new article
    public function create()
    {
        $currentDay = date('j');
        $currentMonth = date('n');
        $currentYear = date('Y');

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
        $deadline = $daysInMonth - 14;
        $daysLeft = $daysInMonth - $currentDay;

        //for deadline
        if ($daysLeft <= 14) {
            $currentMonth++;
            if ($currentMonth > 12) {
                $currentMonth = 1;
                $currentYear++;
            }
            session()->flash('warning', 'Deadline for this month is up.There is less than 14 days in the current month. Please submit your article for the next month.');
        } else {
        }
        session()->flash('info', 'Today is ' . date('F') . ' ' . $currentDay . '. ' . $deadline . 'th ' . date('F') . ' is the deadline for submitting articles for the current month.');

        $twoMonthsLater = strtotime('+2 months');
        $monthTwoMonthsLater = date('n', $twoMonthsLater);
        $yearTwoMonthsLater = date('Y', $twoMonthsLater);

        if ($yearTwoMonthsLater != $currentYear) {
            $magazines = Magazine::where('published', false)
                ->where(function ($query) use ($currentYear, $currentMonth, $yearTwoMonthsLater, $monthTwoMonthsLater) {
                    $query->where([
                        ['year', '=', $currentYear],
                        ['month', '>=', $currentMonth],
                    ])->orWhere([
                        ['year', '=', $yearTwoMonthsLater],
                        ['month', '<=', $monthTwoMonthsLater],
                    ]);
                })
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
        } else {
            $magazines = Magazine::where('published', false)
                ->where(function ($query) use ($currentYear, $currentMonth, $yearTwoMonthsLater, $monthTwoMonthsLater) {
                    $query->where([
                        ['year', '=', $currentYear],
                        ['month', '>=', $currentMonth],
                        ['month', '<=', $monthTwoMonthsLater],
                    ]);
                })
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
        }


        $tags = Tag::all(); // Fetch all tags from the database
        //dd($daysInMonth, $currentDay , $daysLeft, $currentMonth, $currentYear );
        return view('article.create', ['magazines' => $magazines, 'tags' => $tags]);
    }

    //Show articles using ID
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $filePath = storage_path('app/public/' . $article->content);
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }
        // Load .docx file
        $phpWord = IOFactory::load($filePath);

        // Convert to HTML
        Settings::setOutputEscapingEnabled(true);
        $xmlWriter = IOFactory::createWriter($phpWord, 'HTML');


        // Save HTML to temp file
        $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
        $xmlWriter->save($tempFile);

        // Read contents of temp file
        $content = file_get_contents($tempFile);

        // Delete temp file
        unlink($tempFile);

        $userId = auth()->id();

        $view = $article->views()->where('user_id', $userId)->first();


        if (!$view) {
            $article->views()->create(['user_id' => $userId]);
        }

        $viewcount = $article->views()->count();

        return view('article.show', compact('article', 'content', 'viewcount'));
    }


    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $request->validate([
                'title' => ['required', 'unique:articles', 'max:255'],
                'intro' => ['required'],
                'image' => ['required', 'mimes:jpeg,png,jpg'],
                'content' => ['required', 'mimes:docx'],
                //anonymous checkbox
                'anon' => ['nullable'],

                'magazine_id' => ['required', 'exists:magazines,id'],
                'tags' => ['required', 'array'], // validate that tags is an array
                'tags.*' => ['exists:tags,id'], // validate that each tag ID exists in the tags table
            ]);

            $imagepath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $file->hashName('articles');

                // Store the file
                $imagepath = $file->store('articles', 'public');
                if (!$imagepath) {
                    throw new Exception('Failed to store image');
                }
            }

            $contentpath = null;
            if ($request->hasFile('content')) {
                $file = $request->file('content');
                $filename = $file->hashName('articles');

                // Store the file
                $contentpath = $file->store('articles', 'public');
                if (!$contentpath) {
                    throw new Exception('Failed to store content');
                }
            }

            $article = Article::create([
                'title' => $request->title,
                'intro' => $request->intro,
                'image' => $imagepath ?? null, // assuming $imagepath contains the path to the image file
                'content' => $contentpath ?? null, // assuming $contentpath contains the path to the content file
                'selected' => false,
                'published' => false,
                'anonymous' =>  $request->anon == 'on' ? true : false,
                'author_id' => auth()->id(),
                'faculty_id' => auth()->user()->faculty_id, // get faculty_id from the authenticated user
                'magazine_id' => $request->magazine_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if (!$article) {
                throw new Exception('Failed to create article');
            }
            $article->tags()->sync($request->tags);
            DB::commit();
            $coordinatorEmails = User::where('faculty_id', auth()->user()->faculty_id)
                ->where('role_id', 3)
                ->pluck('email')
                ->toArray();

            // Send the mailable
            if (!empty($coordinatorEmails)) {
                // Send the mailable
                Mail::to($coordinatorEmails)->send(new ArticleCreationNoti(auth()->user(), $article));
            }return redirect()->route('article.create')->with('success', 'Article created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

   
    public function download(Article $article)
    {
        // Check if the user is authorized to download the article
        $user = auth()->user();
        if ($user->id != $article->author_id && $user->role_id != 1 && $user->role_id != 2 && $user->role_id != 3) {
            abort(403, 'Unauthorized action.');
        }

        // Get the path to the article file
        $filePath = storage_path('app/public/' . $article->content);

        // Check if the file exists
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }
        $issueName = str_replace(' ', '_', $article->magazine->issue_name);
        $fileName = $user->name . '_' . $issueName . '_' . $article->magazine->year . '_' . DateTime::createFromFormat('!m', $article->magazine->month)->format('F') . '_' . '.docx';
        // Download the file
        return response()->download($filePath, $fileName);
    }


    public function reupload(Request $request, Article $article)
    {
        try {
            // Validate the request
            $request->validate([
                'content' => ['required', 'mimes:docx'],
            ]);
    
            // Check if a file was uploaded
            if ($request->hasFile('content')) {
                $file = $request->file('content');
                $filename = $file->hashName('articles');
    
                // Store the file
                $contentpath = $file->store('articles', 'public');
                if (!$contentpath) {
                    throw new Exception('Failed to store content');
                }
    
                // Update the article
                $article->update([
                    'content' => $contentpath,
                    'updated_at' => now(),
                ]);
            }
            if(auth()->user()->role_id == 4){
                $coordinatorEmails = User::where('faculty_id', auth()->user()->faculty_id)
                ->where('role_id', 3)
                ->pluck('email')
                ->toArray();

            // Send the mailable
            if (!empty($coordinatorEmails)) {
                // Send the mailable
                Mail::to($coordinatorEmails)->send(new ArticleUpNotiStu(auth()->user(), $article));
            }
            }
            else
            {
                $studentEmail = User::where('id', $article->author_id)->pluck('email')->toArray();
                
                Mail::to($studentEmail)->send(new ArticleUpNotiCoor(auth()->user(), $article));

            }
            
    
            return redirect()->route('articles.show', $article);
        } catch (Exception $e) {
            // Handle the exception
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    
}
