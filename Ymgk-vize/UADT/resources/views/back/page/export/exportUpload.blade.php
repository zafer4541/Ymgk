@extends('back.layouts.master')
@section('title', 'Panel - İhracatlar - Dosya Yükle')
@section('headingTitle','Dosya Yükleme Sistemi')
@section('content')
    <style>
        footer {
            margin-top: 28rem !important;
        }
    </style>
    @if(session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{(session('success'))}}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Hata!',
                text: '{{session('error')}}',
                confirmButtonText: 'Kapat'
            });
        </script>
    @endif
    <link rel="stylesheet"  href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>İhracat Belgesi Yükle</h4>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger" >
                                    @foreach($errors->all() as $err)
                                        <li>{{$err}}</li>
                                    @endforeach
                                </div>
                            @endif
                               <form action="{{route('back.export.uploadFile')}}" method="post"
                                  enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group row"
                                         style="align-items: center;justify-content: center;display: flex;">
                                        <label for="image" class="col-lg-1 col-md-1 col-sm-4 col-xs-6 col-form-label">Açıklama</label>
                                        <div class="col-lg-11 col-md-11 col-sm-8 col-xs-6">
                                            Dosya yükleme sistemi sayesinde sistem içine .pdf, .xlsx(excel) uzantılı
                                            dosyalarınızı yükleyebilirsiniz. Sistem, bu dosyaları okuyup
                                            anlamlandırdıktan sonra ilgili modüllerine yerleştirir. Böylece manuel bir
                                            ihracat fırsatı girişinin oluşturabileceği iş yükü ve zaman kaybının önüne
                                            geçilmiş olur. <a href="#"> <small>Sistemin kabul edebildiği örnek dosya
                                                    formatlarını görmek için tıklayınız.</small> </a>
                                        </div>
                                    </div>
                                    <div class="form-group row"
                                         style="align-items: center;justify-content: center;display: flex;">
                                        <label for="image" class="col-lg-1 col-md-1 col-sm-4 col-xs-6 col-form-label">Dosya</label>
                                        <div class="col-lg-11 col-md-11 col-sm-8 col-xs-6">
                                            <div class="input-group">
                                                <input id="file" name="file" type="file" class="form-control"
                                                       required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"
                                             style="align-items: center;justify-content: center;display: flex;">
                                            <button name="submit" type="submit" class="btn btn-primary">Dosyayı Yükle
                                            </button>
                                        </div>
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

