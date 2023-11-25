@extends('layout.dashboard_template')
@section('dashboard-content')

<!DOCTYPE html>
<head>
    <meta charset='utf-8'/>
    <title>
        Kegiatan
    </title>

    
    {{-- Full Calendar v5 --}}
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.css' rel='stylesheet'/>


    <style>
        #calendar {
            max-width: 1100px;
            margin: 40px auto;
        }
    </style>

    <script>

        var SITEURL = "{{ url('/') }}";

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                nowIndicator: true,
                editable: true,
                selectable: true,
                navLinks: true,
                timeZone: 'Asia/Jakarta',
                locale: 'id',
                initialView: 'resourceTimeGridDay',
                eventColor: 'gray',
                // resources: [
                //     {id: 'a', title: 'Room A'},
                //     {id: 'b', title: 'Room B'}
                // ],
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'resourceTimeGridDay,resourceTimeGridWeek,dayGridMonth'
                },
                events: "{{ route('calendar.getevents') }}",
                dateClick: function (info) {
                    var start = moment(info.dateStr).format('YYYY-MM-DD\THH:mm');
                    var end = moment(info.dateStr).add(30, 'minutes').format('YYYY-MM-DD\THH:mm');

                    document.getElementById('create-start').value = start;
                    document.getElementById('create-end').value = end;

                    var myModal = new bootstrap.Modal(document.getElementById('modal-create'))
                    myModal.show()
                },
                eventClick: function (info) {
                    let id_event = info.event._def['publicId'];
                    let _token = document.getElementsByName("_token")[0].value;
                    document.getElementById('id').value = id_event;

                    $.ajax({
                        method: "get",
                        url: SITEURL  + '/calendar/' + id_event + '/edit',
                        data: {
                            _token: _token
                        },
                        success: function (response) {
                            document.getElementById('update-title').value = response.data.title;
                            document.getElementById('update-description').value = response.data.description;
                            document.getElementById('update-start').value = response.data.start;
                            document.getElementById('update-end').value = response.data.end;
                            document.getElementById('update-color').value = response.data.color;
                            // document.getElementById('update-resource').value = response.data.resourceId;
                            // document.getElementById('update-status').value = response.data.status;

                            var myModal = new bootstrap.Modal(document.getElementById('modal-update'))
                            myModal.show()
                        }
                    });
                },
                eventDrop: function (info) {
                    if (!confirm("Você solicitou a alteração: " + info.event.title +
                        "\nO evento será alterado para a data: " + moment(info.event.startStr).format(
                            'DD-MM-YYYY HH:mm:ss')))
                    {
                        info.revert();
                    } else {
                        console.log(info)
                        let id_event = info.event._def['publicId'];
                        let _token = document.getElementsByName("_token")[0].value;
                        let start = moment(info.event.startStr).format('YYYY-MM-DD\THH:mm');
                        let end = moment(info.event.endStr).format('YYYY-MM-DD\THH:mm');
                        // let resource = info.event._def.resourceIds[0];
                        $.ajax({
                            url: "{{route('calendar.dropevents')}}",
                            method: "post",
                            data: {
                                id: id_event,
                                // resourceId:resource,
                                start: start,
                                end: end,
                                _token: _token
                            },
                            success: function (result) {
                               alert('deu bom');
                            }
                        });
                    }
                },
                eventResize: function (info) {
                    let id_event = info.event._def['publicId'];
                    let _token = document.getElementsByName("_token")[0].value;
                    let end = moment(info.event.endStr).format('YYYY-MM-DD\THH:mm');

                    $.ajax({
                        url: "{{route('calendar.resizeevents')}}",
                        method: "post",
                        data: {
                            id: id_event,
                            end: end,
                            _token: _token
                        },
                        success: function (result) {
                            alert("atualização ok");
                        }
                    });
                },
            });
            calendar.render();
        });

    </script>
    <style>
        .dot {
          height: 15px;
          width: 15px;
          background-color: #bbb;
          border-radius: 50%;
          display: inline-block;
          margin-left: 20px;
        }
        </style>
