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
                    <div class="card-header">Sukurkime miestą:</div>
                    <div class="card-body">
                        <form action="{{ route('book.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Pavadinimas: </label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Autorius: </label>
                                <select name="author_id" id="" class="form-control">
                                    <option value="" selected disabled>Pasirinkite autorių</option>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}">{!! $author->name . ' ' . $author->surname !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Puslapių skaičius: </label>
                                <input type="number" name="pages" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Knygos kodas: </label>
                                <input type="text" name="isbn" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Trumpas aprašymas: </label>
                                <textarea id="mce" name="short_description" rows=10 cols=100
                                    class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Patvirtinti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
