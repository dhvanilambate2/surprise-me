@foreach($model->getMedia('gallery') as $media)
    <div class="col-xl-3 col-md-4 col-6">
        <img class="img-thumbnail" src="{{ $media->getUrl() }}" itemprop="thumbnail" alt="Image description">
    </div>
@endforeach