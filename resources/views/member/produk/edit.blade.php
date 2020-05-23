@extends('member.index')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
    <style type="text/css">
    img#image {
      display: block;
      max-width: 100%;
    }
    .preview {
      overflow: hidden;
      width: 160px; 
      height: 160px;
      margin: 10px;
      border: 1px solid red;
    }
    .modal-lg{
      max-width: 1000px !important;
    }
    </style>
@endsection
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Configuration Produk</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
        <section id="main-content">
            <section class="wrapper">
            <div class="panel panel-white">
                <div class="panel-body">
                <a href="{{ url('/member/produk') }}" title="Back">
                	<button class="btn btn-warning btn-xs">
                		<i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                	</button>
                </a>
                <br />
                <br />
                {!! Form::model($produk, [
                    'method' => 'PATCH',
                    'url' => ['/member/produk/update', $produk->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}
                {!! Form::open(['url' => '/member/produk/store', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @include ('member.produk.form')
                {!! Form::close() !!}
                </div>
            </div>
          </section>
        </section>
        </div><!-- Row -->
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Laravel Crop Image Before Upload using Cropper JS - NiceSnippets.com</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="img-container">
                <div class="row">
                    <div class="col-md-8">
                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                    </div>
                    <div class="col-md-4">
                        <div class="preview"></div>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="crop">Crop</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
<script>
            var $modal = $('#modal');
            var image = document.getElementById('image');
            var cropper;
            var counter = 1;
            var canvas;
            var url;
            var reader2;
            var file2;
            var dataImage = [];
            var resid;
              
            function changemage(e){
                resid = e.id.replace("img-input", "");
                var files = e.files;
                var done = function (url) {
                  image.src = url;
                  crops(e);
                };

                if (files && files.length > 0) {
                  file2 = files[0];

                  // if (URL) {
                  //   console.log('tes1');
                  //   done(URL.createObjectURL(file));
                  // } else 
                  if (FileReader) {
                    console.log('tes2');
                    reader2 = new FileReader();
                    reader2.onload = function (e) {
                      done(reader2.result);
                    };
                    reader2.readAsDataURL(file2);
                  }
                }
            }

            $modal.on('shown.bs.modal', function () {
                cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
                });
            }).on('hidden.bs.modal', function () {
               cropper.destroy();
               cropper = null;
               url = null;
               reader2 = null;
               file2 = null;
            });

            function crops(e){
              $modal.modal('show');
              $("#crop").click(function(){
                  canvas = cropper.getCroppedCanvas({
                    width: 160,
                    height: 160,
                    });

                  canvas.toBlob(function(blob) {
                      url = URL.createObjectURL(blob);
                      var readerFile = new FileReader();
                       readerFile.readAsDataURL(blob); 
                       readerFile.onloadend = function() {
                          var base64data = readerFile.result; 
                          // console.warn(base64data);
                          var id = $(e).parent().find(".input_file_64")[0].id;
                          console.log(resid, id)
                          if(resid == id){
                              $("input#" + id + ".input_file_64").val(base64data);
                              $("#img-view"+ id).attr('src', base64data);
                          }
                          console.log(base64data);
                          // e.input_file_64 = base64data;
                          // console.log(e.files[0]);
                          $modal.modal('hide');
                       }
                  });
              })
            }

</script>
@endsection
        