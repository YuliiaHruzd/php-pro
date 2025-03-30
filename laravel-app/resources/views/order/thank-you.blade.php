@extends('layouts.dashboard')

@section('content')
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Items</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    Thanks you, for your orders in our shop<br>
                    You can download invoice <img src="{{$url}}" alt="{{$url}}"><br>
                </div>
            </div>
        </div>
    </div>
@endsection
