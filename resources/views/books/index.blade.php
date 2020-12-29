@extends('layouts.app')
@section('content')
    <main class="py-4">
        <div class="container">
            @if ($errors->any())
                <h4 style="color:red">{{ $errors->first() }}</h4>
            @endif
            @if (session('status_success'))
                <p style="color: green"><b>{{ session('status_success') }}</b></p>
            @else
                <p style="color: red"><b>{{ session('status_error') }}</b></p>
            @endif
            <div class="card-body">
                <form class="form-inline" action="{{ route('book.index') }}" method="GET">
                    <select name="author_id" id="" class="form-control">
                        <option value="" selected disabled>Pasirinkite autorių knygų filtravimui:</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" @if ($author->id == app('request')->input('author_id'))
                                selected="selected"
                        @endif>{!! $author->surname !!}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Patvirtinti</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Pavadinimas</th>
                        <th>Autorius</th>
                        <th>Puslapių skaičius</th>
                        <th>Knygos kodas</th>
                        <th>Trumpas aprašymas</th>
                        <th>Veiksmai</th>
                    </tr>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{!! $book->author->name . ' ' . $book->author->surname !!}</td>
                            <td>{{ $book->pages }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{!! $book->short_description !!}</td>
                            <td>
                                <form action={{ route('book.destroy', $book->id) }} method="POST">
                                    <a class="btn btn-success" href={{ route('book.edit', $book->id) }}>Redaguoti</a>
                                    @csrf @method('delete')
                                    <input type="submit" class="btn btn-danger" value="Trinti" />
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div>
                    <a href="{{ route('book.create') }}" class="btn btn-success">Pridėti</a>
                </div>
            </div>
        </div>
        <div class="container">
            <iframe id="inbank-calculator" src="https://campaign.inbank.lv/calculators/hirepurchase/index.html" width="100%"
                height="300" frameborder="no" scrolling="no"></iframe>

            // Add script before body end tag.
            <script src="https://campaign.inbank.lv/calculators/hirepurchase/javascripts/iframeResizer.min.js"></script>
            <script>
                // without jQuery
                iFrameResize({}, '#inbank-calculator');

                // with jQuery
                jQuery(function() {
                    $('#inbank-calculator').iFrameResize({
                        log: false
                    });
                });

            </script>
        </div>
        <div class="container">
            <iframe id="inbank-calculator" src="https://campaign.inbank.lv/calculators/hirepurchase/index_en.html?a=partner&b=50&c=5000
    &d=2000&e=3&f=48&g=24&h=3&i=0&j=90&k=30&l=5&m=20.9&n=5.5&o=10&p=0
    &q=1400&t=one&t-amount=2000&t-period=24&t-interest=20.9&t-commision=110&t-adminfee=0&t-total=1812&t-apr=1" width="100%"
                height="300" frameborder="no" scrolling="no"></iframe>

            // Add script before body end tag.
            <script src="https://campaign.inbank.lv/calculators/hirepurchase/javascripts/iframeResizer.min.js"></script>
            <script>
                // without jQuery
                iFrameResize({}, '#inbank-calculator');

                // with jQuery
                jQuery(function() {
                    $('#inbank-calculator').iFrameResize({
                        log: false
                    });
                });

            </script>
        </div>
    </main>
@endsection
