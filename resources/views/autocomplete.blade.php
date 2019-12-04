@extends('layouts.app')

@section('title', 'Learn Autocomplete')

@section('contents')
        <div class="form-row">
            <div class="col-sm-12 col-md-6 mx-auto">
                <div class="form-group">
                    <input 
                        class="form-control form-control-lg autocomplete" 
                        id="autocomplete" 
                        placeholder="search city..."
                        type="text"
                        />
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-12 col-md-6 mx-auto">
                     <input 
                        class="form-control form-control-lg autocomplete" 
                        id="cityId" 
                        type="text"
                        />
            </div>
        </div>
    </div>
@endsection


@section('extra-script')
<script>
// ต้องมี key ชื่อ value  ใน json data จึงจะทำงานได้
    // let cities = [
    //     {value:'Australian' , data:'AU'},
    //     {value:'Japan' , data:'JP'},
    //     {value:'Thailand' , data:'TH'},
    // ];

    // $('#autocomplete').autocomplete({
    //     lookup: cities,
    //     onSelect:(suggestion)=>{
    //         alert('You Selected :'+suggestion.value+','+suggestion.data);
    //     }
    // });
        let selectValue = null;
    $('#autocomplete').autocomplete({
        paramName: "search" , //ส่ง req. ไปที่ back-end
        serviceUrl:"{{url('/get-cities')}}",
        dataType:'json',
        transformResult:(response)=>{
            return{
                suggestions: response.map((cityItem)=>{
                    return {
                        value: `ตำบล ${cityItem.district} > อำเภอ ${cityItem.amphoe} > จังหวัด ${cityItem.province} > ${cityItem.zipcode}`,
                        data: cityItem.id
                    }
                })
            }
        },
        onSelect:(suggestion)=>{
            $('#cityId').val(suggestion.data)
            selectValue = suggestion.value
        },
        minChars:3,   //เป็น setting ว่าจะให้ serach เริ่มตั้งแต่ตัวอักษรที่เท่าไร
    });
   // validate string input ถ้าเป็นค่าที่ไม่ตรงกับใน selectValue จะ เคลียเป็น ว่าง
    $('#autocomplete').change(function(){
        if($(this).val() === selectValue) return false;
        $('.autocomplete').val('');
    })
</script>
 @endsection