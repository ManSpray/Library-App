@extends('layouts.app')
@section('content')
    <main class="py-4">
        <div class="container">
            <div class="card-body">
                <form class="form-inline" action="{{ route('author.index') }}" method="GET">
                    <select name="book_id" id="" class="form-control">
                        <option value="" selected disabled>Pasirinkite knygą autoriaus paeiškai:</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}" @if ($book->id == app('request')->input('book_id'))
                                selected="selected"
                        @endif>{{ $book->title }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            {{-- <div class="card-body">
                <form action="search.php" method="POST">
                    <input type="text" name="search" placeholder="Search for authors">
                    <button type="submit" name="submit-search">Search</button>
                </form>
            </div> --}}
            @if ($errors->any())
                <h4 style="color:red">{{ $errors->first() }}</h4>
            @endif
            @if (session('status_success'))
                <p style="color: green"><b>{{ session('status_success') }}</b></p>
            @else
                <p style="color: red"><b>{{ session('status_error') }}</b></p>
            @endif
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th style="width:33%">Vardas</th>
                        <th style="width:33%">Pavardė</th>
                        <th style="width:33%">Veiksmai</th>
                    </tr>
                    @foreach ($authors as $author)
                        <tr>
                            <td>{{ $author->name }}</td>
                            <td>{!! $author->surname !!}</td>
                            <td>
                                <form action={{ route('author.destroy', $author->id) }} method="POST">
                                    <a class="btn btn-success" href={{ route('author.edit', $author->id) }}>Redaguoti</a>
                                    @csrf @method('delete')
                                    <input type="submit" class="btn btn-danger" value="Trinti">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div>
                    <a href="{{ route('author.create') }}" class="btn btn-success">Pridėti</a>
                </div>
            </div>
        </div>
        @yield('content')
    </main>
@endsection
