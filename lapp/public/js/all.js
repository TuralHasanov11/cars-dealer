import Axios from 'axios';
import $ from 'jquery';
import axios from 'axios';

$(document).ready(()=>{
    let selectedBrand=document.getElementById('brand');
    selectedBrand.addEventListener('change',(e)=>{
        let brand = $(e.currentTarget).val();
        let models = getModelsOfBrand(brand);
        $('#model').html(models);
    });
    console.log(selectedBrand);

    async function getModelsOfBrand(brand){
        const models = await axios.get(`brands/${brand}/models`);

        return models.data;
    }
});