</head>
<body>
    <div class="card">
        {{-- <div class="card-header p-5 pt-2"> --}}
            
            <div class="text-start pt-1">
                <p class="text-lg mb-0 text-capitalize" style="font-weight: bold; margin-left: 10px; padding: 5px">Keterangan:</p>
                <span class="dot" style="background-color: red"></span>
                <p style="margin-top: -28px; margin-left: 55px">: Kegiatan untuk seluruh siswa</p>
                <span class="dot" style="background-color: black"></span>
                <p style="margin-top: -29px; margin-left: 55px">: Kegiatan untuk Toddler</p>
                <span class="dot" style="background-color: blue"></span>
                <p style="margin-top: -30px; margin-left: 55px">: Kegiatan untuk Playgroup</p>
                <span class="dot" style="background-color: green"></span>
                <p style="margin-top: -31px; margin-left: 55px">: Kegiatan untuk Kindy</p>
                
                {{-- <h4 class="mb-0">{{$total_kelas}}</h4> --}}
            </div>
        {{-- </div> --}}
    </div>
<div id='calendar'></div>

@if(auth()->user()->role === 'admin')
{{--Modal Create--}}
<div class="modal fade" id="modal-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" {{ auth()->user()->role !== 'admin' ? ' style=display:none;' : '' }}{{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>Tambah Kegiatan</h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" {{ auth()->user()->role !== 'admin' ? ' style=display:none;' : '' }}{{ auth()->user()->role !== 'admin' ? 'disabled' : '' }} ></button>
            </div>
            <form method="post" action="{{route('calendar.store')}}" {{ auth()->user()->role !== 'admin' ? ' disabled' : '' }}>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text"  class="form-control" id="create-title" name="title"
                               aria-describedby="emailHelp" required >
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="create-description" name="description"
                               aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Warna</label>
                        <input type="color" name="color" class="form-control form-control-color"
                               id="create-color" value="#563d7c"
                               title="Choose your color" required>
                    </div>
                    <div class="mb-3">
                        <label for="datetime-local">Tanggal Mulai</label>
                        <input type="datetime-local" class="form-control" id="create-start" name="start" required>
                    </div>
                    <div class="mb-3">
                        <label for="datetime-local">Tanggal selesai</label>
                        <input type="datetime-local" class="form-control" id="create-end" name="end" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"{{ auth()->user()->role !== 'admin' ? ' style=display:none;' : '' }}{{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

{{--Modal Update--}}
<div class="modal fade" id="modal-update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" {{ auth()->user()->role !== 'admin' ? ' style=display:none;' : '' }}{{ auth()->user()->role !== 'admin' ? 'disabled' : '' }} ></button>
            </div>
            <form method="POST" action="{{route('calendar.updateevents')}}">
                @method('PUT')
                @csrf
                <input type="hidden" id="id" name="id" value="">
                <div class="modal-body">
                   
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text"  class="form-control" id="update-title" name="title"
                               aria-describedby="emailHelp" required {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>
                    </div>


                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="update-description" name="description"
                               aria-describedby="emailHelp" required {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Warna</label>
                        <input type="color" name="color" class="form-control form-control-color"
                               id="update-color"
                               title="Choose your color" required {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>
                    </div>
                    <div class="mb-3">
                        <label for="datetime-local">Tanggal mulai</label>
                        <input type="datetime-local" {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }} class="form-control" id="update-start" name="start" required>
                    </div>
                    <div class="mb-3">
                        <label for="datetime-local" >Tanggal selesai</label>
                        <input type="datetime-local" {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }} class="form-control" id="update-end" name="end" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"{{ auth()->user()->role !== 'admin' ? ' style=display:none;' : '' }}{{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


{{-- Full Calendar v5 --}}
<script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.js'></script>

{{-- Moment JS--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>


@endsection