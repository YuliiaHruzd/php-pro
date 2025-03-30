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
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Count Item</label>
                <div class="col-sm-10">
                    <input type="text" value="{{$item->count}}" name="count" class="form-control form-control-sm"
                           id="colFormLabelSm" placeholder="col-form-label-sm">
                </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
