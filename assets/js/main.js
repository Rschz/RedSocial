$(function () {
  console.log("Ready!");

  //Aplica clase active al menu nav
  try {
      let currPage = document.location.href.match(/[^\/]+$/)[0];
    if (currPage == 'amigos.php') {
        $('.navbar-nav li:nth-child(2)').addClass('active');
    }else{
        $('.navbar-nav li:nth-child(1)').addClass('active');
    }
  } catch (error) {}

  //Modal dinamico
  $("#staticBackdrop").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var content = button.data("whatever");
    var id = button.data("id");
    var modal = $(this);
    modal.find(".modal-body input#edited-publish").val(content);
    modal.find(".modal-body input#id-publish").val(id);
  });

  //Valida que el usuario del amigo agregar tenga valor antes de enviar
  $('#add-friend').click(function (e) { 
    if (!$('#friend-user').val().trim()) {
      $('.modal-body div').show();
      e.preventDefault();
    }
    
  });




});
