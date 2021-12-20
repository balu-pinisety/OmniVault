<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Validator;
use Auth;
use Illuminate\Support\Facades\Crypt;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::latest()->where('user_id',Auth::user()->id)->get();
        return view('SavedLinks.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('SavedLinks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'url' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        $validator->validated();

        $link = new Link;
        $link->title = $request->input('title');
        $link->username = $request->input('username');
        $link->url = $request->input('url');
        $link->password = Crypt::encryptString($request->password);
        $link->user_id = Auth::user()->id;
        $link->save();

        //$link = Link::where('url', $request->url)->where('username', $request->username)->first();

        return redirect()->route('savedlinks')
            ->with('success', 'Link created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $link = Link::find($id);
        $decrypted_password = Crypt::decryptString($link->password);
        return view('SavedLinks.show', compact('link','decrypted_password'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = Link::find($id);
        $decrypted_password = Crypt::decryptString($link->password);
        return view('SavedLinks.edit', compact('link','decrypted_password'));
    }

    public function showPassword($id)
    {
        $link = Link::find($id);
        $decrypted_password = Crypt::decryptString($link->password);
        return view('SavedLinks.showPassword', compact('decrypted_password', 'link'));
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
        $validator = Validator::make($request->all(), [
            'title' => 'string',
            'url' => 'string',
            'username' => 'string',
            'password' => 'string',
        ]);

        $validator->validated();

        Link::where('id', $id)->update(array_merge(
            $validator->validated(),
            ['password' => Crypt::encryptString($request->password)]
        ));

        return redirect()->route('savedlinks')
            ->with('success', 'Link updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $link = Link::find($id);

        return view('savedlinks.delete', compact('link'));
       }

    public function delete($id)
    {
        Link::where('id', $id)->delete();

        return redirect()->route('savedlinks')
            ->with('sucess','Link deleted Successfully');
    }

    public function share($id)
    {

        $link = Link::find($id);

        return view('SavedLinks.share', compact('link'));
    }
}
