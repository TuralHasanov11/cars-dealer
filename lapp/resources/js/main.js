import $ from 'jquery';
import jQuery from 'jquery';
import axios from 'axios';

$(document).ready(()=>{


        $('#searchBrandAdvanced').on('change', function(e){
          let brand = $(e.currentTarget).val()
          let models=[];
            let options='<option>Bütün Modellər</option>';
            if(Array.isArray(brand) && brand.length === 1 && brand[0]!=''){
                getModelsOfBrand(brand[0]).then((res)=>{
                    $('#searchCarModelAdvanced').removeAttr('disabled');
                    models=res;
                    console.log(models);
                    $(models).each((index, model)=>{
                        options+=`<option value="${model.id}">${model.name}</option>`;
                      
                    });
                    $('#searchCarModelAdvanced').html(options);
                });
            } else{
                $('#searchCarModelAdvanced').html('<option>Bütün Modellər</option>').addAttr('disabled');
            }
        });

      $('#searchBrands').on('change',(e)=>{
          let brand = $(e.currentTarget).val();
          
          if(brand!=''){
            let models=[];
            let options='<option value="">Bütün Modellər</option>';
            getModelsOfBrand(brand).then((res)=>{
                $('#searchCarModels').removeAttr('disabled');
                models=res;
                $(models).each((index, model)=>{
                    options+=`<option value="${model.id}">${model.name}</option>`;
                });
                $('#searchCarModels').html(options);
                console.log(options);
            });
          } else{
            // $('#carModel').addAttr('disabled');
            $('#searchCarModels').html('<option value="">Bütün Modellər</option>');
          }
      });    


    $('#brand').on('change',(e)=>{
        let brand = $(e.currentTarget).val();
        let models=[];
        let options='<option value="">Model seçin</option>';
        getModelsOfBrand(brand).then((res)=>{
            $('#carModel').removeAttr('disabled');
            models=res;
            $(models).each((index, model)=>{
                options+=`<option value="${model.id}">${model.name}</option>`;
            });
            $('#carModel').html(options);
        });
    });

    async function getModelsOfBrand(brand) {
        try {
          const response = await axios.get(`/brands/${brand}/models`);
          return response.data;
        } catch (error) {
          console.error(error);
        }
      }




    //   Scroll Effect
    $("a.scroll-link").on('click', function(event) {

        if (this.hash !== "") {
          event.preventDefault();
    
          var hash = this.hash;
  
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){
       
            window.location.hash = hash;
          });
        } 
      });


    // Multiple Options Select
    jQuery.fn.multiselect = function() {
      $(this).each(function() {
          var checkboxes = $(this).find("input:checkbox");
          checkboxes.each(function() {
              var checkbox = $(this);
              // Highlight pre-selected checkboxes
              if (checkbox.prop("checked"))
                  checkbox.parent().addClass("multiselect-on");
   
              // Highlight checkboxes that the user selects
              checkbox.click(function() {
                  if (checkbox.prop("checked"))
                      checkbox.parent().addClass("multiselect-on");
                  else
                      checkbox.parent().removeClass("multiselect-on");
              });
          });
      });
    };

    $(".multiselect").multiselect();
});