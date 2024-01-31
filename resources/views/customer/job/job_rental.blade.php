@extends('layouts.main', $jobs = App\Models\Job::where('status', 1)->offset(0)->limit(3)->get())

@section('content')
<style>
    .pac-matched{
        color: black !important;
    }
    .pac-item-query{
        color: black !important;
    }
    .pac-item{
        background-color: #cdcfcf !important;
    }
    .pac-item:hover {
        background-color: #dde0e0 !important;
    }
</style>
    <div class="title-list-dworker">
        <h2 class="text-dark">Chi tiết thuê</h2>
    </div>
    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary mt-2 mb-3">Trở lại</a>
    <div class="row mt-3" style="margin-bottom: 100px;">
        @if (session('msg'))
            <p class="text-danger fs-2">{{ session('msg') }}</p>
        @endif
        <form action="{{ route('handle-rental', ['job_rental_id' => $job_rental[0]->id]) }}" method="post" enctype="multipart/form-data" >
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-6">
                    <h4 class="text-dark">Công việc: </h4>
                    <div class="mb-3">
                        <p class="text-dark" style="font-size: 25px;"><h2 class="text-dark">{{ $job->name }}</h2></p>
                        <p class="text-dark">{{ $job->note }} </p>
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset('storage/images/job-images/'.$job->avatar) }}" id="preview-image-before-upload" style="width: 180px;" class="mb-2">
                    </div>

                    <h4 class="text-dark">Hình thức thuê: {{ $job_rental[0]->type_rental->name }} </h4>
                    <h4 class="text-dark">Giá thuê: {{ number_format($job_rental[0]->cost, 0) }}</h4>
                    <input type="hidden" id="cost" value="{{ $job_rental[0]->cost }}">
                    <div class="mb-3">
                        <label for="">Nhập số lần thuê</label>
                        <input type="number" name="amount" class="form-control" min="1" value="1" id="amount" value="{{ old('amount') }}">
                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Vị trí</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location') }}" id="autocomplete">
                        @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Ghi chú cho người thực hiện</label>
                        <div class="form-floating">
                            <textarea class="form-control" name="note" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{ old('note') }}</textarea>
                            <label for="floatingTextarea2"></label>
                          </div>
                    </div>
                    <div class="mb-3">
                        <h3 class="text-dark">Tổng: <b id="total" class="text-danger fs-3"></b></h3>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">Thanh toán</button>
                </div>
                <div class="col-6">
                    <h4 class="text-dark mb-3">Người thực hiện: </h4>
                    <div class="mb-3">
                        <p class="text-dark" style="font-size: 25px;"><h2 class="text-dark">{{ $errand_worker->name }}</h2></p>
                        <p class="text-dark">{{ $job_rental[0]->note }} </p>
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset('storage/images/errand_worker-images/'.$errand_worker->avatar) }}" id="preview-image-before-upload" style="width: 180px;" class="mb-2">
                    </div>
                    <div class="mb-3">
                        <a href="" class="btn btn-outline-success">Sẵn sàng</a>
                    </div>
                </div>
            </div>

        </form>
    </div>



@endsection
@section('scripts')
<script>

    $(document).ready(function(){
        let cost = $('#cost').val();
        let amount = $('#amount').val()
        let total = cost*amount;
        total = total.toLocaleString('vi', {style : 'currency', currency : 'VND'});
        $('#total').html(total);
        $('#amount').change(function(){
            let amount = $('#amount').val()
            let total = cost*amount;
            total = total.toLocaleString('vi', {style : 'currency', currency : 'VND'});
            $('#total').html(total);
        })
    });

    let autocomplete;
        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('autocomplete'), {
                types: ['address'],
                componentRestrictions: { 'country': ['VN'] },
                fields: ['name']
            });
            autocomplete.addListener('place_changed', onPlaceChanged);
        }

        function onPlaceChanged() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                document.getElementById('autocomplete').placeholder = 'Enter a location';
            } else {
                document.getElementById('autocomplete').innerHTML = place.name;
            }
        }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChNNTJnl-Yy-ipzVszlROovhy9mPX9CEc&callback=initAutocomplete&libraries=places" async defer></script>


@endsection
