@extends('back.layouts.master')
@section('title', 'Ana Sayfa Güncelleme Sayfası')
@section('headingTitle','Ana Sayfa Güncelleme Sayfası')
@section('content')
    @if(session('addHeaderSuccess'))
        <script>
            Swal.fire({
                position: 'top-enter',
                icon: 'success',
                title: '{{(session('addHeaderSuccess'))}}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ana Sayfa İçerik Güncelleme Paneli</h4>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                        <li>{{$err}} </li>
                                    @endforeach
                                </div>

                            @endif
                            <form action="{{route('back.web.header.update')}}"  method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="basicInput">Ana Sayfa Mesajı:</label>
                                            <div class="form-group">
                                                <input id="title" name="title" value="{{$header->title}}" placeholder="Açıklama"  type="text" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="basicInput">Ana Sayfa Resmi:
                                                    @if($header->image != null)
                                                    <a href=""
                                                       target="_blank" style="display: inline-block" >
                                                        <i class="fa fa-file-pdf fa-8x"></i>
                                                        {{str_replace("/uploads/","",$header->image)}}
                                                    </a>
                                                </label>
                                            </div>

                                            <div class="row">
                                                <img  src="{{URL::to('')}}{{$header->image}}" alt="" class=" img-fluid w-25">
                                                @endif
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="form-group">
                                                    <input id="image" name="image" type="file"  class="form-control">
                                                    <small> Yukarıda yüklemiş olduğunuz resim gözükmektedir. Resmi değiştirmek için Dosya Seç'e tıklayınız.</small><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-3 mb-1">Kaydet</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

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
