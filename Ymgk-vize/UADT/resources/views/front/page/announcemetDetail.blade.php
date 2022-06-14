@extends('front.layouts.master')
@section('css')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{asset('Mazer/timeline2.css')}}">
@endsection
@section('content')
    <style>
        header{
            background: #021130 !important;
            /*background: rgba(2, 17, 48, 0.71) !important;*/
            box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;        }
        .btn-primary {
            color: #fff;
            background-color: #021130 !important;
            border-color: #021130 !important;
        }
        a{
            font-weight: unset!important;
        }
        footer{
            z-index: 25 !important;
        }
        *{
            overflow: visible !important;
        }
    </style>

    <div class="news-detail">
        <div class="new-dt">
            <div class="neww">
                <div class="news-text">
                    <div class="text-content">
                        <div class="news-header">
                            <span class="headerrr">{{$announcement->title}}</span>
                            <span class="date">{{$announcement->created_at}}</span>
                        </div>
                        <div class="news-about">
                    <span>
                        {!! $announcement->description !!}
                    </span>
                        </div>
                    </div>
                </div>
                <div class="news-img">
                    <div class="news-img2">
                        <img src="{{asset($announcement->image)}}" alt="Foto">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection

