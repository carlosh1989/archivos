<?php

namespace App\Http\Controllers\Concejal;

use Alert;
use App\File as Arch;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ArchivosController extends Controller
{
    public function __construct()
    {
        define('COUNCILORID', Auth::user()->councilor_id);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resultados = Post::where('councilor_id', $request->user()->councilor->id)->paginate();
        //dd($resultados);
        return view('concejal.archivos.all', compact('resultados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('concejal.archivos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $request->file('archivo')->store('public');
        $file = new Arch;
        $file->user_id = $request->user()->id;
        $file->name = $request->name;
        $file->description = $request->description;
        $file->type = $request->type;
        $file->url = $path;
        $file->save();
            
        Alert::success('Archivo guardado con exito!')->autoclose(3000);
        return Redirect::to('/concejal/archivos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //El usuaprio entrara aqui al dar click al enlace que se le enviara al correo
        $post = Post::find($id);
        $visto = $post->visto;

        //si no lo vio entoinces se actualiza el estado a que si lo vio y se guarda
        if ($visto="no") {
            $post->visto = "si";
            $post->save();
        }

        //se muestra renderizado el archivo
        return view('concejal.archivos.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function publicar()
    {
        $posts = Arch::where('user_id', $request->user()->id)->first();
        return view('concejal.archivos.publicar', compact('posts'));
    }

    public function ver(Request $request)
    {
        $councilor = $request->user()->councilor->id;
        $posts = Post::where('councilor_id', $councilor)->paginate();
        $search = "no";
        return view('concejal.archivos.all', compact('posts', 'search'));
    }

    public function pusher()
    {
        return view('concejal.archivos.pusher');
    }
}
