@extends('layouts.main', $jobs = App\Models\Job::where('status', 1)->offset(0)->limit(3)->get())

@section('content')
<style>
    .pac-container {
    background-color: #fff;
    position: absolute!important;
    z-index: 1000;
    border-radius: 2px;
    border-top: 1px solid #d9d9d9;
    font-family: Arial, sans-serif;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    overflow: hidden
}

.pac-logo:after {
    content: "";
    padding: 1px 1px 1px 0;
    height: 16px;
    text-align: right;
    display: block;
    background-image: url(https://maps.gstatic.com/mapfiles/api-3/images/powered-by-google-on-white3.png);
    background-position: right;
    background-repeat: no-repeat;
    background-size: 120px 14px
}
.hdpi.pac-logo:after {
    background-image: url(https://maps.gstatic.com/mapfiles/api-3/images/powered-by-google-on-white3_hdpi.png)
}
.pac-item {
    cursor: default;
    padding: 0 4px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    line-height: 30px;
    text-align: left;
    border-top: 1px solid #e6e6e6;
    font-size: 11px;
    color: #999
}
.pac-item:hover {
    background-color: #fafafa
}
.pac-item-selected,
.pac-item-selected:hover {
    background-color: #ebf2fe
}
.pac-matched {
    font-weight: 700
}
.pac-item-query {
    font-size: 13px;
    padding-right: 3px;
    color: #000
}
.pac-icon {
    width: 15px;
    height: 20px;
    margin-right: 7px;
    margin-top: 6px;
    display: inline-block;
    vertical-align: top;
    background-image: url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons.png);
    background-size: 34px
}
.hdpi .pac-icon {
    background-image: url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons_hdpi.png)
}
.pac-icon-search {
    background-position: -1px -1px
}
.pac-item-selected .pac-icon-search {
    background-position: -18px -1px
}
.pac-icon-marker {
    background-position: -1px -161px
}
.pac-item-selected .pac-icon-marker {
    background-position: -18px -161px
}
.pac-placeholder {
    color: gray
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
