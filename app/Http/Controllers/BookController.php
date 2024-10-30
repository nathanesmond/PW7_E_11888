<?php
namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get book
        $book = Book::latest()->paginate(5);
        //render view with posts
        return view('book.index', compact('book'));
    }
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('book.create');
    }
    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'pages' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif'
        ]);

        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('image'), $imageName);
        $imagePath = 'image/' . $imageName;

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'pages' => $request->pages,
            'image' => $imagePath,
            // 'image' => $imagePath,
        ]);
        try {
            return redirect()->route('book.index');
        } catch (Exception $e) {
            return redirect()->route('book.index');
        }
    }
    /**
     * edit
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('book.edit', compact('book'));
    }
    /**
     * update
     *
     * @param mixed $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return redirect()->route('book.index')->withErrors(['error' => 'Book not found.']);
        }

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'pages' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,jfif'
        ]);

        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::delete($book->image);
            }

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('image'), $imageName);
            $imagePath = 'image/' . $imageName;
            $book->image = $imagePath;
        }

        $book->title = $request->title;
        $book->author = $request->author;
        $book->pages = $request->pages;
        $book->save();

        return redirect()->route('book.index')->with([
            'success' => 'Data Berhasil Diubah!'
        ]);
    }

    /**
     * destroy
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('book.index')->with([
            'success' => 'Data
Berhasil Dihapus!'
        ]);
    }
}