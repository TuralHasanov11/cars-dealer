<template>
    <div class="row my-5 justify-content-between">
        <div class="col-12 col-md-6 col-lg-3">
            <h3 class="text-primary">Daha tez sat :</h3>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <button class="btn btn-outline-primary" @click="makeForward">Elanı irəli çək</button>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <button class="btn btn-outline-primary" @click="makeVip">Elanı VIP et</button>
        </div>

    </div>
   
</template>

<script>
export default {
    props:{
        vipUrl:{
            default:null
        },
        forwardUrl:{
            default:null
        }
    },

    methods:{
        makeVip(){

        },
        makeForward(){
            
        }
    }
}
</script>
