<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Category;
use Response;
use File;

class TestController extends Controller
{
    public function getTests(){
        $tests=Test::All();
        return view('display', ['title'=>'List of tests','data'=>$tests,'url' => '/test/']);
    }
    
    public function getTestsByID($id){
        $test=Test::find($id);
        return view('displaySingular', ['title'=>'Test '.$id,'value'=>$test,'url' => '/test/']);
    }

    public function inputTestCreate(){
        $categories=Category::All();
        return view('form',['title'=>'Add new test','list'=>$categories,'url'=>'test/create','method'=>'POST','listSelected'=>null,'element'=>new Test()]);
    }

    public function inputTestEdit($id){
        $test=Test::find($id);
        $categories=Category::All()->except($test->listBelongTo()->allRelatedIds()->toArray());
        return view('form',['title'=>'Edit test '.$id,'list'=>$categories,'url'=>'/test/update/'.$id,'method'=>'PUT','listSelected'=>$test->listBelongTo,'element'=>$test]);
    }

    public function downloadCategory($id){
        $test=Test::find($id);
        $data=json_encode($test);
        $jsongFile = time() . '_file.json';
	    File::put(public_path('/upload/json/'.$jsongFile), $data);
	    return Response::download(public_path('/upload/json/'.$jsongFile));
    }

    public function create(Request $request){
        $test = new Test();
        $test->name = $request->input('name');
        $test->description = $request->input('description');
        $test->save();
        $test->listBelongTo()->attach($request->input('data'));
        return redirect('index');
    }

    public function update(Request $request,$id){
        $test = Test::find($id);
        $test->name = $request->input('name');
        $test->description = $request->input('description');
        $test->save();
        $test->listBelongTo()->attach($request->input('data'));
        return redirect('index');
    }

    public function destroy($id){
        $test = Test::find($id);
        $test->delete();
        return redirect('index');
    }
    
}
