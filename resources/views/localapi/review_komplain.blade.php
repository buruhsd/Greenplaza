<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Review Produk</h4>
        </div>
        {!! Form::open(['url' => route('member.komplain.review_komplain', $item->id), 'method' => 'POST', 'id' => 'addaddress']) !!}
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="review_user_id" type="text" value="{{Auth::id()}}" placeholder="user" hidden />
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('size') ? 'has-error' : ''}}">
                                {!! Form::label('review_stars', ' : ', ['class' => 'col-md-12 control-label']) !!}
                                <div class="col-md-12">
                                    <div class="btn-group" data-toggle="buttons">
                                        @for($i=1;$i<=5;$i++)
                                            <label class="border1 btn btn-default">
                                                <input type="radio" name="review_stars" value="{{$i}}" autocomplete="off">
                                                    {{$i}}<i class="fa fa-star"></i> <span class="check glyphicon glyphicon-ok"></span>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('review_text') ? 'has-error' : ''}}">
                                    {!! Form::textarea('review_text', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Komentar', 
                                        'cols' => 30,
                                        'rows' => 3,
                                        'required'
                                    ])!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
            <input type="submit" class="btn btn-success" value="Simpan">
        </div>
        {!! Form::close() !!}
    </div>
</div>