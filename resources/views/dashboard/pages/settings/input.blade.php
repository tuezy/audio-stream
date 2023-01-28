<div class="row align-items-center mb-3">
    <div class="col-lg-2">
        <label for="{{$config['key']}}" class="form-label">{{ __($config['title']) }}</label>
    </div>
    <div class="col-lg-10">
        @if(in_array($config['type'], ['text', 'integer', 'double']))
            <div class="input-group">
                <input name="{{ $config['key'] }}"
                       type="{{ $config['type']}}" class="form-control"
                       id="{{$config['key']}}"
                       value="{{ core()->getSetting($config['key'])}}"
                >
                @isset($config['with'])
                    <span class="input-group-text">{{ $config['with'] }}</span>
                @endisset
            </div>
        @endif
        @if(in_array($config['type'], ['boolean']))
                <div class="form-check form-switch">
                    <input name="{{ $config['key'] }}"
                           class="form-check-input"
                           type="checkbox"
                           role="switch"
                           id="{{$config['key']}}"
                        {{ core()->getSetting($config['key']) == 'false' ? '' : 'checked' }}>
                </div>
        @endif
    </div>
</div>
