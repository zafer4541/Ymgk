@extends('back.layouts.master')
@section('title', 'Müşavir Yönetim Sayfası')
@section('headingTitle','Müşavir Yönetim Sayfası')
@section('content')
    @if(session('addUsersSuccess'))
        <script>
            Swal.fire({
                position: 'top-enter',
                icon: 'success',
                title: '{{(session('addUsersSuccess'))}}',
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
                            <h6>{{$usersAdviser->count()}} adet kullanıcı bulundu.</h6>
                            <div style="float: right!important;">
                            <a class="btn btn-sm btn-primary" href="{{route('back.users.adviserCreate')}}">Müşavir Ekle </a>
                            <a class="btn btn-sm btn-primary " href="{{route('back.users.adviserUpload')}}">İçeriye Müşavir Belgesi
                                Aktar </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="yajraTable" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center whitespace-no-wrap">Adı-Soyadı</th>
                                        <th class="text-center whitespace-no-wrap">E-Mail</th>
                                        <th class="text-center whitespace-no-wrap">Müşavirin Ülkesi</th>
                                        <th class="text-center whitespace-no-wrap">Oluşturulma Tarihi</th>
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
@section('js')
    {{--yajra data table --}}
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $( document ).ready(function() {
            document.querySelector('#yajraTable').classList.add('yajraWidth');
            var el=document.querySelector(".yajraWidth")
            el.style.cssText = "max-width:100%!important;width:100%!important;"
        });
        let userTable = $('#yajraTable').DataTable({
            order:[4,'desc'],
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: '{!! route('back.users.fetchAdviser') !!}',
            columns: [
                {data: 'name'},
                {data: 'email'},
                {data: 'country'},

                {
                    data:'created_at',
                    type: 'date',

                    "render": function (data) {
                        if (data === null) return "- - - - -";
                        var date = new Date(data);
                        var month = date.getMonth() + 1;
                        return (month.length > 1 ? month : "0" + month) + "/" + date.getDate() + "/" + date.getFullYear() ;
                        //return date;
                    }},

                {data: 'crud'}

            ],
            columnDefs: [
                {
                    targets: '_all',
                }

            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.1/i18n/tr.json"

            },
        });
        function delete_user(user_id){
            Swal.fire({
                icon:'warning',
                title:'Emin misiniz?',
                text:'Müşaviri silmek istediğinize emin misiniz?',
                showConfirmButton: true,
                showCancelButton:true,
                cancelButtonText: "İptal",
                confirmButtonText: "Evet",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '{{route('back.users.adviserDelete')}}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": user_id,
                        },
                        success: function (data) {
                            Swal.fire({
                                position: 'top-enter',
                                icon: 'success',
                                title: 'Müşavir başarıyla silindi',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            userTable.ajax.reload();
                        },
                    });
                }
            });
        }
    </script>

@endsection

