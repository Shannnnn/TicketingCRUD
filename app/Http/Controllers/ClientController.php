<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\Company;
use App\Branch;

class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();

        if($request->get('search')){
            $clients = Client::where("company_name", "LIKE", "%{$request->get('search')}%")
                ->paginate(5);
        }else{
		  $clients = Client::paginate(5);
        }

        return response($clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
    	$input = $request->all();
        $create = Client::create($input);
        return response($create);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return response($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
    	$input = $request->all();

        Client::where("id",$id)->update($input);
        $client = Client::find($id);
        return response($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return Client::where('id',$id)->delete();
    }

    public function show($id)
    {
        $client = Client::find($id);
        return view('clients.show',compact('client'));
    }
}
