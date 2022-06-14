@extends('back.layouts.master')
@section('title', 'Duyuru Yönetim Sayfası')
@section('headingTitle','Duyuru Yönetim Sayfası')
@section('content')
    @if(session('addAnnouncementsSuccess'))
        <script>
            Swal.fire({
                position: 'top-enter',
                icon: 'success',
                title: '{{(session('addAnnouncementsSuccess'))}}',
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
                            <h6>{{$announcements->count()}} adet duyuru bulundu.</h6>
                            <a href="{{route('back.announcements.create')}}" class="btn btn-sm btn-primary">Duyuru Ekleme Paneli</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="yajraTable" class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <th class="text-left whitespace-no-wrap">Duyuru Başlığı</th>
                                            <th class="text-left whitespace-no-wrap">Duyuru İçeriği</th>
                                            <th class="text-left whitespace-no-wrap">Duyuru Resmi</th>
                                            <th class="text-left whitespace-no-wrap">Aktiflik Durumu</th>
                                            <th class="text-left whitespace-no-wrap">Duyuru İşlemleri</th>
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
    function getToggleValue(id , switchedButton){
        let isPublished = null;
        if(switchedButton.checked){
            isPublished = 1;
        }
        else {
            isPublished = 0;
        }
        $.ajax({
            url:'{{route('back.announcements.changeStatus')}}',
            type:'POST',
            data: {
                "_token":'{!! csrf_token() !!}',
                id:id,
                isPublished:isPublished,
            }
        })

    }
</script>
<script type="text/javascript">
    function showDetailMessage(id){
        $.ajax({
            url:'{{route('back.announcements.fetchInfo')}}',
            type:'GET',
            data:{
                id:id,
            },
            success:function (response){
                Swal.fire({
                    title: response.title,
                    html:response.description,
                    cancelButtonColor:'#646464',
                    cancelButtonText: 'Kapat',
                    showCancelButton: true,
                    showConfirmButton:false
                })
            }
        })
    }
</script>
<script>
    function deleteAnnouncements(id){
       Swal.fire({
           icon:'warning',
           title:'Duyuruyu silmek istediğinizden emin misiniz?',
           text:'Silinen duyuru geri getirilemez!',
           showConfirmButton: true,
           showCancelButton:true,
           cancelButtonText: "İptal",
           confirmButtonText: "Evet",
       }).then((result) => {
           if(result.isConfirmed){
               $.ajax({
                   type:'POST',
                   url:'{{route('back.announcements.delete')}}',
                   data:{
                       "_token": "{{ csrf_token() }}",
                       "id": id,
                   },
                   success:function (){
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
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

<script>
    let userTable = $('#yajraTable').DataTable({
     order: [
         [0,'ASC']
     ],
     responsive: true,
     processing: true,
     serverSide: true,
     ajax: "{!! route('back.announcements.FetchAnnouncements') !!}",
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.10.12/i18n/Turkish.json"
        },
     columns: [
         {data: 'title'},
         {data: 'detail'},
         {data:'image'},
         {data: 'toggle'},
         {data: 'delete'},

     ],
     columnDefs: [
         {
             targets: '_all',
         }
     ],
     "fnDrawCallback": function() {
         $('.switch').bootstrapToggle();
     },
 });
    function refreshTable(){
        userTable.ajax.reload();
    }
</script>
@endsection
