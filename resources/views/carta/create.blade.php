@extends ('app.base')
@section('Create Card', 'Magical Proxy')

@section ('content')


<div class="container mt-4">
    <div class="mb-3">
        <div class="card-body">
            <form action="{{ url('carta') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" maxlength="60" required value="{{ old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="text" class="form-control" name="color" id="color" maxlength="20" required value="{{ old('color')}}">
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" class="form-control" name="type" id="type" maxlength="20" required value="{{ old('type')}}">
                        </div>
                        <div class="form-group">
                            <label for="rarity">Rarity</label>
                            <input type="text" class="form-control" name="rarity" id="rarity" maxlength="20" required value="{{ old('rarity')}}">        
                        </div>
                        <div class="form-group">
                            <label for="edition">Edition</label>
                            <input type="text" class="form-control" name="edition" id="edition" maxlength="20" required value="{{ old('edition')}}">        
                        </div>
                        <div class="form-group">
                            <label for="year">Year</label>
                            <input type="number" class="form-control" name="year" id="year" min="1950" max="{{ date('Y') }}" value="{{ old('year') }}">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ url('carta')}}" class="btn btn-danger mx-3">Cancel</a>
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
