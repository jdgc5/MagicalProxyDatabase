@extends('app.base')

@section('title', 'Magical Proxy')

@section('content')

@include('modal.deletecarta')

<div class="table-responsive small">

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 m-0">
  @foreach($cartas as $carta)
    <div class="col mb-4">
      <div class="card">
        @if($carta->image)
          <img src="{{ asset($carta->image) }}" class="img-fluid img-size" alt="{{ $carta->name }}">
        @else
          <img src="{{ asset('uploads/No_Picture.jpg') }}" class="img-fluid img-size" alt="{{ $carta->name }}">
        @endif
        <div class="card-body text-center">
          <h5 class="card-title mb-3">{{ $carta->name }}</h5>
          <!-- Botones de acción -->
          <div class="d-flex justify-content-around">
            <a class="btn btn-primary" href="{{ url('carta/' . $carta->id) }}"><i class="fa-regular fa-eye"></i></a>
            <a class="btn btn-warning" href="{{ url('carta/' . $carta->id . '/edit') }}"><i class="fa-solid fa-pen"></i></a>
            <button data-url="{{ url('carta/' . $carta->id) }}" data-title="{{ $carta->title }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCartaModal">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>

<a class="btn-secondary btn" href="{{ url('carta/create') }}">link to create</a>
<script>
  const deleteCartaModal = document.getElementById('deleteCartaModal');
  const cartaTitle = document.getElementById('cartaTitle');
  const formDeleteV3 = document.getElementById('formDeleteV3');
  deleteCartaModal.addEventListener('show.bs.modal', event => {
  cartaTitle.innerHTML = event.relatedTarget.dataset.title;
  formDeleteV3.action = event.relatedTarget.dataset.url;
  });
</script>
@endsection