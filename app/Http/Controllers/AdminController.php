<?php
namespace App\Http\Controllers;

use Alert;
use App\Councilor;
use App\File as Arch;
use App\Http\Requests;
use App\Http\Requests\StoreCuenta;
use App\Http\Requests\StoreFile;
use App\Http\Requests\StoreForm;
use App\Http\Requests\StorePublicar;
use App\Http\Requests\busquedaPublicar;
use App\Post;
use App\Publication;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Date\Date;
use Mailgun\Mailgun;
use SendGrid\Email;
use Vinkla\Pusher\Facades\Pusher;

class AdminController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
              \Cloudinary::config(array(
          "cloud_name" => "tuconsultaenlinea",
          "api_key" => "969938491626729",
          "api_secret" => "J2mGOPnz9A1dl9kubb7Qyh9h_MI"
              ));
    }

    public function index()
    {
/*        $options = array(
        'encrypted' => true
        );
        $pusher = new Pusher(
        '5a6a7f37ae077a81c1d4',
        'd06edd4e16bb97181a1d',
        '259420',
        $options
        );

        $data['message'] = 'hello world';
        $pusher->trigger('test_channel', 'my_event', $data);*/
        return view('archivos/ingresar');
    }


    public function busquedaProcesar(Request $request)
    {
        $cadena  = urlencode($request->search);
        //add more logic to validate and secure user entered data before turning it loose in a query
        //return redirect('busqueda/'.$cadena);
        return redirect('/admin/archivos/'.$cadena);
    }

    public function busqueda(Request $request)
    {
        $busqueda = urldecode($request->cadena);

        if ($busqueda) {
            $exp = explode(' ', $busqueda);

            $s = '';
            $c = 1;
            foreach ($exp as $e) {
                $s .= "+$e*";

                if ($c + 1 == count($exp)) {
                    $s .= ' ';
                }

                $c++;
            }

            $query = "MATCH (name, description, type) AGAINST ('$s' IN BOOLEAN MODE)";
        // $query looks like
        // MATCH (first_name, last_name, email) AGAINST ('+jar* +eitni*' IN BOOLEAN MODE)

            $resultados = Arch::whereRaw($query)->paginate();
        //dd($resultados);
        //$resultados = Part::where('description', 'LIKE', 'amortiguadores toyota')->Paginate(1);
        } else {
            $resultados = Arch::paginate();
        }
   
        $parts = Arch::paginate();
        return view('/admin/archivos/ver', compact('resultados'));
    }

    public function archivoIngresar()
    {
        return view('admin.archivos.ingreso');
    }

    public function archivoGuardar(StoreFile $request)
    {
        $path = $request->file('archivo')->store('storage');
        $file = new Arch;
        $file->user_id = $request->user()->id;
        $file->name = $request->name;
        $file->description = $request->description;
        $file->type = $request->type;
        $file->url = $path;
        $file->save();
            
        Alert::success('Archivo guardado con exito!')->autoclose(3000);
        return Redirect::to('/admin/archivos/ingresar');
    }

    public function archivoVer()
    {
        return "ver archivos";
    }

    public function mensaje()
    {
        $message = "Local chevybarinas ingreso el siguiente repuesto: P4-as";
        Pusher::trigger('test_channel', 'my_event', ['message' => $message]);
        // We're done here - how easy was that, it just works!
        Pusher::getSettings();
        // This example is simple and there are far more methods available.
        return "Notificaciones enviadas";
    }

    public function home()
    {
        return view('admin.home.inicio');
    }

    public function usuario(Request $request)
    {
        $usuarios = User::all();
        return view('admin.archivos.datos', compact('usuarios'));
    }

    public function cuentaIngresar()
    {
        return view('admin.cuentas.ingresar');
    }

    public function cuentaStore(StoreCuenta $request)
    {
        $archivo = $request->file('archivo');
        $name = $request->name;
        $email = $request->email;
        $password = bcrypt($request->password);
        $role = $request->role;
        $cedula = $request->cedula;
        $telefono = $request->telefono;
        $comision = $request->comision;
        $direccion = $request->direccion;
        $parroquia = $request->parroquia;
        $nacimiento = $request->nacimiento;

        //Guadar login
        $user = User::create([
            'councilor_id' => '0',
            'email' => $email,
            'password' => $password,
            'role'=> $role,
        ]);

        //modificando el enlace al archivo para que solo quede el url
        $subida = $request->file('archivo')->store('public');
        list($public, $avatar) = explode('/', $subida);

        //crear la tabla de datos de concejales
        $datos = Councilor::create([
            'user_id' => $user->id,
            'avatar' => $avatar,
            'name' => $name,
            'cedula' => $cedula,
            'telefono' => $telefono,
            'comision' => $comision,
            'direccion' => $direccion,
            'parroquia' => $parroquia,
            'nacimiento' => $nacimiento,
        ]);

        $room = Room::create([
            'councilor_id' => $datos->id,
            'siteID' => '',
        ]);

        $user->councilor_id = $datos->id;
        $user->save();

        Alert::success(''.ucfirst($role).' agregado con exito')->autoclose(3000);
        return Redirect::to('/admin/cuentas/ingresar');
    }

    public function cuentasForm()
    {
        return view('/admin/cuentas/form');
    }

    public function cuentasFormGuardar(StoreForm $request)
    {
        return "store";
    }

    public function busquedaProcesarPublicar(busquedaPublicar $request)
    {
        $id = $request->idArchivo;
        $cadena  = urlencode($request->search);
        return redirect('/admin/publicar/'.$id.'/'.$cadena);
    }

    public function publicar(Request $request, $id, $cadena = null)
    {
        if ($cadena) {
            $busqueda = urldecode($cadena);
            $exp = explode(' ', $busqueda);

            $s = '';
            $c = 1;
            foreach ($exp as $e) {
                $s .= "+$e*";

                if ($c + 1 == count($exp)) {
                    $s .= ' ';
                }

                $c++;
            }

            $query = "MATCH (name, cedula, telefono, comision, direccion, parroquia, nacimiento) AGAINST ('$s' IN BOOLEAN MODE)";
            $usuarios = Councilor::whereRaw($query)->paginate();
            $search = "si";
        } else {
            $search = "no";
            $usuarios = Councilor::paginate();
        }
        $todos = Councilor::paginate();
        $archivo = Arch::find($id);
        //dd($usuarios);
        return view('admin/archivos/publicar', compact('usuarios', 'archivo', 'todos', 'search'));
    }

    public function publicarProceso(Request $request)
    {
        //buscando si la publicación esta repetida
        $publicacion = Publication::where('file_id', $request->file_id)->where('clasificacion', $request->clasificacion)->first();

        if ($publicacion) {
            # code...
        } else {
            $publicacion = Publication::create([
                'user_id' => $request->user()->id,
                'file_id' => $request->file_id,
                'clasificacion' => $request->clasificacion,
            ]);
        }
        

        if ($request->comision or $request->concejales) {
        //Crear publicaciones


            //Cuando se selecciona de forma individual por concejal y asistente
            $concejales = $request->concejales;
            if ($concejales) {
                foreach ($concejales as $concejal) {
                    $archivo = Post::where('councilor_id', $concejal)->where('file_id', $request->file_id)->first();
                    
                    if ($archivo) {
                       // ya existe";
                    } else {
                        // Guarda
                        $mensaje = Post::create([
                        'publication_id' => $publicacion->id,
                        'file_id' => $request->file_id,
                        'councilor_id' => $concejal,
                        'visto' => 'no',
                        ]);

                        //Verificando si se ingreso el registro
                        if (!$mensaje->id > 0) {
                            Alert::error('Error al publicar el archivo a concejales y asistentes. Porfavor intentelo de nuevo', 'Upps!')->autoclose(5000);
                            return Redirect::to('/admin/publicar/'.$request->file_id);
                        } else {
                                $link = "Ingrese al siguiente link: ".url('/')."/concejal/archivos/".$mensaje->id."";
                            $this->email($link);
                            $councilor_id = $concejal;
                            $post_id = $mensaje->id;
                            $this->pusher($councilor_id, $post_id);
                        }
                    }
                }
            }

            $comisiones = $request->comision;
            if ($comisiones) {
                foreach ($comisiones as $comision) {
                    $concejales = Councilor::where('comision', $comision)->get();

                    foreach ($concejales as $concejal) {
                        $archivo = Post::where('councilor_id', $concejal->id)->where('file_id', $request->file_id)->count();
                        
                        if ($archivo) {
                           // ya existe";
                        } else {
                            // Guarda
                            $mensaje = Post::create([
                            'publication_id' => $publicacion->id,
                            'file_id' => $request->file_id,
                            'councilor_id' => $concejal->id,
                            'visto' => 'no',
                            ]);

                            //Verificando si se ingreso el registro
                            if (!$mensaje->id > 0) {
                                Alert::error('Error al publicar el archivo a concejales y asistentes. Porfavor intentelo de nuevo', 'Upps!')->autoclose(5000);
                                return Redirect::to('/admin/publicar/'.$request->file_id);
                            } else {
                                $link = "Ingrese al siguiente link: ".url('/')."/concejal/archivos/".$mensaje->id."";
                                $this->email($link);
                                $councilor_id = $concejal;
                                $post_id = $mensaje->id;
                                $this->pusher($councilor_id, $post_id);
                            }
                        }
                    }
                }
            }
        } else {
            Alert::error('Debe ingresar una comisión o un concejal minimo.', 'Upps!')->autoclose(5000);
            return back();
        }

        Alert::success('Archivo publicado con exito!');
        return Redirect::to('/admin/publicaciones');
    }

    public function publicaciones(Request $request)
    {
        $publicaciones = Publication::orderBy('id', 'DESC')->paginate();
        return view('admin/archivos/publicaciones', compact('publicaciones'));
    }

    public function publicacionesVistas(Request $request, $id)
    {
        $publicacionesVistas = Post::where('publication_id', $id)->where('visto', 'si')->paginate();
        $publicacionesNoVistas = Post::where('publication_id', $id)->where('visto', 'no')->paginate();

        $file= Post::where('publication_id', $id)->first();
        $posts = Post::where($id);

        //dd($publicacionesNoVistas);
        //dd($publicacionesNoVistas);
        return view('admin/archivos/vistas', compact('publicacionesVistas', 'publicacionesNoVistas','file'));
    }

    public function email($link)
    {
        $from = new \SendGrid\Email("Example User", "soporte@tuconsultaenlinea.com");
        $subject = "Sending with SendGrid is Fun";
        $to = new \SendGrid\Email("Example User", "elmorochez22@gmail.com");
        ob_start();
        include('email.php');

        $content = new \SendGrid\Content("text/plain", ob_get_clean());
        $mail = new \SendGrid\Mail($from, $subject, $to, $content);

        $apiKey ='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';
        $sg = new \SendGrid($apiKey);
        $response = $sg->client->mail()->send()->post($mail);
    }

    public function pusher($councilor_id, $post_id)
    {
        $options = array(
        'encrypted' => true
        );
        $pusher = new \Pusher(
        '5a6a7f37ae077a81c1d4',
        'd06edd4e16bb97181a1d',
        '259420',
        $options
        );

        $data['message'] = 'Nuevo archivo, usted sera redirigido a el mismo.';
        $data['url'] = url('/').'/concejal/archivos/'.$post_id;
        //echo $councilor_id;
        $pusher->trigger($councilor_id, 'nuevo-archivo', $data);
    }

    public function eliminarArchivo($id)
    {
        $archivo = Arch::find($id);

        if($archivo)
        {
            $publicacion = Publication::where('file_id',$archivo->id)->get();
            $post = Post::where('file_id',$archivo->id)->get();
            //Eliminando
            $archivo->delete();
            $publicacion->delete();
            $post->delete();
            Alert::success('El archivo ha sido eliminado!');
            return Redirect::to('/admin/archivos');
        }
        else
        {
            Alert::info('El archivo no existe!');
            return Redirect::to('/admin/archivos');
        }
    }

    public function reporte($idArchivo)
    {
        //echo $idArchivo;
        $archivo = Arch::find($idArchivo);
        $posts_vistos = Post::where('file_id',$archivo->id)->where('visto','si')->get();
        $posts_no_vistos = Post::where('file_id',$archivo->id)->where('visto','no')->get();

        $mpdf = new \mPDF('','Letter',12,'arial');
        $mpdf->AddPage('', // L - landscape, P - portrait 
        '', '', '', '',
        5, // margen izquierdo
        5, // margen derecho
        30, // margin arriba
        2.5, // margin abajo
        0, // margin encabezado
        0); // margin pie de pagina

        ob_start();
        include("reporte.php");
        $mpdf->WriteHTML(ob_get_clean());
        $nombre = "Reporte.pdf";
        $mpdf->Output($nombre,'D');

        // @var('date',new Date($post->update_at))
        //    <td>{{$date->format('j-m-Y')}} a las {{$date->format('H:i:s')}}</td>
    }
}
