$('.popat_ac').click(function (){
    const ders_id = $(this).attr('id');
    console.log(ders_id);
    $('#post-ders-id').val(ders_id);
    $('#bolge').text(ders_id+" BÖLGESİ");
    $('.mesaj').show();
    $('.message').position('fixed');
})

$('#yorum_kapat').click(function (){
    $('.mesaj').hide();
})
