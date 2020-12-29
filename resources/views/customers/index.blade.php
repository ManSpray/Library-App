@extends('layouts.app')
@section('content')
    <main class="py-4">
        <div class="container">
            <div class="card-body">
                <form class="form-inline" action="{{ route('customer.index') }}" method="GET">
                    <select name="book_id" id="" class="form-control">
                        <option value="" selected disabled>Pasirinkite knygą skaitovų filtravimui:</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}" @if ($book->id == app('request')->input('book_id'))
                                selected="selected"
                        @endif>{{ $book->title }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="card-body">
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
                <table class="table">
                    <tr>
                        <th>Vardas</th>
                        <th>Pavardė</th>
                        <th>Knyga</th>
                        <th>Veiksmai</th>
                    </tr>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->surname }}</td>
                            <td>{{ $customer->book->title }}</td>
                            <td>
                                <form action={{ route('customer.destroy', $customer->id) }} method="POST">
                                    <a class="btn btn-success"
                                        href={{ route('customer.edit', $customer->id) }}>Redaguoti</a>
                                    @csrf @method('delete')
                                    <input type="submit" class="btn btn-danger" value="Trinti" />
                                    {{-- <a href="{{ route('customer.read', $customer->id) }}"
                                        class="btn btn-primary m-1">Peržiūrėti skaityklą</a> --}}
                                </form>
                            </td>                            
                        </tr>
                    @endforeach
                </table>
                <div>
                    <a href="{{ route('customer.create') }}" class="btn btn-success">Pridėti</a>
                </div>
            </div>
        </div>
        @yield('content')
    </main>
@endsection
