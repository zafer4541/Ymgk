@extends('back.layouts.master')
@section('title', 'Site İçi İletişim Paneli')
@section('headingTitle','Site İçi İletişim Yönetim Paneli')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="display: flex;justify-content: space-between;">
                            <h6>{{$contacts->count()}} adet mesaj bulundu.</h6>
                        </div>
                        <div class="card-body">
                            <table id="yajraTable" class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center whitespace-no-wrap">Adı-Soyadı</th>
                                    <th class="text-center whitespace-no-wrap">E-Mail</th>
                                    <th class="text-center whitespace-no-wrap">Telefon Numarası</th>
                                    <th class="text-center whitespace-no-wrap">Gönderilen İçerik</th>
                                    <th class="text-center whitespace-no-wrap">İşlemler</th>
                                </tr>
                                </thead>
                            </table>
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
    <script type="text/javascript">
        $( document ).ready(function() {
            document.querySelector('#yajraTable').classList.add('yajraWidth');
            var el=document.querySelector(".yajraWidth")
            el.style.cssText = "max-width:100%!important;width:100%!important;"
        });
        function showDetailMessage(id) {
            var val = $("#button_message" + id).val();
            Swal.fire({
               title:'Açıklama',
               html:val,
               showConfirmButton:true,
               confirmButtonText:'Kapat',
            });
        }
        function delete_description(id) {
            Swal.fire({
                icon:'warning',
                title:'Silinen iletişim metni geri getirilemez!',
                text:'Silmek istediğinizden eminmisiniz?',
                showConfirmButton:true,
                showCancelButton:true,
                confirmButtonText:'Evet',
                cancelButtonText:'Kapat',
            }).then($response =>{
             if($response.isConfirmed){
                 $.ajax({
                     type: 'POST',
                     url: '{{route('back.contact.delete')}}',
                     data: {
                         "_token": "{{ csrf_token() }}",
                         "id": id,
                     },
                     success: function (data) {
                         Swal.fire({
                             position: 'top-center',
                             icon: 'success',
                             title: 'İletişim metni başarıyla silindi.',
                             showConfirmButton: false,
                             timer: 1500
                         })
                         contactTable.ajax.reload();
                     },
                 });
             }
            });
        }

        let contactTable = $('#yajraTable').DataTable({
            order:[0,'DESC'],
            responsive: true,
            processing: true,
            serverSide: true,
            ajax:'{!! route('back.contact.fetch') !!}',
            columns:[
                {data:'name'},
                {data:'email'},
                {data:'phone'},
                {data:'description'},
                {data:'delete'},
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
        function refreshTable(){
            userTable.ajax.reload();
        }
    </script>
@endsection
