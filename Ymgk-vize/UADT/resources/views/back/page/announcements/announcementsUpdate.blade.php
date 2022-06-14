@extends('back.layouts.master')
@section('title', 'Duyuru Düzenleme Paneli')
@section('headingTitle','Duyuru Yönetim Sayfası')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Duyuru Düzenleme Paneli</h4>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                        <li>{{$err}} </li>
                                    @endforeach
                                </div>

                            @endif
                            <form action="{{route('back.announcements.update',$announcements->id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="basicInput">Başlık:</label>
                                            <div class="form-group">
                                                <input id="title" name="title" placeholder="Başlık"
                                                       value="{{$announcements->title}}" type="text"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="row">
                                            <label for="basicInput">Resim :
                                                @if($announcements->image != null)
                                                    <a href="{{URL::to('')}}{{$announcements->image}}"
                                                       target="_blank" style="display: inline-block">
                                                        <i class="fa fa-file-pdf fa-8x"></i>
                                                        {{str_replace("/uploads/","",$announcements->image)}}
                                                    </a>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <img src="{{URL::to('')}}{{$announcements->image}}" alt=""
                                                 class=" img-fluid w-25">
                                            @endif
                                        </div>


                                        <div class="row">
                                            <div class="form-group">
                                                <input id="image" name="image" type="file" class="form-control"
                                                       placeholder="image">
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
                                                <label for="roundText">Duyuru Açıklaması:</label>
                                                <textarea id="summernote" name="description"
                                                          class="form-control">{{$announcements->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-3 mb-1">Duyuruyu Kaydet</button>
                                        <a href="{{route('back.announcements')}}" type="reset"
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
