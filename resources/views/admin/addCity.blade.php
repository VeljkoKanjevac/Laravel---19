@extends("layout")

@section("naslovStranice")
    Add City
@endsection

@section("sadrzajStranice")

    <form method="post" action="{{ route('saveCity') }}">

        {{csrf_field()}}

        @if($errors->any())
            @foreach($errors->all() as $error)
                <p>Greska:{{$error}}</p>
            @endforeach
        @endif

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ime grada</label>
            <input type="text" name="city" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Temperatura</label>
            <input type="number" name="temperature" class="form-control" id="exampleInputEmail1"
                   aria-describedby="emailHelp">
        </div>

        <button type="submit" class="btn btn-primary">Dodaj</button>
    </form>

@endsection
