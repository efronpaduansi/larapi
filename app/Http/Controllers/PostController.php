<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //Import Post Model
use Illuminate\Support\Facades\Validator; //import validator

class PostController extends Controller
{
    //Fungsi untuk menginsert data ke dalam database
    public function store(Request $request){

        //membuat validasi semua files wajib diisi
        $validasi = Validator::make($request->all(), [
            'judul'     => 'required',
            'isi'       => 'required',
            'penulis'   => 'required'
        ]);

        //Jika validasi gagal, kirimkan pesan error
        if($validasi->fails()){
            return response()->json( $validasi->errors() );
        }else{
            //melakukan insert data 
            $post   = new Post;
            $post->judul    = $request->judul;
            $post->isi      = $request->isi;
            $post->penulis  = $request->penulis;

            //jika berhasil maka simpan data dengan methode $post->save()
            if($post->save()){
                return response()->json( 'Post Berhasil Disimpan');
            }else{
                return response()->json('Post Gagal Disimpan');
            }
        }

    }

    //Fungsi untuk menampilkan data
    public  function index(){
        //Mengambil data dari table posts dan menyimpannya dalam variabel $posts
        $posts = Post::all();
        return response([
            $posts
        ]);
    }

    //fungsi untuk menampilkan detail data
    public function detail($id){
        $post = Post::where('id', $id)->first();
        if($post){
            return response([
                $post
            ]);
        }else{
            return response([
                'Tidak ada data yang ditemukan'
            ]);
        }
    }

    //fungsi update
    public function update($id, Request $request){

        // membuat validasi semua field wajib diisi
        $validasi = Validator::make($request->all(), [
            'judul'     => 'required',
            'isi'       => 'required',
            'penulis'   => 'required'
        ]);

        //jika validasi gagal maka kirim pesan error
        if($validasi->fails()){
            //mengembalikan pesan error dengan menggunakan json
            return response()->json( $validasi->errors() );
        }else{
            //melakukan update data berdasarkan $id
            $post           = Post::find($id);
            $post->judul    = $request->judul;
            $post->isi      = $request->isi;
            $post->penulis  = $request->penulis;

            //jika berhasil maka simpan data dengan methode $post->save()
            if($post->save()){
                return response()->json( 'Post Berhasil Diupdate');
            }else{
                return response()->json('Post Gagal Diupdate');
            }
        }
    }

    //Fungsi delete
    public function destroy($id){
        //mencari data sesuai $id
        $post = Post::findOrFail($id);
    
        // jika data berhasil didelete maka tampilkan pesan json 
        if($post->delete()){
            return response([
                'Berhasil Menghapus Data'
            ]);
        }else{
            return response([
                'Tidak Berhasil Menghapus Data'
            ]);
        }
    }
    
}
