@extends ('app.base')
@section('title', 'Magical Proxy')

@section ('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 mb-3">
            @if($carta->image)
                <img src="{{ asset('uploads/' . $carta->image) }}" class="img-fluid" alt="{{ $carta->name }}">

            @else
                <img src="{{ asset('uploads/No_Picture.jpg') }}" class="img-fluid" alt="{{ $carta->name }}">
            @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <h5 class="card-title">{{ $carta->name }}</h5>
                </div>
                <!-- Fields -->
                <ul class="list-unstyled custom-list">
                    <li><span class="field">Color:</span> {{ $carta->color }}</li>
                    <li><span class="field">Type:</span> {{ $carta->type }}</li>
                    <li><span class="field">Rarity:</span> {{ $carta->rarity }}</li>
                    <li><span class="field">Edition:</span> {{ $carta->edition }}</li>
                    <li><span class="field">Year:</span> {{ $carta->year }}</li>
                </ul>
                <!-- End of Fields -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <a href="{{ route('carta.index') }}" class="btn btn-danger mt-3">Go Back</a>
        </div>
    </div>
</div>
@endsection
