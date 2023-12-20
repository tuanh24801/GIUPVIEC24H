@extends('layouts.main', $jobs = App\Models\Job::where('status', 1)->get())

@section('content')

    <div class="title-list-dworker">
        <h2 class="text-dark">Danh sách người chạy việc</h2>
    </div>
    <!-- Dánh sach người chạy việc -->
    <div class="list-dworker">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 ">
            <div class="col mb-3">
              <div class="card box-dworker">
                <div class="top-card-dworker">
                    <p class="text-dark box-worker-top-star">4.9/5</p>
                    <p class="text-dark">'<3'</p>
                </div>
                <img src="{{ asset('images/user_1.png') }}" class="img-info-dworker" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-dark">Nguyễn Tuấn Anh</h5>
                    <div class="card-info-dworker">
                        <p class="">Lượt thuê: 1</p>
                        <p class="">Hoàn thành: 1</p>
                    </div>
                    <div class="card-seemore-dworker">
                        <a href="">xem thêm</a>
                    </div>
                </div>
              </div>
            </div>

            <div class="col mb-3">
                <div class="card box-dworker">
                  <div class="top-card-dworker">
                      <p class="text-dark box-worker-top-star">4.9/5</p>
                      <p class="text-dark">'<3'</p>
                  </div>
                  <img src="images/user_1.png" class="img-info-dworker" alt="...">
                  <div class="card-body">
                      <h5 class="card-title text-dark">Nguyễn Tuấn Anh</h5>
                      <div class="card-info-dworker">
                          <p class="">Lượt thuê: 1</p>
                          <p class="">Hoàn thành: 1</p>
                      </div>
                      <div class="card-seemore-dworker">
                          <a href="">xem thêm</a>
                      </div>
                  </div>
                </div>
              </div>

              <div class="col mb-3">
                <div class="card box-dworker">
                  <div class="top-card-dworker">
                      <p class="text-dark box-worker-top-star">4.9/5</p>
                      <p class="text-dark">'<3'</p>
                  </div>
                  <img src="images/user_1.png" class="img-info-dworker" alt="...">
                  <div class="card-body">
                      <h5 class="card-title text-dark">Nguyễn Tuấn Anh</h5>
                      <div class="card-info-dworker">
                          <p class="">Lượt thuê: 1</p>
                          <p class="">Hoàn thành: 1</p>
                      </div>
                      <div class="card-seemore-dworker">
                          <a href="">xem thêm</a>
                      </div>
                  </div>
                </div>
              </div>

              <div class="col mb-3">
                <div class="card box-dworker">
                  <div class="top-card-dworker">
                      <p class="text-dark box-worker-top-star">4.9/5</p>
                      <p class="text-dark">'<3'</p>
                  </div>
                  <img src="images/user_1.png" class="img-info-dworker" alt="...">
                  <div class="card-body">
                      <h5 class="card-title text-dark">Nguyễn Tuấn Anh</h5>
                      <div class="card-info-dworker">
                          <p class="">Lượt thuê: 1</p>
                          <p class="">Hoàn thành: 1</p>
                      </div>
                      <div class="card-seemore-dworker">
                          <a href="">xem thêm</a>
                      </div>
                  </div>
                </div>
              </div>

              <div class="col mb-3">
                <div class="card box-dworker">
                  <div class="top-card-dworker">
                      <p class="text-dark box-worker-top-star">4.9/5</p>
                      <p class="text-dark">'<3'</p>
                  </div>
                  <img src="images/user_1.png" class="img-info-dworker" alt="...">
                  <div class="card-body">
                      <h5 class="card-title text-dark">Nguyễn Tuấn Anh</h5>
                      <div class="card-info-dworker">
                          <p class="">Lượt thuê: 1</p>
                          <p class="">Hoàn thành: 1</p>
                      </div>
                      <div class="card-seemore-dworker">
                          <a href="">xem thêm</a>
                      </div>
                  </div>
                </div>
              </div>

        </div>
    </div>
    <!-- End Dánh sach người chạy việc -->

    <div class="title-list-dworker">
        <h2 class="text-dark">Danh sách công việc hiện có</h2>
    </div>
    <!-- Dánh sach công việchiện có -->
    <div class="list-dworker">
        <div class="row row-cols-1 row-cols-md-4 ">
            <div class="col mb-3">
              <div class="card box-dworker">
                <div class="top-card-dworker">
                    <p class="text-dark box-worker-top-star">4.9/5</p>
                    <p class="text-dark"><i class="fa-regular fa-heart fa-lg" style="color: red;"></i></p>
                </div>
                <img src="images/user_1.png" class="img-info-dworker" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-dark">Nguyễn Tuấn Anh</h5>
                    <div class="card-info-dworker">
                        <p class="">Lượt thuê: 1</p>
                        <p class="">Hoàn thành: 1</p>
                    </div>
                    <div class="card-seemore-dworker">
                        <a href="">xem thêm</a>
                    </div>
                </div>
              </div>
            </div>

            <div class="col mb-3">
                <div class="card box-dworker">
                  <div class="top-card-dworker">
                      <p class="text-dark box-worker-top-star">4.9/5</p>
                      <p class="text-dark"><i class="fa-regular fa-heart fa-lg" style="color: red;"></i></p>
                  </div>
                  <img src="images/user_1.png" class="img-info-dworker" alt="...">
                  <div class="card-body">
                      <h5 class="card-title text-dark">Nguyễn Tuấn Anh</h5>
                      <div class="card-info-dworker">
                          <p class="">Lượt thuê: 1</p>
                          <p class="">Hoàn thành: 1</p>
                      </div>
                      <div class="card-seemore-dworker">
                          <a href="">xem thêm</a>
                      </div>
                  </div>
                </div>
              </div>

              <div class="col mb-3">
                <div class="card box-dworker">
                  <div class="top-card-dworker">
                      <p class="text-dark box-worker-top-star">4.9/5</p>
                      <p class="text-dark"><i class="fa-regular fa-heart fa-lg" style="color: red;"></i></p>
                  </div>
                  <img src="images/user_1.png" class="img-info-dworker" alt="...">
                  <div class="card-body">
                      <h5 class="card-title text-dark">Nguyễn Tuấn Anh</h5>
                      <div class="card-info-dworker">
                          <p class="">Lượt thuê: 1</p>
                          <p class="">Hoàn thành: 1</p>
                      </div>
                      <div class="card-seemore-dworker">
                          <a href="">xem thêm</a>
                      </div>
                  </div>
                </div>
              </div>

              <div class="col mb-3">
                <div class="card box-dworker">
                  <div class="top-card-dworker">
                      <p class="text-dark box-worker-top-star">4.9/5</p>
                      <p class="text-dark"><i class="fa-regular fa-heart fa-lg" style="color: red;"></i></p>
                  </div>
                  <img src="images/user_1.png" class="img-info-dworker" alt="...">
                  <div class="card-body">
                      <h5 class="card-title text-dark">Nguyễn Tuấn Anh</h5>
                      <div class="card-info-dworker">
                          <p class="">Lượt thuê: 1</p>
                          <p class="">Hoàn thành: 1</p>
                      </div>
                      <div class="card-seemore-dworker">
                          <a href="">xem thêm</a>
                      </div>
                  </div>
                </div>
              </div>

              <div class="col mb-3">
                <div class="card box-dworker">
                  <div class="top-card-dworker">
                      <p class="text-dark box-worker-top-star">4.9/5</p>
                      <p class="text-dark"><i class="fa-regular fa-heart fa-lg" style="color: red;"></i></p>
                  </div>
                  <img src="images/user_1.png" class="img-info-dworker" alt="...">
                  <div class="card-body">
                      <h5 class="card-title text-dark">Nguyễn Tuấn Anh</h5>
                      <div class="card-info-dworker">
                          <p class="">Lượt thuê: 1</p>
                          <p class="">Hoàn thành: 1</p>
                      </div>
                      <div class="card-seemore-dworker">
                          <a href="">xem thêm</a>
                      </div>
                  </div>
                </div>
              </div>

        </div>
    </div>
    <!-- End Dánh sach người chạy việc -->

@endsection
