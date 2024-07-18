@extends('Admin.Layouts.master')
@section('title')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row gx-lg-5">
                        <div class="col-xl-4 col-md-8 mx-auto">
                            <div class="product-img-slider sticky-side-div">
                                <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            @php
                                                $url = Storage::url($data->thumbnail);
                                            @endphp
                                            <img src="{{ $url }}" alt="" class="img-fluid d-block" />
                                        </div>

                                    </div>

                                </div>
                                <!-- end swiper thumbnail slide -->
                                <p class="p-3">{{ $data->excerpt }}
                                </p>
                                <!-- end swiper nav slide -->
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-xl-8">
                            <div class="mt-xl-0 mt-5">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h4>{{ $data->title }}</h4>
                                        <div class="hstack gap-3 flex-wrap">
                                            <div><a href="#"
                                                    class="text-primary d-block">{{ $data->user->first_name }}
                                                    {{ $data->user->last_name }}</a></div>
                                            <div class="vr"></div>
                                            <div class="text-muted">
                                                @foreach ($data->tags as $item)
                                                    <span class="badge bg-primary text-uppercase">{{ $item->name }}</span>
                                                @endforeach

                                            </div>
                                            <div class="vr"></div>
                                            <div class="text-muted fw-medium">{{ $formatDate }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div>
                                            <a href="{{ route('admin.post.edit', $data->id) }}" class="btn btn-light"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                                                    class="ri-pencil-fill align-bottom"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    {!! $data->content !!}
                                </div>
                                <!-- end card body -->
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection
