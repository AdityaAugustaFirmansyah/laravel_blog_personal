<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
use App\Blog;
use App\Comentar;
use Auth;
use Route;
use File;
use AuthenticatesUsers;
use App\Tag;
use Carbon;
use App\User;
use Illuminate\support\Facades\Mail;
use App\Category;
use Redirect;
use App\Gallery;
use Intervention\Image\ImageManagerStatic as Image;
use App\Mail\Verification;

class BlogController extends Controller
{
 
    public function index()
    {
            $blog = Blog::all();
            $time =  Carbon::createFromTimestamp(-1,'Asia/Jakarta')->toDateTimeString();
            $now = Carbon::now();
            $waktu = $now->diffForHumans($time);
            $hitung = count($blog);
            return view('berandablog',['waktu'=>$waktu])->withBlog($blog);
    }

    public function index1()
    {
        $id = Auth::user()->id;
        $username = Auth::user()->id;
        $blog = DB::table('blog')->where('user_id','=',$username)->get();
        $status = User::where('id','=',$id)->get();
        return view('post',['data'=>$blog,'angka'=>1,'status'=>$status]);
    }

    public function liatid($id)
    {
        // lihat detail blog
        $blog = Blog::where('id','=',$id)->get();
        $blog1 = Blog::find($id);
        $comment = Comentar::where('blog_id','=',$id)->get();
        $recent = Blog::orderBy('created_at','DESC')->get();
        $titleAsc = Blog::orderBy('tiitle','ASC')->limit(5)->get();
        $titleDesc = Blog::orderBy('tiitle','DESC')->limit(5)->get();
        $tag = $blog1->tag_blog;
        $tagArr = explode(',',$tag);
        $qr = QrCode::size(500)->format('png')->generate("http://localhost:8000/blog/$id",public_path('image/qrcode.png'));
        return view('detailblog',['blog'=>$blog,
        'comment'=>$comment,
        'recent'=>$recent,
        'tag'=>$tagArr,
        'ascBlog'=>$titleAsc,
        'descBlog'=>$titleDesc]);
    }
    public function insert(Request $request)
    {
        $this->validate(request(),[
            'tiitle'=>'required',
            'desc'=>'required',
            'category_id'=>'required',
            'image'=>'mimes:jpeg,png,jpg',
            'content'=>'required',
        ]);
        $blog = new Blog();
        $blog->tiitle = $request->post('tiitle');
        $blog->desc = $request->post('desc');
        $blog->category_id = $request->post('category_id');
        $tag = $request->post('tag_blog');
            $tagString = implode(",",$tag);
            $blog->tag_blog = $tagString;

            if($request->hasFile('image')){
            $foto = $request->file('image');
            $filename = pathinfo($foto,PATHINFO_FILENAME);
            $image_resize = Image::make($foto->getRealPath());
            $image_resize->resize(200,250);
            $image_resize->save(public_path('image/images/'.$filename));
            $blog->image = $filename;    
        }
        $blog->content = $request->post('content');
        $blog->user_id = Auth::user()->id;
        $blog->save();
        return redirect ('/blog');
    }

    public function delete($id)
    {
        $blog1 = Blog::find($id);
        $blog1->delete();
        $username = Auth::user()->id;
        
        $blog = Blog::all();
        return view('berandablog')->withBlog($blog);
    }

    public function update($id)
    {
        $blog = Blog::find($id);
        $category = Category::where('user_id','=',Auth::user()->id)->get();
        $tag = $blog->tag_blog;
        $tagArr = explode(',',$tag);
        $tag1 = Tag::where('user_id','=',Auth::user()->id)->get();
        return view('formupdateblog',compact('category'),compact('blog'))->withtagArr($tagArr)->withtag1($tag1);
    }

