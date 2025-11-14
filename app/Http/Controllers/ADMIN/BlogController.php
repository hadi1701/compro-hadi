<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Blog;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Alert;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('admin.user.index'); // bikin file user yang berisi index di folder admin

        $datas = Blog::with('category')->get();
        $title ="Data Blog";
        return view('admin.blog.index', compact('datas', 'title')); //lempar data ke view pake compact
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Blog";
        // PERBAIKAN: Menggunakan operator nullsafe (?->) dan null coalescing (?? '')
        // untuk mencegah error jika pengguna belum login.
        $user = Auth::user()?->name ?? 'Admin';
        $categories = Categories::get();
        return view('admin.blog.create', compact('title', 'categories', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content, //foto gk dimasukkin karna opsional
            'status' => $request->status,
            // Perbaikan kecil: Lebih baik menggunakan Auth::user() daripada Auth()->user()
            // Menggunakan ?? '' sudah benar untuk default.
            'writer' => Auth::user()?->name ?? 'System'
        ];

        //has file (memiliki gambar)
        if($request->hasFile('photo')){
            $photo = $request->file('photo')->store('blog', 'public');
            $data['photo'] = $photo;
        }
        Blog::create($data);
        Alert::success('Success', 'Create New Blog Success');
        // alert()->info('Info','Password Belum Diisi');
        //toast posisi atas sebelah kanan
        // toast('Create New User Success','success');


        return redirect()->to('admin/blog');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Blog::find($id); //User mewakili table
        $categories = Categories::get();
        $title = "Edit Blog";
        return view('admin.blog.edit', compact('edit', 'categories', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Blog::find($id); //menemukan table dan ambil id-nya
        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content, //foto gk dimasukkin karna opsional
            'status' => $request->status,
            // PERBAIKAN: Memastikan Auth::user() aman dengan ?->
            'writer' => Auth::user()?->name ?? 'System'
        ];

        if($request->hasFile('photo')){
            if($update->photo){
                File::delete(public_path('storage/'. $update->photo)); //setiap foto masuk ke storage, dan ke public, nanti dia masuk ke folder blog
            }
            $photo = $request->file('photo')->store('blog', 'public');
            $data['photo'] = $photo;
        }

        $update->update($data);
        return redirect()->to('admin/blog');
    }

    /**
     * Remove the specified resource from storage.
     */

    //kalo make destroy makenya form buat eksekusi delete data, gk make a href, kalo make a href nanti bikin public function lagi
    public function destroy(string $id)
    {
        $delete = Blog::find($id);
        $delete->delete();
        // PERBAIKAN: Nama variabel foto salah, harusnya $delete->photo, bukan $delete->$photo
        File::delete(public_path('storage/'. $delete->photo));
        alert()->success('Success', 'Delete success!');
        return redirect()->to('admin/blog');
    }
}
