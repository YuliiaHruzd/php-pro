@extends('layouts.dashboard')

@section('content')
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" action=" " enctype="multipart/form-data">
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Name</label>
                <div class="col-sm-10">
                    <input type="text" value="{{$author->name}}" name="name" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Password</label>
                <div class="col-sm-10">
                    <input type="text" name="password" value="{{$author->password}}" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" value="{{$author->email}}" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Avatar</label>
                <div class="col-sm-10">
                    <input type="file" name="avatar" value="{{$author->avatar}}" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
                </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
