@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <div>
                        @foreach ($errors->all() as $error)
                            <p style="color: red">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @if (session('status_success'))
                    <p style="color: green"><b>{{ session('status_success') }}</b></p>
                @else
                    <p style="color: red"><b>{{ session('status_error') }}</b></p>
                @endif
                <div class="card">
                    <div class="card-header">Pakeiskime kliento informaciją</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('customer.update', $customer->id) }}">
                            @csrf @method("PUT")
                            <div class="form-group">
                                <label>Vardas: </label>
                                <input type="text" name="name" class="form-control" value="{{ $customer->name }}">
                            </div>
                            <div class="form-group">
                                <label>Pavardė: </label>
                                <input type="text" name="surname" class="form-control" value="{{ $customer->surname }}">
                            </div>
                            <div class="form-group">
                                <label>Skaitys: </label>
                                <select name="book_id" id="" class="form-control">
                                    <option value="" selected disabled>Pasirinkite knygą</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}" @if ($book->id == $customer->book_id) selected="selected"
                                    @endif>{{ $book->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Pakeisti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
