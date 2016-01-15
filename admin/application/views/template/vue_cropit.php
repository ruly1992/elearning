<template id="cropit-preview">
    <div class="cropit-wrapper">
        <div class="image-preview image-{{ name }} center">
            <img src="{{ imageSrc }}" width="{{ width }}" height="{{ height }}" class="img img-responsive img-thumbnail">
        </div>
        <div class="form-group" v-show="inputDescription">
            <textarea class="form-control" placeholder="Keterangan gambar" v-model="description"></textarea>
        </div>
        <div class="cropit-button center">
            <slot name="button-select">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cropit-{{ name }}">Select Image</button>
            </slot>
            <slot name="button-remove">
                <button type="button" class="btn btn-danger btn-margin-btm" v-on:click="remove">Remove</button>
            </slot>
        </div>
    </div>
</template>

<template id="cropit-result">
    <input type="hidden" name="{{ name }}[src]" value="{{ imageSrc }}">
    <input type="hidden" name="{{ name }}[action]" value="{{ action }}">
    <input type="hidden" name="{{ name }}[description]" value="{{ description }}">
</template>

<template id="cropit-cropper">
    <div class="cropit-cropper cropit-{{ name }}">
        <div class="cropit-image-preview-container">
            <div class="cropit-image-preview" style="width: {{ width }}px; height: {{ height }}px;">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
        </div>

        <div class="slider-wrapper">
            <input type="range" class="cropit-image-zoom-input">
        </div>
    
        <input type="file" class="cropit-image-input" style="display: none;">
        <button type="button" class="btn btn-primary file-btn">
            <span>Browse</span>
        </button>
    </div>
</template>