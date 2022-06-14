@extends('back.layouts.master')
@section('title', 'Haber Yönetim Sayfası')
@section('headingTitle','Haber Yönetim Sayfası')
@section('content')
    @if(session('addNewsSuccess'))
        <script>
            Swal.fire({
                position: 'top-enter',
                icon: 'success',
                title: '{{(session('addNewsSuccess'))}}',
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

                        <div class="card-header">
                            <h6>{{$news->count()}} adet haber bulundu.</h6>
                            <a href="{{route('back.news.create')}}" class="btn btn-sm btn-primary">Haber Ekle</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="yajraTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th class="text-center whitespace-no-wrap">Başlık</th>
                                            <th class="text-center whitespace-no-wrap">Açıklama</th>
                                            <th class="text-center whitespace-no-wrap">Resim</th>
                                            <th class="text-center whitespace-no-wrap">Durum</th>
                                            <th class="text-center whitespace-no-wrap">İşlemler</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">

@endsection

@section('js')
    <script>
        $( document ).ready(function() {
            document.querySelector('#yajraTable').classList.add('yajraWidth');
            var el=document.querySelector(".yajraWidth")
            el.style.cssText = "max-width:100%!important;width:100%!important;"
        });
        function getToggleValue(id, switchedButton) {
            let isPublished = null;
            if (switchedButton.checked) {
                isPublished = 1;
            } else {
                isPublished = 0;
            }
            $.ajax({
                url: '{{route('back.news.changeStatus')}}',
                type: 'POST',
                data: {
                    "_token": '{!! csrf_token() !!}',
                    id: id,
                    isPublished: isPublished,
                }
            })

        }
    </script>

    <script type="text/javascript">
        function showDetailMessage(id) {
            $.ajax({
                url: '{{route('back.news.fetchInfo')}}',
                type: 'GET',
                data: {
                    id: id,
                },
                success: function (response) {
                    Swal.fire({
                        title: response.title,
                        html: response.description,
                        cancelButtonColor: '#646464',
                        cancelButtonText: 'Kapat',
                        showCancelButton: true,
                        showConfirmButton: false
                    })
                }
            })
        }
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteNews(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Haberi silmek istediğinzden emin misiniz?',
                text: 'Silinen haber geri getirilemez!',
                showConfirmButton: true,
                showCancelButton: true,
                cancelButtonText: "İptal",
                confirmButtonText: "Sil",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '{!! route('back.news.delete') !!}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                        },
                        success: function () {
                            Swal.fire({
                                position: 'top-enter',
                                icon: 'success',
                                title: 'Başarıyla silindi',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            userTable.ajax.reload()
                        },
                    });
                }
            })
        }

    </script>

    {{--yajra data table --}}
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script>
        let userTable = $('#yajraTable').DataTable({
            order: [
                [0, 'DESC']
            ],

            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{!! route('back.news.fetchNews') !!}',
            columns: [
                {data:'id'},
                {data: 'title'},
                {data: 'detail'},
                {data: 'image'},
                {data: 'toggle'},
                {data: 'delete'},


            ],

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.1/i18n/tr.json"

            },
            "fnDrawCallback": function () {
                $('.switch').bootstrapToggle();
            },
        });

        function refreshTable() {
            userTable.ajax.reload();
        }

    </script>



@endsection

