@extends('back.layouts.master')
@section('title', 'Duyuru Yönetim Paneli')
@section('headingTitle','Duyuru Yönetim Sayfası')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Duyuru Ekleme Paneli</h4>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger" >
                                    @foreach($errors->all() as $err)
                                        <li>{{$err}}</li>
                                    @endforeach
                                </div>
                            @endif
                            <form id="AnnouncementsForm" data-flag="0" action="{{route('back.announcements.store')}}" method="POST" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="basicInput">Duyuru Başlığı:</label>
                                            <div class="form-group">
                                                <input id="title" name="title" placeholder="Başlık" type="text" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="basicInput">Duyuru Resmi:</label>
                                            <div class="form-group">
                                                <input id="image" name="image" type="file" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div style="position: relative">
                                                <label for="roundText">Duyuru İçeriği:</label>
                                                <textarea id="summernote" name="description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-3 mb-1">Duyuruyu Kaydet</button>
                                        <a href="{{route('back.announcements')}}" type="reset" class="btn btn-light-secondary me-1 mb-1"> Geri Dön</a>
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
