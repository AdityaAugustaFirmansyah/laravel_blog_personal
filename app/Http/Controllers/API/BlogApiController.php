<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Blog;
use App\Http\Controllers\Controller;
use Carbon;
use Image;
use DB;
use App\Category;
use File;
use Illuminate\Support\Facades\Input;

class BlogApiController extends Controller
{
    public function index()
    {
        $blog = DB::select("SELECT blog.*,users.name,DATE_FORMAT(DATE(blog.created_at),'%d%M%Y') AS 'tanggal',category.nama FROM blog,users,category WHERE users.id = blog.user_id AND category.id = blog.category_id");
        return $blog;
    }

    public function category($category)
    {
        return DB::select("SELECT blog.*,users.name,DATE_FORMAT(DATE(blog.created_at),'%d%M%Y') AS 'tanggal',category.nama FROM blog,users,category WHERE users.id = blog.user_id AND category.id = blog.category_id AND category.id = $category");
    }

    public function searchBlog($blog)
    {
        return DB::select("SELECT blog.*,users.name,DATE_FORMAT(DATE(blog.created_at),'%d%M%Y') AS 'tanggal',category.nama FROM blog,users,category WHERE users.id = blog.user_id AND category.id = blog.category_id AND blog.tiitle LIKE '$blog%' ");
    }

    public function insertData(Request $request)
    {
        $this->validate(request(),[
            'tiitle'=>'required',
            'desc'=>'required',
            'category_id'=>'required',
            'image'=>'mimes:jpeg,png,jpg',
            'content'=>'required',
        ]);
        $blog = new Blog();
        $blog->tiitle = $request->input('tiitle');
        $blog->desc = $request->input('desc');
        $blog->category_id = $request->input('category_id');
        if($request->hasFile('image')){
            $foto = $request->file('image');
            $filename = pathinfo($foto,PATHINFO_FILENAME);
            $image_resize = Image::make($foto->getRealPath());
            $image_resize->resize(200,250);
            $image_resize->save(public_path('image/images/'.$filename));
            $blog->image = $filename;    
        }
        $blog->content = $request->input('content');
        $blog->user_id = $request->input('user_id');;
        
        if($blog->save()){
            $res ['message'] = "success";
            $res ['value'] = $blog;
            return response($res);
        }
    }

    public function blogId($id)
    {
        $blog = DB::select("SELECT blog.*,users.name,DATE_FORMAT(DATE(blog.created_at),'%d%M%Y') AS 'tanggal',category.nama FROM blog,users,category WHERE users.id = blog.user_id AND category.id = blog.category_id AND users.id = $id");
        $res['succes'] = $blog;
         return $res;
    }

    public function updates(Request $request)
    {
        $id = $request->post('id');
        $blog = Blog::find($id);
        $blog->tiitle = $request->post('tiitle');
        $blog->desc = $request->post('desc');
        $blog->category_id=$request->post('category_id');

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
            $blog->save();

            return response($blog);
    }

    public function detailBlog($id)
    {
        $query = Blog::find($id);
        return response($query);
    }
}
