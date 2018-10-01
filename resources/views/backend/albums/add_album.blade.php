@extends ('backend.partials.layout')

@section('title', 'Add New Car Album')
@section('content-body-head', 'Cars')
@section('breadcrumb-list')
    <li><span>Cars</span></li>
    <li><span>Add Car Album</span></li>
@stop

@push('styles')
    <style>
        .cancel {
            color: rgba(0, 0, 0, .4);
            cursor: pointer;
        }

        .cancel:hover {
            color: rgba(0, 0, 0, .7);
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
                                <button id="upload-btn" type="button" class="mb-xs mt-xs mr-xs btn btn-xs btn-default">
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
                                <ul class="list-group" id="fileList">
                                    <li class="list-group-item">No files</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group"><label for=""
                                                       class="col-md-3 hidden-sm hidden-xs  control-label"></label>
                            <div class="col-md-6">
                                <button id="submit" class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@stop


@push('scripts')
    <script>
        var fileArray = [];
        //open file select
        $('#upload-btn').on('click', function () {
            if ($('#photos')) {
                $('#photos').click();
            }
        });

        $('#photos').on('change', function () {
            fileArray = [];
            //get the input and UL list
            var input = document.getElementById('photos');

            //empty list for now...
            var list = clearList();

            //Creating new Array of files
            for (var i = 0; i < input.files.length; i++) {
//                var file = new FileReader();
//                file.readAsDataURL(input.files[i]);
                fileArray.push(input.files[i]);
            }


            //for every file...
            for (var x = 0; x < fileArray.length; x++) {
                //add to list
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
            var index = e.currentTarget.getAttribute('data-index');
            fileArray.splice(index, 1);

            var list = clearList();

            for (var x = 0; x < fileArray.length; x++) {
                //add to list
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
            }
        }

        $('#submit').on('click', function (e) {
            e.preventDefault();
            var fileLength = fileArray.length,
                _csrf = $('meta[name=csrf]').attr('content'),
                car_id = $('#car_id').val();

            if (!fileLength) {
                console.log('You have selected ' + fileLength + ' files');
            }

            var al = $('#album')
            var formData = new FormData();
            for (var y = 0; y < fileLength; y++) {
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
                    console.log(data)
                },
                error: function (err) {
                    console.dir(err)
                }
            });
        });
    </script>
@endpush