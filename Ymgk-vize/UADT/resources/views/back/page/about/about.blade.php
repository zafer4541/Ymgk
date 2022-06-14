@extends('back.layouts.master')
@section('title', 'Hakkımızda Yönetim Sayfası')
@section('headingTitle','Hakkımızda Yönetim Sayfası')
@section('content')
    @if(session('addAboutSuccess'))
        <script>
            Swal.fire({
                position: 'top-enter',
                icon: 'success',
                title: '{{(session('addAboutSuccess'))}}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            @if($errors->count()>0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                        <li>{{$err}}</li>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{route('back.web.about.update')}}" method="post"
                                  enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="basicInput">Hakkımızda Başlığı:</label>
                                            <div class="form-group">
                                                <input id="title" name="title" placeholder="Başlık"
                                                       value="@if(isset($about->title)){{$about->title}}@endif"
                                                       type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label for="basicInput">Hakkımızda Sayfası Resmi:</label>
                                            @if(isset($about->image))
                                                <a href="{{URL::to('')}}{{$about->image}}"
                                                   target="_blank" style="display: inline-block">
                                                    <i class="fa fa-file-pdf fa-8x"></i>
                                                    {{str_replace("/uploads/","",$about->image)}}
                                                </a>
                                        </div>
                                        <div class="row">
                                            <img src="{{URL::to('')}}{{$about->image}}" alt=""
                                                 class=" img-fluid w-25">
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <input type="file" name="image" class="form-control">
                                                <small> Yukarıda yüklemiş olduğunuz resim gözükmektedir.Resmi
                                                    değiştirmek için Dosya Seç'e tıklayınız.</small><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div style="position: relative">
                                                <label for="roundText">Hakkımızda İçeriği:</label>
                                                <textarea id="summernote" name="description"
                                                          class="form-control">@if(isset($about->description)){{$about->description}}@endif</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-3 mb-1">Hakkımızda İçeriğini Kaydet</button>
                                        <a href="{{route('back.dashboard')}}" type="reset"
                                           class="btn btn-light-secondary me-1 mb-1"> Geri Dön</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('back')}}/dist/assets/vendors/summernote/summernote-lite.min.css">
@endsection
@section('js')
    <script src="{{asset('back')}}/dist/assets/vendors/summernote/summernote-lite.min.js"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 220,
        })
    </script>
@endsection

