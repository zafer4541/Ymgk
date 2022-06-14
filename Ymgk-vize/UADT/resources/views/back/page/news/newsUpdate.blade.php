@extends('back.layouts.master')
@section('title', 'Haber Yönetim Sayfası')
@section('headingTitle','Haber Güncelleme Paneli')
@section('content')

    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Haber Güncelleme Paneli</h4>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                        <li>{{$err}} </li>
                                    @endforeach
                                </div>

                            @endif
                            <form action="{{route('back.news.update',$news->id)}}"  method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="basicInput">Haber Başlığı:</label>
                                        <div class="form-group">
                                            <input id="title" name="title" placeholder="Başlık" value="{{$news->title}}" type="text" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="basicInput">Haberin Tipi:</label>
                                        <div class="form-group">
                                            <select onchange="checkType()" class="form-control" name="newsType" id="newsType">
                                                <option value="0" {{$news->type == 0 ? 'selected':''}}>Site İçi</option>
                                                <option value="1" {{$news->type == 1 ? 'selected':''}}>Site Dışı</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="row" id="urlArea">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Haberin Url'i:</label>
                                            <input type="text" value="{{$news->url}}" class="form-control" name="newsUrl" id="newsUrl">
                                        </div>
                                    </div>
                                </div>
                            <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="basicInput">Haber Resmi:
                                                @if($news->image != null)
                                                    <a href="{{URL::to('')}}{{$news->image}}"
                                                       target="_blank" style="display: inline-block" >
                                                        <i class="fa fa-file-pdf fa-8x"></i>
                                                        {{str_replace("/uploads/","",$news->image)}}
                                                    </a>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <img  src="{{URL::to('')}}{{$news->image}}" alt="" class=" img-fluid w-25">
                                            @endif
                                        </div>

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

                            <div class="row" id="descriptionArea">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div style="position: relative">
                                            <label for="roundText">Haberin İçeriği:</label>
                                            <textarea id="summernote" name="description"  class="form-control">{{$news->description}}</textarea>
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
