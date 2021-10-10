<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use Symfony\Component\Console\Input\Input;

class BlogController extends Controller
{
    /**
     * ぶろぐ一覧を表示する
     * @return view
     */
    public function showList()
    {
        $blogs = Blog::all();
        return view('blog.list',
        ['blogs'=>$blogs]);
    }



    /**
     * ぶろぐ詳細を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {
        $blog = Blog::find($id);

        if(is_null($blog)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('blogs'));
        }
        return view('blog.detail',['blog'=>$blog]);
    }
    /**
     * ぶろぐ登録画面を表示する
     * @return view
     */
    public function showCreate(){

        return view('blog.form');
    }

    /**
     * ぶろぐを登録する
     * @return view
     */
    public function exeStore(BlogRequest $request){
        // ブログのデータを受け取る
        $inputs = $request->all();
        \DB::beginTransaction();
        try{
            // ブログを登録c
        Blog::create($inputs);
        \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }

        
        \Session::flash('err_msg','ブログを登録しました');
        return redirect(route('blogs'));
    }

    /**
     * ぶろぐを編集画面表示
     * @param int $id
     * @return view 
     */
    public function showEdit($id){
        $blog = Blog::find($id);

        if(is_null($blog)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('blogs'));
        }
        return view('blog.edit',['blog'=>$blog]);
    }


    /** 
     * ぶろぐを更新する
     * @param int $id
     * @return view
     */
    public function exeUpdate($id){
        // ブログのデータを受け取る
        $blog = Blog::destroy($id);

        if(is_null($blog)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('blogs'));
        }
        return view('blog.edit',['blog'=>$blog]);

    }

    /**
     * ぶろぐを編集画面表示
     * @param int $id
     * @return view 
     */
    public function exeDelete($id){
        if(empty($id)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('blogs'));
        }
        try{
            // ブログを削除
        $blog = Blog::destroy($id);
        }catch(\Throwable $e){
            abort(500);
        }

        \Session::flash('err_msg','削除しました。');
        return redirect(route('blogs'));
    }
    



}