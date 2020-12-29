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
                    <div class="card-header">Pakeiskime knygos informaciją</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('book.update', $book->id) }}">
                            @csrf @method("PUT")
                            <div class="form-group">
                                <label for="">Pavadinimas: </label>
                                <input type="text" name="title" class="form-control" value="{{ $book->title }}">
                            </div>
                            <div class="form-group">
                                <label>Autorius: </label>
                                <select name="author_id" id="" class="form-control">
                                    @foreach ($authors as $author)
                                        <option value="{!! $author->id !!}" @if ($author->id == $book->author_id) selected="selected"
                                    @endif>{{ $author->name . ' ' . $author->surname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Puslapių skaičius: </label>
                                <input type="number" name="pages" class="form-control" value="{{ $book->pages }}">
                            </div>
                            <div class="form-group">
                                <label for="">Knygos kodas: </label>
                                <input type="text" name="isbn" class="form-control" value="{{ $book->isbn }}">
                            </div>
                            <div class="form-group">
                                <label for="">Apibūdinkime: </label>
                                <textarea id="mce" type="text" name="short_description" rows=10 cols=100
                                    class="form-control">{{ $book->short_description }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Pakeisti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
