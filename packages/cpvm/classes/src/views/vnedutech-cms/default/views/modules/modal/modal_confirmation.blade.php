<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="user_delete_confirm_title">{{ trans('vne-classes::confirm.' . $model .'.'.$type. '.title') }}</h4>
</div>
<div class="modal-body">
    @if($error)
        <div>{!! $error !!}</div>
    @else
        {{ trans('vne-classes::confirm.' . $model . '.' . $type . '.body') }}
    @endif
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('vne-classes::confirm.cancel') }}</button>
  @if(!$error)
    <a href="{{ $confirm_route }}" type="button" class="btn btn-danger">{{ trans('vne-classes::confirm.confirm') }}</a>
  @endif
</div>
