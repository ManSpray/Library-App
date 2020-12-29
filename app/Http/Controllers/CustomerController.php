<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request){
        if(isset($request->book_id) && $request->book_id !== 0)
            $customers = \App\Models\Customer::where('book_id', $request->book_id)->orderBy('id')->get();
        else
            $customers = \App\Models\Customer::orderBy('surname')->get();
        $books = \App\Models\Book::orderBy('title')->get();
        return view('customers.index', ['customers' => $customers, 'books' => $books]);
    }
    public function create(){
        $books = \App\Models\Book::orderBy('title')->get();
        return view('customers.create', ['books' => $books]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'book_id' => 'required',
        ]);
        $customer = new Customer();
        // can be used for seeing the insides of the incoming request
        // dd($request->all());;
        $customer->fill($request->all());
        $customer->save();
        return redirect()->route('customer.index');
    }
    public function show(Customer $customer){
        //
    }
    public function edit(Customer $customer){
        $books = \App\Models\Book::orderBy('title')->get();
        return view('customers.edit', ['customer' => $customer, 'books' => $books]);
    }
    public function update(Request $request, Customer $customer){
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'book_id' => 'required',
        ]);
        $customer->fill($request->all());
        $customer->save();
        return redirect()->route('customer.index');
    }
    public function destroy(Customer $customer, Request $request)
    {
        $customer->delete();
        return redirect()->route('customer.index', ['book_id'=> $request->input('book_id')]);
    }
}
