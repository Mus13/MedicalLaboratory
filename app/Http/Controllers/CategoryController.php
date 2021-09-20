<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Test;
use Response;
use File;


class CategoryController extends Controller
{
    
    public function getCategories(){
        $categories=Category::All();
        return view('display', ['title'=>'List of categories','data'=>$categories,'url' => '/category/']);
    }
    
    public function getCategoriesByID($id){
        $category=Category::find($id);
        return view('displaySingular', ['title'=>'Category '.$id,'value'=>$category,'url' => '/category/']);
    }

    public function inputCategoryCreate(){
        $tests=Test::All();
        return view('form',['title'=>'Add new category','list'=>$tests,'url'=>'category/create','method'=>'POST','listSelected'=>null,'element'=>new Category()]);
    }

    public function inputCategoryEdit($id){
        $category=Category::find($id);
        $tests=Test::All()->except($category->listBelongTo()->allRelatedIds()->toArray());
        return view('form',['title'=>'Edit category '.$id,'list'=>$tests,'url'=>'/category/update/'.$id,'method'=>'PUT','listSelected'=>$category->listBelongTo,'element'=>$category]);
    }

    public function downloadCategory($id){
        $category=Category::find($id);
        $data=json_encode($category);
        $jsongFile = time() . '_file.json';
	    File::put(public_path('/upload/json/'.$jsongFile), $data);
	    return Response::download(public_path('/upload/json/'.$jsongFile));
    }

    public function create(Request $request){
        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        $category->listBelongTo()->attach($request->input('data'));
        return redirect('index');
    }

    public function update(Request $request,$id){
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        $category->listBelongTo()->attach($request->input('data'));
        return redirect('index');
    }

    public function destroy($id){
        $category = Category::find($id);
        $category->delete();
        return redirect('index');
    }

}
