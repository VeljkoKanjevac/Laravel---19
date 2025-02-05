@extends("layout")

@section("naslovStranice")
    Edit City
@endsection

@section("sadrzajStranice")

    <form method="post" action="{{ route('updateCity', ['city' => $city->id]) }}">

        {{csrf_field()}}

        @if($errors->any())
            @foreach($errors->all() as $error)
                <p>Greska:{{$error}}</p>
            @endforeach
        @endif

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ime grada</label>
            <input type="text" name="city" value="{{$city->city->name}}" class="form-control" id="exampleInputEmail1"
                   aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Temperatura</label>
            <input type="number" name="temperature" value="{{$city->temperature}}" class="form-control"
                   id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <button type="submit" class="btn btn-primary">Izmeni</button>
    </form>

@endsection
