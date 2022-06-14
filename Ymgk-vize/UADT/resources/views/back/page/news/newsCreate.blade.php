@extends('back.layouts.master')
@section('title', 'Haber Yönetim Sayfası')
@section('headingTitle','Haber Ekleme Paneli')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Haber Ekleme Paneli</h4>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                        <li>{{$err}}</li>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{route('back.news.store')}}" method="POST" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="basicInput">Haber Başlığı:</label>
                                            <div class="form-group">
                                                <input id="title" name="title" placeholder="Başlık" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="basicInput">Haber Resmi:</label>
                                            <div class="form-group">
                                                <input id="image" name="image" type="file" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="basicInput">Haber Tipi:</label>
                                            <div class="form-group">
                                                <select onchange="checkType()" class="form-control" name="newsType" id="newsType">
                                                    <option value="0" selected>Site İçi</option>
                                                    <option value="1">Site Dışı</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="urlArea">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Haberin Url'i:</label>
                                            <input type="text" class="form-control" name="newsUrl" id="newsUrl">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="descriptionArea">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div style="position: relative">
                                                <label for="roundText">Haber İçeriği:</label>
                                                <textarea id="summernote" name="description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-3 mb-1">Kaydet</button>
                                        <a href="{{route('back.news')}}" type="reset" class="btn btn-light-secondary me-1 mb-1"> Geri Dön</a>
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
    <script>
        checkType()
        function checkType(){
            let type = document.getElementById('newsType').value;

            if(type === '1'){
                document.getElementById('urlArea').style.display = "block";
                document.getElementById('descriptionArea').style.display = "none";
            }
            else {
                document.getElementById('urlArea').style.display = "none";
                document.getElementById('descriptionArea').style.display = "block";
            }
        }
    </script>
@endsection
