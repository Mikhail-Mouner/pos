<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientRequest $request)
    {
        $clients = Client::when($request->search, function ($q) use ($request) {
            return $q->where('name','like','%'.$request->search.'%');
        })->get();
        return view('dashboard.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.form.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        Client::create($this->fillable($request));

        Session::flash('success',__('message.add'));
        return redirect()->route('dashboard.client.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('dashboard.clients.form.index',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        //
        $client->update($this->fillable($request));

        Session::flash('success',__('message.edit'));
        return redirect()->route('dashboard.client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        Session::flash('success',__('message.delete'));
        return redirect()->route('dashboard.client.index');
    }

    public function fillable($request){
        $fillables = [
            ['attribute' => 'name', 'input_name' => 'name'],
            ['attribute' => 'phone', 'input_name' => 'phone'],
            ['attribute' => 'address', 'input_name' => 'address'],
        ];
        $data = [];
        foreach ($fillables as $fillable){
            $data[$fillable['attribute']] = $request[$fillable['input_name']];
        }
        return $data;
    }
}
