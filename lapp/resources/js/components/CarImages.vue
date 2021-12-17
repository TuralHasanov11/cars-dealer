<template>
    <div id="modalImagesContainer" class="row justify-content-start">
        <div v-for="(image, key, index) in images" @click="slideImage(index+1)" class="col-6 col-md-4 my-2" 
            data-toggle="modal" data-target="#imagesModal">
            <div class="car-image-container">
                <img class="car-image hover-shadow" :src="'/'+image.url" alt="">
            </div>
        </div>

        <div class="modal fade" id="imagesModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-dark p-2">
                    <div class="modal-header ">
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div v-for="(image, key, index) in images" class="modal-slide bg-dark" :ref="`modalSlides`">
                        <img class="slide-image" :src="'/'+image.url">
                    </div>
                    <div class="modal-footer">
                        <div class="text-white">{{this.selectedImage}} / {{Object.keys(images).length}}</div>
                    </div>
                    <div class="modal-prev" @click="plusSlides(-1)">&#10094;</div>
                    <div class="modal-next" @click="plusSlides(1)">&#10095;</div>     
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    props:{
        images:{
            // type:Array,
            default:[],
        },
        car:{
            // type:Number,
            default:null,
        }
    },

    data(){
        return {
            slideIndex:1,
            showModal:false,
            selectedImage:null,
        }
    },

    methods:{
        plusSlides(n) {
            this.showSlides(this.slideIndex += n);
        },
        closeModal() {
            this.$refs['images-modal'].hide();
        },
        openModal() {
            this.$refs['images-modal'].show();
        },
        slideImage(index){
            this.currentSlide(index);
        },
        currentSlide(n) {
            this.showSlides(this.slideIndex = n);
        },

        showSlides(n) {
            if (n > Object.keys(this.images).length) {
                this.slideIndex = 1
            }
            if (n < 1) {
                this.slideIndex = Object.keys(this.images).length;
            }
            for (let i = 0; i < Object.keys(this.images).length; i++) {
               
                this.$refs.modalSlides[i].style.display='none';
            }
            this.selectedImage=this.slideIndex;
            this.$refs.modalSlides[this.slideIndex-1].style.display='block';

        }
    }
}
</script>

<style>

.modal-close:hover,
.modal-close:focus {
    color: #999;
    text-decoration: none;
    cursor: pointer;
}

.modal-prev,
.modal-next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 1rem;
    margin-top: -50px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    transition: 0.6s ease !important;
    border-radius: 0 3px 3px 0;
    user-select: none;
    -webkit-user-select: none;
}

.modal-next {
    right: 0;
    border-radius: 3px 0 0 3px;
}

.modal-prev:hover,
.modal-next:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

.modal-slide {
    display: none;
    cursor: pointer;
    width: 100%;
    padding-top: 56.25%;
    overflow: hidden;
    position: relative;
}

img.slide-image {
    width: 100%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    /* width: 100% !important;
    height: 100%; */
}

img.hover-shadow {
    transition: 0.3s;
}

.hover-shadow:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}



</style>