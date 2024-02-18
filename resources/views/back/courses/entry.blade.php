<div id="{{ $index }}">
    <div class="form-group">
        <label for="title" class="col-sm-12 col-form-label">Judul <span class="text-red">*</span></label>
        <div class="col-sm-12">
            <input type="text" name="title" id="title{{ $index }}" class="form-control"
                placeholder="Judul Course" value="{{ $model->exists ? $model->title : old('title') }}">
            @error('title')
                <small class="text-red">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="short_description" class="col-sm-12 col-form-label">Deskripsi Singkat<span
                class="text-red">*</span></label>
        <div class="col-sm-12">
            <textarea name="short_description" rows="5" class="form-control" id="short_description{{ $index }}"
                placeholder="Deskripsi Singkat">{{ $model->exists ? $model->short_description : old('short_description') }}</textarea>
            @error('short_description')
                <small class="text-red">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="content" class="col-sm-12 col-form-label">Konten <span class="text-red">*</span></label>
        <div class="col-sm-12">
            <textarea name="content" class="summernote" id="content{{ $index }}" rows="5">
                {{ $model->exists ? $model->content : old('content') }}
            </textarea>
            @error('content')
                <small class="text-red">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
    </div>
</div>
