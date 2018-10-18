@extends ('backend.partials.layout')

@section('title', 'Add New Car Album')
@section('content-body-head', 'Cars')
@section('breadcrumb-list')
    <li><span>Cars</span></li>
    <li><span>Add Car Album</span></li>
@stop

@push('styles')
    <style>
        .table > tbody > tr > td {
            vertical-align : middle !important;
        }

        .image-list{
            display: none;
        }

        .cancel {
            color  : rgba(0, 0, 0, .4);
            cursor : pointer;
        }

        .cancel:hover {
            color : rgba(0, 0, 0, .7);
        }
        .pleaseWait {
            background: rgba(130, 5, 26, 0.92);
            height: 100%;
            left: 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 102;
        }
        .pleaseWait::after {
            color: white;
            content: attr(data-content);
            font-family: 'Poppins', sans-serif;
            font-size: 2rem;
            font-weight: 600;
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
@endpush

{{-- this template has pushed scripts at the bottom of this file --}}

@section('content-body')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Add Car Album</h2>
                </header>
                <div class="panel-body">
                    @if($errors->any())
                        <h3 class="text-danger">Sorry!</h3>
                        <p>{{ $errors->first() }}</p>
                    @else
                        <form id="album" name="album" action="{{ route('store-album') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <input id="car_id" type="hidden" value="{{ $car_id }}">

                            {{--Brand Name--}}
                            <div class="form-group {{$errors->has('photos')? 'has-error' : ''}}">
                                <label class="col-md-3 control-label" for="photos">
                                    Upload Images
                                </label>
                                <div class="col-md-6">
                                    <button id="upload-btn" type="button"
                                            class="mb-xs mt-xs mr-xs btn btn-xs btn-default">
                                        Click to select image(s)
                                    </button>
                                    <input name="photos[]"
                                           value="{{ old('photos') }}"
                                           type="file"
                                           accept="image/*"
                                           class="form-control"
                                           id="photos"
                                           style="display: none;"
                                           multiple
                                    >

                                    @if ($errors->has('photos'))
                                        <span class="help-block">{{$errors->first('photos')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group file-list-container">
                                <label for="" class="col-md-3 control-label">Selected Files</label>
                                <div class="col-md-6">
                                    <h4 class="no-image">No images selected</h4>
                                    <div class="table-responsive image-list">
                                        <table class="table mb-none">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Image Preview</th>
                                                    <th class="text-center">Image Name</th>
                                                    <th class="text-center">Make Cover</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="fileList">
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--<ul class="list-group" id="fileList">--}}
                                    {{--<li class="list-group-item">No files</li>--}}
                                    {{--</ul>--}}
                                </div>
                            </div>

                            <div class="form-group"><label for=""
                                                           class="col-md-3 hidden-sm hidden-xs  control-label"></label>
                                <div class="col-md-6">
                                    <button id="submit" class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </section>
        </div>
    </div>
@stop


@push('scripts')
    <script>
        var fileArray = [];
        var fileNameArray = [];
        //open file select
        $('#upload-btn').on('click', function () {
            if ($('#photos')) {
                $('#photos').click();
            }
        });

        // After Selecting file(s)
        $('#photos').on('change', function () {
            $('.no-image').css('display', 'none');
            $('.image-list').css('display', 'block');
            //get the input and UL list
            var input = document.getElementById('photos');

            //empty list for now...
            var list = clearList();

            //Creating new Array of files
            for (var i = 0; i < input.files.length; i++) {
                fileArray.push(input.files[i]);
                fileNameArray.push(input.files[i].name);
            }
            var count = fileNameArray.length;
            for (var z = 0; z < count; z++) {
                var fIndex = fileNameArray.indexOf(fileNameArray[z]);
                var lIndex = fileNameArray.lastIndexOf(fileNameArray[z]);

                if (fIndex == lIndex) {
                    continue;
                }
                fileNameArray.splice(z, 1);
                fileArray.splice(z, 1);
                z = 0;
                count = fileNameArray.length;
            }


            //for every file...
            for (var x = 0; x < fileArray.length; x++) {
                //add to list
                create_list(list, x);
            }
        })

        function clearList() {
            var list = document.getElementById('fileList');
            //empty list for now...
            while (list.hasChildNodes()) {
                list.removeChild(list.firstChild);
            }
            return list;
        }

        function handleCancel(e) {
            var index = $(this).closest('tr').data('index');
            fileArray.splice(index, 1);
            fileNameArray.splice(index, 1);

            var list = clearList();

            for (var x = 0; x < fileArray.length; x++) {
                //add to list
                create_list(list, x);
            }
            if(fileArray.length <1){
                $('.no-image').css('display', 'block');
                $('.image-list').css('display', 'none');
            }
        }

        function create_list(list, x) {
            var tr = document.createElement('tr');
            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            var td4 = document.createElement('td');
            var img = document.createElement('img');
            var radio = document.createElement('input');
            var span = document.createElement('span');

            td1.className = 'text-center';
            td2.className = 'text-center';
            td3.className = 'text-center';
            td4.className = 'text-center';
            radio.className = 'is_featured';
            span.className = 'cancel';


            td2.innerHTML = fileArray[x].name;
            span.innerHTML = "<i class='fa fa-close'></i>";

            tr.setAttribute('data-index', x);
            img.setAttribute('src', '');
            img.setAttribute('height', '80');
            span.addEventListener('click', handleCancel, false);
            radio.setAttribute('name', 'is_featured');
            radio.setAttribute('type', 'radio');
            if (x == 0) {
                radio.setAttribute('checked', 'checked')
            }

            list.append(tr);
            tr.append(td1);
            tr.append(td2);
            tr.append(td3);
            tr.append(td4);
            td1.append(img);
            td3.append(radio);
            td4.append(span);

            var fileReader = new FileReader();
            var image = $('#preview_' + x);
            fileReader.addEventListener('load', function () {
                img.src = fileReader.result;
            }, false);
            if (fileArray[x]) {
                fileReader.readAsDataURL(fileArray[x]);
            }
            /*
                var li = document.createElement('li');
                li.className = 'list-group-item';
                li.innerHTML = fileArray[x].name
                list.append(li);

                var span = document.createElement('span');
                span.className = 'pull-right cancel';
                span.setAttribute('data-index', x);
                span.innerHTML = "<i class='fa fa-close'></i>"
                span.addEventListener('click', handleCancel, false)
                li.append(span);
            */
        }

        $('#submit').on('click', function (e) {
            e.preventDefault();
            activateWait();
            var fileLength = fileArray.length,
                _csrf = $('meta[name=csrf]').attr('content'),
                car_id = $('#car_id').val(),
                is_featured = $('.is_featured');


            if (fileLength < 1) {
                console.log('You have selected ' + fileLength + ' files');
                return;
            }

            var al = $('#album')
            var formData = new FormData();
            for (var y = 0; y < fileLength; y++) {
                var featVal = (is_featured[y].checked) ? 1 : 0;
                formData.append('feat-' + y, featVal);
                formData.append('img-' + y, fileArray[y]);

            }
            formData.append('total_files', fileLength);
            formData.append('car_id', car_id);

            $.ajax({
                url: "/cars/albums/add-album",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': _csrf,
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data == 1) {
                        var waitDiv = $('.pleaseWait');
                        waitDiv.attr('data-content', 'Successfully Uploaded');
                        setTimeout(function(){
                            deactivateWait()
                            window.location.replace("{{ route('albums') }}")
                        }, 2000)
                    }
                },
                error: function (err) {
                    var waitDiv = $('.pleaseWait');
                    waitDiv.attr('data-content', 'Failed to Upload')
                    setTimeout(function(){
                        deactivateWait()
                    }, 2000)
                }
            });
        });

        function activateWait(){
            var body = document.getElementsByTagName('body');
            var div = document.createElement('div');
            div
                .classList
                .add('pleaseWait');
            div.setAttribute('data-content', 'Please Wait...');
            body[0].appendChild(div);
            body[0].style.overflow = 'hidden';
        }

        function deactivateWait(){
            var body = $('body');
            body.remove('.pleaseWait');
            body.removeAttr('style');
        }
    </script>
@endpush