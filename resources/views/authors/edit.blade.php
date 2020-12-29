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
                <div class="card-header">Pakeiskime autoriaus informaciją</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('author.update', $author->id) }}">
                        @csrf @method("PUT")
                        <div class="form-group">
                            <label for="">Vardas</label>
                            <input type="text" name="name" class="form-control" value="{{ $author->name }}">
                        </div>
                        <div class="form-group">
                            <label for="">Pavardė: </label>
                            <textarea id="mce" type="text" name="surname" rows=10 cols=100
                                class="form-control">{{ $author->surname }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Pakeisti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