    public function updates(Request $request)
    {
        $id = $request->post('id');
        $blog = Blog::find($id);

        $blog->tiitle=$request->post('tiitle');
        $blog->desc=$request->post('desc');
        $blog->category_id=$request->post('category_id');
        if($request->post('tag_blog') != null){
            $tag = $request->post('tag_blog');
            $tagString = implode(',',$tag);
            $blog->tag_blog = $tagString;    
        }else{
            $blog->tag_blog =$blog->tag_blog;    
        }
            if($request->hasfile('image')){
                $foto = $request->file('image');
                $filename = pathinfo($foto,PATHINFO_FILENAME);
                $image_resize = Image::make($foto->getRealPath());
                $image_resize->resize(200,250);
                $image_resize->save(public_path('image/images/'.$filename));
                
                if(File::exists($filename)){
                File::delete($filename);
                }

                $oldimage = $blog->image;
                $blog->image = $filename;
            }else{
                $blog->image = $blog->image;
            }
            $blog->content=$request->post('content');
            $blog->update();
            return redirect ('/blog');
    }

    public function category($category)
    {
        $blog = Blog::where('category_id','=',$category)->get();
        
        return view('cobablog',['blog'=>$blog]);
    }

    public function cekLogin()
    {
        return view('auth.login');
    }

    public function edituser($id)
    {
        $blog = DB::table('users')->where('id','=',$id)->get();
        return view('auth.edituser',['usr'=>$blog]);
    }
    public function edituser1($id)
    {
        $blog = DB::table('users')->where('id','=',$id)->get();
        return view('auth.edituser1',['usr'=>$blog]);
    }
    public function paymentPrem(Request $request)
    {
        $id = $request->post('id');
        $payment = User::find($id);
        $payment->membership_id = $request->post('membership_id');
        $payment->update();
        $username = Auth::user()->id;
        $blog = DB::table('blog')->where('user_id','=',$username)->get();
        return view('post1',['data'=>$blog,'angka'=>1]);

    }

    public function paymentPlat(Request $request)
    {
        $id = $request->post('id');
        $payment = User::find($id);
        $payment->membership_id = $request->post('membership_id');
        $payment->update();
        $username = Auth::user()->id;
        $blog = DB::table('blog')->where('user_id','=',$username)->get();
        return view('post2',['data'=>$blog,'angka'=>1]);

    }

    public function deleteUser($id)
    {
        $user = User::find($id);        
        Auth::logout();
        if($user->delete()){
            return view('beranda');
        }
    }

    public function addCategory(Request $request)
    {
        $category = new Category();
        $category->nama = $request->get('nama');
        $category->user_id = Auth::user()->id;
        $category->save();
        $msg = "success create category";
        return redirect('/addblog');
    }

    public function listCategory()
    {
        $user = Auth::user()->id;
        $category = Category::where('user_id','=',$user)->get();
        return view('category.category',['category'=>$category,'angka'=>1]);
    }

    public function viewCategory($id)
    {
        $category = Category::find($id);
        return view('category.categoryview',compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $id = $request->post('id');
        $category = Category::find($id);
        $category->nama = $request->post('nama');
        $category->update();
        $msg = "success update category";
        return redirect('/addblog');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        $msg = "success create category";
        return redirect('/addblog');
    }

    public function gallery()
    {
        $user = User::where('membership_id','>','1')->get();
        return view('galery.galery',['user'=>$user]);
    }

    public function addGalery(Request $request)
    {
        $galery = new Gallery();
        $galery->user_id = Auth::user()->id;
        if($request->hasFile('image')){
            $foto = $request->file('image');
            $filename = pathinfo($foto,PATHINFO_FILENAME);
            $image_resize = Image::make($foto->getRealPath());
            $image_resize->resize(200,250);
            $image_resize->save(public_path('image/imagegalery/'.$filename));
            $galery->image = $filename;    
        }
        $galery->description = $request->post('description');
        $galery->save();
        return redirect('/galery');
    }
    public function detailGalery($id)
    {
        $galery = Gallery::where('user_id','=',$id)->get();
        return view('galery.galerydetail',['galery'=>$galery]);
    }

    public function addTag(Request $request)
    {
        $tag = new Tag();
        $tag->name = $request->post('name');
        $tag->user_id = Auth::user()->id;
        $tag->save();
        return redirect('/addblog');
    }

    public function deleteTag($id)
    {
        $tag = Tag::where('id','=',$id);
        $tag->delete();
        return redirect('/addblog');
    }

    public function sendMail($type,$mailUser)
    {
        Mail::to($mailUser)->send(new Verification($type));
        return redirect('/');
    }
}