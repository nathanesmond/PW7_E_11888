<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookings;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $bookings = Bookings::latest()->paginate(5);
        //render view with posts
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $books = Book::all();

        return view('bookings.create', compact('books'));
    }

    public function store(Request $request)
    {
        //Validasi Formulir
        $request->validate([
            'id_book' => 'required',
            'class' => 'required',
            'price' => 'required'
        ], [
            'id_book.required' => '! Book Tidak boleh kosong',
            'class.required' => '! Class Tidak boleh kosong',
            'price.required' => '! Price Tidak boleh kosong',
        ]);
        //Fungsi Simpan Data ke dalam Database

        Bookings::create([
            'id_book' => $request->id_book,
            'class' => $request->class,
            'price' => $request->price,
        ]);
        try {
            return redirect()->route('bookings.index');
        } catch (Exception $e) {
            return redirect()->route('bookings.index');
        }
    }

    public function edit($id)
    {
        $bookings = Bookings::find($id);
        $books = Book::all();

        return view('bookings.edit', compact('bookings', 'books'));
    }

    public function update(Request $request, $id)
    {
        $bookings = Bookings::find($id);
        //validate form
        $request->validate([
            'id_book' => 'required',
            'class' => 'required',
            'price' => 'required'
        ]);

        $bookings = Bookings::findOrFail($id);

        $bookings->id_book = $request->id_book;
        $bookings->class = $request->class;
        $bookings->price = $request->price;

        $bookings->save();

        return redirect()->route('bookings.index')->with([
            'success' => 'Data
        Berhasil Diubah!'
        ]);
    }

    public function destroy($id)
    {
        $bookings = Bookings::find($id);
        $bookings->delete();
        return redirect()->route('bookings.index')->with([
            'success' => 'Data
        Berhasil Dihapus!'
        ]);
    }
}
