@extends('admin.layouts.container')
@section('title', 'Manajemen Media')
@section('title_description', 'Form Album Foto')
@section('css')
    <link href="{{ URL::to('/engine/multiSelect/css/multi-select.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('/engine/adminLTE/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/adminLTE/dist/css/skins/skin-red.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .img-container {
            position: relative;
            width: 100%%;
            height: 100%;
            max-width: 250px;
        }

        .image {
            display: block;
            width: 100%;
            height: auto;
        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: auto;
            opacity: 0;
            transition: .3s ease;
        }

        .img-container:hover .overlay {
            opacity: 90%;
        }

        .icon {
            color: white;
            font-size: 30px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .fa-trash:hover {
            color: #e2001d;
        }


        div.gallery img {
            width: 100%;
            height: auto;
        }

        div.desc {
            padding: 15px;
            text-align: center;
        }

        * {
            box-sizing: border-box;
        }

        .responsive {
            margin-top: 6px;
            padding: 6px;
            float: left;
            width: 24.99999%;
        }

        @media only screen and (max-width: 700px) {
            .responsive {
                width: 49.99999%;
                margin: 6px 0;
            }
        }

        @media only screen and (max-width: 500px) {
            .responsive {
                width: 100%;
            }
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        .modal-dialog {
            margin-top: 10%;
        }


    </style>

@stop
@section('body-class', 'skin-red')
@section('content')
    <div class="row">
        <div class="col-md-12">

            @if(session('msg') != null)
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
                    {{session('msg')}}
                </div>
            @endif


            <div class="box box-info">

                @if($album != null)
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Data Album::{{$album->nama_album}}</h3>
                    </div>

                @else
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Add Data Album</h3>
                    </div>
                @endif


                @if($album != null)
                    <form action="{{URL::route('galleryFotoUpdate')}}" method="POST">
                        <input type="hidden" name="id_album" value="{{$album->id_album}}">
                        @else
                            <form action="{{URL::route('galleryFotoSave')}}" method="POST">
                                @endif

                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class="form-horizontal col-md-12">

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Nama Album</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="nama_album"
                                                       value="{{$album != null ? $album->nama_album : ''}}">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Nama Album Bahasa Inggris</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="nama_album_eng"
                                                       value="{{$album != null ? $album->nama_album_eng : ''}}">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="box-footer">
                                    <a href="{{URL::route('galleryFoto')}}"><button type="button" class="btn btn-default">Cancel</button></a>
                                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                                </div>
                            </form>
                    </form>
            </div>

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Galery Foto</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalAddFoto"><i class="fa fa-plus"></i> Tambah Foto</button>
                    </div>
                </div>

                <div class="box-body">
                    @if($foto != null)
                        @if(count($foto) > 0)
                            @foreach($foto as $idx => $foto_item)
                                <div class="responsive">
                                    <div class="gallery">
                                        <div class="img-container">
                                            <img src="{{URL::to('storage/uploads/album/'.$foto_item->file)}}"
                                                 class="image"/>
                                            <div class="overlay">
                                                <a href="{{ URL::route('uploadFotoDelete', [$album->id_album, $foto_item->id_foto]) }}" class="icon" title="User Profile">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif

                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modalAddFoto" tabindex="-1" role="dialog" aria-labelledby="modalAddFoto" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <form id="frmUploadFoto" action="{{URL::route('uploadFotoSave')}}" method="POST">
                <div class="modal-body">

                        <input type="hidden" name="id_album" value="{{$album != null ? $album->id_album : ''}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputFile">Tambah File Foto</label>
                            <div class="needsclick dropzone" id="document-dropzone">


                            </div>
                            <p class="help-block">Harap Mengunggah File Dengan Ekstensi <b>.jpg .png .jpeg</b> dengan ukuran maksimum <b>2 Mb</b> .</p>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button id="btnUploadSave" type="submit" class="btn btn-primary" disabled>Simpan</button>
                </div>

                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ URL::to('/engine/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('/engine/fastclick/fastclick.min.js') }}"></script>
    <script src="{{ URL::to('/engine/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::to('/engine/dropzone/dist/min/dropzone.min.js') }}" type="text/javascript"></script>

            <script type="text/javascript">
                var uploadedDocumentMap = {}
                const maxFiles = 10
                Dropzone.options.documentDropzone = {
                    url: '{{ URL::route('uploadFoto') }}',
                    acceptedFiles: '.png,.jpeg,.jpg',
                    maxFilesize: 2, // MB
                    addRemoveLinks: true,
                    dictInvalidFileType: "Invalid File Type",
                    dictMaxFilesExceeded: "Only "+maxFiles+" files are allowed",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function (file, response) {
                        $('#frmUploadFoto').append('<input type="hidden" name="foto[]" value="' + response.name + '">')
                        uploadedDocumentMap[file.name] = response.name
                        $('#btnUploadSave').attr('disabled', false);
                        console.log(response.name)
                    },
                    removedfile: function (file) {
                        file.previewElement.remove()
                        var name = ''
                        if (typeof file.file_name !== 'undefined') {
                            name = file.file_name
                        } else {
                            name = uploadedDocumentMap[file.name]
                        }
                        $('#frmUploadFoto').find('input[name="document[]"][value="' + name + '"]').remove()
                    },
                    error: function(errorMessage){
                        $('#btnUploadSave').attr('disabled', true);
                        console.log(errorMessage)
                    },
                    init: function () {
                        @if(isset($fotoUploaded) && $fotoUploaded->file)
                            var files = {!! json_encode($fotoUploaded->file) !!}
                            for (var i in files) {
                                var file = files[i]
                                this.options.addedfile.call(this, file)
                                file.previewElement.classList.add('dz-complete')
                                $('#frmUploadFoto').append('<input type="hidden" name="foto[]" value="' + file.file_name + '">')

                            }
                        @endif
                    }
                }

            </script>
@stop
