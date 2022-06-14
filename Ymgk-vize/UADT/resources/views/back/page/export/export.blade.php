@extends('back.layouts.master')
@section('title', 'İhracat Fırsatları Yönetim Paneli')
@section('headingTitle','İhracat Fırsatları Yönetim Sayfası')
@section('content')
    @if(session('addExportSuccess'))
        <script>
            Swal.fire({
                position: 'top-enter',
                icon: 'success',
                title: '{{(session('addExportSuccess'))}}',
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
                        <div class="card-header" style="display: flex;justify-content: space-between;">
                            <h6>{{$exports->count()}} adet ihracat bulundu.</h6>
                            <div style="float: right!important;">
                                <a href="{{route('back.export.create')}}" class="btn btn-sm btn-primary">İhracat Fırsatı
                                    Ekle</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="yajraTable" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center whitespace-no-wrap">İhracat Başlığı</th>
                                        <th style="max-width: 100px" class="text-center whitespace-no-wrap">Kategori</th>
                                        <th class="text-center whitespace-no-wrap">Durumu</th>
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
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('js')
    <script type="text/javascript">
        $( document ).ready(function() {
            document.querySelector('#yajraTable').classList.add('yajraWidth');
            var el=document.querySelector(".yajraWidth")
            el.style.cssText = "max-width:100%!important;width:100%!important;"
        });
        function showDetailMessage(id) {
            $.ajax({
                url: '{{route('back.export.fetchInfo')}}',
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



    <script>

        function get_exports() {
            $.ajax({
                type: 'GET',
                url: '{{filter_var('proendx.com/api/ihracat_test_verileri', FILTER_VALIDATE_URL)}}',
                success: function () {
                    console.log('success');
                },
            });
        }
    </script>
    <script>
        function getToggleValue(id, switchedButton) {
            let isPublished = null;
            if (switchedButton.checked) {
                isPublished = 1;
            } else {
                isPublished = 0;
            }
            $.ajax({
                url: '{{route('back.export.switch')}}',
                type: 'POST',
                data: {
                    "_token": '{!! csrf_token() !!}',
                    id: id,
                    isPublished: isPublished,
                }
            })

        }
    </script>

    <script>
        function delete_exports(id) {
            Swal.fire({
                text: 'Silinen ihracat geri getirilemez!',
                title: "İhracatı silmek istediğinizden emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sil',
                cancelButtonText: 'İptal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '{{route('back.export.delete')}}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                        },
                        success: function () {
                            Swal.fire({
                                position: 'top-enter',
                                icon: 'success',
                                title: 'İhracat başarıyla silindi',
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
    {{--yajra data table fetch--}}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        let userTable = $('#yajraTable').DataTable({
            orderBy:[0],
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{!! route('back.export.fetchNews') !!}',
            columns: [
                {data: 'title'},
                {data: 'category'},
                {data: 'switch'},//controller
                {data: 'crud'}//controller
            ],
            columnDefs: [
                {
                    targets: '_all',
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.1/i18n/tr.json"
            },
            "fnDrawCallback": function () {
                $('.switch').bootstrapToggle();
            },
        });
    </script>


@endsection


