$(function(){
    $('#videoFile').change(ev=>{
        console.log("Hammasi joyida");
        $(ev.target).closest('form').trigger('submit');
    })
});



$(function(){
    $('#imageFile').change(ev=>{
        // console.log($('#imageFile').val().split('\\').pop());
        $('#videos-thumbnail').val($('#imageFile').val().split('\\').pop());
        // $(ev.target).closest('form').trigger('submit');
    })
});
$('#btn_save_img').click(function(){
    console.log('Button bosildi');
});
// $('#imageFile').change(function(){
//     $('#videos-thumbnail').val("Hello");
// }); 