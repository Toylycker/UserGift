@extends('layouts.app')
@section('content')
<div class="container-xxl">
    <div class="d-grid gap-2 col-6 mx-auto my-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Craete User</button>
    </div>

    <div class="d-grid gap-2 col-6 mx-auto">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Create Gift</button>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Craete User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('users.store')}}" method="post">
                @csrf
                <label for="name" class="form-label">name</label>
                <input type="text" name="name" class="form-control my-4">
                <button type="submit" class="btn bg-success">create</button>
            </form>
        </div>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="staticBackdropLabel">Create Gift</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{route('gifts.store')}}" method="post">
            @csrf
                <label for="name" class="form-label">name</label>
                <input type="text" name="name" class="form-control my-4">
                <div class="mb-3">
                    <label for="user_id" class="form-label fw-bold">
                        user <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" >
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="parent_id" class="form-label fw-bold">
                        attach to other gift <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id" required>
                        @foreach($gifts as $gift)
                            <option value="{{ $gift->id }}" >
                                {{ $gift->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn bg-success">create</button>
        </form>
    </div>
  </div>
</div>
</div>
</div>

<div class="container-xxl mt-3 mb-3">
    @foreach ($users as $user)
    <div class="border">
        <a href="{{route('users.show', $user->id)}}">
            <h4>{{$user->name}}</h4>
            <h6>Gifts:{{$user->gifts->count()}}</h6>
        </a>   
    </div>
    @endforeach
</div>
@endsection