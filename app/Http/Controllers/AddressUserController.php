<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressUserController extends Controller
{
    private $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = auth()->user()->adresses()->paginate(10);

        return view('user.address.index', compact('addresses' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();

        $address = $user->adresses()->create($data);

        flash("Endereço cadastrado com sucesso!")->success();

        if(session()->has('cart')){
            return redirect()->route('checkout.index');
        }
        return redirect()->route('user.address.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = $this->address->find($id);

        return view('user.address.edit', compact('address'));
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
        $data = $request->all();

        $address = $this->address->find($id);
        $address->update($data);

        flash('O endereço foi atualizado com sucesso!')->success();
        return redirect()->route('user.address.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = $this->address->find($id);
        $address->delete();

        flash('Endereço excluído com sucesso')->success();
        return redirect()->route('user.address.index');
    }
}
