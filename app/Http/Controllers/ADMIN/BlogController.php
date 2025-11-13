<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\Categories;
Use Alert;


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
        $categories = Categories::get();
        return view('admin.blog.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Blog::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,

        ]);
        Alert::success('Success', 'Create New User Success');
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
        $title = "Edit Blog";
        return view('admin.blog.edit', compact('edit', 'categories', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Blog::find($id); //menemukan table dan ambil id-nya
        $update->category_id = $request->category_id; //ambil semua data yang mau diupdate category, email, pass
        $update->title = $request->title;
        $update->content = $request->content;
        $update->slug = Str::slug($request->slug); //untuk membuat pemisah untuk kata yang jamak

        $update->save();
        return redirect()->to('blog');
    }

    /**
     * Remove the specified resource from storage.
    */

    //kalo make destroy makenya form buat eksekusi delete data, gk make a href, kalo make a href nanti bikin public function lagi
    public function destroy(string $id)
    {
        Blog::find($id)->delete();
        return redirect()->to('admin/blog');
    }
}
