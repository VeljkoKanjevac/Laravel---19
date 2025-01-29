@extends("layout")

@section("naslovStranice")

@endsection

@section("sadrzajStranice")

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">CITY</th>
            <th scope="col">TEMPERATURE</th>
            <th scope="col">ACTIONS</th>
        </tr>
        </thead>

        <tbody>
        @foreach($weather as $singleCity)
            <tr>
                <th scope="row">{{$singleCity->id}}</th>
                <td>{{$singleCity->city}}</td>
                <td>{{$singleCity->temperature}}</td>
                <td>
                    <a href="{{ route('deleteCity', ['city' => $singleCity->id]) }}" class="btn btn-danger">Obrisi</a>
                    <a href="{{ route('getCity', ['city' => $singleCity->id]) }}" class="btn btn-primary">Edituj</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
