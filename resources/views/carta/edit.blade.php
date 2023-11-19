@extends ('app.base')
@section('edit', 'Magical Proxy')

@section ('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 mb-3">
            @if($carta->image)
                <img src="{{ asset($carta->image) }}" class="img-fluid" alt="{{ $carta->name }}">
            @else
                <img src="{{ asset('uploads/No_Picture.jpg') }}" class="img-fluid" alt="{{ $carta->name }}">
            @endif
            <form action="{{ url('carta/' . $carta->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mt-4">
                    <label for="image" class="mb-3">Edit Image</label>
                    <input type="file" class="form-control btn btn-warning" id="image" name="image">
                </div>
                <button class="btn btn-primary mt-3" type="submit">Update Image</button>
            </form>
        </div>
        <div class="col-md-8">
            <div class="">
                <div class="card-body">
                    <form action="{{ url('carta/' . $carta->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="mb-1">Name</label>
                            <input type="text" class="form-control" id="name" name="name" maxlength="60" required value="{{ old('name', $carta->name )}}">
                        </div>
                        <div class="form-group">
                            <label for="color" class="mb-1">Color</label>
                            <input type="text" class="form-control" id="color" name="color" maxlength="20" value="{{ old('color', $carta->color)}}">
                        </div>
                        <div class="form-group">
                            <label for="type" class="mb-1">Type</label>
                            <input type="text" class="form-control" id="type" name="type"  maxlength="20" value="{{ old('type', $carta->type)}}">
                        </div>
                        <div class="form-group">
                            <label for="rarity" class="mb-1">Rarity</label>
                            <input type="text" class="form-control" id="rarity" name="rarity"  maxlength="20" value="{{ old('rarity', $carta->rarity)}}">        
                        </div>
                        <div class="form-group">
                            <label for="edition" class="mb-1">Edition</label>
                            <input type="text" class="form-control" id="edition" name="edition" maxlength="20" value="{{ old('edition', $carta->edition)}}">        
                        </div>
                        <div class="form-group">
                            <label for="year" class="mb-1">Year</label>
                            <input type="number" class="form-control" id="year" name="year"  min="1950" max="{{ date('Y') }}" value="{{ old('year',$carta->year) }}">
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('carta.index') }}" class="btn btn-danger m-3">Cancel</a>
                            <button class="btn btn-primary m-3" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

