@extends('layouts.dashboard-admin')

@section('content')
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" action=" ">
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Name</label>
                <div class="col-sm-10">
                    <input readonly type="text" value="{{$post->name}}" name="name" class="form-control form-control-sm"
                           id="colFormLabelSm" placeholder="col-form-label-sm">
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Text</label>
                <div class="col-sm-10">
                    <input type="text" readonly value="{{$post->text}}" name="text" class="form-control form-control-sm"
                           id="colFormLabelSm" placeholder="col-form-label-sm">
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Author Id</label>
                <div class="col-sm-10">
                    <input type="text" readonly value="{{$post->author_id}}" name="author_id"
                           class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
                </div>
            </div>
        </form>
    </div>
@endsection
